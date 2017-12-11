<?php
/**
 * Created by PhpStorm.
 * User: hero
 * Date: 2017/5/23
 * Time: 14:37
 */

namespace App\Http\Controllers\WeBank;

use App\Models\Order;
use App\Models\PageSets;
use App\Models\WeixinPayConfig;
use App\Models\WeixinPayNotify;
use App\Models\WXNotify;
use EasyWeChat\Foundation\Application;
use Illuminate\Support\Facades\Log;
use Mockery\CountValidator\Exception;
use Symfony\Component\HttpFoundation\Request;

class WebankAccessTokenController extends WebankBaseController
{
    public function getaccesstoken(Request $request){
//         return 'aaaaa';
//        $WeixinPayNotifyStore = WeixinPayNotify::where('store_id', $store_id)->first();
                        //实例化
        Log::info($request);
        $config = WeixinPayConfig::where('id', 1)->first();
        if ($config) {
            $options = [
                       'app_id' => $request->appid,
                       'secret' => $request->secret,
//                       'token' => '18851186776',
 //                      'payment' => [
//                                    'merchant_id' => $config->merchant_id,
//                                    'key' => $config->key,
//                                    'cert_path' => $config->cert_path, // XXX: 绝对路径！！！！
//                                    'key_path' => $config->key_path,      // XXX: 绝对路径！！！！
//                                    'notify_url' => $config->notify_url,       // 你也可以在下单时单独设置来想覆盖它
//                                    ],
                       ];
            $app = new Application($options);
            //$token = $app->access_token->getToken();
            $token = [
                     'access_token'=>$app->access_token->getToken(true),
                     'expires_in'=>7200,
                  ];
            Log::info($token);
             return $token;
        }

    }
}
