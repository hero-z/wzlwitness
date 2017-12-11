<?php

namespace App\Http\Controllers\Weixin;

use App\Models\Member;
use App\Models\Order;
use function iconv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\WeixinPayConfig;
use EasyWeChat\Foundation\Application;


class UserManagerController extends BaseController
{
    //
    public function updateWxSubscribers(Request $request)
    {
//        WeixinPayController
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
        $userService = $app->user;
        $ulist = $userService->lists();
        $ulisttotal = $ulist->total;
        $ulistcount = $ulist->count;
        $ulistArray = $ulist->data['openid'];

        foreach ($ulistArray as $openid) {
            $member = Member::where('wxopenid',$openid)->first();
            if ($member){//微信关注会员已经在平台有付款记录
                $member->is_subscribed = 1;
                $u= $userService->get($openid);
                $nick = $u->nickname;
                //iconv('GBK','UTF-8',$nick);
                $member->wx_nickname = $nick;
                $member->headimgurl = $u->headimgurl;
                $order = Order::where('buyer_id',$openid)->first();
                if ($order){
                    $member->subscribe_store_id = $order->store_id;
                    $member->created_at = $order->created_at;
                    $member->point = round(Order::where('buyer_id',$openid)->sum('total_amount'));
                }
                $member->save();
                Log::info($member);
            }
        }
        return 'success end';
//        Log::info($ulistArray);
    }

    public function updateMembersPoint(Request $request)
    {
        $memberList = Member::whereNotNull('wxopenid')->get();
        foreach ($memberList as $item) {
            $item->point = round(Order::where('buyer_id', $item->wxopenid)->sum('total_amount'));

            $item->save();
        }

        $memberList = Member::whereNotNull('ali_buyerid')->get();
        foreach ($memberList as $item) {
            $item->point = round(Order::where('buyer_id', $item->ali_buyerid)->sum('total_amount'));
            $item->save();
        }
        return 'success';
    }
}
