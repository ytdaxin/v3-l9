<?php

namespace App\Http\Controllers;

use App\Libs\KV\ReplitDB;
use App\Libs\TgSDK\Telegram;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function Test()
    {
        $name = 'daxin2022 - testOK';
        $tg = Telegram::TelegramFun()->getWebhookInfo();
        dd($tg);
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
}
