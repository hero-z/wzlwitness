<?php

namespace App\Http\Controllers\Member;

use App\Models\Member;
use App\Models\Order;
use function crypt;
use Exception;
use function getenv;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use View;

class MemberController extends Controller
{
    //会员积分增加
    public static function AddMemberPoint($data, $payway = '微信')
    {
        try{
            switch ($payway) {
                case '微信':
                    $member = Member::where('wxopenid', $data['buyerId'])->first();
                    if ($member) {
                        $newpoint = $member->point + floatval($data['totalAmount']);
                        Log::info($newpoint);
                        //$member['point']->add(floatval($data['totalAmount']));
                        Member::where('wxopenid', $data['buyerId'])->update([
                            'point' => $newpoint,
                        ]);
                    } else {
                        DB::table('members')->insert([
                            'wxopenid' => $data['buyerId'],
                            'point' => $data['totalAmount'],
                        ]);
                    }
                    break;
                case '支付宝':
                    $member = Member::where('ali_buyerid', $data['buyerId'])->first();
                    if ($member) {
                        $newpoint = $member->point + floatval($data['totalAmount']);

                        Log::info($newpoint);
                        //$member['point']->add(floatval($data['totalAmount']));
                        Member::where('ali_buyerid', $data['buyerId'])->update([
                            'point' => $newpoint,
                        ]);
                    } else {
                        Member::insert([
                            'ali_buyerid' => $data['buyerId'],
                            'point' => $data['totalAmount'],
                        ]);
                    }
                    break;
            }
        }catch (Exception $e)
        {
            Log::error($e);
        }
    }

    /**
     * 积分变动通知
    */
    public function PointVariation(Member $member,$pointAdd)
    {
        $config = WeixinPayConfig::where('id', 1)->first();
        $options = [
            'app_id' => $config->app_id,
            'secret' => $config->secret,
            'token' => '18851186776',
            'payment' => [
                'merchant_id' => $config->merchant_id,
                'key' => $config->key,
                'cert_path' => $config->cert_path, // XXX: 绝对路径！！！！
                'key_path' => $config->key_path,      // XXX: 绝对路径！！！！
                'notify_url' => $config->notify_url,       // 你也可以在下单时单独设置来想覆盖它
            ],
        ];
        $app = new Application($options);
        $notice = $app->notice;
        $userId = $member->wxopenid;
        $url = '';
        $templateId = getenv('WX_NOTICE_ID');
    }
    //会员积分消费
    public static function SubMemberPoint($data)
    {

    }
    //POST 注册会员
    public static function Register(Request $request)
    {
        $buyerId = $request->buyerId;
        $phone =$request->phone;
        $password = $request->password;
        //$memberInfo = DB::table('members')->where('ali_buyerid',$buyerId)->orWhere('wxopenid',$buyerId)->first();
        $memberInfo = Member::where('ali_buyerid',$buyerId)->orWhere('wxopenid',$buyerId)->first();
        $memberExist = Member::where('phone',$phone)->first();
        //手机号码已经存在
        if ($memberExist){
            if ($memberInfo['password']==crypt($password)){
                //更新会员信息，如果是从微信客户端注册，则更新 'wxopenid'；如果是从支付宝客户端注册，则更新'ali_buyerid'
                if ($request->from=='weixin'){

                }elseif($request->from=='alipay'){

                }
            }else{
                return back()->with('errors','手机号码已存在，请输入原密码');
            }
        }else{

        }
    }

    //获取会员积分
    public static function getPoint(Request $request)
    {
        $buyerId =$request->buyerId;
        $storeId = $request->storeId;
        $memberInfo = Member::where('ali_buyerid',$buyerId)->orWhere('wxopenid',$buyerId)->first();
        $point = $memberInfo['point'];
        $point1 = Order::where('store_id',$storeId)-where('buyer_id',$memberInfo['ali_buyerid'])-orWhere('buyer_id',$memberInfo['wxopenid'])->sum('totalAmount');
        $data = Array([
            'point'=>$point,
            'point1'=>$point1
            ]
        );
        return $data;
    }

}
