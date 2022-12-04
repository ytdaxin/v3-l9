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
        if(!isset($info['update_id'])){
            Log::channel('mylog')->info("code:20001,消息格式错误".json_encode($info));
            return $this->_msgSave("code:20001,消息格式错误".json_encode($info));
        }
        Log::channel('mylog')->info(oToJson($info));
//        if (isset($info['message']['chat']['type']) && $info['message']['chat']['type'] == 'private'){ //私聊
//
//            if (isset($info['message']['text'])){ //文本
//                $this->_send_msg([
//                    'chat_id' => $info['message']['chat']['id'],
//                    'text' => $info['message']['text'],
//                ]);
//            }else if(isset($info['message']['photo'])){ //图片
//
//            }else{
//                return "未识别私聊";
//            }
//        }else if(isset($info['message']['chat']['type']) && $info['message']['chat']['type'] == 'supergroup'){ //群组
//            if (isset($info['message']['text'])){ //文本
//                $this->_send_msg([
//                    'chat_id' => $info['message']['chat']['id'],
//                    'text' => $info['message']['text'],
//                ]);
//            }else if(isset($info['sticker'])){ //表情
//
//            }else{
//                return "未识别群组";
//            }
//        }else if(isset($info['channel_post']['chat']['type']) && $info['message']['chat']['type'] == 'channel'){ //频道
//            if (isset($info['channel_post']['text'])){ //文本
//                $this->_send_msg([
//                    'chat_id' => $info['message']['chat']['id'],
//                    'text' => $info['message']['text'],
//                ]);
//            }else if(isset($info['channel_post']['photo'])){ //图片
//
//            }else{
//                return "未识别频道";
//            }
//        }else{
//            return "未识别频道";
//        }
        $this->_msgSave($info);
        return true;
    }

    public function _msgSave(array $params)
    {
        $http = new Client([
            'base_uri' => 'http://bb.ziyouyu.cn/api/v1/',
            'headers'   =>  [
                'content-type'  =>  'application/json'
            ],
            'verify' => false
        ]);
        $res = $http->postAsync('Telegram', ['form_params' => $params]);
        Log::channel('mylog')->info(oToJson($params));
    }

    public function _send_msg($data)
    {
        $sendInfo = ' |> 我收到信息了！';
        return Telegram::TelegramFun()->sendMessage([
            'chat_id' => $data['chat_id'],
            'text' => $data['text'] . $sendInfo,
        ]);
    }

    public function _sendMsg(Request $request)
    {
        $res = $request->all();
        Log::channel('mylog')->info(oToJson($res));
        if (!$res) return false;
        $sendInfo = ' |> 我收到信息了！';
        return Telegram::TelegramFun()->sendMessage([
            'chat_id' => $res['chat_id'],
            'text' => $res['text'] . $sendInfo,
        ]);
    }
}
