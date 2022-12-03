<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TelegramController extends Controller
{
    public function _pushmsg(Request $request)
    {
        $res = $request->all();
//        if(!isset($res['update_id'])){
//            return "code:20001,消息格式错误".json_encode($res);
//        }
        $this->_msgSave(json_encode($res));
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
        return;
    }
}
