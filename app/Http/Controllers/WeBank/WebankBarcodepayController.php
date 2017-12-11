<?php
/**
 * Created by PhpStorm.
 * User: hero
 * Date: 2017/5/23
 * Time: 11:53
 */

namespace App\Http\Controllers\WeBank;


use App\Http\Controllers\Member\MemberController;
use App\Models\Order;
use App\Models\ProvinceCity;
use App\Models\WeBankStore;
use function create_object;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use function json_encode;
use Mockery\CountValidator\Exception;
use function random_int;
use function sleep;
use Symfony\Component\HttpFoundation\Request;
use function time;

class WebankBarcodepayController extends  WebankBaseController
{
    const WB_BARCODE_PAY_PATH='/api/aap/server/wepay/barcodepay';
    const WB_QUERY_TRADE_PATH='/api/aap/server/wepay/querytrade';
    const WB_CANCEL_ORDER_PATH='/api/aap/server/wepay/cancelorder';
    const WB_REFUND_PATH = '/api/aap/server/wepay/refund';
    const WB_QUERYREFUND_PATH = '/api/aap/server/wepay/queryrefund';
//    public function barcodePay(Request $request){
//        $store_id = $request->get('store_id');//商户号
//        $m_id=$request->get('m_id');//收银员
//        $shop = WeBankStore::where('store_id', $store_id)->first();
//        $storeunion=DB::table('we_bank_storeunion')->where('store_id',$store_id)->where('product_type','003')->first();
//        if(empty($storeunion->wb_merchant_id)){
//            $wbstorecontroller=new WebankStoreController();
//            $data=[];
//            $alipartid='ali'.date('YmdHis').rand(100,999);
//            $data['store_id']=$alipartid;
//            $data['id_type']=$shop->id_type;
//            $data['id_no']=$shop->id_no;
//            $data['merchant_name']=$shop->store_name;
//            $data['alias_name']=$shop->alias_name;
//            $data['licence_no']=$shop->licence_no;
//            $data['contact_name']=$shop->contact_name;
//            $data['contact_phone']=$shop->contact_phone;
//            $data['merchant_type_code']=$shop->merchant_type_code;
//            $data['ali_category_id']=$storeunion->category_id;
//            $data['account_no']=$shop->account_no;
//            $data['account_opbank_no']=$shop->account_opbank_no;
//            $data['account_name']=$shop->account_name;
//            $data['account_opbank']=$shop->account_opbank;
//            $data['acct_type']=$shop->acct_type;
//            $data['service_phone']=$shop->service_phone;
//            $data['district']='0755';
//            $data['payment_type']=($storeunion->payment_type=='23'||$storeunion->payment_type=='25')?1:2;
//            $cityname=ProvinceCity::where('areaCode',$shop->city_code)->first();
//            if($cityname){
//                $district=DB::table('we_bank_district')->where('district',$cityname)->first();
//                if($district)
//                    $data['district']=$district->district_code;
//            }
//            $res=$wbstorecontroller->registerapi($data,2);
////            dd($res);
//            if($res['code'] == 0&&$res['success']){
//                DB::table('we_bank_storeunion')->where('store_id',$store_id)->where('product_type','003')->update(['wb_merchant_id'=>$res['wbMerchantId'],'partner_mch_id'=>$alipartid]);
//            }
//        }
//        return view('admin.webank.weixin.alipay_view', compact('shop','m_id'));
//    }

