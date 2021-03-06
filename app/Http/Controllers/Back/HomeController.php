<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends BackController
{
    //
    public function index(){
        if(!Auth::user()->level){
            return redirect(route('ReportIndex'));
        }
        return view('back.index');
    }


    public function getServer(){
//        dd(env('SYSTEM_NAME'));
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
        if(env('SYSTEM_NAME') == 'windows'){
            exec('wmic memorychip get capacity', $totalMemory);
            $total = (int) array_sum($totalMemory) / 1000;
            exec('wmic OS get FreePhysicalMemory /Value 2>&1', $memory_used);
            $memory_used = (int) substr($memory_used[2],19);
            return  round( ($memory_used/$total),2 )*100 . "%";
        }else{

            $free = shell_exec('free');
            $free = (string)trim($free);
            $free_arr = explode("\n", $free);
            $mem = explode(" ", $free_arr[1]);
            $mem = array_filter($mem);
            $mem = array_merge($mem);
            $memory_usage = $mem[2]/$mem[1]*100;
            return round($memory_usage,2);

        }
    }

    protected function get_server_cpu_usage(){
        if(env('SYSTEM_NAME') == 'windows'){
            exec('wmic cpu get LoadPercentage', $p);
            return (int) $p[1];

        }else{
            $load = sys_getloadavg();
            return $load[0];
        }

    }
}
