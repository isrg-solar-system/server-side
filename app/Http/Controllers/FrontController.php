<?php

namespace App\Http\Controllers;

use App\Jobs\SaveDataToInflux;
use App\SettingWarning;
use App\Websetting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use InfluxDB\Point;
use TrayLabs\InfluxDB\Facades\InfluxDB;
use Ixudra\Curl\Facades\Curl;

class FrontController extends Controller
{
    //

    public function index(){
        $place = 'index';
        return view('front.index')->with('place',$place);
    }

    public function inverter(){
        $place = 'inverter';
        return view('front.inverter')->with('place',$place);
    }

    public function log(){
        return view('front.log');
    }

    public function chart($dataname){
        $place = 'chart';
        $now = Carbon::now();
        return view('front.chart')->with('place',$place)->with('dataname',$dataname)->with('now',$now);
    }

    public function ipcam(){
        $place = 'ipcam';
        return view('front.ipcam')->with('place',$place);
    }
}
