<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TelegramController extends Controller
{
    public function _pushmsg(Request $request)
    {
        $res = $request->all();
        if(!isset($input['update_id'])){
            Log::channel('syslog')->info('code:20001,消息格式错误 | ' . oToJson($res));
            return "code:20001,消息格式错误".json_encode($res);
        }
        Log::channel('syslog')->info(oToJson($res));
    }
}
