<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontController extends Controller
{
    //

    public function index(){
        return view('front.index');
    }

    public function inverter(){
        return view('front.inverter');
    }

    public function log(){
        return view('front.log');
    }
}
