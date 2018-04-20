<?php

namespace App\Jobs;

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
        $response = Curl::to('http://foo.com/bar')
            ->withHeaders( array( 'Authorization: Bearer '+$this->token, 'Content-Type: application/x-www-form-urlencoded' ) )
            ->withData( array( 'message' => $this->dataname ) )
            ->asJson()
            ->post();
    }
}
