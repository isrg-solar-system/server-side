<?php

namespace App\Http\Controllers;

use App\Jobs\SaveDataToInflux;
use App\SettingWarning;
use Illuminate\Http\Request;
use InfluxDB\Point;
use TrayLabs\InfluxDB\Facades\InfluxDB;

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

    public function ipcam(){
        $place = 'ipcam';
        return view('front.ipcam')->with('place',$place);
    }
}
