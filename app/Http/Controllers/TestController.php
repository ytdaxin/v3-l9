<?php

namespace App\Http\Controllers;

use App\Libs\KV\ReplitDB;
use App\Models\User;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function Test(Request $request)
    {
        $userInfo = User::all();
        dd($userInfo);
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
