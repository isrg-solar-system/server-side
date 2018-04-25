<?php

namespace App\Jobs;

use App\User;
use App\Websetting;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Carbon;
use InfluxDB\Point;
use Symfony\Component\HttpFoundation\Request;
use TrayLabs\InfluxDB\Facades\InfluxDB;

class SaveDataToInflux implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected  $data;

    public function __construct($data)
    {
        //
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $points = array();
        $time = Carbon::now('Asia/Taipei')->timestamp;
        $arr = array();
        foreach (json_decode($this->data) as $key => $data){
            $result = InfluxDB::query('select * from '.$key. ' ORDER BY time desc limit 1');
            $last = new Carbon($result->getPoints()[0]['time']);
            $last = $last->timestamp;
            $limit = Websetting::where('key','data_limit')->first()->value;
            if(($time - $last) > $limit){
                $points[] =  new Point(
                    $key, // name of the measurement
                    floatval ($data), // the measurement value
                    ['region' => 'tw'], // optional tags
                    [], // optional additional fields,
                    $time
                );
                $arr[] = $key;
            }

        }

        $result = InfluxDB::writePoints($points, \InfluxDB\Database::PRECISION_SECONDS);
        print_r($arr);
    }
}
