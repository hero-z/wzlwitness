<?php

namespace App\Http\Controllers\WeBank;

use function delete_dir;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;

class WebankClearingController extends WebankBaseController
{
    //清算结果查询
    const WB_QUERY_CLEARING_PATH='/api/aap/server/wepay/queryclearing';

    public function index(Request $request)
    {
        $level=Auth::user()->level;
        $uid=Auth::user()->id;
        $where=[];
        $users=[];
        $time=$request->time;
        $time_start=$request->time_start;
        $time_end=$request->time_end;
        //初始化时间
        if(!$time_start&&!$time_end&&!$time){
            $time=1;
        }
        //快速日期选择
        if($time){
            switch ($time){
                case 1:
                    $time_start=date('Y-m-d' . ' ' . ' 23:59:59', strtotime('-7 day'));
                    $time_end=date('Y-m-d H:i:s',time());
                    break;
                case 2:
                    $time_start=date('Y-m-d' . ' ' . ' 00:00:00',time());
                    $time_end=date('Y-m-d H:i:s',time());
                    break;
                case 3:
                    $time_start=date('Y-m-d' . ' ' . ' 00:00:00', strtotime('-1 day'));
                    $time_end=date('Y-m-d' . ' ' . ' 23:59:59', strtotime('-1 day'));
                    break;
                case 4:
                    $firstday = date("Y-m-01" . ' ' . ' 00:00:00',time());
                    $lastday = date("Y-m-d H:i:s",strtotime("$firstday +1 month"));
                    $time_start=$firstday;
                    $time_end=$lastday;
                    break;
                case 5:
                    $firstday = date("Y-m-01" . ' ' . ' 00:00:00',time());
                    $lastday = date("Y-m-d H:i:s",strtotime("$firstday -1 month"));
                    $time_start=$lastday;
                    $time_end=$firstday;
                    break;
            }
        }
        //时间搜索
        if($time_start)
        {
            $times=date("Y-m-d H:i:s",strtotime($time_start));
            $where[]=['user_profit.updated_at','>',$times];
        }
        if($time_end)
        {
            $timee=date("Y-m-d H:i:s",strtotime($time_end));
            $where[]=['user_profit.updated_at','<',$timee];
        }
        $time=$request->time;
        $time_start=$request->time_start;
        $time_end=$request->time_end;
        $storeid = $request->store_id;
        return view('admin.webank.clearing',compact('storeid','time','time_start','time_end'));
    }
    public function queryclearing(Request $request)
    {
        //$wbStoreId
        $wbMerchantIdList = ["202121164483155"];
        $agencyId = '2023640000';
        $transDate = '20170901';
        $data['wbMerchantIdList']=['202121164483155'];
        $data['agencyId'] = '2023640000';
        $data['transDate'] = '20170901';
        $result = $this->sendCMD(1,$data,self::WB_QUERY_CLEARING_PATH);
        Log::info($result);
        dd($result);
    }
}
