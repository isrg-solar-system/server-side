<?php

namespace App\Http\Controllers;

use App\Jobs\SaveDataToInflux;
use App\SettingWarning;
use App\Websetting;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use InfluxDB\Point;
use TrayLabs\InfluxDB\Facades\InfluxDB;
use Ixudra\Curl\Facades\Curl;

class FrontController extends Controller
{
    //

    public function index(){
        $place = 'index';

        $query = sprintf("select MEAN(value) from pv_charging_power  where time > %s AND time < %s group by time(1h) ","'".Carbon::yesterday()->addHour(16)->toDateTimeString()."'","'".Carbon::today()->addHour(16)->toDateTimeString()."'");
        $result = InfluxDB::query($query);
        $today = 0;
        foreach ($result->getPoints() as $point){
            if(!is_null($point['mean'])){
                $today += $point['mean'];
            }
        }

        $query = sprintf("select MEAN(value) from pv_charging_power  where time > %s AND time < %s group by time(1h) ","'".Carbon::now()->startOfWeek()->toDateTimeString()."'","'".Carbon::today()->endOfWeek()->toDateTimeString()."'");
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
        return view('front.index')->with('place',$place)->with('today',round($today,2))->with('week',round($week,2))->with('month',round($month,2))->with('year',round($year,2));
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
