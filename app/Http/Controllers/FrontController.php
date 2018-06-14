<?php

namespace App\Http\Controllers;

use App\Jobs\SaveDataToInflux;
use App\SettingWarning;
use App\Warning;
use App\Websetting;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use InfluxDB\Point;
use TrayLabs\InfluxDB\Facades\InfluxDB;
use Ixudra\Curl\Facades\Curl;

class FrontController extends Controller
{
    //

    public function index(){
        $place = 'index';

        $dataname = 'pv_charging_power';
        $carbon = Carbon::now(new DateTimeZone('Asia/Taipei'));

        $query = sprintf("select MEAN(value) from %s where time > %s AND time < %s group by time(1h)",$dataname,"'".$carbon->startOfDay()->toDateTimeString()."'","'".$carbon->endOfDay()->toDateTimeString()."'");
        $result = InfluxDB::query($query);
        $points = $result->getPoints();
        $today = 0;
        foreach ($points as $point){
            if(!is_null($point['mean'])) {
                $today += $point['mean'];
            }
        }


        $query = sprintf("select MEAN(value) from pv_charging_power  where time > %s AND time < %s group by time(1h) ","'".Carbon::now()->startOfWeek()->yesterday()->addHour(16)->toDateTimeString()."'","'".Carbon::today()->endOfWeek()->addHour(16)->toDateTimeString()."'");
        $result = InfluxDB::query($query);
        $week = 0;
        foreach ($result->getPoints() as $point){
            if(!is_null($point['mean'])){
                $week += $point['mean'];
            }
        }

        $query = sprintf("select MEAN(value) from pv_charging_power  where time > %s AND time < %s group by time(1h) ","'".Carbon::now()->startOfMonth()->toDateTimeString()."'","'".Carbon::today()->endOfMonth()->toDateTimeString()."'");
        $result = InfluxDB::query($query);
        $month = 0;
        foreach ($result->getPoints() as $point){
            if(!is_null($point['mean'])){
                $month += $point['mean'];
            }
        }

        $query = sprintf("select MEAN(value) from pv_charging_power  where time > %s AND time < %s group by time(1h) ","'".Carbon::now()->startOfYear()->toDateTimeString()."'","'".Carbon::today()->endOfYear()->toDateTimeString()."'");
        $result = InfluxDB::query($query);
        $year = 0;
        foreach ($result->getPoints() as $point){
            if(!is_null($point['mean'])){
                $year += $point['mean'];
            }
        }
        $weather = Curl::to('https://works.ioa.tw/weather/api/weathers/120.json')->asJson()->get();
//        dd(mb_strlen($weather->histories[count($weather->histories)-1]->desc));

//        dd($weather);
        return view('front.index')->with('place',$place)->with('today',round($today,2))->with('week',round($week,0))->with('month',round($month,0))->with('year',round($year,0))->with('user',Auth::user())->with('weather',$weather);
    }

    public function inverter(){
        $place = 'inverter';
        $log = Warning::orderBy('created_at','desc')->take(10)->get();
        return view('front.inverter')->with('place',$place)->with('user',Auth::user())->with('warnings',$log);
    }

    public function log(){
        return view('front.log')->with('user',Auth::user());
    }

    public function chart($dataname){
        $place = 'chart';
        $now = Carbon::now();
        return view('front.chart')->with('place',$place)->with('dataname',$dataname)->with('now',$now)->with('user',Auth::user());
    }

    public function ipcam(){
        $place = 'ipcam';
        $token = Websetting::where('key','camera_token')->first()->value;
        return view('front.ipcam')->with('place',$place)->with('user',Auth::user())->with('token',$token);
    }
}
