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
        $res = $request->all();
        if(!isset($res['update_id'])){
            return $this->_msgSave("code:20001,消息格式错误".json_encode($res));
        }
        $this->_msgSave(se($res));
        return true;
    }

    public function _msgSave(string $data)
    {
        $http = new Client([
            'base_uri' => 'http://bb.ziyouyu.cn/api/v1/',
            'headers'   =>  [
                'content-type'  =>  'application/json'
            ]
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