    /**
     * @param int $type 微信1，支付宝2
    */
    public function tradepay($type,$orderId,$authCode,$totalAmount,$subject,$desc,$operatorId,$storeId)
    {
        $info='未知错误';
        switch ($type){
            case 1://微信
                $storeunion=DB::table('we_bank_storeunion')->where('store_id',$storeId)->where('product_type','004')->first();
                $pay_type='804';
                $payWay = '微信';
                break;
            case 2://支付宝
                $storeunion=DB::table('we_bank_storeunion')->where('store_id',$storeId)->where('product_type','003')->first();
                $pay_type='803';
                $payWay = '支付宝';
                break;
            default:
                return json_encode([
                    'status'=>2,
                    'msg'=>'错误的支付类型！'
                ]);
                break;
        }
        $data = [
            'orderId' => $orderId,
            'wbMerchantId' => $storeunion->wb_merchant_id,
            'authCode' => $authCode,
            'totalAmount' => $totalAmount,
            'subject' => $subject,
            'desc' => $desc,
            'operatorId' => $operatorId,
            'storeId' => $storeId,
        ];
//        $ist = [
//            'out_trade_no' => $orderId,
//            'trade_no' => '',
//            'store_id' => $storeId,
//            'merchant_id' => $operatorId,
//            'type' => $pay_type,
//            'total_amount' => $totalAmount,
//            'buyer_id' => '',
//            'pay_status' => 1,
//            'remark' => $desc
//        ];
//        $res = Order::create($ist);
        $result = $this->sendCMD($type,$data,self::WB_BARCODE_PAY_PATH);
        try {

            //Log::info($result);
            /** array (
            'code' => '10003',
            'msg' => '交易处理中,请稍后查询结果',
            'bizSeqNo' => '1708062LD01176100000000000039419',
            'transactionTime' => '20170806092505',
            'totalAmount' => '1.00',
            'buyerId' => '2088102170388385',
            'buyerAccount' => 'tpc***@sandbox.com',
            'outTradeNo' => '17080609250400000134',
            'orderId' => '20170806092502129072',
            'channelNo' => '2017080621001004380200623181',
            'success' => false,
            )
             */
            /**array (
            'code' => '0',
            'msg' => 'Success',
            'bizSeqNo' => '1708062LD01176100000000000039563',
            'transactionTime' => '20170806092708',
            'totalAmount' => '1.00',
            'payTime' => '2017-08-06 09:27:08',
            'buyerId' => '2088102172192852',
            'buyerAccount' => 'pgi***@sandbox.com',
            'outTradeNo' => '17080609270500000137',
            'orderId' => '20170806092704440355',
            'channelNo' => '2017080621001004850200259249',
            'success' => true,
            )
             */
            /**
            array (
            'code' => 'USERPAYING',
            'msg' => '需要用户输入支付密码',
            'bizSeqNo' => '17082321D01176100000000001401876',
            'transactionTime' => '20170823162356',
            'success' => false,
            )

             */
            /**array (
            'code' => 'NOTENOUGH',
            'msg' => '102 银行卡可用余额不足（如信用卡则为可透支额度不足），请核实后再试',
            'bizSeqNo' => '17082321D01176100000000001816607',
            'transactionTime' => '20170823183505',
            'success' => false,
            )
             */
            /**array (
            'code' => 'USERPAYING',
            'msg' => '需要用户输入支付密码',
            'bizSeqNo' => '17082421D01176100000000001878041',
            'transactionTime' => '20170824173427',
            'success' => false,
            )
             */
            /**array (
            'code' => '0',
            'msg' => 'SUCCESS',
            'bizSeqNo' => '17082421D01176100000000002160338',
            'transactionTime' => '20170824190414',
            'totalAmount' => '36.50',
            'payTime' => '2017-08-24 19:04:14',
            'buyerId' => 'oJzTrt4T5zXOaUESm6f2mdF4U4_M',
            'isSubscribe' => 'N',
            'outTradeNo' => 'U1708241904130000000000003967509',
            'orderId' => '10293170824190353',
            'channelNo' => '4007962001201708248025671169',
            'bankType' => 'ABC_DEBIT',
            'cashFee' => '36.50',
            'couponFee' => '0',
            'success' => true,
            )
             */
            if ($result['code'] == 0 && $result['success']) {
                $ist = [
                    'out_trade_no' => $result['orderId'],
                    'trade_no' => $result['outTradeNo'],
                    'store_id' => $storeId,
                    'merchant_id' => $operatorId,
                    'type' => $pay_type,
                    'total_amount' => $totalAmount,
                    'buyer_id' => $result['buyerId'],
                    'pay_status' => 1,
                    'remark' => $desc
                ];
                $res = Order::create($ist);
                $returninfo = [
                    'status' => 1,
                    'msg' => '支付成功',
                    'trade_no' => $result['outTradeNo'],
                    'buyer_id' => $result['buyerId']?$result['buyerId']:$result['buyerAccount'],
                    "out_trade_no" => $result['orderId'],
                ];
                try{
                    $noti = (object)$ist;
                    $noti->updated_at = date('YmdHis', time());

                    $mdata = [
                        'buyerId'=>$result['buyerId'],
                        'totalAmount'=>$totalAmount,
                    ];
                    MemberController::AddMemberPoint($mdata,$payWay);

                    WebankNotifyController::notify($noti,$result,$payWay);
                }catch (\Exception $exception1){
                    Log::error($exception1);
                }
            }
            elseif (($result['code']==10003)||($result['code']=='USERPAYING')){

                $queryData = [
                   'wbMerchantId'=> $storeunion->wb_merchant_id,
                    'orderId'=>$orderId,
                ];
                $queryTime=0;
                $queryResult = $this->sendCMD($type,$queryData,self::WB_QUERY_TRADE_PATH);
                $ist = [
                    'out_trade_no' => $queryResult['orderId'],
                    'trade_no' => $queryResult['outTradeNo'],
                    'store_id' => $storeId,
                    'merchant_id' => $operatorId,
                    'type' => $pay_type,
                    'total_amount' => $totalAmount,
                    'buyer_id' => '',
                    'pay_status' => 3,
                    'remark' => $desc
                ];
                $res = Order::create($ist);
//                Log::info($queryResult);
                /** $queryResult array (
                'code' => '0',
                'msg' => 'Success',
                'bizSeqNo' => '1708062LD01176100000000000053144',
                'transactionTime' => '20170806125043',
                'tradeStatus' => '03',
                'totalAmount' => '13211.00',
                'buyerId' => '2088102172192852',
                'buyerAccount' => 'pgi***@sandbox.com',
                'outTradeNo' => '17080612504200000179',
                'orderId' => 'b20170806125041935575',
                'channelNo' => '2017080621001004850200259254',
                'success' => true,
                )
                 */
                $dbStatus = 3;
                while ((($queryResult['tradeStatus']=='03')||($queryResult['tradeStatus']=='00'))&&($dbStatus==3)&&($queryTime<10)){//查询状态变化或者超时跳出循环
                    $queryResult = $this->sendCMD($type,$queryData,self::WB_QUERY_TRADE_PATH);
//                    Log::info('queryTrade');
//                    Log::info($queryResult);
                    //通过API接口撤单，修改了数据库状态
                    $dbStatus=Order::where('out_trade_no' , $queryResult['orderId'])->first()->pay_status;
                    Log::info('dbStatus');
                    Log::info($dbStatus);
                    $queryTime +=1;
                    sleep(random_int(3,5));//间隔3到5秒查询一次
                }
                Log::info($queryResult);
                if ((($queryResult['tradeStatus']=='03')||($queryResult['tradeStatus']=='00'))&&($dbStatus==3)){//超时，多次查询仍然未付款也未撤单，则主动撤单并返回支付失败
                    $cancelResult = $this->cancelorder($type,$storeunion->wb_merchant_id,$orderId);
                    Log::info('======cancel======');
                    Log::info($cancelResult);
                    if ($cancelResult['code']!='0'){
                        sleep(5);
                        Log::info('=========try cancel again =========');
                        $cancelResult = $this->cancelorder($type,$storeunion->wb_merchant_id,$orderId);
                        Log::info($cancelResult);
                    }
                    Log::info('======cancel======');

                    //$queryResult = $this->sendCMD($type,$queryData,self::WB_QUERY_TRADE_PATH);
                    //Log::info('queryTrade');
                    //Log::info($queryResult);
//                    $ist = [
//                        'out_trade_no' => $queryResult['orderId'],
//                        'trade_no' => $queryResult['outTradeNo'],
//                        'store_id' => $storeId,
//                        'merchant_id' => $operatorId,
//                        'type' => $pay_type,
//                        'total_amount' => $totalAmount,
//                        'buyer_id' => '',
//                        'pay_status' => 4,
//                        'remark' => $desc
//                    ];
//                    $res = Order::create($ist);
                    $res = Order::where('out_trade_no',$queryResult['orderId'])->update([
                        'status' => 'TRADE_CLOSED',
                        'pay_status' => 4,
                    ]);
                    $returninfo = [
                        'status' => 4,
                        'msg' => '订单关闭',
                        'trade_no' => $queryResult['outTradeNo'],
                        'buyer_id' => '',
                        "out_trade_no" => $queryResult['orderId'],
                    ];//
                }
                elseif($queryResult['tradeStatus']=='05'){
                    $res = Order::where('out_trade_no',$queryResult['orderId'])->update([
                        'status' => 'TRADE_ERROR',
                        'pay_status' => 5,
                    ]);
                    $returninfo = [
                        'status' => 5,
                        'msg' => '订单异常',
                        'trade_no' => $queryResult['outTradeNo'],
                        'buyer_id' => '',
                        "out_trade_no" => $queryResult['orderId'],
                    ];//

                }
                elseif(($queryResult['tradeStatus']=='02')||($dbStatus==2)){
                    $res = Order::where('out_trade_no',$queryResult['orderId'])->update([
                        'status' => 'TRADE_CANCEL',
                        'pay_status' => 2,
                    ]);
                    $returninfo = [
                        'status' => 2,
                        'msg' => '订单取消',
                        'trade_no' => $queryResult['outTradeNo'],
                        'buyer_id' => '',
                        "out_trade_no" => $queryResult['orderId'],
                    ];//

                }
                elseif ($queryResult['tradeStatus']=='01'){
//                    $ist = [
//                        'out_trade_no' => $queryResult['orderId'],
//                        'trade_no' => $queryResult['outTradeNo'],
//                        'store_id' => $storeId,
//                        'merchant_id' => $operatorId,
//                        'type' => $pay_type,
//                        'total_amount' => $totalAmount,
//                        'buyer_id' => $queryResult['buyerId'],
//                        'pay_status' => 1,
//                        'remark' => $desc
//                    ];
                    $res = Order::where('out_trade_no',$queryResult['orderId'])->update([
                        'status' => 'TRADE_SUCCESS',
                        'pay_status' => 1,
                        'trade_no' => $queryResult['outTradeNo'],
                        'buyer_id' => $queryResult['buyerId'],
                    ]);
                    $returninfo = [
                        'status' => 1,
                        'msg' => '支付成功',
                        'trade_no' => $queryResult['outTradeNo'],
                        'buyer_id' => $queryResult['buyerId'],
                        "out_trade_no" => $queryResult['orderId'],
                    ];//
                    try{
                        $noti = (object)$ist;
                        $noti->updated_at = date('YmdHis', time());
                        $mdata = [
                            'buyerId'=>$queryResult['buyerId'],
                            'totalAmount'=>$totalAmount,
                        ];
                        MemberController::AddMemberPoint($mdata,$payWay);
                        WebankNotifyController::notify($noti,$queryResult,$payWay);
                    }catch (\Exception $exception1){
                        Log::error($exception1);
                    }
                }


                //if ($queryResult-)
            }
            else{//其他状态返回失败

                $ist = [
                    'out_trade_no' => $orderId,
                    'trade_no' => '',
                    'store_id' => $storeId,
                    'merchant_id' => $operatorId,
                    'type' => $pay_type,
                    'total_amount' => $totalAmount,
                    'buyer_id' => '',
                    'pay_status' => 5,
                    'remark' => $desc
                ];
                $res = Order::create($ist);

                //Log::info($request);
                Log::error($result);
                //$info = $result['msg'];
                $returninfo = $result;
//                return $result;
            }
        }catch (Exception $e){
            Log::error($e);
            $returninfo = $result;
//            return $result;
        }
//        return json_encode([
//            'status' => 1,
//            'msg' => '订单支付成功',
//            'trade_no' => $status->transaction_id,
//            "out_trade_no" => $no,
//        ]);
        return $returninfo;
    }
/**
 * 退款接口
*/
    public function refund($type, $data)
    {
        $result = $this->sendCMD($type,$data,self::WB_REFUND_PATH);
        return $result;
    }
    /***/
    public function wbQuery(Request $request)
    {
        $type = 1;
        $data['wbMerchantId']='202134264483155';
        $data['orderId']='34313241170905132006';
        $result = $this->sendCMD(1,$data,self::WB_QUERY_TRADE_PATH);
        dd($result);
    }

