<?php

namespace App\Http\Controllers;

use App\Events\InputData;
use App\Jobs\SaveDataToInflux;
use Illuminate\Http\Request;
use InfluxDB\Point;
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
        $database = true;
        $diskspace = (int)  floor(disk_total_space("/")/1024/1024/1024);
        $diskfree = (int)  floor(disk_free_space("/")/1024/1024/1024);
        $cpuused = $this->get_server_cpu_usage();
        $memoryused = $this->get_server_memory_usage();
    }

    protected function get_server_memory_usage(){
        $free = shell_exec('free');
        $free = (string)trim($free);
        $free_arr = explode("\n", $free);
        $mem = explode(" ", $free_arr[1]);
        $mem = array_filter($mem);
        $mem = array_merge($mem);
        $memory_usage = $mem[2]/$mem[1]*100;
        return $memory_usage;
    }

    protected function get_server_cpu_usage(){
        $load = sys_getloadavg();
        return $load[0];
    }

}
