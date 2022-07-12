<?php

namespace App\Http\Controllers;

use App\Libs\KV\ReplitDB;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function Test(Request $request)
    {
        $db = new ReplitDB(); // get from terminal: echo $REPLIT_DB_URL

        $db->set_data('name', 'Danns Bass');
        $db->set_data('email', 'dannsbass@gmail.com');
        $db->set_data('repo', 'https://github.com/dannsbass');
        $db->set_data('country', 'Indonesia');

        $db->delete_data('country');

        echo $db->get_keys();

        echo PHP_EOL;

        echo $db->get_data('name');

        $arr = [
            'name' => 'Danns Bass',
            'name1' => 'Danns Bass',
            'name2' => 'Danns Bass',
            'name3' => 'Danns Bass',
        ];

        dd(oToJson($arr));

        $name = 'daxin2022 - testOK';
        return Out($name);
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
}
