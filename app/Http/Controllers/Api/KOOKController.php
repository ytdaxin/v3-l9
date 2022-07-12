<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Libs\KV\ReplitDB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class KOOKController extends Controller
{
    public function _webHookApi(Request $request)
    {
        $Bot = $request->all();
        $kv = new ReplitDB();
        $dbSn = 'webHook_gxy_sn'; //事件唯一ID
        $sn = $Bot['sn'] ?? 0;
        $oSn = $kv->get_data($dbSn); // 取回 事件唯一ID
        $robot = $Bot['robot'] ?? null;
        $data = $Bot['d'] ?? null; // 赋值 $post['d'] 下的成员数据 到 $data
        Log::channel('mylog')->info('>>> | '.oToJson($data));
        $challenge = $data['challenge'] ?? null; // 赋值 接收并响应事件 应用需要原样返回的值
        $channel_type = $data['channel_type'] ?? null; // 赋值 消息频道类型 GROUP 为频道消息 PERSON 为个人消息为
        $event_type = $data['extra']['type'] ?? null; // 接收事件类型
        if ($sn == 0){ // 判定 事件唯一ID 为0时初始化
            $kv->set_data($dbSn, $sn);
        }
        if ($sn == $oSn) {
            return json_encode([ // 构造 webHook 回调验证
                'challenge' => $challenge
            ]);
        } else {
            // 获取事件唯一ID 并记录ID到本地
            $kv->set_data($dbSn, $sn);
        };

        if ($robot == 'gaoxueya'){
            if ($event_type =='' && $channel_type == 'PERSON'){

            }
        }
        return json_encode([ // 构造 webHook 回调验证
            'challenge' => $challenge
        ]);
    }
}
