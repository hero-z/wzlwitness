<?php

namespace App\Http\Controllers\Weixin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use EasyWeChat\Foundation\Application;
use EasyWeChat\Message\Location;
class MessageHandlerController extends BaseController
{
    //
    public static function handleMessage($message){ //处理微信服务器发来的消息
        Log::info($message);
        switch ($message->MsgType){
            case "event":
                switch ($message->Event){
                    case "LOCATION":
                        $location = new Location();
                        $location->Latitude=$message->Latitude;
                        $location->Longitude=$message->Longitude;
                        $location->Precision=$message->Precision;
                        $location->scale="20";
                        $location->label=$message->FromUserName;
                        return $location;
                        break;
                    case "subscribe":
                        return "subscribe";
                        break;
                    case "unsubscribe":
                        break;
                    case "VIEW":
                        return $message->EventKey;
                        break;
                }
                //return $message->Event;
                break;
            case "text":
                return $message->Content;
                break;
        };
        return null;
    }
}

