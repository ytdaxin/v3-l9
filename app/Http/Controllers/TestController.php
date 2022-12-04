<?php

namespace App\Http\Controllers;

use App\Libs\KV\ReplitDB;
use App\Libs\TgSDK\Telegram;
use App\Models\User;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function Test()
    {
        //https://gxy.leyoui.com/api/webHook/Telegram
        $name = [
            'da' => 'daxin2022',
            'dax' => 'testOK1',
        ];

        $tg = Telegram::TelegramFun()->deleteWebhook();//删除 webHook

        $tg = Telegram::TelegramFun()->setWebhook([
            'url' => 'https://gxy.leyoui.com/api/webHook/Telegram'
        ]);

        $http = new Client([
            'base_uri' => 'http://bb.ziyouyu.cn/api/v1/',
            'headers'   =>  [
                'content-type'  =>  'application/json'
            ],
            'verify' => false
        ]);
        $params = [
            'TgData' => $name
        ];
        try {
            $res = $http->post('Telegram', ['form_params' => $params]);
        } catch (GuzzleException $e) {
        }

        dd(123);
    }

    public function getGoods()
    {
        $options = [
            'base_uri' => 'http://test.app.kacaimao.com/api/v1/',
//            'verify' => false
        ];
        $http = new Client($options);
        $res = $http->get('goods',['query' => '']);
        return json_decode($res->getBody(),true);
    }

    public function _deploy(Request $request)
    {
        $res = $request->all();
        $path = base_path();
        $token = 'gaoxueya';

        if (empty($res['token']) || $res['token'] !== $token) {
            return 'error request';
        }
        $cmd = "cd $path && git pull";

        shell_exec($cmd);

        return 'ok!';
    }

    public function SaoMa(Request $request)
    {
        return view('saoma');
    }

    public function SaoMas(Request $request)
    {
        return view('saomas');
    }
}
