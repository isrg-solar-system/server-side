<?php

namespace App\Jobs;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
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
        $time = time();
        foreach (json_decode($this->data) as $key => $data){
            $points[] =  new Point(
                $key, // name of the measurement
                floatval ($data), // the measurement value
                ['region' => 'tw'], // optional tags
                [], // optional additional fields,
                $time
            );
        }
        $result = InfluxDB::writePoints($points, \InfluxDB\Database::PRECISION_SECONDS);
    }
}
