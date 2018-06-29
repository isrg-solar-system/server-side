<?php

namespace App\Jobs;

use App\Events\WarningBroadcast;
use App\Log;
use App\SettingWarning;
use App\Warning;
use App\Websetting;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Carbon;
use InfluxDB\Point;
use Ixudra\Curl\Facades\Curl;
use TrayLabs\InfluxDB\Facades\InfluxDB;

class CheckingData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $data;

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
        // bug > < 必須一起測試
        foreach (json_decode($this->data) as $key => $data){
            $settings = SettingWarning::where('name',$key)->get();


            $lastcheck = Warning::where('dataname',$key)->orderBy('id','desc')->first();
            $status = true;  // true 無狀況 false有狀況
            if(!is_null($settings)){
                foreach ($settings as $setting){
                    switch ($setting->operate){
                        case '>':
                            //先有不正常狀態,才會有恢復正常狀態,若一直在不正常狀態只會有一筆資料
                            if($data > $setting->value){ //當資料為不正常狀態
                                $status = false;
                            }else{ //當資料為正常狀態
                                $status = true && $status;
                            }
                            break;
                        case '<':
                            //先有不正常狀態,才會有恢復正常狀態,若一直在不正常狀態只會有一筆資料
                            if($data < $setting->value){ //當資料為不正常狀態
                                $status = false;
                            }else{ //當資料為正常狀態
                                $status = true && $status;
                            }
                            break;
                    }
                }
                // status=true 安好 = false有狀況
                if(!is_null($lastcheck)){
                    if($lastcheck->status == false && $status == false){ //資料庫:有狀況 實際:有狀況 , 部任何動作
//                        print_r("資料庫:有狀況 實際:有狀況 , 部任何動作\n");
                    }elseif ($lastcheck->status == false && $status == true){ //資料庫:有狀況 實際:無狀況 , 新增至資料庫"無狀況"
//                        print_r("資料庫:有狀況 實際:無狀況 , 新增至資料庫無狀況\n");
                        $this->alert($key,1,$data);

                        $warning = new Warning();
                        $warning->dataname = $key;
                        $warning->status = true;
                        $warning->save();
                    }elseif ($lastcheck->status == true && $status == false) { //資料庫:沒狀況 實際:有狀況 , 新增至資料庫"有狀況"
//                        print_r("資料庫:沒狀況 實際:有狀況 , 新增至資料庫\"有狀況\"\n");
                        $this->alert($key,0,$data);

                        $warning = new Warning();
                        $warning->dataname = $key;
                        $warning->status = false;
                        $warning->save();
                    }elseif ($lastcheck->status == true && $status == true) { //資料庫:沒狀況 實際:沒狀況 , 部動作
//                        print_r("資料庫:沒狀況 實際:沒狀況 , 部動作\n");
                    }
                }else{
                    if($status==false){
//                        print_r("資料庫:未寫入 實際:有狀況 , 新增至資料庫\"有狀況\"\n");
                        $this->alert($key,0,$data);

                        $warning = new Warning();
                        $warning->dataname = $key;
                        $warning->status = false;
                        $warning->save();
                    }else{
//                        print_r("資料庫:未寫入 實際:無狀況 \n");
                    }
                }

            }

        }
    }



    public function alert($dataname,$status,$value){

        $line_token = Websetting::where('key','line_api')->first()->value;

        $message = Websetting::where('key','line_format')->first()->value;
        if($status){
            $_status = '狀況正常';
        }else{
            $_status = '超出異常範圍';
        }
        print_r($dataname."的資料->".$_status."\n");
        $message = "\r\n" . $message;
        $message = str_replace('@dataname', $dataname, $message);
        $message = str_replace('@status', $_status, $message);
        $message = str_replace('@value', $value, $message);
        event(new WarningBroadcast($dataname,$status,$value));
        if(isset($line_token)){
            $response = Curl::to('https://notify-api.line.me/api/notify')
                ->withHeaders( array( 'Authorization: Bearer '.$line_token, 'Content-Type: application/x-www-form-urlencoded' ) )
                ->withData( ['message' => $message ])
                ->post();
        }

//        $email_token = Websetting::where('key','email_api')->first()->value;
//        if(isset($email_token)){
//            $client = new \GuzzleHttp\Client([
//                'verify' => false,
//            ]);
//            $adapter = new \Http\Adapter\Guzzle6\Client($client);
//            $domain = 'sandboxb3d4f76588ab418baeb8fdd337b9e074.mailgun.org';
//            $mgClient = new Mailgun('key-a0b8a600707180e7995561cd674c33dc',$adapter);
//            $result = $mgClient->sendMessage($domain,
//                array('from'    => 'Excited User <excited@samples.mailgun.org>',
//                    'to'      => 'Mailgun Devs <devs@mailgun.net>',
//                    'subject' => 'Hello',
//                    'text'    => 'Testing some Mailgun awesomeness!'));
//        }

    }
}
