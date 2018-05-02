<?php

namespace App\Http\Controllers;

use App\CacheDownload;
use App\Events\InputData;
use App\Events\Realtime;
use App\Events\WarningBroadcast;
use App\Jobs\AlertingToLine;
use App\Jobs\CheckingData;
use App\Jobs\SaveDataToInflux;
use App\Warning;
use App\Websetting;
use DateTime;
use DateTimeZone;
use http\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Crypt;
use InfluxDB\Point;
use Ixudra\Curl\Facades\Curl;
use Maatwebsite\Excel\Facades\Excel;
use TrayLabs\InfluxDB\Facades\InfluxDB;

class DataApiController extends Controller
{
    //
    public function input(Request $request){
        $data = $request->get('data');
//        // 資料EXAMPLE : {"battery_charging_current":21,"grid_voltage":110}
        event(new Realtime(json_decode($data)));
        $this->dispatch(new SaveDataToInflux($data));
        $this->dispatch(new CheckingData($data));
        return 1;
    }

    public function getPower(){
        $query = sprintf("select MEAN(value) from pv_charging_power  where time > %s AND time < %s group by time(1h) ","'".Carbon::yesterday()->addHour(16)->toDateTimeString()."'","'".Carbon::today()->addHour(16)->toDateTimeString()."'");
        $result = InfluxDB::query($query);
        $today = 0;
        foreach ($result->getPoints() as $point){
            if(!is_null($point['mean'])){
                $today += $point['mean'];
            }
        }
    }

