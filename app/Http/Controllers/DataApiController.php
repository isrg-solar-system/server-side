<?php

namespace App\Http\Controllers;

use App\CacheDownload;
use App\Events\InputData;
use App\Jobs\CheckingData;
use App\Jobs\SaveDataToInflux;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Crypt;
use InfluxDB\Point;
use Maatwebsite\Excel\Facades\Excel;
use TrayLabs\InfluxDB\Facades\InfluxDB;

class DataApiController extends Controller
{
    //

    public function input(Request $request){
        $data = $request->get('data');
        print_r($data);
        // 資料EXAMPLE : {"battery_charging_current":21,"grid_voltage":110}
//        event(new InputData($data));
//        $this->dispatch(new SaveDataToInflux($data));
        $this->dispatch(new CheckingData($data));
    }

    public function getData(Request $request){
        /*
         *   datefrom = 2017/12/31
         *   dateto   = 2018/12/31
         */
//        dd($request->all());
        header('Access-Control-Allow-Origin: *');
        $group = '';
        $datefrom = Carbon::parse($request->datefrom, 'Asia/Taipei')->toDateString();
        $dateto = Carbon::parse( $request->dateto,'Asia/Taipei')->toDateString();
        $fyear = Carbon::parse($request->datefrom,'Asia/Taipei')->year;
        $tyear = Carbon::parse($request->dateto,'Asia/Taipei')->year;
        $fmonth = Carbon::parse( $request->datefrom,'Asia/Taipei')->month;
        $tmonth = Carbon::parse( $request->dateto,'Asia/Taipei')->month;
        switch ($request->group) {
            case 'day':
                $result = InfluxDB::query("select MEAN(value) from " . $request->dataname . " where time >= '".$datefrom."' AND time <= '". $dateto."' group by time(1d)");
                $points = $result->getPoints();
                $re = [];
                foreach ($points as $point){
                    if(!is_null($point['mean']))
                        $re[] = $point;
                }
                return json_encode($re);
                break;
            case 'month':

                $re = [];
                for($year = $fyear; $year <= $tyear ;$year++){
                   if($year == $fyear){
                       for ($month= $fmonth;$month <= 12;$month++){
                           $carbon =  Carbon::create($year, $month, 1,0,0,0);
                           $query = sprintf("select MEAN(value) from %s where time > %s AND time < %s",$request->dataname,"'".$carbon->toDateTimeString()."'","'".$carbon->endOfMonth()->toDateTimeString()."'");
//                           var_dump($query);
                           $result = InfluxDB::query($query);
                           $points = $result->getPoints();
                           if(isset($points[0])){
                               $re[] = $points[0];
                           }
                       }
                   }elseif($year == $tyear){
                       for ($month= 1;$month <= $tmonth;$month++){
                           $carbon =  Carbon::create($year, $month, 1,0,0,0);
                           $query = sprintf("select MEAN(value) from %s where time > %s AND time < %s",$request->dataname,"'".$carbon->toDateTimeString()."'","'".$carbon->endOfMonth()->toDateTimeString()."'");
//                           var_dump($query);
                           $result = InfluxDB::query($query);
                           $points = $result->getPoints();
                           if(isset($points[0])){
                               $re[] = $points[0];
                           }
                       }
                   }else{
                       for ($month= 1;$month <= 12;$month++){
                           $carbon =  Carbon::create($year, $month, 1,0,0,0);
                           $query = sprintf("select MEAN(value) from %s where time > %s AND time < %s",$request->dataname,"'".$carbon->toDateTimeString()."'","'".$carbon->endOfMonth()->toDateTimeString()."'");
//                           var_dump($query);
                           $result = InfluxDB::query($query);
                           $points = $result->getPoints();
                           if(isset($points[0])){
                               $re[] = $points[0];
                           }
                       }
                   }
                }
                return json_encode($re);
                break;
            case 'year':
                $re = [];
                for($year = $fyear; $year <= $tyear ;$year++){
                    $carbonform =  Carbon::create($year, 1, 1,0,0,0);
                    $carbonto =  Carbon::create($year, 12, 31,23,59,59);
                    $query = sprintf("select MEAN(value) from %s where time > %s AND time < %s",$request->dataname,"'".$carbonform->toDateTimeString()."'","'".$carbonto->endOfMonth()->toDateTimeString()."'");
//                           var_dump($query);
                    $result = InfluxDB::query($query);
                    $points = $result->getPoints();
                    if(isset($points[0])){
                        $re[] = $points[0];
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


}
