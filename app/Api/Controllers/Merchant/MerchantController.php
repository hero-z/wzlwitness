<?php
/**
 * Created by PhpStorm.
 * User: dmk
 * Date: 2017/3/21
 * Time: 15:48
 */

namespace App\Api\Controllers\Merchant;

use Alipayopen\Sdk\Request\AlipayTradeCancelRequest;
use Alipayopen\Sdk\Request\AlipayTradeQueryRequest;
use App\Api\ApiClass\UnionPay\UnionpayScan;
use App\Api\Transformers\MerchantOrderTransformer;
use App\Http\Controllers\Merchant\NewOrderManageController;
use App\Http\Controllers\MinSheng\MinSheng;
use App\Http\Controllers\PingAn\UserProfitController;
use App\Http\Controllers\PuFa\Tools;
use App\Http\Controllers\Push\AopClient;
use App\Http\Controllers\WeBank\WebankBarcodepayController;
use App\Http\Controllers\WeBank\WebankAopClient;
use App\Merchant;
use App\Http\Controllers\Member\MemberController as Member;
use App\Models\Order;
use App\Models\PufaConfig;
use App\Models\PufaStores;
use App\Models\PushConfig;
use App\Models\UnionPayStore;
use App\Models\WeBankStore;
use App\Models\WeBankStoreUnion;
use App\Models\WeixinShopList;
use function count;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Alipayopen\Sdk\Request\AlipayTradePayRequest;
use App\Http\Controllers\AlipayOpen\AlipayOpenController;
use App\Http\Controllers\PingAn\BaseController;
use App\Models\AlipayAppOauthUsers;
use App\Models\AlipayIsvConfig;
use App\Models\AlipayShopLists;
use App\Models\MerchantPayWay;
use App\Models\MerchantShops;
use App\Models\PinganConfig;
use App\Models\PinganStore;
use EasyWeChat\Foundation\Application;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use function json_encode;
use Mockery\Exception;
use function rand;
use function sleep;

class MerchantController extends \App\Api\Controllers\Merchant\BaseController
{
    //商户查询接口
    public function Morder()
    {
        $user = $this->getMerchantInfo();
        $Order = Order::where('merchant_id', $user['id'])->whereIn('type', [103, 105, 202, 305, 306, 307, 402, 701])->get();
        return $this->collection($Order, new MerchantOrderTransformer());
    }

    //订单查询接口
    public function Order(Request $request)
    {
        $user = $this->getMerchantInfo();
        $type = $request->get('type');//类型
        $page = (int)$request->get('page');//第几页
        $number = (int)$request->get('number', 20);//第几页
        $m_type = Merchant::where('id', $user['id'])->first()->type;
        $out_trade_no = $request->get('out_trade_no');
        $trade_no = $request->get('trade_no');
        $searchid=$m_type==0?$user['id']:$user['pid'];
        $store_ids = self::SelectAdminOrder($searchid);
        $time_start = $request->get('time_start');//开始时间
        $time_end = $request->get('time_end');//结束时间
        $where=[];
        $where[]=['orders.pay_status','=',1];
        if($time_start)
        {
            $where[]=['orders.updated_at','>',$time_start];
        }
        if($time_end)
        {
            $where[]=['orders.updated_at','<',$time_end];
        }
        $b = (int)($page - 1) * $number;
        $Order = Order::when($page,function($query) use ($b,$number){
            return $query->offset($b)->limit($number);
        })->whereIn('orders.store_id', $store_ids)
            ->when($type, function ($query) use ($type) {
                return $query->whereIn('orders.type', [$type]);
            })
            ->when($trade_no, function ($query) use ($trade_no) {
                return $query->where('orders.trade_no', $trade_no);
            })
            ->when($out_trade_no, function ($query) use ($out_trade_no) {
                return $query->where('orders.out_trade_no', $out_trade_no);
            })
            ->where($where)->orderBy('created_at', 'desc')->get();

        return $this->collection($Order, new MerchantOrderTransformer());
    }
    //收银员看自己的订单
//    public function Order(Request $request)
//    {
//        $user = $this->getMerchantInfo();
//        $type = $request->get('type');//类型
//        $page = (int)$request->get('page');//第几页
//        $number = (int)$request->get('number', 20);//第几页
//        $m_type = Merchant::where('id', $user['id'])->first()->type;
//        $out_trade_no = $request->get('out_trade_no');
//        $trade_no = $request->get('trade_no');
//        $store_ids = self::SelectAdminOrder($user['id']);
//        $m_id = $user['id'];
//        $time_start = $request->get('time_start');//开始时间
//        $time_end = $request->get('time_end');//结束时间
//        $where=[];
//        if($time_start)
//        {
//            $where[]=['orders.updated_at','>',$time_start];
//        }
//        if($time_end)
//        {
//            $where[]=['orders.updated_at','<',$time_end];
//        }
//        $b = (int)($page - 1) * $number;
//        $Order = Order::when($page,function($query) use ($b,$number){
//            return $query->offset($b)->limit($number);
//        })->when($m_type == '0', function ($query) use ($store_ids) {
//            return $query->whereIn('orders.store_id', $store_ids);
//        })
//            ->when($m_type != '0', function ($query) use ($m_id) {
//                return $query->where('orders.merchant_id', $m_id);
//            })
//            ->when($type, function ($query) use ($type) {
//                return $query->whereIn('orders.type', [$type]);
//            })
//            ->when($trade_no, function ($query) use ($trade_no) {
//                return $query->where('orders.order_trade_no', $trade_no);
//            })
//            ->when($out_trade_no, function ($query) use ($out_trade_no) {
//                return $query->where('orders.order_trade_no', $out_trade_no);
//            })
//            ->where($where)->orderBy('created_at', 'desc')->get();
////        if ($page) {
////            $b = (int)($page - 1) * $number;
////            $Order = Order::offset($b)->limit($number)->when($m_type == '0', function ($query) use ($store_ids) {
////                return $query->whereIn('orders.store_id', $store_ids);
////            })
////                ->when($m_type != '0', function ($query) use ($m_id) {
////                    return $query->where('orders.merchant_id', $m_id);
////                })
////                ->when($type, function ($query) use ($type) {
////                    return $query->whereIn('orders.type', [$type]);
////                })
////                ->when($trade_no, function ($query) use ($trade_no) {
////                    return $query->where('orders.order_trade_no', $trade_no);
////                })->
////                when($out_trade_no, function ($query) use ($out_trade_no) {
////                    return $query->where('orders.order_trade_no', $out_trade_no);
////                })
////                ->where($where)->orderBy('created_at', 'desc')->get();
////        } else {
////            $Order = Order::when($m_type == '0' && $store_ids, function ($query) use ($store_ids) {
////                return $query->whereIn('orders.store_id', $store_ids);
////            })
////                ->when($m_type != '0', function ($query) use ($m_id) {
////                    return $query->where('orders.merchant_id', $m_id);
////                })
////                ->when($type, function ($query) use ($type) {
////                    return $query->whereIn('orders.type', [$type]);
////                })->
////                when($trade_no, function ($query) use ($trade_no) {
////                    return $query->where('orders.trade_no', $trade_no);
////                })
////                ->when($out_trade_no, function ($query) use ($out_trade_no) {
////                    return $query->where('orders.out_trade_no', $out_trade_no);
////                })->where($where)->orderBy('created_at', 'desc')->get();
////        }
//
//
//        return $this->collection($Order, new MerchantOrderTransformer());
//    }

