<?php

namespace App\Jobs;

use App\SettingWarning;
use App\Warning;
use function GuzzleHttp\Psr7\str;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

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
            print_r("正在處理".$key."的資料->".$data."\n");

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
                        print_r("資料庫:有狀況 實際:有狀況 , 部任何動作\n");
                    }elseif ($lastcheck->status == false && $status == true){ //資料庫:有狀況 實際:無狀況 , 新增至資料庫"無狀況"
                        print_r("資料庫:有狀況 實際:無狀況 , 新增至資料庫無狀況\n");
                        $warning = new Warning();
                        $warning->dataname = $key;
                        $warning->status = true;
                        $warning->save();
                    }elseif ($lastcheck->status == true && $status == false) { //資料庫:沒狀況 實際:有狀況 , 新增至資料庫"有狀況"
                        print_r("資料庫:沒狀況 實際:有狀況 , 新增至資料庫\"有狀況\"\n");
                        $warning = new Warning();
                        $warning->dataname = $key;
                        $warning->status = false;
                        $warning->save();
                    }elseif ($lastcheck->status == true && $status == true) { //資料庫:沒狀況 實際:沒狀況 , 部動作
                        print_r("資料庫:沒狀況 實際:沒狀況 , 部動作\n");
                    }
                }else{
                    if($status==false){
                        print_r("資料庫:未寫入 實際:有狀況 , 新增至資料庫\"有狀況\"\n");
                        $warning = new Warning();
                        $warning->dataname = $key;
                        $warning->status = false;
                        $warning->save();
                    }else{
                        print_r("資料庫:未寫入 實際:無狀況 \n");
                    }
                }

            }

        }

    }
}
