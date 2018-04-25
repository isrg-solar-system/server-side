<?php

namespace App\Jobs;

use App\Websetting;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Ixudra\Curl\Facades\Curl;

class AlertingToLine implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $dataname;
    protected $status;
    protected $token;
    public function __construct($dataname,$status)
    {
        //
        $this->token = Websetting::where('key','line_api')->first()->value;
        $this->dataname = $dataname;
        $this->status = $status;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        if(!is_null($this->token)){
            if($this->status){
                $message = "\r\n".$this->dataname . " 目前已回復穩定數值";
            }else{
                $message = "\r\n".$this->dataname . " 目前有狀況,請維護";
            }
            $response = Curl::to('https://notify-api.line.me/api/notify')
                ->withHeaders( array( 'Authorization: Bearer '.$this->token, 'Content-Type: application/x-www-form-urlencoded' ) )
                ->withData( ['message' => $message ])
                ->post();
        }
    }
}