    public function getData(Request $request){
        /*
         *   datefrom = 2017/12/31
         *   dateto   = 2018/12/31
         */
//        dd($request->all());
        if(env('APP_DEBUG')){
            header('Access-Control-Allow-Origin: *');
        }
        $group = '';
        try{
            $datefrom = Carbon::parse($request->datefrom, 'Asia/Taipei')->toDateString();
            $dateto = Carbon::parse( $request->dateto,'Asia/Taipei')->toDateString();
            $fyear = Carbon::parse($request->datefrom,'Asia/Taipei')->year;
            $tyear = Carbon::parse($request->dateto,'Asia/Taipei')->year;
            $fmonth = Carbon::parse( $request->datefrom,'Asia/Taipei')->month;
            $tmonth = Carbon::parse( $request->dateto,'Asia/Taipei')->month;
        }
        catch (Exception $e){

        }
        switch ($request->group) {
            case 'todayofhour':
                $carbonyes = Carbon::parse($request->datefrom, 'Asia/Taipei')->addHour(-8);
                $carbontod = Carbon::parse($request->datefrom, 'Asia/Taipei')->addHour(16);
                $query = sprintf("select MEAN(value) from %s where time > %s AND time < %s group by time(1h)",$request->dataname,"'".$carbonyes->toDateTimeString()."'","'".$carbontod->toDateTimeString()."'");
                $result = InfluxDB::query($query);
                $points = $result->getPoints();
                $re = [];
                foreach ($points as $point){
                    if(!is_null($point['mean'])){
                        $arr = [];
                        $time = new Carbon($point['time']);
                        $time->timezone = new DateTimeZone('Asia/Taipei');
                        $arr['time'] =  $time->toDateTimeString();
                        $arr['mean'] =  $point['mean'];
                        $re[] = $arr;
                    }else{
                        $arr = [];
                        $time = new Carbon($point['time']);
                        $time->timezone = new DateTimeZone('Asia/Taipei');
                        $arr['time'] =  $time->toDateTimeString();
                        $arr['mean'] = 0;
                        $re[] = $arr;
                    }
                }
                return json_encode($re);
                break;
            case 'allofday':
//                dd("select MEAN(value) from " . $request->dataname . " where time >= '".$datefrom."' AND time <= '". $dateto."' group by time(1d)");

                $result = InfluxDB::query("select MEAN(value) from " . $request->dataname . " where time >= '".$datefrom."' AND time <= '". $dateto."' group by time(1d)");
                $points = $result->getPoints();
                $re = [];
                foreach ($points as $point){
                    if(!is_null($point['mean'])){
                        $arr = [];
                        $time = new Carbon($point['time']);
                        $time->timezone = new DateTimeZone('Asia/Taipei');
                        $arr['time'] =  substr($time->toDateTimeString(),0,10);
                        $arr['mean'] =  $point['mean'];
                        $re[] = $arr;
                    }
                }
                return json_encode($re);
                break;
            case 'allofmonth':
                $re = [];
                //2016-01-01T00:00:00
                for($year = $fyear; $year <= $tyear ;$year++){
                   if($year == $fyear){
                       for ($month= $fmonth;$month <= 12;$month++){
                           $carbon =  Carbon::create($year, $month, 1,0,0,0);
                           $carbon->timezone = new DateTimeZone('Asia/Taipei');
                           $query = sprintf("select MEAN(value) from %s where time > %s AND time < %s",$request->dataname,"'".$carbon->toDateTimeString()."'","'".$carbon->endOfMonth()->toDateTimeString()."'");
//                           var_dump($query);
                           $result = InfluxDB::query($query);
                           $points = $result->getPoints();
                           if(isset($points[0])){
                               $arr = [];
                               $time = new Carbon(substr ($points[0]['time'],0,19));
                               $time->timezone = new DateTimeZone('Asia/Taipei');
                               $arr['time'] =  substr($time->toDateTimeString(),0,7);
                               $arr['mean'] =  $points[0]['mean'];
                               $re[] = $arr;
                           }
                       }
                   }elseif($year == $tyear){
                       for ($month= 1;$month <= $tmonth;$month++){
                           $carbon =  Carbon::create($year, $month, 1,0,0,0);
                           $carbon->timezone = new DateTimeZone('Asia/Taipei');
                           $query = sprintf("select MEAN(value) from %s where time > %s AND time < %s",$request->dataname,"'".$carbon->toDateTimeString()."'","'".$carbon->endOfMonth()->toDateTimeString()."'");
//                           var_dump($query);
                           $result = InfluxDB::query($query);
                           $points = $result->getPoints();
                           if(isset($points[0])){
                               $arr = [];
                               $time = new Carbon(substr ($points[0]['time'],0,19));
                               $time->timezone = new DateTimeZone('Asia/Taipei');
                               $arr['time'] =  substr($time->toDateTimeString(),0,7);
                               $arr['mean'] =  $points[0]['mean'];
                               $re[] = $arr;
                           }
                       }
                   }else{
                       for ($month= 1;$month <= 12;$month++){
                           $carbon =  Carbon::create($year, $month, 1,0,0,0);
                           $carbon->timezone = new DateTimeZone('Asia/Taipei');
                           $query = sprintf("select MEAN(value) from %s where time > %s AND time < %s",$request->dataname,"'".$carbon->toDateTimeString()."'","'".$carbon->endOfMonth()->toDateTimeString()."'");
//                           var_dump($query);
                           $result = InfluxDB::query($query);
                           $points = $result->getPoints();
                           if(isset($points[0])){
                               $arr = [];
                               $time = new Carbon(substr ($points[0]['time'],0,19));
                               $time->timezone = new DateTimeZone('Asia/Taipei');
                               $arr['time'] =  substr($time->toDateTimeString(),0,7);
                               $arr['mean'] =  $points[0]['mean'];
                               $re[] = $arr;
                           }
                       }
                   }
                }
                return json_encode($re);
                break;
            case 'allofyear':
                $re = [];
                for($year = $fyear; $year <= $tyear ;$year++){
                    $carbonform =  Carbon::create($year, 1, 1,0,0,0);
                    $carbonform->timezone = new DateTimeZone('Asia/Taipei');
                    $carbonto =  Carbon::create($year, 12, 31,23,59,59);
                    $carbonto->timezone = new DateTimeZone('Asia/Taipei');
                    $query = sprintf("select MEAN(value) from %s where time > %s AND time < %s",$request->dataname,"'".$carbonform->toDateTimeString()."'","'".$carbonto->endOfMonth()->toDateTimeString()."'");
//                           var_dump($query);
                    $result = InfluxDB::query($query);
                    $points = $result->getPoints();
                    if(isset($points[0])){
                        $arr = [];
                        $time = new Carbon(substr ($points[0]['time'],0,19));
                        $time->timezone = new DateTimeZone('Asia/Taipei');
                        $arr['time'] =  substr($time->toDateTimeString(),0,4);
                        $arr['mean'] =  $points[0]['mean'];
                        $re[] = $arr;
                    }
                }
                return json_encode($re);
                break;
        }
    }

    public function getMeasurement(){
        $result = InfluxDB::query('SHOW MEASUREMENTS');
        $points = $result->getPoints();
        return json_encode($points);
    }

    public function getDataTime(){
        $result = InfluxDB::query('SHOW MEASUREMENTS');
        $points = $result->getPoints();

        $result = InfluxDB::query('select * from '.$points[1]['name']. ' ORDER BY time asc limit 1');
        $first = new DateTime($result->getPoints()[0]['time']);

        $result = InfluxDB::query('select * from '.$points[1]['name']. ' ORDER BY time desc limit 1');
        $last = new DateTime($result->getPoints()[0]['time']);
        return json_encode(['first'=>$first->format('Y-m-d'),'last'=>$last->format('Y-m-d')]);
    }

    public function getDataStatus(){
        $measures = json_decode($this->getMeasurement());
        $arr = [];
        foreach ($measures as $measure ){
            $lastcheck = Warning::where('dataname',$measure->name)->orderBy('id','desc')->first();
            if(is_null($lastcheck)){
                $arr[$measure->name] = 1;
            }else{
                $arr[$measure->name] = 0;
            }
        }
        return json_encode($arr);

    }


}
