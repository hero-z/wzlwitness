<?php
/**
 * Created by PhpStorm.
 * User: dmk
 * Date: 2017/1/17
 * Time: 22:56
 */

namespace App\Http\Controllers\WeBank;


use App\Http\Controllers\Controller;
use App\Models\WeBankConfig;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Mockery\CountValidator\Exception;
use Symfony\Component\HttpFoundation\Request;

class WebankBaseController extends Controller
{
    const TOKEN_FORMAT = "?app_id=%s&secret=%s&grant_type=client_credential&version=%s";
    const TICKET_FORMAT = "?app_id=%s&access_token=%s&type=%s&version=%s";
    const COMMON_SIGN_FORMAT = "?app_id=%s&nonce=%s&version=%s&sign=%s";
    const RESPONSE_SIGN_FORMAT = "?app_id=%s&nonce=%s&version=%s&sign=%s";

    const TOKEN_PATH = "/api/oauth2/access_token";
    const TICKET_PATH = "/api/oauth2/api_ticket";
    const TEST_SIGN_PATH = "/api/base/signTest";

    public static $timeout = 60;

    /**
     * 初始化微众助手
     * @param $id
     * @return WebankAopClient
     */
    public function WebankHelper($id)
    {
        $webank=new WebankAopClient();
        try{
            $cfg=WeBankConfig::where('id',$id)->first();
            if($cfg){
                $webank->agency_id = $cfg->code_no;
                $webank->appId = $cfg->app_id;
                $webank->secret = $cfg->secret;
                $webank->wx_app_id = $cfg->wx_app_id;
                $webank->wx_secret = $cfg->wx_secret;
                $webank->client_cert= public_path().$cfg->client_cert;
                $webank->client_key = public_path().$cfg->client_key;
                $webank->client_pass = $cfg->client_pass;
            }else{
                die('请先进行微众配置');
            }
            $wx=WeBankConfig::where('id',1)->first();
            $ali=WeBankConfig::where('id',2)->first();
            if($wx->app_id==$ali->app_id){
                $id=1;
            }
            $webank->access_token=self::getWeBankAccessToken($webank,$id);
            $webank->ticket=self::getWeBankTicket($webank,$id);
        }catch (Exception $e){
            die($e);
        }
        return $webank;
    }

    /**
     * 获取accesstoken
     * @param WebankAopClient $aopClient
     * @param $target
     * @return mixed
     */
    public function getWeBankAccessToken(WebankAopClient $aopClient, $id){
        $marktoken=[1=>'webank_wx_accessToken',2=>'webank_ali_accessToken'];
        $markticket=[1=>'webank_wx_ticket',2=>'webank_ali_ticket'];
        $target=$marktoken[$id];
        $ca = Cache::store('file')->get($target);
        try{
            if(empty($ca)){
                $url_params = sprintf(self::TOKEN_FORMAT, $aopClient->appId, $aopClient->secret, $aopClient->version);
                $url=$aopClient->headUrl.self::TOKEN_PATH.$url_params;
                $request = array(
                    'url' => $url,
                    'method' => 'get',
                    'timeout' => self::$timeout
                );
                $result = $aopClient->sendRequest($request);
                if($result&&$result['code']==0){
                    Cache::store('file')->put($target, $result["access_token"], 110);
                    $ca = $result["access_token"];
                    //如果access_token被替换,ticket也要被替换
                    Cache::store('file')->forget($markticket[$id]);
                }else{
                    die($result['msg']);
                }
            }
            return $ca;
        }catch (Exception $e){
            die($e);
        }
    }

    /**
     * 获取ticket
     * @param WebankAopClient $aopClient
     * @param $target
     * @return mixed
     */
    public function getWeBankTicket(WebankAopClient $aopClient, $id){
        $markticket=[1=>'webank_wx_ticket',2=>'webank_ali_ticket'];
        $target=$markticket[$id];
        $ticket = Cache::store('file')->get($target);
        try{
            if(empty($ticket)){
                //获取ticket
                $url_params = sprintf(self::TICKET_FORMAT, $aopClient->appId, $aopClient->access_token,$aopClient->type,$aopClient->version);
                $url=$aopClient->headUrl.self::TICKET_PATH.$url_params;
                $request = array(
                    'url' => $url,
                    'method' => 'get',
                    'timeout' => self::$timeout
                );
                $result = $aopClient->sendRequest($request);
                if($result&&$result['code']==0){
                    $ticket=$result['tickets'][0]['value'];
                    Cache::store('file')->put($target, $ticket, 40);
                }else{
                    die($result['msg']);
                }
            }
            return $ticket;
        }catch (Exception $e){
            die($e);
        }
    }
    /**
     * 重置等待时间
     * @param int $timeout
     * @return bool
     */
    public static function setTimeout($timeout = 60)
    {
        if (!is_int($timeout) || $timeout < 0) {
            return false;
        }

        self::$timeout = $timeout;
        return true;
    }
    public function checkSign(Request $request,$type){
        try{
            $params=$request->except('type','sign');
            $sign=$request->sign;
            $wbhelper=$this->WebankHelper($type);
            $ticket=$wbhelper->ticket;
            if (!$ticket) {
                Log::error("Ticket is empty!");
                return false;
            }
            array_push($params, $ticket);
            sort($params);
            $data_string = implode($params);
            $chsign= strtoupper(sha1($data_string));
            if($chsign===$sign){
                return true;
            }
        }catch (Exception $e){
            Log::error($e);
        }
        return false;
    }

    /**
     * 微众银行发送请求
     * @param int $type 配置类型，1 微信， 2 支付宝
     * @param array $data 请求参数
     * @param string $wb_request_path 请求地址
    */
    public function sendCMD($type, $data, $wb_request_path)
    {
        Log::info('============== Webank SendCMD start ============');
        $info='微众银行发送命令错误!';
        try{
            $webank = $this->WebankHelper($type);
            $app_id = $webank->appId;
            $version = $webank->version;
            $nonce = $webank->getNonce();
            $jsonData = json_encode($data, true);
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
                'url' => $webank->headUrl . $wb_request_path . $url_params,
                'method' => 'post',
                'timeout' => self::$timeout,
                'data' => $jsonData,
                'header' => $header,
            );
            Log::info($request);
            $result = $webank->sendRequest($request);
            Log::info($result);
            Log::info('============== Webank SendCMD end ============');
            return $result;
        }catch (Exception $e){
            Log::error($e);
        }
        Log::info('============== Webank SendCMD end ============');
        return array(
            'code'=>-1,
            'msg'=>$info,
        );
    }
}