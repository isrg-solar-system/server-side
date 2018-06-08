<?php

namespace App\Jobs;


use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\CacheDownload;
use App\Events\DownloadStatus;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Maatwebsite\Excel\Facades\Excel;
use TrayLabs\InfluxDB\Facades\InfluxDB;

class DownloadMaker implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $r;
    protected $bkey;

    public function __construct($bkey,$request)
    {
        //
        $this->r = $request;
        $this->bkey = $bkey;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $request = $this->r;
        $bkey = $this->bkey;
        ini_set('memory_limit', '4096M');
        ini_set('max_execution_time', -1); //300 seconds = 5 minutes
        $total_datas = count($request['datas']);
        $colect_status = 0;
        $re = [];
        foreach ($request['datas'] as $data){
            $result = InfluxDB::query("select * from " . $data . " where time > '".$request['datefrom']."' AND time < '". $request['dateto']."'");
            $points = $result->getPoints();
            foreach ($points as $point){
                $re[$point['time']][$data] = $point['value'];
            }
            $colect_status += 1;
            event(new DownloadStatus($bkey,['downloadstatus' => [ 'status'=>'collecting data','val'=> round($colect_status / $total_datas / 2,2)*100 ]]));

            print_r("collection data\n");
//                session(['downloadstatus' => [ 'status'=>'collecting data','val'=> round($colect_status / $total_datas / 2,2)*100 ]]);
        }
        event(new DownloadStatus($bkey,['downloadstatus' => [ 'status'=>'converting data to file','val'=> 75 ]]));
        print_r("converting data to file\n");
//            session(['downloadstatus' => [ 'status'=>'converting data to file','val'=> 75 ]]);
        /*  conver to excel data */
        $out = [];
        foreach ($re as $key => $value){
            array_push($value, $key);
            $out[] = $value;
        }
        /*    add title */
        $da = [];
        foreach ($request['datas'] as $data) {
            $da[] = $data;
        }
        $da[] = 'datetime';
        array_unshift($out,$da);

        $filename = substr(Carbon::now(),0,10) . substr(Crypt::encrypt(random_int(0,99)),15,8);
        event(new DownloadStatus($bkey,['downloadstatus' => [ 'status'=>'Making File','val'=> 90 ]]));
        print_r("Making File\n");
        $file = Excel::create($filename,function($excel) use ($out){
            $excel->sheet('data', function($sheet) use ($out){
                $sheet->rows($out);
            });
        })->store($request['filetype'],storage_path('excel/exports'));
        event(new DownloadStatus($bkey,['downloadstatus' => [ 'status'=>'Finished','val'=> 100 ,'filename'=>$filename.'.'.$request['filetype']]]));
        session(['downloadstatus' => [ 'status'=>'Finished','val'=> 100 ,'filename'=>$filename.'.'.$request['filetype']]]);
        $create = new CacheDownload();
        $create->key = json_encode($request);
        $create->filename = $filename.'.'.$request['filetype'];
        $create->save();
        print_r($create->filename."\n");


        unset($out);
        unset($da);
        unset($filename);
        unset($file);
    }
}
