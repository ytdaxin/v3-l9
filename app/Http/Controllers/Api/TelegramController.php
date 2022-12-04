<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Libs\TgSDK\Telegram;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
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
//        $this->_msgSave($info);
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
        try {
            $res = $http->post('Telegram', ['form_params' => $params]);
        } catch (GuzzleException $e) {
        }
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