    public function wbquerywx($last_trade_no)
    {
        $type =1;
        $data['wbMerchantId']='202001243491822';
        $data['channelNo']=$last_trade_no;
        $result = $this->sendCMD($type,$data,self::WB_QUERY_TRADE_PATH);
    }
    public function queryRefund($type, $data)
    {
        return $this->sendCMD($type,$data,self::WB_QUERYREFUND_PATH);
    }
    /**
     *撤销订单
     * @param int $type 微信1，支付宝2
    */
    public function cancelorder($type,$wbMerchantId, $orderId)
    {
        $cancelNo = date('YmdHis', time()).mt_rand(100000,999999);
        $data=[
            'wbMerchantId'=>$wbMerchantId,
            'orderId'=>$orderId,
            'cancelNo'=>$cancelNo,
        ];
        $result = $this->sendCMD($type,$data,self::WB_CANCEL_ORDER_PATH);
        return $result;
    }
/*
    public function doPay(Request $request){
        $type=$request->get("type");
        $remark=$request->get("remark");
        $total_amount = $request->get('total_amount');
        $m_id=$request->get('m_id');//收银员
        $auth_code = $request>get('auth_code');
        $store_id= $request->get('store_id');
        $wbstore=WeBankStore::where('store_id',$store_id)->first();
        $info='未知错误';
        $storeunion=DB::table('we_bank_storeunion')->where('store_id',$store_id)->where('product_type','003')->first();
        if($type=='2'){
            $user = $request->session()->get('user_data');//买家信息
            $user_id=$user[0]->user_id;
            $notify_url=url('admin/webank/ali_callback');
            $pay_type='801';
        }else{
            $wx_user_data = $request->session()->get('wx_user_data');
            $user_id=$wx_user_data[0]['id'];
            $notify_url=url('admin/webank/wx_callback');
            $pay_type='802';
        }
        try{
            if($storeunion&&$storeunion->wb_merchant_id){
                $webank=$this->WebankHelper($type);
                $app_id = $webank->appId;
                $version = $webank->version;
                $nonce = $webank->getNonce();
                $order_id=$webank->getOrderNum('b');
//                $ip=$request->getClientIp();
                $data=[
                    'orderId'=>$order_id,
                    'wbMerchantId'=>$storeunion->wb_merchant_id,
                    'authCode'=>$auth_code,
                    'totalAmount'=>$total_amount,
                    'subject'=>$wbstore->alias_name.'二维码收款',
                    'operatorId'=>$m_id,
//                    'storeId'=>$wbstore->store_id,
//                    'spbillCreateIp'=>$ip,
//                    'subAppid'=>$webank->wx_app_id,
//                'userId'=>'2088102172192852',
//                    'userId'=>$user_id,
//                    'notifyUrl'=>$notify_url
                ];
                $jsonData=json_encode($data,true);
                $params = array($app_id, $version, $nonce, $jsonData);
                $sign = $webank->getSign($params);
                if (!$sign) {
                    Log::error("Sign is empty!");
                    return array(
                        'code' => '-2',
                        'msg' => '签名计算失败！'
                    );
                }
                $url_params = sprintf(self::COMMON_SIGN_FORMAT, $app_id, $nonce, $version, $sign);
                $header = ['Content-Type: application/json'];
                $request = array(
                    'url' => $webank->headUrl.self::WB_BARCODE_PAY_PATH . $url_params,
                    'method' => 'post',
                    'timeout' => self::$timeout,
                    'data' => $jsonData,
                    'header' => $header,
                );
                $result = $webank->sendRequest($request);
                if ($result['code'] == 0&&$result['success']) {
                    $ist=[
                        'out_trade_no'=>$result['outTradeNo'],
                        'trade_no'=>$result['channelNo'],
                        'store_id'=>$store_id,
                        'merchant_id'=>$m_id,
                        'type'=>$pay_type,
                        'total_amount'=>$total_amount,
                        'buyer_id'=>$result['buyerId'],
                        'pay_status'=>3,
                        'remark'=>$remark
                    ];
                    $res=Order::create($ist);
                    if($res){
                        return json_encode([
                            'success'=>1,
                            'channelNo'=>$result['channelNo']
                        ]);
                    }
                }else{
                    Log::info($request);
                    Log::error($result);
                    $info=$result['msg'];
                }

            }

            return json_encode([
                'success'=>0,
                'msg'=>$info
            ]);
        }catch (Exception $e){
            Log::error($e);
            $info=$e;
        }
        return json_encode([
            'success'=>0,
            'msg'=>$info
        ]);
    }
    public function wxdoPay(Request $request){
        $type=$request->get("type");
        $remark=$request->get("remark");
        $total_amount = $request->get('total_amount');
        $m_id=$request->get('m_id');//收银员
        $store_id= $request->get('store_id');
        $wbstore=WeBankStore::where('store_id',$store_id)->first();
        $info='未知错误';
        $storeunion=DB::table('we_bank_storeunion')->where('store_id',$store_id)->where('product_type','004')->first();
        if($type=='2'){
            $user = $request->session()->get('user_data');//买家信息
            $user_id=$user[0]->user_id;
            $notify_url=url('admin/webank/ali_callback');
            $pay_type='801';
        }else{
            $wx_user_data = $request->session()->get('wx_user_data');
            $user_id=$wx_user_data[0]['id'];
            $notify_url=url('admin/webank/wx_callback');
            $pay_type='802';
        }
        try{
            if($storeunion&&$storeunion->wb_merchant_id){
                $webank=$this->WebankHelper($type);
                $app_id = $webank->appId;
                $version = $webank->version;
                $nonce = $webank->getNonce();
                $order_id=$webank->getOrderNum('b');
                $ip=$request->getClientIp();
                Log::info($ip);
                $data=[
                    'orderId'=>$order_id,
                    'wbMerchantId'=>$storeunion->wb_merchant_id,
                    'totalAmount'=>$total_amount,
                    'subject'=>$wbstore->alias_name.'二维码收款',
                    'operatorId'=>$m_id,
                    'storeId'=>$wbstore->store_id,
                    'spbillCreateIp'=>$ip,
                    'subAppid'=>$webank->wx_app_id,
//                'userId'=>'2088102172192852',
                    'userId'=>$user_id,
                    'notifyUrl'=>$notify_url
                ];
                $jsonData=json_encode($data,true);
                $params = array($app_id, $version, $nonce, $jsonData);
                $sign = $webank->getSign($params);
                if (!$sign) {
                    Log::error("Sign is empty!");
                    return array(
                        'code' => '-2',
                        'msg' => '签名计算失败！'
                    );
                }
                $url_params = sprintf(self::COMMON_SIGN_FORMAT, $app_id, $nonce, $version, $sign);
                $header = ['Content-Type: application/json'];
                $request = array(
                    'url' => $webank->headUrl.self::WB_BARCODE_PAY_PATH . $url_params,
                    'method' => 'post',
                    'timeout' => self::$timeout,
                    'data' => $jsonData,
                    'header' => $header,
                );
                $result = $webank->sendRequest($request);
                if ($result['code'] == 0&&$result['success']) {
                    $ist=[
                        'out_trade_no'=>$order_id,
//                    'trade_no'=>$result['channelNo'],
                        'store_id'=>$store_id,
                        'merchant_id'=>$m_id,
                        'type'=>$pay_type,
                        'total_amount'=>$total_amount,
                        'buyer_id'=>$user_id,
                        'pay_status'=>3,
                        'remark'=>$remark
                    ];
                    //Log::info($ist);
                    $res=Order::create($ist);
                    if($res){
                        return json_encode([
                            'success'=>1,
                            'payInfo'=>$result['payInfo']
                        ]);
                    }
                }else{
                    Log::info($request);
                    Log::error($result);
                    $info=$result['msg'];
                }
            }
            return json_encode([
                'success'=>0,
                'msg'=>$info
            ]);
        }catch (Exception $e){
            Log::error($e);
            $info=$e;

        }
        return json_encode([
            'success'=>0,
            'msg'=>$info
        ]);
    }
    public function alipaysuccess(Request $request){
        $price=$request->price;
        return view('admin.webank.alipay.pay_success',compact('price'));
    }
    public function alipayerror(Request $request){
        $code=$request->code;
        return view('admin.webank.alipay.pay_error',compact('code'));
    }
    public function weixinPay(Request $request){
        $store_id = $request->get('store_id');//商户号
        $m_id=$request->get('m_id');//收银员
        $shop = WeBankStore::where('store_id', $store_id)->first();
        $storeunion=DB::table('we_bank_storeunion')->where('store_id',$store_id)->where('product_type','004')->first();
        try{
            if(empty($storeunion->wb_merchant_id)){
                $wbstorecontroller=new WebankStoreController();
                $data=[];
                $alipartid='wx'.date('YmdHis').rand(100,999);
                $data['store_id']=$alipartid;
                $data['id_type']=$shop->id_type;
                $data['id_no']=$shop->id_no;
                $data['merchant_name']=$shop->store_name;
                $data['alias_name']=$shop->alias_name;
                $data['licence_no']=$shop->licence_no;
                $data['contact_name']=$shop->contact_name;
                $data['contact_phone']=$shop->contact_phone;
                $data['merchant_type_code']=$shop->merchant_type_code;
                $data['wx_category_id']=$storeunion->category_id;
                $data['account_no']=$shop->account_no;
                $data['account_opbank_no']=$shop->account_opbank_no;
                $data['account_name']=$shop->account_name;
                $data['account_opbank']=$shop->account_opbank;
                $data['acct_type']=$shop->acct_type;
                $data['service_phone']=$shop->service_phone;
                $data['district']='0755';
                $data['payment_type']=($storeunion->payment_type=='23'||$storeunion->payment_type=='25')?1:2;
                $cityname=ProvinceCity::where('areaCode',$shop->city_code)->first();
                if($cityname){
                    $district=DB::table('we_bank_district')->where('district',$cityname)->first();
                    if($district)
                        $data['district']=$district->district_code;
                }
                $res=$wbstorecontroller->registerapi($data,1);
                if($res['code'] == 0&&$res['success']){
                    DB::table('we_bank_storeunion')->where('store_id',$store_id)->where('product_type','004')->update(['wb_merchant_id'=>$res['wbMerchantId'],'partner_mch_id'=>$alipartid]);
                }
            }
        }catch (Exception $e){
            Log::info($e);
        }

        return view('admin.webank.weixin.wxpay_view', compact('shop','m_id'));
    }
    public function wxpaysuccess(Request $request){
        $price=$request->price;
        return view('admin.webank.weixin.pay_success',compact('price'));
    }
    public function wxpayerror(Request $request){
        $code=$request->code;
        return view('admin.webank.weixin.pay_error',compact('code'));
    }
    */
}
