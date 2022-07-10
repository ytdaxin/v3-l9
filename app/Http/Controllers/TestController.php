<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function Test(Request $request)
    {
        $name = 'daxin';
        dd($name.' - testIng!!!');
    }
}