    //管理员的store_id
    public function SelectAdminOrder($merchant_id)
    {
        //管理员,收银员搜索选项
        try {
            $mid = DB::table('merchants')->where('id', $merchant_id)->first();
            $store_ids = [];
            if ($mid->type == 0) {
                //如果是管理员,分配分店列表信息
                $shoplistsorce = MerchantShops::where('merchant_id', $merchant_id)->select('store_id');
                $shoplists = $shoplistsorce->get();
                //总店分店flag
                $flag = true;
                $resmain = [];
                $resbranch = [];
                foreach ($shoplists as $v) {
                    $head = substr($v->store_id, 0, 1);
                    switch ($head) {
                        case 'o':
                            $parent = AlipayAppOauthUsers::where('store_id', $v->store_id)->first();
                            $parent2 = AlipayAppOauthUsers::where('store_id', $v->store_id)->select('store_id');
                            if ($parent&&$parent->pid == 0) {
                                $pid = $parent->id;
                                $resmain[] = $parent2;
                                $resbranch[] = AlipayAppOauthUsers::where('pid', $pid)->where('is_delete', 0)->select('store_id');
                            } else {
                                $resbranch[] = $parent2;
                            }
                            break;
                        case 's':
                            $parent = AlipayShopLists::where('store_id', $v->store_id)->first();
                            $parent2 = AlipayShopLists::where('store_id', $v->store_id)->select('store_id');
                            if ($parent&&$parent->pid == 0) {
                                $pid = $parent->id;
                                $resmain[] = $parent2;
                                $resbranch[] = AlipayShopLists::where('pid', $pid)->where('is_delete', 0)->select('store_id');
                            } else {
                                $resbranch[] = $parent2;
                            }
                            break;
                        case 'w':
                            $parent = WeixinShopList::where('store_id', $v->store_id)->first();
                            $parent2 = WeixinShopList::where('store_id', $v->store_id)->select('store_id');
                            if ($parent&&$parent->pid == 0) {
                                $pid = $parent->id;
                                $resmain[] = $parent2;
                                $resbranch[] = WeixinShopList::where('pid', $pid)->where('is_delete', 0)->select('store_id');
                            } else {
                                $resbranch[] = $parent2;
                            }
                            break;
                        case 'p':
                            $parent = PinganStore::where('external_id', $v->store_id)->first();
                            $parent2 = PinganStore::where('external_id', $v->store_id)->select('external_id as store_id');
                            if ($parent&&$parent->pid == 0) {
                                $pid = $parent->id;
                                $resmain[] = $parent2;
                                $resbranch[] = PinganStore::where('pid', $pid)->where('is_delete', 0)->select('external_id as store_id');
                            } else {
                                $resbranch[] = $parent2;
                            }
                            break;
                        case 'f':
                            $parent = PufaStores::where('store_id', $v->store_id)->first();
                            $parent2 = PufaStores::where('store_id', $v->store_id)->select('store_id');
                            if ($parent&&$parent->pid == 0) {
                                $pid = $parent->id;
                                $resmain[] = $parent2;
                                $resbranch[] = PufaStores::where('pid', $pid)/*->where('is_delete',0)*/
                                ->select('store_id');
                            } else {
                                $resbranch[] = $parent2;
                            }
                            break;
                        case 'u':
                            $parent = UnionPayStore::where('store_id', $v->store_id)->first();
                            $parent2 = UnionPayStore::where('store_id', $v->store_id)->select('store_id');
                            if ($parent&&$parent->pid == 0) {
                                $pid = $parent->id;
                                $resmain[] = $parent2;
                                $resbranch[] = UnionPayStore::where('pid', $pid)->where('is_delete', 0)->select('store_id');
                            } else {
                                $resbranch[] = $parent2;
                            }
                            break;
                        case 'm':
                            $parent = DB::table('ms_stores')->where('store_id', '=', $v->store_id)->first();
                            $parent2 = DB::table('ms_stores')->where('store_id', '=', $v->store_id)->select('store_id');
                            if ($parent&&$parent->pid == 0) {
                                $pid = $parent->id;
                                $resmain[] = $parent2;
                                $resbranch[] = DB::table('ms_stores')->where('pid', $pid)->select('store_id');
                            } else {
                                $resbranch[] = $parent2;
                            }
                            break;
                        case 'n':
                            $parent = DB::table('merc_regists')->where('store_id', '=', $v->store_id)->first();
                            $parent2 = DB::table('merc_regists')->where('store_id', '=', $v->store_id)->select('store_id');
                            if ($parent&&$parent->pid == 0) {
                                $pid = $parent->id;
                                $resmain[] = $parent2;
                                $resbranch[] = DB::table('merc_regists')->where('pid', $pid)->select('store_id');
                            } else {
                                $resbranch[] = $parent2;
                            }
                            break;
                        case 'b':                  //add by Neomor
                            $parent = WeBankStore::where('store_id', $v->store_id)->first();                 //add by Neomor
                            $parent2 = WeBankStore::where('store_id', $v->store_id)->select('store_id');                 //add by Neomor
                            if ($parent&&$parent->pid == 0) {                 //add by Neomor
                                $pid = $parent->id;                 //add by Neomor
                                $resmain[] = $parent2;                 //add by Neomor
                                $resbranch[] = WeBankStore::where('pid', $pid)/*->where('is_delete',0)*/                 //add by Neomor
                                ->select('store_id');                 //add by Neomor
                            } else {                 //add by Neomor
                                $resbranch[] = $parent2;                 //add by Neomor
                            }                 //add by Neomor
                            break;                 //add by Neomor
                    }
                }
                $ordermanager = new NewOrderManageController();
                $result = $ordermanager->checkEmpty($resbranch);
                $shoplists = empty($result) ? [] : $result->get();

                $result = $ordermanager->checkEmpty($resmain);
                $shoplistmain = empty($result) ? [] : $result->get();


                //取出store_id
                foreach ($shoplists as $v) {
                    $store_ids[] = $v->store_id;
                }
                foreach ($shoplistmain as $v) {
                    $store_ids[] = $v->store_id;
                }
            }
            return $store_ids;
//          return Order::whereIn('store_id',$store_ids)->get();
        } catch (Exception $exception) {
            die('获取店铺id集合出错');
        }
    }

    public function StoreList(Request $request)
    {
        $merchant = $this->getMerchantInfo();
        //管理员,收银员搜索选项
        $shoplists = [];
        $shoplistmain = [];
        $shop = [];
        try {
            if ($merchant['merchant_type'] == 0) {
                //如果是管理员,分配分店列表信息
                $shoplistsorce = MerchantShops::where('merchant_id', $merchant['id'])->select('store_id');
                $shoplists = $shoplistsorce->get();
                //总店分店flag
                $flag = true;
                $resmain = [];
                $resbranch = [];
                foreach ($shoplists as $v) {
                    $head = substr($v->store_id, 0, 1);
                    switch ($head) {
                        case 'o':
                            $parent = AlipayAppOauthUsers::where('store_id', $v->store_id)->first();
                            $parent2 = AlipayAppOauthUsers::where('store_id', $v->store_id)->select('store_id', 'auth_shop_name as store_name');
                            if ($parent2 && $parent->pid == 0) {
                                $pid = $parent->id;
                                $resmain[] = $parent2;
                                $resbranch[] = AlipayAppOauthUsers::where('pid', $pid)->where('is_delete', 0)->select('store_id', 'auth_shop_name as store_name');
                            } else {
                                $resbranch[] = $parent2;
                            }
                            break;
                        case 's':
                            $parent = AlipayShopLists::where('store_id', $v->store_id)->first();
                            $parent2 = AlipayShopLists::where('store_id', $v->store_id)->select('store_id');
                            if ($parent->pid == 0) {
                                $pid = $parent->id;
                                $resmain[] = $parent2;
                                $resbranch[] = AlipayShopLists::where('pid', $pid)->where('is_delete', 0)->select('store_id');
                            } else {
                                $resbranch[] = $parent2;
                            }
                            break;
                        case 'w':
                            $parent = WeixinShopList::where('store_id', $v->store_id)->first();
                            $parent2 = WeixinShopList::where('store_id', $v->store_id)->select('store_id', 'store_name');
                            if ($parent2 && $parent->pid == 0) {
                                $pid = $parent->id;
                                $resmain[] = $parent2;
                                $resbranch[] = WeixinShopList::where('pid', $pid)->where('is_delete', 0)->select('store_id', 'store_name');
                            } else {
                                $resbranch[] = $parent2;
                            }
                            break;
                        case 'p':
                            $parent = PinganStore::where('external_id', $v->store_id)->first();
                            $parent2 = PinganStore::where('external_id', $v->store_id)->select('external_id as store_id', 'alias_name as store_name');
                            if ($parent2 && $parent->pid == 0) {
                                $pid = $parent->id;
                                $resmain[] = $parent2;
                                $resbranch[] = PinganStore::where('pid', $pid)->where('is_delete', 0)->select('external_id as store_id', 'alias_name as store_name');
                            } else {
                                $resbranch[] = $parent2;
                            }
                            break;
                        case 'f':
                            $parent = PufaStores::where('store_id', $v->store_id)->first();
                            $parent2 = PufaStores::where('store_id', $v->store_id)->select('store_id', 'merchant_short_name as store_name');
                            if ($parent2 && $parent->pid == 0) {
                                $pid = $parent->id;
                                $resmain[] = $parent2;
                                $resbranch[] = PufaStores::where('pid', $pid)/*->where('is_delete',0)*/
                                ->select('store_id', 'merchant_short_name as store_name');
                            } else {
                                $resbranch[] = $parent2;
                            }
                            break;
                        case 'u':
                            $parent = UnionPayStore::where('store_id', $v->store_id)->first();
                            $parent2 = UnionPayStore::where('store_id', $v->store_id)->select('store_id', 'alias_name as store_name');
                            if ($parent2 && $parent->pid == 0) {
                                $pid = $parent->id;
                                $resmain[] = $parent2;
                                $resbranch[] = UnionPayStore::where('pid', $pid)->where('is_delete', 0)->select('store_id', 'alias_name as store_name');
                            } else {
                                $resbranch[] = $parent2;
                            }
                            break;
                        case 'm':
                            $parent = DB::table('ms_stores')->where('store_id', '=', $v->store_id)->first();
                            $parent2 = DB::table('ms_stores')->where('store_id', '=', $v->store_id)->select('store_id', 'store_short_name as store_name');
                            if ($parent2 && $parent->pid == 0) {
                                $pid = $parent->id;
                                $resmain[] = $parent2;
                                $resbranch[] = DB::table('ms_stores')->where('pid', $pid)->select('store_id', 'store_short_name as store_name');
                            } else {
                                $resbranch[] = $parent2;
                            }
                            break;
                        case 'b':
                            $parent = DB::table('we_bank_stores')->where('store_id', '=', $v->store_id)->first();
                            $parent2 = DB::table('we_bank_stores')->where('store_id', '=', $v->store_id)->select('store_id', 'alias_name as store_name');
                            if ($parent && $parent->pid == 0) {
                                $pid = $parent->id;
                                $resmain[] = $parent2;
                                $resbranch[] = DB::table('we_bank_stores')->where('pid', $pid)->select('store_id', 'alias_name as store_name');
                            } else {
                                $resbranch[] = $parent2;
                            }
                            break;
                    }
                }
                $ordermanager = new NewOrderManageController();
                $result = $ordermanager->checkEmpty($resbranch);
                $shoplists = empty($result) ? [] : $result->get();

                $result = $ordermanager->checkEmpty($resmain);
                $shoplistmain = empty($result) ? [] : $result->get();

                foreach ($shoplists as $v) {
                    $shop[] = $v;
                }
                foreach ($shoplistmain as $v) {
                    $shop[] = $v;
                }
            } else {
                $shoplistsorce = MerchantShops::where('merchant_id', $merchant['id'])->select('store_id');
                $shoplists = $shoplistsorce->get();
                $resbranch = [];
                foreach ($shoplists as $v) {
                    $head = substr($v->store_id, 0, 1);
                    switch ($head) {
                        case 'o':
                            $parent2 = AlipayAppOauthUsers::where('store_id', $v->store_id)->select('store_id', 'auth_shop_name as store_name');
                            $resbranch[] = $parent2;
                            break;
                        case 's':
                            $parent2 = AlipayShopLists::where('store_id', $v->store_id)->select('store_id', 'main_shop_name as store_name');
                            $resbranch[] = $parent2;
                            break;
                        case 'w':
                            $parent2 = WeixinShopList::where('store_id', $v->store_id)->select('store_id', 'store_name');
                            $resbranch[] = $parent2;
                            break;
                        case 'p':
                            $parent2 = PinganStore::where('external_id', $v->store_id)->select('external_id as store_id', 'alias_name as store_name');
                            $resbranch[] = $parent2;
                            break;
                        case 'f':
                            $parent2 = PufaStores::where('store_id', $v->store_id)->select('store_id', 'merchant_short_name as store_name');
                            $resbranch[] = $parent2;
                            break;
                        case 'u':
                            $parent2 = UnionPayStore::where('store_id', $v->store_id)->select('store_id', 'alias_name as store_name');
                            $resbranch[] = $parent2;
                            break;
                        case 'm':
                            $parent2 = DB::table('ms_stores')->where('store_id', '=', $v->store_id)->select('store_id', 'store_short_name as store_name');
                            $resbranch[] = $parent2;
                            break;
                        case 'b':
                            $parent2 = DB::table('we_bank_stores')->where('store_id', '=', $v->store_id)->select('store_id', 'alias_name as store_name');
                            $resbranch[] = $parent2;
                            break;
                    }
                }
                $ordermanager = new NewOrderManageController();
                $result = $ordermanager->checkEmpty($resbranch);
                $shoplists = empty($result) ? [] : $result->get();
                foreach ($shoplists as $vv) {
                    $shop[] = $vv;
                }
            }
            return json_encode(['success' => 1, 'data' => $shop]);
        } catch (\Exception $e) {
            return json_encode(['success' => 0, 'msg' => $e->getMessage() . $e->getLine()]);
        }
    }

