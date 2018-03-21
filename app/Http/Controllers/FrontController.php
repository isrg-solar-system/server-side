<?php

namespace App\Http\Controllers;

use App\Jobs\SaveDataToInflux;
use Illuminate\Http\Request;
use InfluxDB\Point;
use TrayLabs\InfluxDB\Facades\InfluxDB;

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
