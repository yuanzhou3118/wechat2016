<?php

namespace App\Http\Controllers\Wechat;

use App\WechatMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Exception;

class ServeController extends Controller
{
    public function serve()
    {
        $wechat = app('wechat');
        $server = $wechat->server;
        $user = $wechat->user;
        $server->setMessageHandler(function ($message) use ($user) {
            $fromUser = $user->get($message->FromUserName);
            switch ($message->MsgType) {
                case 'event':
                    $msgResult = (new EventController())->handler($message->Event, $message->EventKey, $fromUser);

                    if(is_null($msgResult))
                        return null;

                    return  $msgResult;
                case 'text':
                case 'image':
                case 'voice':
                case 'video':
                    return null;
                default:
                    return null;
            }
        });

        return $server->serve();
    }
}