    //获取收银员
    public function getCashier(Request $request)
    {
        try {
            $merchant = $this->getMerchantInfo();
            $store_id = $request->store_id;
            if ($merchant['type'] == 0) {
                //管理员
                $merchant = DB::table('merchant_shops')
                    ->join('merchants', 'merchants.id', 'merchant_shops.merchant_id')
                    ->where('merchant_shops.store_id', $store_id)
                    ->select('merchants.name', 'merchants.id')->get();
                if ($merchant) {
                    $merchant = $merchant->toArray();
                    foreach ($merchant as $k => $v) {
                        $amount = self::getamount([$store_id], 1, $v->id);
                        $merchant[$k]->amount = $amount;
                    }
                }
            } else {
                $merchant = DB::table('merchant_shops')
                    ->join('merchants', 'merchants.id', 'merchant_shops.merchant_id')
                    ->where('merchant_shops.store_id', $store_id)
                    ->where('merchant_id', $merchant['id'])
                    ->select('merchants.name', 'merchants.id')->get();
                if ($merchant) {
                    $merchant = $merchant->toArray();
                    foreach ($merchant as $k => $v) {
                        $amount = self::getamount([$store_id], 1, $v->id);
                        $merchant[$k]->amount = $amount;
                    }
                }
            }
            return json_encode(['success' => 1, 'data' => $merchant]);
        } catch (\Exception $e) {
            return json_encode(['success' => 0, 'msg' => $e->getMessage() . $e->getLine()]);
        }

    }

    //获取金额
    public function getTotalAmount(Request $request)
    {
        $merchant = $this->getMerchantInfo();
        $ids = self::SelectAdminOrder($merchant['id']);
        if ($merchant['type'] == 0) {
            $tamount = self::getamount($ids, 3);
            $damount = self::getamount($ids, 1);
            $mamount = self::getamount($ids, 2);
        } else {
            $tamount = self::getamount($ids, 3, $merchant['id']);
            $damount = self::getamount($ids, 1, $merchant['id']);
            $mamount = self::getamount($ids, 2, $merchant['id']);
        }
        return json_encode(['tamount' => $tamount, 'damount' => $damount, 'mamount' => $mamount]);
    }

    public function getamount($store_id, $type, $mch_id = '')
    {
        $amount = 0;
        $where = [];
        if ($type) {
            $time_start = '';
            $time_end = '';
            switch ($type) {
                case 1:
                    $time_start = date('Y-m-d' . ' ' . ' 00:00:00', time());
                    $time_end = date('Y-m-d H:i:s', time());
                    break;
                case 2:
                    $firstday = date("Y-m-01" . ' ' . ' 00:00:00', time());
                    $lastday = date("Y-m-d H:i:s", strtotime("$firstday +1 month"));
                    $time_start = $firstday;
                    $time_end = $lastday;
                    break;
            }
            //时间搜索
            if ($time_start) {
                $times = date("Y-m-d H:i:s", strtotime($time_start));
                $where[] = ['orders.updated_at', '>', $times];
            }
            if ($time_end) {
                $timee = date("Y-m-d H:i:s", strtotime($time_end));
                $where[] = ['orders.updated_at', '<', $timee];
            }
        }
        if ($mch_id) {
            $where[] = ['orders.merchant_id', $mch_id];
        }
        $amount = Order::whereIn('store_id', $store_id)->where('pay_status', 1)->where($where)->sum('total_amount');
        return $amount;
    }

    //获取菜单项
    public function getMenu(Request $request)
    {
        $list = DB::table('app_manage')->where('is_delete', 0)->select('name', 'url', 'icon_url')->get();
        if ($list) {
            $list = $list->toArray();
            foreach ($list as $k => $v) {
                $list[$k]->icon_url = url($v->icon_url);
            }
        }
        return json_encode($list);
    }

    //秒到收款
    public function mdpay(Request $request)
    {

    }

    //设备管理
    public function getMachine(Request $request)
    {
        try {
            $merchant = $this->getMerchantInfo();
            if ($merchant['type'] == 0) {
                //管理员
                $info = DB::table("merchant_shops")
                    ->where("merchant_id", $merchant['id'])
                    ->select("store_id")
                    ->get();
                $array = [];
                foreach ($info as $v) {
                    $array[] = $v->store_id;
                }
                $list = DB::table("push_print_shop_lists")->whereIn("store_id", $array)->get();
                if ($list) {
                    $list = $list->toArray();
                } else {
                    $list = [];
                }
            } else {
                $list = [];
            }
            return json_encode(['success' => 1, 'data' => $list]);
        } catch (\Exception $e) {
            return json_encode(['success' => 0, 'msg' => $e->getMessage() . $e->getLine()]);
        }
    }

    //添加修改易联云
    public function addMachine(Request $request)
    {
        try {
            $merchant = $this->getMerchantInfo();
            $info = '系统错误';
            if ($merchant['type'] == 0) {
                //管理员
                $config = PushConfig::where('merchant_id', $merchant['id'])->first();
                if ($config) {
                    $data['name'] = $request->get("name");
                    $data['sign'] = $request->get("sign");
                    $data['machine_code'] = $request->get("machine_code");
                    $data['store_name'] = $request->get("store_name");
                    $data['store_id'] = $request->get("store_id");
                    $data['phone'] = $request->get("phone");
                    $data['type'] = "yilianyun";
                    $time = date("Y-m-d H:i:s");
                    $data['updated_at'] = $time;
                    $id = $request->id;
                    //id存在时修改操作
                    $print = DB::table("push_print_shop_lists")->where("store_id", $data['store_id'])->where("type", "yilianyun")->first();
                    $push = new AopClient();
                    $ck = false;
                    if ($print) {
                        $info = '店铺已绑定设备';
                        $ck = true;
                    }
                    if (!$ck) {
                        //添加新设备
                        $add = $push->action_addprint($config->push_id, $data['machine_code'], $config->push_user_name, $data['name'], '', $config->push_key, $data['sign']);
                        if ($add == 1) {
                            //易联云新添加设备
                            if ($id) {
                                //修改入库
                                DB::table("push_print_shop_lists")->where("id", $id)->update($data);
                                //移除旧设备
//                            $delete=$push->action_removeprinter($config->push_id,$print->machine_code,$config->push_key,$print->msign);
                                return json_encode(['success' => 1, 'data' => '修改成功']);
                            } else {
                                //新增入库
                                DB::table("push_print_shop_lists")->insert($data);
                                return json_encode(['success' => 1, 'data' => '添加成功']);
                            }
                        } elseif ($add == 2) {
                            $info = '该设备已经被添加!';
                        } elseif ($add == 3 || $add == 4) {
                            $info = '添加失败!';
                        } elseif ($add == 5) {
                            $info = '用户验证失败';
                        } else {
                            $info = '非法终端号';
                        }
                    }
                } else {
                    $info = '请先设置配置!';
                }
            } else {
                $info = '非管理员无权限';
            }
            return ['success' => 0, 'msg' => $info];
//            return json_encode(['success'=>0,'msg'=>$info]);
        } catch (\Exception $e) {
            return json_encode(['success' => 0, 'msg' => $e->getMessage() . $e->getLine()]);
        }
    }

    //删除易联云
    public function delMachine(Request $request)
    {
        try {
            $merchant = $this->getMerchantInfo();
            $info = '系统错误';
            if ($merchant['type'] == 0) {
                //管理员
                $id = $request->get("id");
                $list = DB::table("push_print_shop_lists")->where("id", $id)->first();
                $info = DB::table("push_print_shop_lists")->where("machine_code", $list->machine_code)->get();
                if (count($info) > 1) {
                    if (DB::table("push_print_shop_lists")->where("id", $id)->delete()) {
                        return json_encode(['success' => 1, 'data' => '删除成功']);
                    } else {
                        $info = '删除失败!';
                    }
                } else {//提交到易联云接口
                    $push = new AopClient();
                    $config = PushConfig::where("id", 1)->first();
                    $delete = $push->action_removeprinter($config->push_id, $list->machine_code, $config->push_key, $list->msign);
                    if ($delete == 1) {
                        if (DB::table("push_print_shop_lists")->where("id", $id)->delete()) {
                            return json_encode(['success' => 1, 'data' => '删除成功']);
                        }
                    } else {
                        $info = '执行删除失败!';
                    }
                }
            } else {
                $info = '非管理员无权限';
            }
            return json_encode(['success' => 0, 'msg' => $info]);
        } catch (\Exception $e) {
            return json_encode(['success' => 0, 'msg' => $e->getMessage() . $e->getLine()]);
        }


    }

    //配置易联云
    public function getMachineCfg(Request $request)
    {
        try {
            $merchant = $this->getMerchantInfo();
            $info = '系统错误';
            if ($merchant['type'] == 0) {
                //管理员
                $list = DB::table("push_configs")->where('merchant_id', $merchant['id'])->first();
                if (!$list) {
                    $time = date('YmdHis');
                    DB::table("push_configs")->insert(['merchant_id' => $merchant['id'], 'created_at' => $time, 'updated_at' => $time]);
                    $list = DB::table("push_configs")->where('merchant_id', $merchant['id'])->first();
                }
                return json_encode(['success' => 1, 'data' => [$list]]);
            } else {
                $info = '非管理员无权限';
            }
            return json_encode(['success' => 0, 'msg' => $info]);
        } catch (\Exception $e) {
            return json_encode(['success' => 0, 'msg' => $e->getMessage() . $e->getLine()]);
        }
    }

