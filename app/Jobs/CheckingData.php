<?php

namespace App\Jobs;

use App\SettingWarning;
use App\Warning;
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
            if(!is_null($settings)){
                foreach ($settings as $setting){
                    switch ($setting->operate){
                        case '>':
                            //先有不正常狀態,才會有恢復正常狀態,若一直在不正常狀態只會有一筆資料
                            $lastcheck = Warning::where('dataname',$key)->where('operate','>')->orderBy('id','desc')->first();
                            if($data > $setting->value){ //當資料為不正常狀態
                                if(!is_null($lastcheck)){  //如果最後一比存在
                                    if($lastcheck->status){ //最後一筆為 正常值
                                        print_r("資料不正常,發現最後一筆為正常值.建立一筆新的不正常警告\n");
                                        $new_warning = new Warning(); //新增一筆為不正常狀態
                                        $new_warning->dataname = $key;
                                        $new_warning->operate = '>';
                                        $new_warning->status = 0;
                                        $new_warning->save();
                                    }else{ //若為不正常但最會一筆依然為"未恢復狀態"則不動
                                        print_r("資料依然處於不正常.不做任何作業\n");
                                    }
                                }else{  //最後一筆不存在
                                    print_r("資料不正常,未最後一筆為正常值.建立一筆新的不正常警告\n");
                                    $new_warning = new Warning();  //新增一筆為不正常狀態
                                    $new_warning->dataname = $key;
                                    $new_warning->operate = '>';
                                    $new_warning->status = 0;
                                    $new_warning->save();
                                }
                            }else{ //當資料為正常狀態
                                if(!is_null($lastcheck)){  //如果最後一比存在
                                    if(!$lastcheck->status){ //最後一筆為 未恢復正常
                                        print_r("資料正常,發現最後一筆為不正常值.建立一筆新的正常警告\n");
                                        $new_warning = new Warning(); //新增一筆為恢復正常狀態
                                        $new_warning->dataname = $key;
                                        $new_warning->operate = '>';
                                        $new_warning->status = 1;
                                        $new_warning->save();
                                    }else{//若為正常但最會一筆依然為"正常狀態"則不動
                                        print_r("資料依然處於正常.不做任何作業\n");
                                    }
                                }else{//若最後一筆不存在則不動
                                    print_r("資料正常,未發現最後一筆.不做任何作業\n");
                                }
                            }
                            break;
                        case '<':
                            //先有不正常狀態,才會有恢復正常狀態,若一直在不正常狀態只會有一筆資料
                            $lastcheck = Warning::where('dataname',$key)->where('operate','<')->orderBy('id','desc')->first();
                            if($data < $setting->value){ //當資料為不正常狀態
                                if(!is_null($lastcheck)){  //如果最後一比存在
                                    if($lastcheck->status){ //最後一筆為 正常值
                                        print_r("資料不正常,發現最後一筆為正常值.建立一筆新的不正常警告\n");
                                        $new_warning = new Warning(); //新增一筆為不正常狀態
                                        $new_warning->dataname = $key;
                                        $new_warning->operate = '<';
                                        $new_warning->status = 0;
                                        $new_warning->save();
                                    }else{ //若為不正常但最會一筆依然為"未恢復狀態"則不動
                                        print_r("資料依然處於不正常.不做任何作業\n");
                                    }
                                }else{  //最後一筆不存在
                                    print_r("資料不正常,未最後一筆為正常值.建立一筆新的不正常警告\n");
                                    $new_warning = new Warning();  //新增一筆為不正常狀態
                                    $new_warning->dataname = $key;
                                    $new_warning->operate = '<';
                                    $new_warning->status = 0;
                                    $new_warning->save();
                                }
                            }else{ //當資料為正常狀態
                                if(!is_null($lastcheck)){  //如果最後一比存在
                                    if(!$lastcheck->status){ //最後一筆為 未恢復正常
                                        print_r("資料正常,發現最後一筆為不正常值.建立一筆新的正常警告\n");
                                        $new_warning = new Warning(); //新增一筆為恢復正常狀態
                                        $new_warning->dataname = $key;
                                        $new_warning->operate = '<';
                                        $new_warning->status = 1;
                                        $new_warning->save();
                                    }else{//若為正常但最會一筆依然為"正常狀態"則不動
                                        print_r("資料依然處於正常.不做任何作業\n");
                                    }
                                }else{//若最後一筆不存在則不動
                                    print_r("資料正常,未發現最後一筆.不做任何作業\n");
                                }
                            }
                            break;
                    }
                }
            }

        }

    }
}
