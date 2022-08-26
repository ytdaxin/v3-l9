<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function _index(Request $request)
    {
        $res = $request->all();
        return Out($res);
    }
}