    public function setMachineCfg(Request $request)
    {
        try {
            $merchant = $this->getMerchantInfo();
            $info = '系统错误';
            if ($merchant['type'] == 0) {
                //管理员
                $data['push_id'] = $request->push_id;
                $data['push_key'] = $request->push_key;
                $data['push_user_name'] = $request->push_user_name;
                $list = DB::table("push_configs")->where('merchant_id', $merchant['id'])->first();
                $time = date('YmdHis');
                if (!$list) {
                    $data['created_at'] = $time;
                    $data['updated_at'] = $time;
                    $data['merchant_id'] = $merchant['id'];
                    $ist = DB::table("push_configs")->insert($data);
                    if ($ist) {
                        return json_encode(['success' => 1, 'data' => ['操作成功']]);
                    } else {
                        $info = '操作失败!';
                    }
                } else {
                    $data['updated_at'] = $time;
                    $ist = DB::table("push_configs")->where('merchant_id', $merchant['id'])->update($data);
                    if ($ist) {
                        return json_encode(['success' => 1, 'data' => ['操作成功']]);
                    } else {
                        $info = '操作失败!';
                    }
                }
            } else {
                $info = '非管理员无权限';
            }
            return json_encode(['success' => 0, 'msg' => $info]);
        } catch (\Exception $e) {
            return json_encode(['success' => 0, 'msg' => $e->getMessage() . $e->getLine()]);
        }
    }

    public function getOrderDetail(Request $request){
        try{
            $user = $this->getMerchantInfo();
            $type = $request->get('type');//类型
            $time_start = $request->get('time_start');//开始时间
            $time_end = $request->get('time_end');//结束时间
            $where=[];
            $where[]=['orders.pay_status',1];
            if($time_start)
            {
                $times=date("Y-m-d ".'00:00:00',strtotime($time_start));
                $where[]=['orders.updated_at','>',$times];
            }
            if($time_end)
            {
                $timee=date("Y-m-d ".'23:59:59',strtotime($time_end));
                $where[]=['orders.updated_at','<',$timee];
            }
            $m_type = Merchant::where('id', $user['id'])->first()->type;
            $out_trade_no = $request->get('out_trade_no');
            $store_ids = self::SelectAdminOrder($user['id']);
            $m_id = $user['id'];
            $Order = Order::when($m_type == '0' && $store_ids, function ($query) use ($store_ids) {
                return $query->whereIn('orders.store_id', $store_ids);
            })
                ->when($m_type != '0', function ($query) use ($m_id) {
                    return $query->where('orders.merchant_id', $m_id);
                })
                ->when($type, function ($query) use ($type) {
                    return $query->whereIn('orders.type', [$type]);
                })
                ->when($out_trade_no, function ($query) use ($out_trade_no) {
                    return $query->where('orders.order_trade_no', $out_trade_no);
                })->where($where)->orderBy('created_at', 'desc')->get();
            $res=['ali'=>['count'=>0,'amount'=>0],'wx'=>['count'=>0,'amount'=>0],'jd'=>['count'=>0,'amount'=>0],'yzf'=>['count'=>0,'amount'=>0],'un'=>['count'=>0,'amount'=>0],'xdl'=>['count'=>0,'amount'=>0]];
            if($Order){
                foreach ($Order as $v){
                    $otype=$this->retype($v->type);
                    $optype=$this->retype($v->pay_status);
                    if($otype=='支付宝'||$otype=='扫码支付'){
                        $res['ali']['count']++;
                        $res['ali']['amount']+=$v->total_amount;
                    }
                    if($otype=='微信支付'){
                        $res['wx']['count']++;
                        $res['wx']['amount']+=$v->total_amount;
                    }
                    if($otype=='京东支付'){
                        $res['jd']['count']++;
                        $res['jd']['amount']+=$v->total_amount;
                    }
                    if($otype=='银联支付'){
                        $res['un']['count']++;
                        $res['un']['amount']+=$v->total_amount;
                    }
                    if($otype=='翼支付支付'){
                        $res['yzf']['count']++;
                        $res['yzf']['amount']+=$v->total_amount;
                    }
                    if($otype=='新大陆刷卡'){
                        $res['xdl']['count']++;
                        $res['xdl']['amount']+=$v->total_amount;
                    }
                }
            }
            $res['ali']['amount']=round($res['ali']['amount'],2);
            $res['wx']['amount']=round($res['wx']['amount'],2);
            $res['jd']['amount']=round($res['jd']['amount'],2);
            $res['un']['amount']=round($res['un']['amount'],2);
            $res['yzf']['amount']=round($res['yzf']['amount'],2);
            $res['xdl']['amount']=round($res['xdl']['amount'],2);
            $total=$res['ali']['amount']+$res['wx']['amount']+$res['yzf']['amount']+$res['jd']['amount']+$res['un']['amount']+$res['xdl']['amount'];
            $page = (int)$request->get('page');//第几页
            $number = (int)$request->get('number', 20);//第几页
            if ($page) {
                $b = (int)($page - 1) * $number;
                $Order = Order::offset($b)->limit($number)->when($m_type == '0', function ($query) use ($store_ids) {
                    return $query->whereIn('orders.store_id', $store_ids);
                })
                    ->when($m_type != '0', function ($query) use ($m_id) {
                        return $query->where('orders.merchant_id', $m_id);
                    })
                    ->when($type, function ($query) use ($type) {
                        return $query->whereIn('orders.type', [$type]);
                    })
                    ->when($out_trade_no, function ($query) use ($out_trade_no) {
                        return $query->where('orders.order_trade_no', $out_trade_no);
                    })->where($where)->orderBy('created_at', 'desc')->get();
            }
            return json_encode(['success'=>1,'data'=>['detail'=>$res,'total'=>$total,'order'=>$Order]]);
        }catch (\Exception $e){
            return json_encode(['success'=>0,'msg'=>$e->getMessage().$e->getLine()]);
        }
    }

