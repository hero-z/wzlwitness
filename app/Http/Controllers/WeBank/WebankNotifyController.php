<?php
/**
 * Created by PhpStorm.
 * User: hero
 * Date: 2017/5/23
 * Time: 14:37
 */

namespace App\Http\Controllers\WeBank;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Member\MemberController as Member;
use App\Http\Controllers\WeBank\WebankUserProfitController;
use App\Models\Order;
use App\Models\PageSets;
use App\Models\WeBankConfig;
use App\Models\WeixinPayConfig;
use App\Models\WeixinPayNotify;
use App\Models\WXNotify;
use EasyWeChat\Foundation\Application;
use function floatval;
use function get_object_vars;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Mockery\CountValidator\Exception;
use Symfony\Component\HttpFoundation\Request;

class WebankNotifyController extends WebankBaseController
{
    public function ali_callback(Request $request){
        Log::info('=========== Webank ali_callback Start =============');
        try{
            if($this->checkSign($request,2)){
                $data=json_decode($request->data,true);
                $order_id=$data['orderId'];
                $order=Order::where('out_trade_no',$order_id)->first();
                if($order&&$order->status!=$data['tradeStatus']){
                    $paystatus=$data['tradeStatus']=='01'?1:3;
                    Order::where('out_trade_no',$order_id)->update([
                        'status'=>$data['tradeStatus'],
                        'total_amount'=>$data['totalAmount'],
                        'pay_status'=>$paystatus
                    ]);
                    if($data['tradeStatus']=='01'){
                        self::notify($order,$data,'支付宝');
                        Member::AddMemberPoint($data,'支付宝');
                    }
                }
            }else{
                Log::info('校验失败');
            }
        }catch (Exception $e){
            Log::error($e);
        }
        Log::info('=========== Webank ali_callback End =============');
        return '200';
    }
    public function wx_callback(Request $request){
        Log::info('=========== Webank wx_callback Start =============');
        Log::info($request->all());
        try{
            if($this->checkSign($request,1)){
                $data=json_decode($request->data,true);
                $order_id=$data['orderId'];
                $order=Order::where('out_trade_no',$order_id)->first();
                if($order&&$order->status!=$data['tradeStatus']){
                    $paystatus=$data['tradeStatus']=='01'?1:3;
                    Order::where('out_trade_no',$order_id)->update([
                        'status'=>$data['tradeStatus'],
                        'total_amount'=>$data['totalAmount'],
                        'trade_no'=>$data['outTradeNo'],
                        'pay_status'=>$paystatus
                    ]);
                    if($data['tradeStatus']=='01'){
                        self::notify($order,$data,'微信');
                        //self::AddMemberPoint($data,'微信');
                        Member::AddMemberPoint($data,'微信');
                    }
                }
            }else{
                Log::info('校验失败');
            }
        }catch (Exception $e){
            Log::error($e);
        }
        Log::info('=========== Webank wx_callback End =============');
        return '200';
    }

