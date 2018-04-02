<?php

namespace App\Http\Controllers;

use App\CacheDownload;
use App\Events\InputData;
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
        event(new InputData($data));
        $this->dispatch(new SaveDataToInflux($data));
    }

    public function getData(Request $request){
        /*
         *   datefrom = 2017-12-31 00:00:00.000
         *   dateto   = 2018-12-31 00:00:00.000
         */

        $group = '';
        switch ($request->group) {
            case 'day':
                $result = InfluxDB::query("select MEAN(value) from " . $request->dataname . " where time > '".$request->datefrom."' AND time < '". $request->dateto."' group by time(1d)");
                $points = $result->getPoints();
                return json_encode($points);
                break;
            case 'month':
                $fyear = Carbon::createFromFormat('Y-m-d', $request->datefrom)->year;
                $tyear = Carbon::createFromFormat('Y-m-d', $request->dateto)->year;
                $fmonth = Carbon::createFromFormat('Y-m-d', $request->datefrom)->month;
                $tmonth = Carbon::createFromFormat('Y-m-d', $request->dateto)->month;
                $re = [];
                for($i = $fyear; $i <= $tyear ;$i++){
                   if($i == $fyear){
                       for ($q = $fmonth; $q <= 12;$q++){
                           $result = InfluxDB::query("select MEAN(value) from " . $i."-".$q. "-01 00:00:00.000  where time > '".$request->datefrom."' AND time < '". $request->dateto."' group by time(1d)");
                           $points = $result->getPoints();
                       }
                   }
                }
                break;
            case 'year':
                $group = '1y';
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
