<?php
/**
 * Created by PhpStorm.
 * User: dmk
 * Date: 2017/2/26
 * Time: 17:39
 */

namespace App\Http\Controllers\Merchant;

use App\Merchant;
use App\Models\AlipayAppOauthUsers;
use App\Models\AlipayShopLists;
use App\Models\MerchantShops;
use App\Models\PinganStore;
use App\Models\PufaStores;
use App\Models\UnionPayStore;
use App\Models\WeBankStore;  //add by Neomor
use App\Models\WeixinShopList;
use DB;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

use App\Http\Controllers\Controller;
use Mockery\CountValidator\Exception;

class NewOrderManageController extends Controller
{
    protected $scanninggun= [103=>'当面付机具',105=>'口碑机具',202=>'微信机具',305=>'平安支付宝机具',306=>'平安微信机具',307=>'平安京东机具',402=>'银联机具',603=>'浦发支付宝机具',604=>'浦发微信机具',701=>'现金',803=>'微众支付宝机具',804=>'微众微信机具']; //modified by Neomor
    protected $qrcodelists=[101=>'当面付',102=>'口碑',104=>'当面付固定金额',106=>'口碑固定金额',201=>'微信',203=>'微信固定金额',301=>'平安支付宝',302=>'平安微信',303=>'平安京东',304=>'平安翼支付',401=>'银联固定金额',501=>'民生支付宝',502=>'民生微信',503=>'民生QQ钱包',601=>'浦发支付宝',602=>'浦发微信',801=>'微众支付宝',802=>'微众微信']; //modified by Neomor
    //商户账单流水
    public function orderls(Request $request){
        $data=$request->only('shop_branch','shop_cashier','pay_source','status','store_type','time','time_start','time_end');
        //过滤无效搜索
        foreach($data as $k=>$v){
            if($v=='0'||is_null($v)){
                $data[$k]='';
            }
        }
        //获取搜索条件
        $shop_branch=$data['shop_branch'];
        $shop_cashier=$data['shop_cashier'];
        $pay_source=$data['pay_source'];
        $status=$data['status'];
        $store_type=$data['store_type'];
        $time=$data['time'];
        $time_start=$data['time_start'];
        $time_end=$data['time_end'];

        $list='';//数据列表
        $shoplists=[];//分店列表
        $userlists=[];//收银员列表
        $totalje=0;//总金额
        $store_ids=[];//店铺id集合
        $merchant_ids=[];//收银员id集合
        $paylists=[];//支付方式列表
        $shopmerge=[];
        $allstorenames=[];
        $pay_mark=['gun'=>[],'code'=>[]];
        $pay=['gun'=>[],'code'=>[]];

        //管理员,收银员搜索选项
        $merchant_id=auth()->guard('merchant')->user()->id;
        $mid=DB::table('merchants')->where('id',$merchant_id)->first();
        if($mid->type==0){
            //如果是管理员,分配分店列表信息
            $shoplistsorce=MerchantShops::where('merchant_id',$merchant_id)->select('store_id','store_name');
            $shoplists=$shoplistsorce->get();
            //总店分店flag
            $flag=true;
            $resmain=[];
            $resbranch=[];
            foreach ($shoplists as $v){
                $head=substr($v->store_id,0,1);
                switch($head){
                    case 'o':
                        array_push($pay_mark['gun'],[103=>'当面付机具',105=>'口碑机具']);
                        array_push($pay_mark['code'],[101=>'当面付',102=>'口碑',104=>'当面付固定金额',106=>'口碑固定金额']);
                        $parent = AlipayAppOauthUsers::where('store_id',$v->store_id)->first();
                        $parent2 = AlipayAppOauthUsers::where('store_id',$v->store_id)->select('store_id','auth_shop_name as store_name');
                        if($parent->pid==0){
                            $pid=$parent->id;
                            $resmain[]=$parent2;
                            $resbranch[] = AlipayAppOauthUsers::where('pid', $pid)->where('is_delete',0)->select('store_id','auth_shop_name as store_name');
                        }else{
                            $resbranch[]=$parent2;
                        }
                        break;
                    case 's':
                        array_push($pay_mark['gun'],[103=>'当面付机具',105=>'口碑机具']);
                        array_push($pay_mark['code'],[101=>'当面付',102=>'口碑',104=>'当面付固定金额',106=>'口碑固定金额']);
                        $parent = AlipayShopLists::where('store_id',$v->store_id)->first();
                        $parent2 = AlipayShopLists::where('store_id',$v->store_id)->where('is_delete',0)->where('audit_status','AUDIT_SUCCESS')->select('store_id','main_shop_name as store_name');
                        if($parent->pid==0){
                            $pid=$parent->id;
                            $resmain[]=$parent2;
                            $resbranch[] = AlipayShopLists::where('pid', $pid)->where('is_delete',0)->where('audit_status','AUDIT_SUCCESS')->select('store_id','main_shop_name as store_name');
                        }else{
                            $resbranch[]=$parent2;
                        }
                        break;
                    case 'w':
                        array_push($pay_mark['gun'],[202=>'微信机具']);
                        array_push($pay_mark['code'],[201=>'微信',203=>'微信固定金额']);
                        $parent = WeixinShopList::where('store_id',$v->store_id)->first();
                        $parent2 = WeixinShopList::where('store_id',$v->store_id)->select('store_id','store_name');
                        if($parent->pid==0){
                            $pid=$parent->id;
                            $resmain[]=$parent2;
                            $resbranch[]= WeixinShopList::where('pid', $pid)->where('is_delete',0)->select('store_id','store_name');
                        }else{
                            $resbranch[]=$parent2;
                        }
                        break;
                    case 'p':
                        array_push($pay_mark['gun'],[305=>'平安支付宝机具',306=>'平安微信机具',307=>'平安京东机具']);
                        array_push($pay_mark['code'],[301=>'平安支付宝',302=>'平安微信',303=>'平安京东',304=>'平安翼支付']);
                        $parent = PinganStore::where('external_id',$v->store_id)->first();
                        $parent2 = PinganStore::where('external_id',$v->store_id)->select('external_id as store_id','alias_name as store_name');
                        if($parent->pid==0){
                            $pid=$parent->id;
                            $resmain[]=$parent2;
                            $resbranch[]= PinganStore::where('pid', $pid)->where('is_delete',0)->select('external_id as store_id','alias_name as store_name');
                        }else{
                            $resbranch[]=$parent2;
                        }
                        break;
                    case 'f':
                        array_push($pay_mark['gun'],[603=>'浦发支付宝机具',604=>'浦发微信机具']);
                        array_push($pay_mark['code'],[601=>'浦发支付宝',602=>'浦发微信']);
                        $parent = PufaStores::where('store_id',$v->store_id)->first();
                        $parent2 = PufaStores::where('store_id',$v->store_id)->select('store_id','merchant_short_name as store_name');
                        if($parent->pid==0){
                            $pid=$parent->id;
                            $resmain[]=$parent2;
                            $resbranch[] = PufaStores::where('pid', $pid)/*->where('is_delete',0)*/->select('store_id','merchant_short_name as store_name');
                        }else{
                            $resbranch[]=$parent2;
                        }
                        break;
                    case 'u':
                        array_push($pay_mark['gun'],[402=>'银联机具']);
                        array_push($pay_mark['code'],[401=>'银联固定码']);
                        $parent = UnionPayStore::where('store_id',$v->store_id)->first();
                        $parent2 = UnionPayStore::where('store_id',$v->store_id)->select('store_id','alias_name as store_name');
                        if($parent->pid==0){
                            $pid=$parent->id;
                            $resmain[]=$parent2;
                            $resbranch[] = UnionPayStore::where('pid', $pid)->where('is_delete',0)->select('store_id','alias_name as store_name');
                        }else{
                            $resbranch[]=$parent2;
                        }
                        break;
                    case 'b':  //add by Neomor
                        array_push($pay_mark['gun'],[803=>'微众支付宝机具',804=>'微众微信机具']);
                        array_push($pay_mark['code'],[801=>'微众支付宝',802=>'微众微信']);
                        $parent = WeBankStore::where('store_id',$v->store_id)->first();
                        $parent2 = WeBankStore::where('store_id',$v->store_id)->select('store_id','alias_name as store_name');
                        if($parent->pid==0){
                            $pid=$parent->id;
                            $resmain[]=$parent2;
                            $resbranch[] = WeBankStore::where('pid', $pid)/*->where('is_delete',0)*/->select('store_id','alias_name as store_name');
                        }else{
                            $resbranch[]=$parent2;
                        }
                        break;  //add by Neomor
                    /*case 'm':
                        $parent = ::where('store_id',$v->store_id)->first();
                        if($parent->pid==0){
                            $pid=$parent->id;
                            $five = UnionPayStore::where('pid', $pid)->where('is_delete',0)->select('store_id','alias_name as store_name');
                        }else{
                            $flag=false;
                        }
                        break;*/
                }
            }
            $result =self::checkEmpty($resbranch);
            $shoplists=empty($result)?'':$result->get();
            $shoplists=self::shopNameEnd($shoplists);

            $result =self::checkEmpty($resmain);
            $shoplistss=empty($result)?'':$result->get();
            $shoplistmain=self::shopNameEnd($shoplistss);
            $shopmerge = array_merge(empty($shoplists)?[]:$shoplists->toArray(), empty($shoplistmain)?[]:$shoplistmain->toArray());

            //取出store_id
            foreach ($shoplists as $v){
                $store_ids[]=$v->store_id;
            }
            foreach ($shoplistmain as $v){
                $store_ids[]=$v->store_id;
            }
            $userlists_merchatids = DB::table('merchants')
                ->join('merchant_shops', 'merchants.id', '=', 'merchant_shops.merchant_id')
                ->whereIn('merchant_shops.store_id',$store_ids)
                ->select('merchants.id','merchants.name')
                ->get();

            //取出merchant_id
            if($userlists_merchatids){
                foreach($userlists_merchatids as $v){
                    $merchant_ids[]=$v->id;
                }
            }
            $merchant_ids=array_unique($merchant_ids);
            //分配收银员列表信息
            if(!$shop_branch){
                $userlists=Merchant::whereIn('id',$merchant_ids)->select('id','name')->get();
            }else{
                $userlists=self::getCashierFromId($shop_branch);
            }
        }else{
            //普通收银员
            $merchantshops=MerchantShops::where('merchant_id',$merchant_id)->select('store_id','store_name')->get();
            foreach ($merchantshops as $v){
                $head=substr($v->store_id,0,1);
                switch($head){
                    case 'o':
                        array_push($pay_mark['gun'],[103=>'当面付机具',105=>'口碑机具']);
                        array_push($pay_mark['code'],[101=>'当面付',102=>'口碑',104=>'当面付固定金额',106=>'口碑固定金额']);
                        break;
                    case 's':
                        array_push($pay_mark['gun'],[103=>'当面付机具',105=>'口碑机具']);
                        array_push($pay_mark['code'],[101=>'当面付',102=>'口碑',104=>'当面付固定金额',106=>'口碑固定金额']);
                        break;
                    case 'w':
                        array_push($pay_mark['gun'],[202=>'微信机具']);
                        array_push($pay_mark['code'],[201=>'微信',203=>'微信固定金额']);
                        break;
                    case 'p':
                        array_push($pay_mark['gun'],[305=>'平安支付宝机具',306=>'平安微信机具',307=>'平安京东机具']);
                        array_push($pay_mark['code'],[301=>'平安支付宝',302=>'平安微信',303=>'平安京东',304=>'平安翼支付']);
                        break;
                    case 'f':
                        array_push($pay_mark['gun'],[603=>'浦发支付宝机具',604=>'浦发微信机具']);
                        array_push($pay_mark['code'],[601=>'浦发支付宝',602=>'浦发微信']);
                        break;
                    case 'u':
                        array_push($pay_mark['gun'],[402=>'银联机具']);
                        array_push($pay_mark['code'],[401=>'银联固定码']);

                        break;
                    case 'b': //add by Neomor
                        array_push($pay_mark['gun'],[803=>'微众支付宝机具',804=>'微众微信机具']);
                        array_push($pay_mark['code'],[801=>'微众支付宝',802=>'微众微信']);
                        break;  //add by Neomor
                    /*case 'm':
                        $parent = ::where('store_id',$v->store_id)->first();
                        if($parent->pid==0){
                            $pid=$parent->id;
                            $five = UnionPayStore::where('pid', $pid)->where('is_delete',0)->select('store_id','alias_name as store_name');
                        }else{
                            $flag=false;
                        }
                        break;*/
                }
            }
            $shopmerge=self::shopNameEnd($merchantshops)->toArray();
            $shop_branch=-1;
            $shop_cashier=$merchant_id;
        }
        foreach($shopmerge as $v){
            $allstorenames[$v['store_id']]=$v['store_name'];
        }
        foreach ($pay_mark['gun'] as $k=>$v){
            if(is_array($v)){
                foreach($v as $kk=>$vv){
                    $pay['gun'][$kk]=$vv;
                }
            }
        }
        foreach ($pay_mark['code'] as $k=>$v){
            if(is_array($v)){
                foreach($v as $kk=>$vv){
                    $pay['code'][$kk]=$vv;
                }
            }
        }
        //支付列表选项
        if($pay_source){
            switch ($pay_source){
                case 1:
                    $paylists=$pay['gun'];
                    break;
                case 2:
                    $paylists=$pay['code'];
                    break;
            }
        }
        //session 收银员
        $request->session()->put('userlists',$userlists);
        //session 支付方式
        $request->session()->put('pay_mark',$pay);

        $sqlCollection=self::sqlCollection(1,$pay_source,$store_type,$shop_branch,$shop_cashier,$store_ids,$merchant_ids,$status,$time,$time_start,$time_end);
        $totalje=$sqlCollection[0]['je'];
        $result=self::checkEmpty($sqlCollection[0]['res']);
        $counts=empty($result)?'':$result->get()->count('id');
        $list=empty($result)?'':$result->orderby('updated_at','desc')->paginate(9);

        //存放数据
//        $request->session()->put('list',$list);
        if($mid->type==0){
            return view('merchant.neworderlsadmin', compact('list','shoplists','shoplistmain','userlists','paylists','shop_branch','shop_cashier','pay_source','status','store_type','time','time_start','time_end','allstorenames','counts'));
        }else{
            return view('merchant.neworderls', compact('list','shoplists','shoplistmain','userlists','paylists','shop_branch','shop_cashier','pay_source','status','store_type','time','time_start','time_end','allstorenames','counts'));
        }

    }
    public function gettotalamount(Request $request){
        $data=$request->only('shop_branch','shop_cashier','pay_source','status','store_type','time','time_start','time_end');
        //过滤无效搜索
        foreach($data as $k=>$v){
            if($v=='0'||is_null($v)){
                $data[$k]='';
            }
        }
        //获取搜索条件
        $shop_branch=$data['shop_branch'];
        $shop_cashier=$data['shop_cashier'];
        $pay_source=$data['pay_source'];
        $status=$data['status'];
        $store_type=$data['store_type'];
        $time=$data['time'];
        $time_start=$data['time_start'];
        $time_end=$data['time_end'];

        $list='';//数据列表
        $shoplists=[];//分店列表
        $userlists=[];//收银员列表
        $totalje=0;//总金额
        $store_ids=[];//店铺id集合
        $merchant_ids=[];//收银员id集合
        $paylists=[];//支付方式列表
        $shopmerge=[];
        $allstorenames=[];
        $pay_mark=['gun'=>[],'code'=>[]];

        //管理员,收银员搜索选项
        $merchant_id=auth()->guard('merchant')->user()->id;
        $mid=DB::table('merchants')->where('id',$merchant_id)->first();
        if($mid->type==0){
            //如果是管理员,分配分店列表信息
            $shoplistsorce=MerchantShops::where('merchant_id',$merchant_id)->select('store_id','store_name');
            $shoplists=$shoplistsorce->get();
            //总店分店flag
            $flag=true;
            $resmain=[];
            $resbranch=[];
            foreach ($shoplists as $v){
                $head=substr($v->store_id,0,1);
                switch($head){
                    case 'o':
                        array_push($pay_mark['gun'],[103=>'当面付机具',105=>'口碑机具']);
                        array_push($pay_mark['code'],[101=>'当面付',102=>'口碑',104=>'当面付固定金额',106=>'口碑固定金额']);
                        $parent = AlipayAppOauthUsers::where('store_id',$v->store_id)->first();
                        $parent2 = AlipayAppOauthUsers::where('store_id',$v->store_id)->select('store_id','auth_shop_name as store_name');
                        if($parent->pid==0){
                            $pid=$parent->id;
                            $resmain[]=$parent2;
                            $resbranch[] = AlipayAppOauthUsers::where('pid', $pid)->where('is_delete',0)->select('store_id','auth_shop_name as store_name');
                        }else{
                            $resbranch[]=$parent2;
                        }
                        break;
                    case 's':
                        array_push($pay_mark['gun'],[103=>'当面付机具',105=>'口碑机具']);
                        array_push($pay_mark['code'],[101=>'当面付',102=>'口碑',104=>'当面付固定金额',106=>'口碑固定金额']);
                        $parent = AlipayShopLists::where('store_id',$v->store_id)->first();
                        $parent2 = AlipayShopLists::where('store_id',$v->store_id)->where('is_delete',0)->where('audit_status','AUDIT_SUCCESS')->select('store_id','main_shop_name as store_name');
                        if($parent->pid==0){
                            $pid=$parent->id;
                            $resmain[]=$parent2;
                            $resbranch[] = AlipayShopLists::where('pid', $pid)->where('is_delete',0)->where('audit_status','AUDIT_SUCCESS')->select('store_id','main_shop_name as store_name');
                        }else{
                            $resbranch[]=$parent2;
                        }
                        break;
                    case 'w':
                        array_push($pay_mark['gun'],[202=>'微信机具']);
                        array_push($pay_mark['code'],[201=>'微信',203=>'微信固定金额']);
                        $parent = WeixinShopList::where('store_id',$v->store_id)->first();
                        $parent2 = WeixinShopList::where('store_id',$v->store_id)->select('store_id','store_name');
                        if($parent->pid==0){
                            $pid=$parent->id;
                            $resmain[]=$parent2;
                            $resbranch[]= WeixinShopList::where('pid', $pid)->where('is_delete',0)->select('store_id','store_name');
                        }else{
                            $resbranch[]=$parent2;
                        }
                        break;
                    case 'p':
                        array_push($pay_mark['gun'],[305=>'平安支付宝机具',306=>'平安微信机具',307=>'平安京东机具']);
                        array_push($pay_mark['code'],[301=>'平安支付宝',302=>'平安微信',303=>'平安京东',304=>'平安翼支付']);
                        $parent = PinganStore::where('external_id',$v->store_id)->first();
                        $parent2 = PinganStore::where('external_id',$v->store_id)->select('external_id as store_id','alias_name as store_name');
                        if($parent->pid==0){
                            $pid=$parent->id;
                            $resmain[]=$parent2;
                            $resbranch[]= PinganStore::where('pid', $pid)->where('is_delete',0)->select('external_id as store_id','alias_name as store_name');
                        }else{
                            $resbranch[]=$parent2;
                        }
                        break;
                    case 'f':
                        array_push($pay_mark['gun'],[603=>'浦发支付宝机具',604=>'浦发微信机具']);
                        array_push($pay_mark['code'],[601=>'浦发支付宝',602=>'浦发微信']);
                        $parent = PufaStores::where('store_id',$v->store_id)->first();
                        $parent2 = PufaStores::where('store_id',$v->store_id)->select('store_id','merchant_short_name as store_name');
                        if($parent->pid==0){
                            $pid=$parent->id;
                            $resmain[]=$parent2;
                            $resbranch[] = PufaStores::where('pid', $pid)/*->where('is_delete',0)*/->select('store_id','merchant_short_name as store_name');
                        }else{
                            $resbranch[]=$parent2;
                        }
                        break;
                    case 'u':
                        array_push($pay_mark['gun'],[402=>'银联机具']);
                        array_push($pay_mark['code'],[401=>'银联固定码']);
                        $parent = UnionPayStore::where('store_id',$v->store_id)->first();
                        $parent2 = UnionPayStore::where('store_id',$v->store_id)->select('store_id','alias_name as store_name');
                        if($parent->pid==0){
                            $pid=$parent->id;
                            $resmain[]=$parent2;
                            $resbranch[] = UnionPayStore::where('pid', $pid)->where('is_delete',0)->select('store_id','alias_name as store_name');
                        }else{
                            $resbranch[]=$parent2;
                        }
                        break;
                    case 'b':  //add by Neomor
                        array_push($pay_mark['gun'],[803=>'微众支付宝机具',804=>'微众微信机具']);
                        array_push($pay_mark['code'],[801=>'微众支付宝',802=>'微众微信']);
                        $parent = WeBankStore::where('store_id',$v->store_id)->first();
                        $parent2 = WeBankStore::where('store_id',$v->store_id)->select('store_id','alias_name as store_name');
                        if($parent->pid==0){
                            $pid=$parent->id;
                            $resmain[]=$parent2;
                            $resbranch[] = WeBankStore::where('pid', $pid)/*->where('is_delete',0)*/->select('store_id','alias_name as store_name');
                        }else{
                            $resbranch[]=$parent2;
                        }
                        break;  //add by Neomor
                    /*case 'm':
                        $parent = ::where('store_id',$v->store_id)->first();
                        if($parent->pid==0){
                            $pid=$parent->id;
                            $five = UnionPayStore::where('pid', $pid)->where('is_delete',0)->select('store_id','alias_name as store_name');
                        }else{
                            $flag=false;
                        }
                        break;*/
                }
            }
            $result =self::checkEmpty($resbranch);
            $shoplists=empty($result)?'':$result->get();
            $shoplists=self::shopNameEnd($shoplists);

            $result =self::checkEmpty($resmain);
            $shoplistss=empty($result)?'':$result->get();
            $shoplistmain=self::shopNameEnd($shoplistss);

            $shopmerge = array_merge(empty($shoplists)?[]:$shoplists->toArray(), empty($shoplistmain)?[]:$shoplistmain->toArray());

            //取出store_id
            foreach ($shoplists as $v){
                $store_ids[]=$v->store_id;
            }
            foreach ($shoplistmain as $v){
                $store_ids[]=$v->store_id;
            }
            $userlists_merchatids = DB::table('merchants')
                ->join('merchant_shops', 'merchants.id', '=', 'merchant_shops.merchant_id')
                ->whereIn('merchant_shops.store_id',$store_ids)
                ->select('merchants.id','merchants.name')
                ->get();

            //取出merchant_id
            if($userlists_merchatids){
                foreach($userlists_merchatids as $v){
                    $merchant_ids[]=$v->id;
                }
            }
            $merchant_ids=array_unique($merchant_ids);
            //分配收银员列表信息
            if(!$shop_branch){
                $userlists=Merchant::whereIn('id',$merchant_ids)->select('id','name')->get();
            }else{
                $userlists=self::getCashierFromId($shop_branch);
            }
        }else{
            //普通收银员
            $merchantshops=MerchantShops::where('merchant_id',$merchant_id)->select('store_id','store_name')->get();
            foreach ($merchantshops as $v){
                $head=substr($v->store_id,0,1);
                switch($head){
                    case 'o':
                        array_push($pay_mark['gun'],[103=>'当面付机具',105=>'口碑机具']);
                        array_push($pay_mark['code'],[101=>'当面付',102=>'口碑',104=>'当面付固定金额',106=>'口碑固定金额']);
                        break;
                    case 's':
                        array_push($pay_mark['gun'],[103=>'当面付机具',105=>'口碑机具']);
                        array_push($pay_mark['code'],[101=>'当面付',102=>'口碑',104=>'当面付固定金额',106=>'口碑固定金额']);
                        break;
                    case 'w':
                        array_push($pay_mark['gun'],[202=>'微信机具']);
                        array_push($pay_mark['code'],[201=>'微信',203=>'微信固定金额']);
                        break;
                    case 'p':
                        array_push($pay_mark['gun'],[305=>'平安支付宝机具',306=>'平安微信机具',307=>'平安京东机具']);
                        array_push($pay_mark['code'],[301=>'平安支付宝',302=>'平安微信',303=>'平安京东',304=>'平安翼支付']);
                        break;
                    case 'f':
                        array_push($pay_mark['gun'],[603=>'浦发支付宝机具',604=>'浦发微信机具']);
                        array_push($pay_mark['code'],[601=>'浦发支付宝',602=>'浦发微信']);
                        break;
                    case 'u':
                        array_push($pay_mark['gun'],[402=>'银联机具']);
                        array_push($pay_mark['code'],[401=>'银联固定码']);

                        break;
                    case 'b':  //add by Neomor
                        array_push($pay_mark['gun'],[803=>'微众支付宝机具',804=>'微众微信机具']);
                        array_push($pay_mark['code'],[801=>'微众支付宝',802=>'微众微信']);
                        break;   //add by Neomor
                    /*case 'm':
                        $parent = ::where('store_id',$v->store_id)->first();
                        if($parent->pid==0){
                            $pid=$parent->id;
                            $five = UnionPayStore::where('pid', $pid)->where('is_delete',0)->select('store_id','alias_name as store_name');
                        }else{
                            $flag=false;
                        }
                        break;*/
                }
            }
            $shopmerge=self::shopNameEnd($merchantshops)->toArray();
            $shop_branch=-1;
            $shop_cashier=$merchant_id;
        }
        foreach($shopmerge as $v){
            $allstorenames[$v['store_id']]=$v['store_name'];
        }
        if($request->listje&&$request->listje==1){
            $sqlCollection=self::sqlCollection(1,$pay_source,$store_type,$shop_branch,$shop_cashier,$store_ids,$merchant_ids,$status,$time,$time_start,$time_end);
            $result=self::checkEmpty($sqlCollection[0]['res']);
            $list=empty($result)?'':$result->orderby('updated_at','desc')->distinct()->get();
            return [$list,$allstorenames];
        }
        $sqlCollection=self::sqlCollection(2,$pay_source,$store_type,$shop_branch,$shop_cashier,$store_ids,$merchant_ids,$status,$time,$time_start,$time_end);
        $result=self::checkEmpty($sqlCollection[0]['res']);
        $totalje+=empty($result)?'':$result->sum('total_amount');
        return json_encode(['totalje'=>$totalje]);
    }
    //封装搜索条件
    public function searchWhere($shopBranch,$shopCashier,$status,$time,$time_start,$time_end){
        $where=[];
        try{
            //初始化时间
            if(!$time_start&&!$time_end&&!$time){
                $time=1;
            }
            //是否选择分店,收银员||收银员选项
            if($shopBranch&&$shopCashier)
            {
                $where[]=['store_id',$shopBranch];
                $where[]=['merchant_id',$shopCashier];
            }elseif(!$shopCashier&&$shopBranch){
                $where[]=['store_id',$shopBranch];
            }elseif($shopCashier&&!$shopBranch){
                $where[]=['merchant_id',$shopCashier];
            }

//        if($storeType){
//            $where[]=['orders.type',$storeType];
//        }
            if($shopBranch<0){
                $where=[];
                $where[]=['merchant_id','=',$shopCashier];
            }

            //是否有订单状态搜索
            if($status){
                if($status=="9"){
                }else{
                    $where[]=['pay_status',$status];
                }
            }else{
                $where[]=['pay_status',1];
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
                $where[]=['updated_at','>',$time_start];
            }
            if($time_end)
            {
                $where[]=['updated_at','<',$time_end];
            }
            $whereList=$where;
            $where[]=['pay_status',1];
            $whereJe=$where;
            return compact('whereList','whereJe');
        }catch (Exception $e){
            die('获取搜索条件失败');
        }
    }
    //封装结果集
    public function sqlCollection($listje,$sourcePay,$storeType,$shopBranch,$shopCashier,$storeIds,$merchantIds,$status,$time,$time_start,$time_end){
        $totalje=0;
        $result=[];
        $res=[];
        $je=0;
        try{
            if($storeType){
                $searchWhere=self::searchWhere($shopBranch,$shopCashier,$status,$time,$time_start,$time_end);
                $result=self::checkIds([$storeType],$shopBranch,$shopCashier,$storeIds,$merchantIds,$searchWhere,$listje);
                $res=$result['res'];
                $je+=$result['je'];
            }else{
                if($sourcePay==1){
                    $storeTypes=array_keys($this->scanninggun);
                    $searchWhere=self::searchWhere($shopBranch,$shopCashier,$status,$time,$time_start,$time_end);
                    $result=self::checkIds($storeTypes,$shopBranch,$shopCashier,$storeIds,$merchantIds,$searchWhere,$listje);
                    $res=$result['res'];
                    $je+=$result['je'];
                }elseif($sourcePay==2){
                    $storeTypes=array_keys($this->qrcodelists);
                    $searchWhere=self::searchWhere($shopBranch,$shopCashier,$status,$time,$time_start,$time_end);
                    $result=self::checkIds($storeTypes,$shopBranch,$shopCashier,$storeIds,$merchantIds,$searchWhere,$listje);
                    $res=$result['res'];
                    $je+=$result['je'];
                }else{
                    $searchWhere=self::searchWhere($shopBranch,$shopCashier,$status,$time,$time_start,$time_end);
                    $result=self::checkIds([],$shopBranch,$shopCashier,$storeIds,$merchantIds,$searchWhere,$listje);
                    $res=$result['res'];
                    $je+=$result['je'];
                }
            }
            return [compact('res','je')];
        }catch (Exception $e){
            die('封装结果集失败');
        }
    }
    //检测store_ids,merchant_ids
    public function checkIds($storeTypes,$shopBranch,$shopCashier,$storeIds,$merchantIds,$searchWhere,$listje){

        $res=[];
        $je=0;
        $whereList=$searchWhere['whereList'];
        $whereJe=$searchWhere['whereJe'];
        $shopTable=[1=>'alipay_app_oauth_users',2=>'alipay_shop_lists',3=>'weixin_shop_lists',4=>'pingan_stores',5=>'pufa_stores',6=>'union_pay_stores',7=>'ms_stores',8=>'we_bank_stores'];
//        $shopTable=[1=>'alipay_app_oauth_users',2=>'alipay_shop_lists',3=>'weixin_shop_lists',4=>'pingan_stores',5=>'pufa_stores',6=>'union_pay_stores',7=>'ms_stores'];
        try{
            $res[]=DB::table('orders')
                ->when(empty($shopBranch)&&empty($shopCashier)&&$storeTypes, function ($query) use ($storeIds,$storeTypes) {
                    return $query->whereIn('store_id',$storeIds)->whereIn('type',$storeTypes);
                })
                ->when(empty($shopBranch)&&empty($shopCashier)&&!$storeTypes, function ($query) use ($storeIds) {
                    return $query->whereIn('store_id',$storeIds);
                })
                ->when(!(empty($shopBranch)&&empty($shopCashier))&&$storeTypes, function ($query) use ($storeTypes) {
                    return $query->whereIn('type',$storeTypes);
                })
                ->when($listje==1, function ($query) use ($whereList) {
                    return $query->where($whereList);
                })
                ->when($listje==2, function ($query) use ($whereJe) {
                    return $query->where($whereJe);
                })
                ->select("out_trade_no",'store_id',"total_amount","merchant_id","remark","pay_status", "type", "updated_at");
            /*$res[]=DB::table('orders')
                ->when(empty($shopBranch)&&empty($shopCashier)&&$storeTypes, function ($query) use ($storeIds,$storeTypes) {
                    return $query->whereIn('orders.store_id',$storeIds)->whereIn('orders.type',$storeTypes);
                })
                ->when(empty($shopBranch)&&empty($shopCashier)&&!$storeTypes, function ($query) use ($storeIds) {
                    return $query->whereIn('orders.store_id',$storeIds);
                })
                ->when(!(empty($shopBranch)&&empty($shopCashier))&&$storeTypes, function ($query) use ($storeTypes) {
                    return $query->whereIn('orders.type',$storeTypes);
                })
                ->where($whereList)
                ->select("orders.out_trade_no",'orders.store_id',"orders.total_amount","orders.merchant_id","orders.remark","orders.pay_status", "orders.type", "orders.updated_at");*/
            /*$je+=DB::table($v)
                ->join('orders',$v.".".$storeidmark,'orders.store_id')
                ->join('users',$v.".".$useridmark,'users.id')
                ->when(empty($shopBranch)&&empty($shopCashier)&&$storeTypes, function ($query) use ($storeIds,$storeTypes) {
                    return $query->whereIn('orders.store_id',$storeIds)->whereIn('orders.type',$storeTypes);
                })
                ->when(empty($shopBranch)&&empty($shopCashier)&&!$storeTypes, function ($query) use ($storeIds) {
                    return $query->whereIn('orders.store_id',$storeIds);
                })
                ->when(!(empty($shopBranch)&&empty($shopCashier))&&$storeTypes, function ($query) use ($storeTypes) {
                    return $query->whereIn('orders.type',$storeTypes);
                })
                ->where($whereJe)
                ->sum('orders.total_amount');*/

            return compact('res','je');
        }catch (Exception $e){
            die('检测结果集失败');
        }
    }
    //检测结果集
    public function checkEmpty($arr){
        $listarr=[];
        try{
            foreach($arr as $v){
                if($v==''||$v==[]){
                    continue;
                }
                $listarr[]=$v;
            }
            $limit=count($listarr);
            if($limit>0){
                $result=$listarr[0];
                if($limit>1){
                    for($i=1;$i<$limit;$i++){
                        $result=$result->union($listarr[$i]);
                    }
                }
                return $result;
            }else{
                return '';
            }
        }catch(Exception $e){
            die('检测空集失败');
        }
    }
    //封装分页
    public function dataPaginator(Request $request,$list){
        try{
            if ($list==''||$list->isEmpty()) {
                $paginator = "";
                $datapage = "";
            } else {
                $data = $list->toArray();
                //非数据库模型自定义分页
                $perPage = 9;//每页数量
                if ($request->has('page')) {
                    $current_page = $request->input('page');
                    $current_page = $current_page <= 0 ? 1 : $current_page;
                } else {
                    $current_page = 1;
                }
                $item = array_slice($data, ($current_page - 1) * $perPage, $perPage); //注释1
                $total = count($data);
                $paginator = new LengthAwarePaginator($item, $total, $perPage, $current_page, [
                    'path' => Paginator::resolveCurrentPath(),
                    'pageName' => 'page',
                ]);
                $datapage = $paginator->toArray()['data'];
            }
            return compact('datapage', 'paginator');
        }catch (Exception $e){
            die('分页失败');
        }

    }
    //shoplists添加后缀
    public function shopNameEnd($shoplists){
        try{
            if(empty($shoplists))
                $shoplists=[];
            foreach($shoplists as $k=>$v){
                switch(substr($v->store_id,0,1)){
                    case 'o':
                        $shoplists[$k]->store_name=$v->store_name.'(当面付)';
                        break;
                    case 's':
                        $shoplists[$k]->store_name=$v->store_name.'(口碑)';
                        break;
                    case 'w':
                        $shoplists[$k]->store_name=$v->store_name.'(微信)';
                        break;
                    case 'p':
                        $shoplists[$k]->store_name=$v->store_name.'(平安)';
                        break;
                    case 'u':
                        $shoplists[$k]->store_name=$v->store_name.'(银联)';
                        break;
                    case 'f':
                        $shoplists[$k]->store_name=$v->store_name.'(浦发)';
                        break;
                    case 'm':
                        $shoplists[$k]->store_name=$v->store_name.'(民生-厦门)';
                        break;
                    case 'b': //add by Neomor
                        $shoplists[$k]->store_name=$v->store_name.'(微众)';
                        break; //add by Neomor
                    default:
                        $shoplists[$k]->store_name=$v->store_name;
                        break;
                }
            }
            return $shoplists;
        }catch (Exception $e){
            die('店铺后缀添加失败');
        }
    }
    //Ajax获取收银员列表
    public function dataCashier(Request $request)
    {
        try{
            $id=$request->id;
            $res=[];
            if($id){
                $userlists=self::getCashierFromId($id);
            }else{
                $userlists=$request->session()->get('userlists');
            }
            return json_encode($userlists);
        }catch (Exception $e){
            die('获取收银员列表异常');
        }
    }
    //根据storeid获取收银员列表
    public function getCashierFromId($storeId){
        try{
            $userlists=[];
            $res=[];
            if($storeId){
                $head=substr($storeId,0,1);
                switch($head){
                    case 'o':
                        $pid = AlipayAppOauthUsers::where('store_id',$storeId)->first()->id;
                        $res[] = AlipayAppOauthUsers::where('pid', $pid)->orwhere('id', $pid)->where('is_delete',0)->select('store_id','auth_shop_name as store_name');
                        break;
                    case 's':
                        $pid = AlipayShopLists::where('store_id',$storeId)->first()->id;
                        $res[] = AlipayShopLists::where('id', $pid)->where('is_delete',0)->select('store_id','main_shop_name as store_name');
                        break;
                    case 'w':
                        $pid = WeixinShopList::where('store_id',$storeId)->first()->id;
                        $res[] = WeixinShopList::where('pid', $pid)->orwhere('id', $pid)->where('is_delete',0)->select('store_id','store_name');
                        break;
                    case 'p':
                        $pid = PinganStore::where('external_id',$storeId)->first()->id;
                        $res[] = PinganStore::where('pid', $pid)->orwhere('id', $pid)->where('is_delete',0)->select('external_id as store_id','alias_name as store_name');
                        break;
                    case 'f':
                        $pid = PufaStores::where('store_id',$storeId)->first()->id;
                        $res[] = PufaStores::where('pid', $pid)->orwhere('id', $pid)/*->where('is_delete',0)*/->select('store_id','merchant_short_name as store_name');
                        break;
                    case 'u':
                        $pid = UnionPayStore::where('store_id',$storeId)->first()->id;
                        $res[] = UnionPayStore::where('pid', $pid)->orwhere('id', $pid)->where('is_delete',0)->select('store_id','alias_name as store_name');
                        break;
                    case 'b':  //add by Neomor
                        $pid = WeBankStore::where('store_id',$storeId)->first()->id;
                        $res[] = WeBankStore::where('pid', $pid)->orwhere('id', $pid)->where('is_delete',0)->select('store_id','alias_name as store_name');
                        break; //add by Neomor
                    /*case 'm':
                        $pid = UnionPayStore::where('store_id',$id)->first()->id;
                        $res[] = UnionPayStore::where('pid', $pid)->orwhere('id', $pid)->where('is_delete',0)->select('store_id','store_name');
                        break;*/
                }
                $result =self::checkEmpty($res);
                $result=empty($result)?'':$result->get();
                $ids=[];
                foreach ($result as $v){
                    $ids[]=$v->store_id;
                }
                $ids=array_unique($ids);
                $userlists = DB::table('merchants')
                    ->join('merchant_shops', 'merchants.id', '=', 'merchant_shops.merchant_id')
                    ->whereIn('merchant_shops.store_id',$ids)
                    ->select('merchants.id','merchants.name')
                    ->get();
            }
            return $userlists;
        }catch (Exception $e){
            die('获取收银员列表失败');
        }
    }
    //Ajax获取支付方式
    public function dataPaylist(Request $request)
    {
        try{
            $result=$paylists='';
            $id=$request->id;
            if($id){
                switch ($id){
                    case 1:
                        $paylists=$request->session()->get('pay_mark')['gun'];
                        break;
                    case 2:
                        $paylists=$request->session()->get('pay_mark')['code'];
                }
                foreach ($paylists as $k=>$v){
                    $result[]=['id'=>$k,'value'=>$v];
                }
            }
            return json_encode($result);
        }catch (Exception $e){
            die('获取支付方式失败');
        }
    }
    //导出Excel
    public function expexceldata(Request $request){
        try{
            $res=self::gettotalamount($request);
            $list=$res[0];
            $allstorenames=$res[1];
            $storename='';
            $head=['订单号','店铺ID','店铺名','金额','状态','支付类型','备注','更新时间'];
            $body=[$head];

            $statusformat=[1=>'成功',2=>'取消订单',3=>'等待支付',4=>'订单关闭',5=>'已退款'];
            foreach($list as $k=>$v){
                $statusstr='未操作';
                $paystr='';
                if(array_key_exists($v->pay_status,$statusformat)){
                    $statusstr=$statusformat[$v->pay_status];
                }
                if(array_key_exists($v->type,$this->scanninggun)){
                    $paystr=$this->scanninggun[$v->type];
                }
                if(array_key_exists($v->type,$this->qrcodelists)){
                    $paystr=$this->qrcodelists[$v->type];
                }
                if(array_key_exists($v->store_id,$allstorenames)){
                    $storename=$allstorenames[$v->store_id];
                }
                $body[]=[$v->out_trade_no." ",$v->store_id,$storename,$v->total_amount,$statusstr.'  ',$paystr,$v->remark,$v->updated_at];
            }
            $cellData = $body;
            Excel::create(iconv('utf-8','gbk',date('Y-m-d日').'账单统计'),function($excel) use ($cellData){
                $excel->sheet('score', function($sheet) use ($cellData){
                    $sheet->rows($cellData);
                });
            })->export('xls');
        }catch (Exception $e){
            die('导出数据失败');
        }
    }
}
