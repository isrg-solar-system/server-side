<?php

namespace App\Http\Controllers;

use App\Events\InputData;
use App\Jobs\SaveDataToInflux;
use DateTime;
use Illuminate\Http\Request;
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

    public function getServer(){
        $db_status = true;
        $diskspace = (int)  floor(disk_total_space("/")/1024/1024/1024);
        $diskfree = (int)  floor(disk_free_space("/")/1024/1024/1024);
        $cpuused = $this->get_server_cpu_usage();
        $memoryused = $this->get_server_memory_usage();

        $arr = [
            'db_status'  => $db_status,
            'disk'  => $diskspace,
            'disk_used'   => $diskspace-$diskfree,
            'cpu_used'    => $cpuused,
            'mem_used' => $memoryused,
        ];

        return json_encode($arr);
    }

    protected function get_server_memory_usage(){
        //linux
//        $free = shell_exec('free');
//        $free = (string)trim($free);
//        $free_arr = explode("\n", $free);
//        $mem = explode(" ", $free_arr[1]);
//        $mem = array_filter($mem);
//        $mem = array_merge($mem);
//        $memory_usage = $mem[2]/$mem[1]*100;
//        return $memory_usage;
        exec('wmic memorychip get capacity', $totalMemory);
        $total = (int) array_sum($totalMemory) / 1000;
        exec('wmic OS get FreePhysicalMemory /Value 2>&1', $memory_used);
        $memory_used = (int) substr($memory_used[2],19);
        return  round( ($memory_used/$total),2 )*100 . "%";

    }

    protected function get_server_cpu_usage(){
        //linux
//        $load = sys_getloadavg();
//        return $load[0];
        exec('wmic cpu get LoadPercentage', $p);
        return (int) $p[1];
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

    public function makedownload(Request $request){
//        dd($request->all());
        $total_datas = count($request->datas);
        $colect_status = 0;
        $re = [];
        foreach ($request->datas as $data){
            $result = InfluxDB::query("select * from " . $data . " where time > '".$request->datefrom."' AND time < '". $request->dateto."'");
            $points = $result->getPoints();
            foreach ($points as $point){
                $re[$point['time']][$data] = $point['value'];
            }
            $colect_status += 1;
            session(['downloadstatus' => [ 'status'=>'collecting data','val'=> round($colect_status / $total_datas / 2,2)*100 ]]);
        }
        session(['downloadstatus' => [ 'status'=>'converting data to file','val'=> 75 ]]);
        /*  conver to excel data */
        $out = [];
        foreach ($re as $key => $value){
            array_push($value, $key);
            $out[] = $value;
        }
        /*    add title */
        $da = [];
        foreach ($request->datas as $data) {
            $da[] = $data;
        }
        $da[] = 'data';
        array_unshift($out,$da);

        $file = Excel::create('data',function($excel) use ($out){
            $excel->sheet('data', function($sheet) use ($out){
                $sheet->rows($out);
            });
        })->store('csv',storage_path('excel/exports'));
        session(['downloadstatus' => [ 'status'=>'Finished','val'=> 100 ]]);
    }
    public function downloadstatus(){
        return json_encode(session('downloadstatus'));
    }
}
