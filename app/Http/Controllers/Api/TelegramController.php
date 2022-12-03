<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Libs\TgSDK\Telegram;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TelegramController extends Controller
{
    public function _pushmsg(Request $request)
    {
        $info = $request->all();
        if(!isset($res['update_id'])){
            return $this->_msgSave("code:20001,消息格式错误".json_encode($info));
        }
        if (isset($info['message']['chat']['type']) && $info['message']['chat']['type'] == 'private'){ //私聊

            if (isset($info['message']['text'])){ //文本
                $this->_sendMsg([
                    'chat_id' => $info['message']['chat']['id'],
                    'text' => $info['message']['text'],
                ]);
            }else if(isset($info['message']['photo'])){ //图片

            }else{
                return "未识别私聊";
            }
        }else if(isset($info['message']['chat']['type']) && $info['message']['chat']['type'] == 'supergroup'){ //群组
            if (isset($info['message']['text'])){ //文本
                $this->_sendMsg([
                    'chat_id' => $info['message']['chat']['id'],
                    'text' => $info['message']['text'],
                ]);
            }else if(isset($info['sticker'])){ //表情

            }else{
                return "未识别群组";
            }
        }else if(isset($info['channel_post']['chat']['type']) && $info['message']['chat']['type'] == 'channel'){ //频道
            if (isset($info['channel_post']['text'])){ //文本
                $this->_sendMsg([
                    'chat_id' => $info['message']['chat']['id'],
                    'text' => $info['message']['text'],
                ]);
            }else if(isset($info['channel_post']['photo'])){ //图片

            }else{
                return "未识别频道";
            }
        }else{
            return "未识别频道";
        }
        return true;
    }

    public function _msgSave($data)
    {
        $http = new Client([
            'base_uri' => 'http://bb.ziyouyu.cn/api/v1/',
            'headers'   =>  [
                'content-type'  =>  'application/json'
            ],
            'verify' => false
        ]);
        $params = [
            'TgData' => $data
        ];
        $res = $http->post('Telegram', ['form_params' => $params]);
        return 'ok';
    }

    public function _sendMsg(Request $request)
    {
        $res = $request->all();
        $Info = $res['sendInfo'] ?? null;
        if (!$Info) return false;
        return Telegram::TelegramFun()->sendMessage([
            'chat_id' => $Info['chat_id'],
            'text' => $Info['text'],
        ]);
    }
}