    //扫码枪入库
    public function TradePay(Request $request)
    {
        $user = $this->getMerchantInfo();
        $no = $request->get('out_trade_no');
        $m_id = $user['id'];
        $code = $request->get('code');
        $data = $request->except(['token']);
        //支付宝28微信13QQ91京东18正常都是18位，支付宝早期有密支付是17位，银联新版19位62打头
        $str = substr($code, 0, 2);
        //判断通道 这里需要在表里设置 切换通道
        $MerchantPayWay = MerchantPayWay::where('merchant_id', $m_id)->first();
        $configs = AlipayIsvConfig::where('id', 1)->first();
        $store = MerchantShops::where('merchant_id', $m_id)->first();
        if (!$store) {
            $msg = '账号没有绑定任何店铺相关数据！请联系服务商开通店铺！';
            return json_encode([
                'status' => 0,
                'msg' => $msg
            ]);
        }
        //判断通道
        if (!$MerchantPayWay) {
            $msg = '没有设置收款通道！请设置收款通道';
            return json_encode([
                'status' => 0,
                'msg' => $msg
            ]);
        }
        //判断订单号
        if (!$no) {
            $msg = '订单号不能为空';
            return json_encode([
                'status' => 0,
                'msg' => $msg
            ]);
        }
        /****************支付宝 开始*******************/
        if (($str == '25')||($str == '26')||($str == '27')||($str == '28')||($str == '29')||($str == '30')) {
             //支付宝官方
            if ($MerchantPayWay->alipay == "oalipay" || $MerchantPayWay->alipay == "salipay") {
                $ao = new AlipayOpenController();
                $aop = $ao->AopClient();
                $aop->apiVersion = "2.0";
                $aop->method = 'alipay.trade.pay';
                $aop->notify_url = url('/notify_m');
                $requests = new AlipayTradePayRequest();
                $requests->setNotifyUrl(url('/notify_m'));
                if ($MerchantPayWay->alipay == "oalipay") {
                    $type = 103;
                    //仅当面付
                    $store = MerchantShops::where('merchant_id', $m_id)->where('store_type', 'oalipay')->first();
                    $storeInfo = AlipayAppOauthUsers::where('store_id', $store->store_id)->first();
                    if (!$storeInfo) {
                        $msg = '商户信息不存在！请重新授权！';
                        return json_encode([
                            'status' => 0,
                            'msg' => $msg
                        ]);
                    }
                    $desc = $request->get('desc', $storeInfo->auth_shop_name . "机具收款");
                    //提交到口碑
                    $requests->setBizContent("{" .
                        "    \"out_trade_no\":\"" . $no . "\"," .
                        "    \"scene\":\"bar_code\"," .
                        "    \"auth_code\":\"" . $data['code'] . "\"," .
                        "    \"subject\":\"" . $desc . "\"," .
                        "    \"total_amount\":" . $data['total_amount'] . "," .
                        "    \"timeout_express\":\"90m\"," .
                        "    \"body\":\"" . $desc . "\"," .
                        "      \"goods_detail\":[{" .
                        "        \"goods_id\":\"" . $store->store_id . "\"," .
                        "        \"goods_name\":\"" . $desc . "\"," .
                        "        \"quantity\":1," .
                        "        \"price\":" . $data['total_amount'] . "," .
                        "        \"body\":\"" . $desc . "\"" .
                        "        }]," .
                        "    \"store_id\":\"" . $store->store_id . "\"," .
                        "    \"extend_params\":{" .
                        "      \"sys_service_provider_id\":\"" . $configs->pid . "\"" .
                        "}" .
                        "  }");
                }
                //门店付款
                if ($MerchantPayWay->alipay == "salipay") {
                    $type = 105;
                    $store = MerchantShops::where('merchant_id', $m_id)->where('store_type', 'salipay')->first();
                    $storeInfo = AlipayShopLists::where('store_id', $store->store_id)->first();
                    if (!$storeInfo) {
                        $msg = '商户信息不存在！请联系服务商！';
                        return json_encode([
                            'status' => 0,
                            'msg' => $msg
                        ]);
                    }
                    $desc = $request->get('desc', $storeInfo->main_shop_name . "机具收款");
                    //提交到口碑
                    $requests->setBizContent("{" .
                        "    \"out_trade_no\":\"" . $no . "\"," .
                        "    \"scene\":\"bar_code\"," .
                        "    \"auth_code\":\"" . $data['code'] . "\"," .
                        "    \"subject\":\"" . $desc . "\"," .
                        "    \"total_amount\":" . $data['total_amount'] . "," .
                        "    \"timeout_express\":\"90m\"," .
                        "    \"alipay_store_id\":\"" . $storeInfo->shop_id . "\"," .
                        "    \"body\":\"" . $desc . "\"," .
                        "      \"goods_detail\":[{" .
                        "        \"goods_id\":\"" . $store->store_id . "\"," .
                        "        \"goods_name\":\"" . $desc . "\"," .
                        "        \"quantity\":1," .
                        "        \"price\":" . $data['total_amount'] . "," .
                        "        \"body\":\"" . $desc . "\"" .
                        "        }]," .
//                        "    \"store_id\":\"" . $store->store_id . "\"," .
                        "    \"extend_params\":{" .
                        "      \"sys_service_provider_id\":\"" . $configs->pid . "\"" .
                        "}" .
                        "  }");
                }

                try {
                    $result = $aop->execute($requests, null, $storeInfo->app_auth_token);
                    $responseNode = str_replace(".", "_", $requests->getApiMethodName()) . "_response";
                    $resultCode = $result->$responseNode->code;
                    $pay_user = $result->$responseNode->buyer_user_id;
                    $price = $result->$responseNode->total_amount;
                    $receipt_amount = $result->$responseNode->receipt_amount;
                    if (!empty($resultCode) && $resultCode == 10000) {//10003 正在输入密码
                        Order::create([
                            'out_trade_no' => $no,
                            'trade_no' => $result->$responseNode->trade_no,
                            'store_id' => $store->store_id,
                            'total_amount' => $result->$responseNode->total_amount,
                            'status' => 'TRADE_SUCCESS',
                            'pay_status' => 1,
                            'merchant_id' => $m_id,
                            'buyer_id'=>$pay_user,
                            'type' => $type,
                        ]);
                        $mdata = [
                            'buyerId'=>$pay_user,
                            'totalAmount'=>$price,
                        ];
                        Member::AddMemberPoint($mdata,'支付宝');
                        return json_encode([
                            'status' => 1,
                            'msg' => '支付成功',
                            'out_trade_no' => $no,
                            'buyer_id'=>$pay_user,
                            'trade_no' => $result->$responseNode->trade_no,
                        ]);

                    } else {
                        Order::create([
                            'out_trade_no' => $no,
                            'trade_no' => '',
                            'store_id' => $store->store_id,
                            'total_amount' => $data['total_amount'],
                            'status' => $result->$responseNode->code,
                            'pay_status' => 3,
                            'merchant_id' => $m_id,
                            'buyer_id'=>$pay_user,
                            'type' => $type
                        ]);
                    }
                    //正在支付
                    $out_trade_no = $no;
                    if (!empty($resultCode) && $resultCode == 10003) {
                        $status = $this->AlipayTradePayQuery($out_trade_no, $storeInfo->app_auth_token);
                        $queryTime=0;
                        $dbStatus=3;
                        while (($status->alipay_trade_query_response->trade_status == "WAIT_BUYER_PAY")&&($dbStatus==3)&&($queryTime<20)){
                            $queryTime +=1;
                            sleep(rand(3,5));
                            $dbStatus=Order::where('out_trade_no' , $no)->first()->pay_status;
                            Log::info($dbStatus);
                            $status = $this->AlipayTradePayQuery($out_trade_no, $storeInfo->app_auth_token);
                        }
                        if ($status->alipay_trade_query_response->trade_status == "WAIT_BUYER_PAY") {
                            $chanel = $this->AlipayTradePayCancel($out_trade_no, $storeInfo->app_auth_token);
                            if ($chanel->alipay_trade_cancel_response->code == "10000") {
                                Order::where('out_trade_no', $out_trade_no)->update([
                                    'status' => 'TRADE_CLOSED',
                                    'pay_status' => 4,
                                ]);
                                return json_encode([
                                    'status' => 0,
                                    'msg' => '订单已经关闭'
                                ]);
                            } else {
                                return json_encode([
                                    'status' => 0,
                                    'msg' => $status->alipay_trade_cancel_response->sub_msg
                                ]);
                            }
                        }
                        if ($status->alipay_trade_query_response->trade_status == "TRADE_SUCCESS" && $status->alipay_trade_query_response->trade_status != "WAIT_BUYER_PAY") {
                            Order::where('out_trade_no', $no)->update([
                                'status' => 'TRADE_SUCCESS',
                                'pay_status' => 1,
                                'out_trade_no' => $no,
                                'trade_no' => $status->alipay_trade_query_response->trade_no,
                            ]);
                            $mdata = [
                                'buyerId'=>$pay_user,
                                'totalAmount'=>$price,
                            ];
                            Member::AddMemberPoint($mdata,'支付宝');
                            return json_encode([
                                'status' => 1,
                                'msg' => '订单支付成功',
                                'out_trade_no' => $no,
                                'buyer_id'=>$pay_user,
                                'trade_no' => $status->alipay_trade_query_response->trade_no
                            ]);
                        } else {
                            return json_encode([
                                'status' => 0,
                                'msg' => $status->alipay_trade_query_response->sub_msg
                            ]);
                        }
                    } else {
                        $msg = $result->$responseNode->sub_msg;//错误信息
                        return json_encode([
                            'status' => $result->$responseNode->sub_code,
                            'msg' => $msg,
                        ]);
                    }
                } catch (\Exception $exception) {
                    Log::info($exception);
                    return json_encode([
                        'status' => 0,
                        'msg' => '系统异常请重新再试123！'
                    ]);
                }
            }

            //支付宝平安
            if ($MerchantPayWay->alipay == "pingan") {
                $store = MerchantShops::where('merchant_id', $m_id)->where('store_type', 'pingan')->first();
                $storeInfo = PinganStore::where('external_id', $store->store_id)->first();
                $ao = new BaseController();
                $aop = $ao->AopClient();
                $aop->method = "fshows.liquidation.submerchant.alipay.trade.pay";
                $pay = [
                    'out_trade_no' => $no,
                    'notify_url' => url('/admin/pingan/notify_url'),
                    'scene' => 'bar_code',
                    'auth_code' => $data['code'],
                    'total_amount' => $data['total_amount'],
                    'subject' => $request->get('desc') . '门店收款',
                    'body' => $request->get('desc') . '门店收款信息',
                    'sub_merchant' => [
                        'merchant_id' => $storeInfo->sub_merchant_id
                    ],
                ];
                $dataAop = array('content' => json_encode($pay));
                try {
                    $response = $aop->execute($dataAop);
                    $responseArray = json_decode($response, true);
                    //保存数据库
                    if ($responseArray['success']) {
                        $price = $responseArray['return_value']['totalAmount'];
                        $pay_user = $responseArray['return_value']['buyerLogonId'];
                        $insert = [
                            'trade_no' => $responseArray['return_value']['tradeNo'],
                            "out_trade_no" => $responseArray['return_value']['outTradeNo'],
                            'store_id' => $store->store_id,
                            'total_amount' => $price,
                            'status' => 'SUCCESS',
                            'pay_status' => 1,
                            'merchant_id' => $m_id,
                            'type' => 305
                        ];
                        Order::create($insert);
                        return json_encode([
                            'status' => 1,
                            'msg' => '支付成功',
                            'trade_no' => $responseArray['return_value']['tradeNo'],
                            "out_trade_no" => $responseArray['return_value']['outTradeNo'],
                        ]);

                    } else {
                        $out_trade_no = $no;
                        $insert1 = [
                            'trade_no' => "",
                            "out_trade_no" => $out_trade_no,
                            'store_id' => $store->store_id,
                            'total_amount' => $data['total_amount'],
                            'status' => '',
                            'pay_status' => 3,
                            'merchant_id' => $m_id,
                            'type' => 305
                        ];
                        Order::create($insert1);
                        $status = $this->PingAnOrderQuery($out_trade_no);
                        $data = json_decode($status, true);
                        if ($data['success']) {
                            //等待付款
                            if ($data['return_value']['trade_status'] == "WAIT_BUYER_PAY") {
                                $i = 60;//循环35次
                                for ($a = 1; $a < $i; $a++) {
                                    sleep(1);
                                    $status = $this->PingAnOrderQuery($out_trade_no);
                                    $data = json_decode($status, true);
                                    if ($data['return_value']['trade_status'] == "TRADE_SUCCESS") {
                                        Order::where('out_trade_no', $out_trade_no)->update(
                                            [
                                                'status' => "TRADE_SUCCESS",
                                                'pay_status' => 1,
                                                'trade_no' => $status['return_value']['trade_no'],
                                                "out_trade_no" => $out_trade_no,
                                            ]);
                                        return json_encode([
                                            'status' => 1,
                                            'msg' => '订单支付成功',
                                            'trade_no' => $status['return_value']['trade_no'],
                                            "out_trade_no" => $out_trade_no
                                        ]);
                                        break;
                                    }
                                    if ($data['return_value']['trade_status'] != "WAIT_BUYER_PAY") {
                                        break;
                                    }

                                }
                                if ($data['return_value']['trade_status'] == "WAIT_BUYER_PAY") {
                                    $chanel = $this->PingAnOrderClose($out_trade_no);
                                    $data = json_decode($chanel, true);
                                    if ($data['success']) {
                                        Order::where('out_trade_no', $out_trade_no)->update([
                                            'status' => 'TRADE_CLOSED',
                                            'pay_status' => 4,
                                        ]);
                                        return json_encode([
                                            'status' => 0,
                                            'msg' => '订单已经关闭'
                                        ]);
                                    } else {
                                        return json_encode([
                                            'status' => 0,
                                            'msg' => $data['error_message']
                                        ]);
                                    }

                                }

                            }

                        } else {
                            return json_encode([
                                'status' => 0,
                                'msg' => $data['error_message']
                            ]);
                        }
                    }

                } catch (\Exception $exception) {
                    Log::info($exception);
                    return json_encode([
                        'status' => 0,
                        'msg' => '系统异常请重新再试456！'
                    ]);
                }
            }

            //支付宝 浦发
            if ($MerchantPayWay->alipay == "pufa") {
                return $this->PufaPay($m_id, $data, 603, $no);
            }

            //支付宝 民生
            if ($MerchantPayWay->alipay == "ms") {
                // 接口工具参数准备
                $store = MerchantShops::where('merchant_id', $m_id)->where('store_type', 'ms')->first();
                $MSstore = DB::table('ms_pay_way')->where('store_id', $store->store_id)->where('pay_way', 'ZFBZF')->first();
                $ms = MinSheng::start();
                $config = DB::table('ms_configs')->where('id', '=', '1')->first();
                MinSheng::$rsa->self_public_key = MinSheng::$rsa->matePubKey($config->self_public_key);
                MinSheng::$rsa->self_private_key = MinSheng::$rsa->matePriKey($config->self_private_key);
                MinSheng::$rsa->third_public_key = MinSheng::$rsa->matePubKey($config->third_public_key);
                $odata = [

                    'subject' => '门店消费收款',
                    'desc' => '门店消费收款',
                    'operatorId' => 0,
                    'storeId' => $store->store_id,
                ];
                return $cout = $ms->pay(503, $code, $data['total_amount'], $store->store_id, $MSstore->merchant_id, $odata, $m_id, $callback = '');
            }

            //微众银行支付宝
            if ($MerchantPayWay->alipay == 'webank') {
                $store = MerchantShops::where('merchant_id', $m_id)->where('store_type', 'webank')->first();
                $wbapp = new WebankBarcodepayController();

                $result = $wbapp->tradepay(2, $no, $data['code'], $data['total_amount'], $request->get('desc') . '商家收款', $request->get('desc') . '门店收款信息', $m_id, $store->store_id);
                //Log::info($result);
                return $result;
            }
            $msg = '尚未支持' . $MerchantPayWay->alipay . '通道';
            return json_encode([
                'status' => 0,
                'msg' => $msg,
            ]);
        }
        /****************支付宝结束*******************/


        /****************微信 开始*******************/

       if (($str == "10")||($str == "11")||($str == "12")||($str == "13")||($str == "14")||($str == "15")) { 
            //官方的微信
            if ($MerchantPayWay->weixin == "weixin") {
                $weixin = new \App\Http\Controllers\Weixin\BaseController();
                $options = $weixin->Options();
                try {
                    $store = MerchantShops::where('merchant_id', $m_id)->where('store_type', 'weixin')->first();
                    $mch_id = WeixinShopList::where('store_id', $store->store_id)->first()->mch_id;
                } catch (\Exception $exception) {
                    return json_encode([
                        'status' => 0,
                        'msg' => '商户信息通道出错！请检测配置是否正确'
                    ]);
                }
                $options['payment']['sub_merchant_id'] = $mch_id;//微信子商户号
                $total_fee = (int)($data['total_amount'] * 100);//金额
                $app = new Application($options);
                $payment = $app->payment;
                $attributes = [
                    // 'trade_type' => 'MICROPAY', // JSAPI，NATIVE，APP...
                    'body' => $request->get('desc') . '商家收款',
                    'detail' => $request->get('desc') . '商家收款',
                    'out_trade_no' => $no,
                    'total_fee' => $total_fee,
                    'spbill_create_ip' => $_SERVER['SERVER_ADDR'],
                    'auth_code' => $data['code']
                ];
                $order = new \EasyWeChat\Payment\Order($attributes);
                $result = $payment->pay($order);
                if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS') {
                    $insertW = [
                        'trade_no' => $result->transaction_id,
                        "out_trade_no" => $no,
                        'store_id' => $store->store_id,
                        'total_amount' => $data['total_amount'],
                        'status' => 'SUCCESS',
                        'buyer_id'=>$result->openid,
                        'pay_status' => 1,
                        'merchant_id' => $m_id,
                        'type' => 202
                    ];
                    Order::create($insertW);
                    $mdata = [
                        'buyerId'=>$result->openid,
                        'totalAmount'=>$data['totalAmount'],
                    ];
                    Member::AddMemberPoint($mdata,'微信');
                    return json_encode([
                        'status' => 1,
                        'msg' => '支付成功',
                        'trade_no' => $result->transaction_id,
                        'buyer_id'=>$result->openid,
                        "out_trade_no" => $no,
                    ]);
                } else {
                    $insertW = [
                        'trade_no' => $result->transaction_id,
                        "out_trade_no" => $no,
                        'store_id' => $store->store_id,
                        'total_amount' => $data['total_amount'],
                        'status' => '',
                        'buyer_id'=>$result->openid,
                        'pay_status' => 3,
                        'merchant_id' => $m_id,
                        'type' => 202
                    ];
                    Order::create($insertW);
                    $out_trade_no = $no;
                    //用户正在输入密码
                    if ($result->err_code == "USERPAYING") {
                        //暂停10秒
                        $i = 60;
                        for ($a = 1; $a < $i; $a++) {
                            sleep(1);
                            $status = $this->WxOrderStatus($out_trade_no);
                            if ($status->trade_state == 'SUCCESS') {
                                Order::where('out_trade_no', $out_trade_no)->update([
                                    'status' => "SUCCESS",
                                    'pay_status' => 1,
                                ]);
                                $mdata = [
                                   'buyerId'=>$result->openid,
                                   'totalAmount'=>$data['totalAmount'],
                                ];
                                Member::AddMemberPoint($mdata,'微信');
                                return json_encode([
                                    'status' => 1,
                                    'msg' => '订单支付成功',
                                    'buyer_id'=>$result->openid,
                                    'trade_no' => $status->transaction_id,
                                    "out_trade_no" => $no,
                                ]);
                                break;
                            }
                            if ($status->trade_state != "USERPAYING") {
                                break;
                            }
                        }
                        if ($status->trade_state == 'USERPAYING') {
                            return $this->WxOrderReverse($out_trade_no);//返回撤销订单成功的提醒
                        }

                        //用户取消
                        return json_encode([
                            'status' => 0,
                            'msg' => $status->trade_state_desc,
                        ]);

                    } else {
                        $msg = $result->err_code_des;//错误信息
                        return json_encode([
                            'status' => 0,
                            'msg' => $msg,
                        ]);
                    }
                }
            }
            //平安的微信
            if ($MerchantPayWay->weixin == "pingan") {
                $store = MerchantShops::where('merchant_id', $m_id)->where('store_type', 'pingan')->first();
                $storeInfo = PinganStore::where('external_id', $store->store_id)->first();
                $ao = new BaseController();
                $aop = $ao->AopClient();
                $aop->method = "fshows.liquidation.wx.trade.pay";
                $pay = [
                    'out_trade_no' => $no,
                    'body' => $request->get('desc') . '门店收款信息',
                    'total_fee' => $data['total_amount'],
                    'spbill_create_ip' => $_SERVER['SERVER_ADDR'],
                    'auth_code' => $data['code'],
                    'store_id' => $storeInfo->sub_merchant_id
                ];
                $dataWAop = array('content' => json_encode($pay));
                try {
                    $response = $aop->execute($dataWAop);
                    $responseArray = json_decode($response, true);
                    Log::info($responseArray);Log::info('11111111');
                    //保存数据库
                    if ($responseArray['success']) {
                        $price = $responseArray['return_value']['total_fee'];
                        $insertPW = [
                            'trade_no' => $responseArray['return_value']['transaction_id'],
                            "out_trade_no" => $responseArray['return_value']['out_trade_no'],
                            'store_id' => $store->store_id,
                            'total_amount' => $price,
                            'status' => 'SUCCESS',
                            'pay_status' => 1,
                            'merchant_id' => $m_id,
                            'type' => 306
                        ];
                        $istorderid=Order::create($insertPW);
                        $liquidator_commission_fee=$responseArray['return_value']['total_fee']-$responseArray['return_value']['net_money']-$responseArray['return_value']['pay_platform_rate']*$responseArray['return_value']['total_fee']-$responseArray['return_value']['bank_commission_rate']*$responseArray['return_value']['total_fee'];
//                        $liquidator_commission_fee=$data['total_amount']*$data['liquidator_commission_rate'];
                        $liquidator_commission_fee=round($liquidator_commission_fee, 2);
                        //计入分润
                        if($liquidator_commission_fee>0){
                            $cmd=New UserProfitController();
                            $res=$cmd->orderToprofit($istorderid->id,$liquidator_commission_fee,($responseArray['return_value']['pay_platform_rate']+$responseArray['return_value']['bank_commission_rate'])*100,($responseArray['return_value']['pay_platform_rate']+$responseArray['return_value']['bank_commission_rate']+$responseArray['return_value']['liquidator_commission_rate'])*100);
                            $res=json_decode($res,true);
                            if($res['code']!=1){
                                Log::info($responseArray);
                                Log::info('分润+++++++++++++++++++');
                                Log::info($responseArray['return_value']['pay_platform_rate']." ".$responseArray['return_value']['bank_commission_rate']." ".$responseArray['return_value']['liquidator_commission_rate']);
                                Log::info($res['msg']);
                            }
                        }
                        return json_encode([
                            'status' => 1,
                            'msg' => '支付成功',
                            'trade_no' => $responseArray['return_value']['transaction_id'],
                            "out_trade_no" => $responseArray['return_value']['out_trade_no'],
                        ]);
                    } else {
                        $insertPW = [
                            'trade_no' => "",
                            "out_trade_no" => $no,
                            'store_id' => $store->store_id,
                            'total_amount' => $data['total_amount'],
                            'status' => '',
                            'pay_status' => 3,
                            'merchant_id' => $m_id,
                            'type' => 306
                        ];
                        $istorderid=Order::create($insertPW);
                        //暂停10秒
                        $out_trade_no = $no;
                        $status = $this->PingAnOrderQuery($out_trade_no);
                        $status = json_decode($status, true);
                        if ($status['return_value']['trade_state'] == 'USERPAYING') {
                            $i = 60;
                            for ($a = 1; $a < $i; $a++) {
                                sleep(1);
                                $status = $this->PingAnOrderQuery($out_trade_no);
                                $status = json_decode($status, true);
                                Log::info($status);Log::info('222222');

                                if ($status['return_value']['trade_state'] == "SUCCESS") {
                                    Order::where('out_trade_no', $out_trade_no)->update([
                                        'status' => "SUCCESS",
                                        'pay_status' => 1,
                                        'trade_no' => $status['return_value']['trade_no'],
                                        "out_trade_no" => $out_trade_no,
                                    ]);
                                    $liquidator_commission_fee=$status['return_value']['total_fee']-$status['return_value']['net_receipt_amount']-$status['return_value']['pay_platform_commission_rate']*$status['return_value']['total_fee']-$status['return_value']['bank_commission_rate']*$status['return_value']['total_fee'];
//                        $liquidator_commission_fee=$data['total_amount']*$data['liquidator_commission_rate'];
                                    $liquidator_commission_fee=round($liquidator_commission_fee, 2);
                                    //计入分润
                                    if($liquidator_commission_fee>0){
                                        $cmd=New UserProfitController();
                                        $res=$cmd->orderToprofit($istorderid->id,$liquidator_commission_fee,($status['return_value']['pay_platform_rate']+$status['return_value']['bank_commission_rate'])*100,($status['return_value']['pay_platform_rate']+$status['return_value']['bank_commission_rate']+$status['return_value']['liquidator_commission_rate'])*100);
                                        $res=json_decode($res,true);
                                        if($res['code']!=1){
                                            Log::info($status);
                                            Log::info('分润+++++++++++++++++++');
                                            Log::info($status['return_value']['pay_platform_rate']." ".$status['return_value']['bank_commission_rate']." ".$status['return_value']['liquidator_commission_rate']);
                                            Log::info($res['msg']);
                                        }
                                    }
                                    return json_encode([
                                        'status' => 1,
                                        'msg' => '订单支付成功',
                                        'trade_no' => $status['return_value']['trade_no'],
                                        "out_trade_no" => $out_trade_no,
                                    ]);
                                    break;
                                }
                                if ($status['return_value']['trade_state'] != 'USERPAYING') {
                                    break;
                                }

                            }
                            //撤销订单接口
                            if ($status['return_value']['trade_state'] == "USERPAYING") {
                                $chanel = $this->PingAnOrderClose($out_trade_no);
                                $data = json_decode($chanel, true);
                                if ($data['success']) {
                                    Order::where('out_trade_no', $out_trade_no)->update([
                                        'status' => "CLOSED",
                                        'pay_status' => 4,
                                    ]);
                                    return json_encode([
                                        'status' => 0,
                                        'msg' => '订单关闭'
                                    ]);
                                } else {
                                    return json_encode([
                                        'status' => 0,
                                        'msg' => $data['error_message']
                                    ]);
                                }
                            }

                            //用户取消或者失败
                            return json_encode([
                                'status' => 0,
                                'msg' => $status['return_value']['trade_state_desc']
                            ]);

                        }

                        if ($status['success'] == false) {
                            return json_encode([
                                'status' => 0,
                                'msg' => $status['error_message']
                            ]);
                        }
                    }
                } catch (\Exception $exception) {
                    Log::info($exception);
                    return json_encode([
                        'status' => 0,
                        'msg' => '系统异常请重新再试567！'
                    ]);
                }

            }
            //浦发微信
            if ($MerchantPayWay->weixin == "pufa") {
                return $this->PufaPay($m_id, $data, 604, $no);
            }
            //微信 民生
            if ($MerchantPayWay->weixin == "ms") {
                // 接口工具参数准备
                $store = MerchantShops::where('merchant_id', $m_id)->where('store_type', 'ms')->first();
                $MSstore = DB::table('ms_pay_way')->where('store_id', $store->store_id)->where('pay_way', 'WXZF')->first();
                $ms = MinSheng::start();
                $config = DB::table('ms_configs')->where('id', '=', '1')->first();
                MinSheng::$rsa->self_public_key = MinSheng::$rsa->matePubKey($config->self_public_key);
                MinSheng::$rsa->self_private_key = MinSheng::$rsa->matePriKey($config->self_private_key);
                MinSheng::$rsa->third_public_key = MinSheng::$rsa->matePubKey($config->third_public_key);
                $odata = [

                    'subject' => '消费收款',
                    'desc' => '门店消费收款',
                    'operatorId' => 0,
                    'storeId' => $store->store_id,
                ];
                return $cout = $ms->pay(504, $code, $data['total_amount'], $store->store_id, $MSstore->merchant_id, $odata, $m_id, $callback = '');
            }

            //微众微信
            if ($MerchantPayWay->weixin == 'webank') {
                $store = MerchantShops::where('merchant_id', $m_id)->where('store_type', 'webank')->first();
                $wbapp = new WebankBarcodepayController();
                $result = $wbapp->tradepay(1, $no, $data['code'], $data['total_amount'], $request->get('desc') . '商家收款', $request->get('desc') . '门店收款信息', $m_id, $store->store_id);
                return $result;
            }
        }
        /****************微信支付 结束*******************/
        /****************银联 开始*******************/
        if ($str == '62') {
            try {
                //衫德的银联
                $store = MerchantShops::where('merchant_id', $m_id)->where('store_type', 'unionpay')->first();
                $u = new UnionpayScan();
                $u->scanSend($code, $data['price'], $store->store_id, $m_id);
            } catch (\Exception $exception) {
                dd($exception);
            }


        }
        /****************银联 结束*******************/
    }


    public function Reverse(Request $request)
    {
        Log::info('======= Reverse start ========');
        Log::info($request);
        $user = $this->getMerchantInfo();
        $no = $request->get('out_trade_no');
        $m_id = $user['id'];
        $code = $request->get('code');
        $data = $request->except(['token']);
        $o = Order::where('out_trade_no',$no)->first();
//        Log::info($o->toArray());
//        Order::where('out_trade_no',$no)->first()->update([
//            'status' => 'TRADE_CANCEL',
//            'pay_status' => 2,]);
//
       // $o->update([
       //     'status' => 'TRADE_CANCEL',
       //     'pay_status' => 2,]);

        Log::info($o->pay_status);
        Log::info('======= Reverse end ========');

        return 'success';
    }
    //浦发统一支付
    public function PufaPay($m_id, $data, $type, $no)
    {
        $pufaconfig = PufaConfig::where("id", '1')->first();
        $store = MerchantShops::where('merchant_id', $m_id)->where('store_type', 'pufa')->first();
        $store = PufaStores::where('store_id', $store->store_id)->first();
        $key = trim($pufaconfig->security_key);
        // 异步通知地址   订单状态修改以及店铺的微信提醒
        $dataR = [
            'service' => 'unified.trade.micropay',
            'version' => '2.0',
            'charset' => 'UTF-8',
            'sign_type' => 'MD5',
            'sign_agentno' => $pufaconfig->partner,
            'mch_id' => $store->merchant_id,//商户号
            'out_trade_no' => $no,
            'body' => $store->merchant_short_name . '收款',
            'attach' => $store->merchant_short_name . '收款',//'附加信息'
            'total_fee' => $data['total_amount'] * 100,//单位为：分
            'mch_create_ip' => $_SERVER['SERVER_ADDR'],
            'auth_code' => $data['code'],
            'time_start' => date('YmdHis', time()),
            'nonce_str' => md5($no),
        ];
        // 生成签名、生成xml数据
        $dataw = Tools::createSign($dataR, $key);
        $xmldata = Tools::toXml($dataw);//生成xml数据

        // 向浦发接口发送xml下单数据
        $xmlresult = Tools::curl($xmldata, $pufaconfig->payurl);//获取银行xml数据
        $thirddata = Tools::setContent($xmlresult);

        //异常系统错误
        if ($thirddata['status'] != "0") {
            return json_encode([
                'status' => 0,
                'msg' => $thirddata['message']
            ]);
        }

        //支付成功
        if ($thirddata['status'] == "0" && $thirddata['result_code'] == '0') {
            Order::create([
                'trade_no' => $thirddata['transaction_id'],
                "out_trade_no" => $no,
                'store_id' => $store->store_id,
                'total_amount' => $data['total_amount'],
                'status' => 'SUCCESS',
                'pay_status' => 1,
                'merchant_id' => $m_id,
                'type' => $type

            ]);

            return json_encode([
                'status' => 1,
                'msg' => '支付成功',
                'trade_no' => $thirddata['transaction_id'],
                "out_trade_no" => $no,
            ]);

        } else {
            Order::create([
                'trade_no' => '',
                "out_trade_no" => $no,
                'store_id' => $store->store_id,
                'total_amount' => $data['total_amount'],
                'status' => '',
                'pay_status' => 3,
                'merchant_id' => $m_id,
                'type' => $type

            ]);
            //需要输入密码
            if ($thirddata['need_query'] == 'Y') {
                $query = $this->PufaQuery($no, $store->merchant_id);

                //用户需要输入密码
                if ($query['trade_state'] == 'USERPAYING') {
                    $i = 60;
                    for ($a = 1; $a < $i; $a++) {
                        sleep(1);
                        $query = $this->PufaQuery($no, $store->merchant_id);
                        if ($query['trade_state'] != 'USERPAYING') {
                            break;//跳转
                        }
                    }
                }
                //支付成功
                if ($query['trade_state'] == 'SUCCESS') {
                    Order::where('out_trade_no', $no)->update(['pay_status' => 1]);
                    return json_encode([
                        'status' => 1,
                        'msg' => '支付成功',
                        'trade_no' => $query['transaction_id'],
                        "out_trade_no" => $no,
                    ]);
                }
                //如果还是未支付 关闭订单
                if ($query['trade_state'] == 'USERPAYING') {
                    //调用撤销订单接口
                    $close = $this->PufaClose($no, $store->merchant_id);
                    if ($close['status'] == "0" && $close['result_code'] == '0') {
                        return json_encode([
                            'status' => 0,
                            'msg' => '订单已经关闭'
                        ]);
                    } else {
                        return json_encode([
                            'status' => 0,
                            'msg' => '系统异常！'
                        ]);
                    }

                }
                return json_encode([
                    'status' => 0,
                    'msg' => $query['trade_state_desc']
                ]);


            } else {
                return json_encode([
                    'status' => 0,
                    'msg' => $thirddata['err_msg']
                ]);
            }
        }
    }

    //浦发查询接口
    public function PufaQuery($out_trade_no, $merchant_id)
    {

        $pufaconfig = PufaConfig::where("id", '1')->first();
        $key = trim($pufaconfig->security_key);
        // 异步通知地址   订单状态修改以及店铺的微信提醒
        $dataR = [
            'service' => 'unified.trade.query',
            'version' => '2.0',
            'charset' => 'UTF-8',
            'sign_type' => 'MD5',
            'mch_id' => $merchant_id,//商户号
            'out_trade_no' => $out_trade_no,
            'nonce_str' => md5($out_trade_no),
        ];
        // 生成签名、生成xml数据
        $dataw = Tools::createSign($dataR, $key);
        $xmldata = Tools::toXml($dataw);//生成xml数据
        // 向浦发接口发送xml下单数据
        $xmlresult = Tools::curl($xmldata, $pufaconfig->payurl);//获取银行xml数据
        $thirddata = Tools::setContent($xmlresult);
        return $thirddata;
    }

    //浦发关闭接口
    public function PufaClose($out_trade_no, $merchant_id)
    {

        $pufaconfig = PufaConfig::where("id", '1')->first();
        $key = trim($pufaconfig->security_key);
        // 异步通知地址   订单状态修改以及店铺的微信提醒
        $dataR = [
            'service' => 'unified.micropay.reverse',
            'version' => '2.0',
            'charset' => 'UTF-8',
            'sign_type' => 'MD5',
            'mch_id' => $merchant_id,//商户号
            'out_trade_no' => $out_trade_no,
            'nonce_str' => md5($out_trade_no),
        ];
        // 生成签名、生成xml数据
        $dataw = Tools::createSign($dataR, $key);
        $xmldata = Tools::toXml($dataw);//生成xml数据
        // 向浦发接口发送xml下单数据
        $xmlresult = Tools::curl($xmldata, $pufaconfig->payurl);//获取银行xml数据
        $thirddata = Tools::setContent($xmlresult);
        return $thirddata;
    }

    //现金入库
    public function MoneyPay(Request $request)
    {
        if (!$request->get('out_trade_no')) {
            return json_encode([
                'status' => 0,
                'msg' => '订单号不能为空',
            ]);
        }
        $user = $this->getMerchantInfo();
        $out_trade_no = $request->get('out_trade_no');
        $data = $request->except(['token']);
        $data['out_trade_no'] = $out_trade_no;
        $data['trade_no'] = time() . rand(1000000, 9999999);
        $data['store_id'] = MerchantShops::where('merchant_id', $user['id'])->first()->store_id;
        $data['status'] = 'SUCCESS';
        $data['pay_status'] = 1;
        $data['type'] = 701;
        $data['merchant_id'] = $user['id'];
        $data['total_amount'] = $request->get('total_amount');
        $this->validate($request, [
            'total_amount' => 'required',
            'type' => 'required',
        ]);
        try {
            Order::create($data);
        } catch (\Exception $exception) {
            return json_encode([
                'status' => 0,
                'msg' => '系统异常'
            ]);
        }

        return json_encode([
            'status' => 1,
            'msg' => '插入成功',
            'out_trade_no' => $out_trade_no
        ]);

    }

    public function retype($type)
    {
        $ali = array(101, 102, 103, 104, 105, 106, 301, 305, 501, 504, 601, 603, 801, 803);
        if (in_array($type, $ali)) {
            return "支付宝";
        }
        $wx = array(201, 202, 203, 302, 306, 502, 505, 602, 604, 802, 804);
        if (in_array($type, $wx)) {
            return "微信支付";
        }
        $jd = array(303, 307, 308);
        if (in_array($type, $jd)) {
            return "京东支付";
        }
        if (in_array($type, [401, 402])) {
            return "银联支付";
        }
        if (in_array($type, [304])) {
            return "翼支付支付";
        }
        if (in_array($type, [1001])) {
            return "新大陆刷卡";
        }
        return '扫码支付';


    }

    //订单查询接口
    public function TradeQuery(Request $request)
    {
        $user = $this->getMerchantInfo();
        $out_trade_no = $request->get('out_trade_no');
        if ($out_trade_no) {
            $true = Order::where('out_trade_no', $out_trade_no)->first();
            if ($true) {
                return json_encode([
                    'status' => 1,
                    'data' => [
                        'out_trade_no' => $true->out_trade_no,
                        'store_name' => '######',
                        'store_phone' => "#######",
                        'pay_user' => $this->retype($true->type),
                        'merchant_id' => $true->merchant_id,
                        'total_amount' => $true->total_amount,
                        'status' => $true->status,
                        'pay_status' => $true->pay_status,
                        'type' => $true->type,
                        'remark' => $true->remark,
                        'created_at' => date('Y-m-d:H:i:s')
                    ]
                ]);
            } else {
                return json_encode([
                    'status' => 0,
                    'msg' => '订单号不存在'
                ]);
            }

        } else {
            return json_encode([
                'status' => 0,
                'msg' => '订单号不能为空'
            ]);
        }

    }

    //查询支付宝的订单状态
    public function AlipayTradePayQuery($out_trade_no, $app_auth_token)
    {
        $ao = new AlipayOpenController();
        $aop = $ao->AopClient();
        $aop->method = 'alipay.trade.query';
        $requests = new AlipayTradeQueryRequest();
        $requests->setBizContent("{" .
            "    \"out_trade_no\":\"" . $out_trade_no . "\"" .
            "  }");
        $result = $aop->execute($requests, '', $app_auth_token);
        return $result;
    }

    //平安的查询接口
    public function PingAnOrderQuery($out_trade_no)
    {
        try {
            $ao = new BaseController();
            $aop = $ao->AopClient();
            $aop->method = "fshows.liquidation.alipay.trade.query";
            $pay = [
                'out_trade_no' => $out_trade_no,
            ];
            $dataWAop = array('content' => json_encode($pay));
            $response = $aop->execute($dataWAop);
            return $response;
        } catch (\Exception $exception) {
            return json_encode(
                [
                    "status" => 0,
                    "msg" => "系统异常"
                ]);
        }
    }

    //平安的关闭订单接口
    public function PingAnOrderClose($out_trade_no)
    {
        $ao = new BaseController();
        $aop = $ao->AopClient();
        $aop->method = "fshows.liquidation.order.reverse";
        $pay = [
            'out_trade_no' => $out_trade_no,
        ];
        $dataWAop = array('content' => json_encode($pay));
        $response = $aop->execute($dataWAop);
        return $response;
    }

    //查询支付宝的订单状态
    public function AlipayTradePayCancel($out_trade_no, $app_auth_token)
    {
        $ao = new AlipayOpenController();
        $aop = $ao->AopClient();
        $aop->method = 'alipay.trade.cancel';
        $requests = new AlipayTradeCancelRequest();
        $requests->setBizContent("{" .
            "    \"out_trade_no\":\"" . $out_trade_no . "\"" .
            "  }");
        $result = $aop->execute($requests, '', $app_auth_token);
        return $result;
    }

    //查询订单
    public function TradePayQuery($out_trade_no)
    {
        $m = Order::where('out_trade_no', $out_trade_no)->first();

        return $m->status;

    }

    //微信官方的订单查询
    public function WxOrderStatus($out_trade_no)
    {
        $user = $this->getMerchantInfo();
        $m_id = $user['id'];
        $weixin = new \App\Http\Controllers\Weixin\BaseController();
        $options = $weixin->Options();
        $store = MerchantShops::where('merchant_id', $m_id)->where('store_type', 'weixin')->first();
        $mch_id = WeixinShopList::where('store_id', $store->store_id)->first()->mch_id;
        $options['payment']['sub_merchant_id'] = $mch_id;//微信子商户号
        $app = new Application($options);
        $payment = $app->payment;
        return $payment->query($out_trade_no);
    }

    //微信官方的订单查询
    public function WxOrderReverse($out_trade_no)
    {
        $user = $this->getMerchantInfo();
        $m_id = $user['id'];
        $weixin = new \App\Http\Controllers\Weixin\BaseController();
        $options = $weixin->Options();
        $store = MerchantShops::where('merchant_id', $m_id)->where('store_type', 'weixin')->first();
        $mch_id = WeixinShopList::where('store_id', $store->store_id)->first()->mch_id;
        $options['payment']['sub_merchant_id'] = $mch_id;//微信子商户号
        $app = new Application($options);
        $payment = $app->payment;
        $status = $payment->reverse($out_trade_no);
        //撤销成功
        if ($status->return_code == "SUCCESS") {
            Order::where('out_trade_no', $out_trade_no)->update([
                'status' => 'CLOSED',
                'pay_status' => 4,
            ]);
            return json_encode([
                'status' => 0,
                'msg' => '交易失败，输入密码等待时间过长！请重新下单',
            ]);
        } else {
            return json_encode([
                'status' => 0,
                'msg' => $status->err_code_des,
            ]);
        }
    }

    //微信官方的订单查询
    public function WxPOrderReverse($out_trade_no)
    {
        $user = $this->getMerchantInfo();
        $m_id = $user['id'];
        $config = PinganConfig::where('id', 1)->first();
        $options = [
            'app_id' => $config->app_id,
        ];
        $store = MerchantShops::where('merchant_id', $m_id)->where('store_type', 'weixin')->first();
        $options['payment']['sub_merchant_id'] = substr($store->store_id, 1);//微信子商户号
        $app = new Application($options);
        $payment = $app->payment;
        $status = $payment->reverse($out_trade_no);
        //撤销成功
        if ($status->return_code == "SUCCESS") {
            return json_encode([
                'status' => 0,
                'msg' => 'pa交易失败，输入密码等待时间过长！请重新下单',
            ]);
        } else {
            return json_encode([
                'status' => 0,
                'msg' => $status->err_code_des,
            ]);
        }
    }

    //平安的查询接口
    public function WxPOrderStatus($out_trade_no)
    {
        $ao = new BaseController();
        $aop = $ao->AopClient();
        $aop->method = "fshows.liquidation.alipay.trade.query";
        $pay = [
            'out_trade_no' => $out_trade_no,
        ];
        $dataWAop = array('content' => json_encode($pay));
        $response = $aop->execute($dataWAop);
        return $responseArray = json_decode($response, true);
    }

    //平安的撤销订单接口
}