    public static function notify($order,$data,$payway='微信')
    {
        Log::info('=========== Webank Notify Start =============');
        Log::info($data);
        Log::info(get_object_vars($order));
/*
        array (//alipay
            'totalAmount' => '0.01',
            'channelNo' => '2017072721001004910293344173',
            'buyerAccount' => 'neo***@163.com',
            'payTime' => '2017-07-27 23:37:16',
            'orderId' => 'b20170727233712737712',
            'outTradeNo' => '17072723371200194182',
            'tradeStatus' => '01',
            'buyerId' => '2088102068067916',
        )
         array (//weixin
          'cashFee' => '0.01',
          'couponFee' => '0',
          'totalAmount' => '0.01',
          'channelNo' => '4003102001201707273016037997',
          'payTime' => '2017-07-27 23:40:22',
          'orderId' => 'b20170727234016132099',
          'bankType' => 'CFT',
          'outTradeNo' => 'U1707272340160000000000003203023',
          'tradeStatus' => '01',
          'buyerId' => 'oJzTrt_-MhnStlLGjpQxgz2vcHnY',
          'isSubscribe' => 'N',
        )

*/
        //微信推送
        $store_id = $order->store_id;
        $order_id = $order->out_trade_no;
        $profit = $order->total_amount;
        $cmd = new WebankUserProfitController();
        $cmd->orderToprofit($order_id,0.25,0.38);
        $WeixinPayNotifyStore = WeixinPayNotify::where('store_id', $store_id)->first();
        //实例化
        //$config = WeixinPayConfig::where('id', 1)->first();
        $config = WeBankConfig::where('id',1)->first();

        if ($WeixinPayNotifyStore&&$config) {
            $options = [
                'app_id' => $config->wx_app_id,
                'secret' => $config->wx_secret,
                'token' => '18851186776',
                'payment' => [
                    'merchant_id' => $config->merchant_id,
                    'key' => $config->key,
                    'cert_path' => $config->cert_path, // XXX: 绝对路径！！！！
                    'key_path' => $config->key_path,      // XXX: 绝对路径！！！！
                    'notify_url' => $config->notify_url,       // 你也可以在下单时单独设置来想覆盖它
                ],
            ];
            Log::info($options);
            $app = new Application($options);
            //$userService = $app->user;
            //$template = $config->template_id;
            $notice = $app->notice;
            $userIds = $WeixinPayNotifyStore->receiver;
            $open_ids = explode(",", $userIds);
            $templateId = $config->template_id;
            $url = $WeixinPayNotifyStore->linkTo;
            $color = $WeixinPayNotifyStore->topColor;
            $markstr='';
            if($order&&!empty($order->remark)){
                $markstr.='(备注:'.$order->remark.')';
            }
            $senddata = array(
                "keyword1" => $order->total_amount,
                "keyword2" => $payway.'(' . $data['buyerId'] . ')'.$markstr,
                "keyword3" => '' . $order->updated_at . '',
                "keyword4" => $data['outTradeNo'],
                "remark" => '祝' . $WeixinPayNotifyStore->store_name . '生意红火',
            );
            /**
             * 发送模板消息
             */
            foreach ($open_ids as $v) {
                $s = WXNotify::where('open_id', $v)->where('store_id', $store_id)->first();
                if ($s) {
                    if ($s->status) {
                        try {
                            $notice->uses($templateId)->withUrl($url)->andData($senddata)->andReceiver($v)->send();
                        } catch (\Exception $exception) {
                            Log::info($exception);
                            continue;
                        }
                    }
                } else {
                    WXNotify::create([
                        'store_id' => $store_id,
                        'open_id' => $v,
                    ]);
                    try {
                        $notice->uses($templateId)->withUrl($url)->andData($senddata)->andReceiver($v)->send();
                    } catch (\Exception $exception) {
                        Log::info($exception);
                        continue;
                    }
                }
            }
        }
        Log::info('=========== Webank Notify End =============');
    }

//    public function AddMemberPoint($data,$payway='微信')
//    {
//        switch ($payway){
//            case '微信':
//                $member = DB::table('members')->where('wxopenid',$data['buyerId'])->first();
//                if ($member){
//                    $newpoint = $member->point+floatval($data['totalAmount']);
//                    Log::info($newpoint);
//                    //$member['point']->add(floatval($data['totalAmount']));
//                    DB::table('members')->where('wxopenid',$data['buyerId'])->update([
//                        'point'=>$newpoint,
//                    ]);
//                }else{
//                    DB::table('members')->insert([
//                        'wxopenid'=>$data['buyerId'],
//                        'point'=>$data['totalAmount'],
//                    ]);
//                }
//                break;
//            case '支付宝':
//                $member = DB::table('members')->where('ali_buyerid',$data['buyerId'])->first();
//                if ($member){
//                    $newpoint = $member->point+floatval($data['totalAmount']);
//                    Log::info($newpoint);
//                    //$member['point']->add(floatval($data['totalAmount']));
//                    DB::table('members')->where('ali_buyerid',$data['buyerId'])->update([
//                        'point'=>$newpoint,
//                    ]);
//                }else{
//                    DB::table('members')->insert([
//                        'ali_buyerid'=>$data['buyerId'],
//                        'point'=>$data['totalAmount'],
//                    ]);
//                }
//                break;
//        }
//    }
}