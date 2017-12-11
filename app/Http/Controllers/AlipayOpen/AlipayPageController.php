<?php
/**
 * Created by PhpStorm.
 * User: dmk
 * Date: 2016/12/21
 * Time: 18:23
 */

namespace App\Http\Controllers\AlipayOpen;


use Alipayopen\Sdk\Request\AlipayPassInstanceAddRequest;
use App\Models\Alipay_pass;
use App\Models\AlipayIsvConfig;
use App\Models\PassUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AlipayPageController extends AlipayOpenController
{
    /**
     * 支付成功页面
     */
    public function PaySuccess(Request $request)
    {
        $out_trade_no=$request->get("out_trade_no");

        //获取店铺可用卡券模板
        $store_id=$request->get("store_id");
        $time=date("Y-m-d H:i:s");
        $tpl_array=Alipay_pass::where("store_id",$store_id)->where("stock_number",">",0)->where("startDate","<",$time)->where("endDate",">",$time)->select('stock_number','tpl_id')->get()->toArray();
        //判断是否已有卡券
        if(empty(PassUser::where("user_id",session("user_data")[0]->user_id)->first())){
            if(!empty($tpl_array)){
                $ao=new AlipayOpenController();
                $aop = $ao->AopClient();
                $aop->method="alipay.pass.instance.add";
                $requests = new AlipayPassInstanceAddRequest ();
                $partner_id=AlipayIsvConfig::where("id","1")->first()['pid'];
                $channelID=AlipayIsvConfig::where("id","1")->first()['app_id'];
                $serialNumber=session("user_data")[0]->user_id.date("YmdHis");
                $tpl_key=array_rand($tpl_array,1);
                $tpl_id=$tpl_array[$tpl_key]['tpl_id'];
                $requests->setBizContent("{" .
                    "    \"tpl_id\":\"".$tpl_id."\"," .
                    " \"recognition_type\": \"1\",".
                    " \"recognition_info\": {".
                    " \"partner_id\": \"".$partner_id."\",".
                    " \"out_trade_no\": \"" .$out_trade_no."\"
                },".
                    "\"tpl_params\": {
            \"code\" : \"".$serialNumber."\",
            \"channelID\": \"".$channelID."\",
             \"serialNumber\":\"".$serialNumber."\"
      }" .

                    "  }");
                $result = $aop->execute($requests,null,null);
                $responseNode = str_replace(".", "_", $requests->getApiMethodName()) . "_response";
                $resultCode = $result->$responseNode->code;
                if(!empty($resultCode)&&$resultCode == 10000){
                    PassUser::create([
                        "channel_id"=>$channelID,
                        "serial_number"=>$serialNumber,
                        "user_id"=>session("user_data")[0]->user_id,
                        "tpl_id"=>$tpl_id
                    ]);
                    $data['stock_number']=$tpl_array[$tpl_key]['stock_number']-1;
                    Alipay_pass::where("tpl_id",$tpl_id)->update($data);
                }
            }

        }else{
            PassUser::where("user_id",session("user_data")[0]->user_id)->delete();
        }

        $price=$request->get('price');
        return view('admin.alipayopen.page.paysuccess',compact('price'));

    }
    public function OrderErrors(Request $request){

        $code=$request->get('code');
        return view('admin.alipayopen.page.ordererrors',compact('code'));
    }

}