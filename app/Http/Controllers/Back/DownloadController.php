<?php

namespace App\Http\Controllers\Back;



use App\CacheDownload;
use App\Events\DownloadStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Session\Session;
use TrayLabs\InfluxDB\Facades\InfluxDB;


class DownloadController extends BackController
{
    //
    public $title = 'Data Download';

    public function index(){
        $key = substr(Crypt::encrypt(rand (0, 99)),0,28);
        session(['downloadbroadkey' => $key]);
        return view('back.download.index')->with('user',$key);
    }



    public function getDownloadFile(){
        $value = Session('downloadstatus');
//        dd($value);
        if(isset($value['filename'])){
            $path = storage_path('excel/exports' .'/'. $value['filename']);
            session()->forget('downloadstatus');
            return response()->download($path);
        }else{
            abort(500);
        }

    }

    public function makedownload(Request $request){
        $bkey = Session('downloadbroadkey');
        $sql = CacheDownload::where('key', json_encode($request->all()))->first();
        if(!is_null($sql)){
            $filename = $sql->first()->filename;
            event(new DownloadStatus($bkey,['downloadstatus' => [ 'status'=>'Finished(From Cache)','val'=> 100 ,'filename'=>$filename]]));
//            session(['downloadstatus' => [ 'status'=>'Finished','val'=> 100 ,'filename'=>$filename]]);
        }else{
            ini_set('memory_limit', '-1');
            ini_set('max_execution_time', 300); //300 seconds = 5 minutes
            $total_datas = count($request->datas);
            $colect_status = 0;
            $re = [];
            foreach ($request->datas as $data){
                $result = InfluxDB::query("select * from " . $data . " where time > '".$request->datefrom."' AND time < '". $request->dateto."'");
                $points = $result->getPoints();
                foreach ($points as $point){
                    $re[$point['time']][$data] = $point['value'];
                }
                $colect_status += 1;
                event(new DownloadStatus($bkey,['downloadstatus' => [ 'status'=>'collecting data','val'=> round($colect_status / $total_datas / 2,2)*100 ]]));
//                session(['downloadstatus' => [ 'status'=>'collecting data','val'=> round($colect_status / $total_datas / 2,2)*100 ]]);
            }
            event(new DownloadStatus($bkey,['downloadstatus' => [ 'status'=>'converting data to file','val'=> 75 ]]));
//            session(['downloadstatus' => [ 'status'=>'converting data to file','val'=> 75 ]]);
            /*  conver to excel data */
            $out = [];
            foreach ($re as $key => $value){
                array_push($value, $key);
                $out[] = $value;
            }
            /*    add title */
            $da = [];
            foreach ($request->datas as $data) {
                $da[] = $data;
            }
            $da[] = 'datetime';
            array_unshift($out,$da);

            $filename = substr(Carbon::now(),0,10) . substr(Crypt::encrypt(random_int(0,99)),15,8);
            event(new DownloadStatus($bkey,['downloadstatus' => [ 'status'=>'Making File','val'=> 90 ]]));

            $file = Excel::create($filename,function($excel) use ($out){
                $excel->sheet('data', function($sheet) use ($out){
                    $sheet->rows($out);
                });
            })->store($request->filetype,storage_path('excel/exports'));
            event(new DownloadStatus($bkey,['downloadstatus' => [ 'status'=>'Finished','val'=> 100 ,'filename'=>$filename.'.'.$request->filetype]]));
            session(['downloadstatus' => [ 'status'=>'Finished','val'=> 100 ,'filename'=>$filename.'.'.$request->filetype]]);
            $create = new CacheDownload();
            $create->key = json_encode($request->all());
            $create->filename = $filename.'.'.$request->filetype;
            $create->save();
        }

    }

    public function downloadstatus(){
        return json_encode(session('downloadstatus'));
    }
}
