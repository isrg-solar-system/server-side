<?php

namespace App\Http\Controllers\Back;



use App\CacheDownload;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Session\Session;
use TrayLabs\InfluxDB\Facades\InfluxDB;


class DownloadController extends BackController
{
    //
    public $title = 'Data Download';

    public function index(){
        return view('back.download.index');
    }



    public function getDownloadFile(){
        $value = Session('downloadstatus');
//        dd($value);
        if(isset($value['filename'])){
            $path = storage_path('excel\exports' .'\\'. $value['filename']);
            session()->forget('downloadstatus');
            return response()->download($path);
        }else{
            abort(500);
        }
    }

    public function makedownload(Request $request){
        $sql = CacheDownload::where('key', json_encode($request->all()))->first();
        if(!is_null($sql)){
            $filename = $sql->first()->filename;
            session(['downloadstatus' => [ 'status'=>'Finished','val'=> 100 ,'filename'=>$filename]]);
        }else{
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
                session(['downloadstatus' => [ 'status'=>'collecting data','val'=> round($colect_status / $total_datas / 2,2)*100 ]]);
            }
            session(['downloadstatus' => [ 'status'=>'converting data to file','val'=> 75 ]]);
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
            $da[] = 'data';
            array_unshift($out,$da);

            $filename = substr(Carbon::now(),0,10) . substr(Crypt::encrypt(random_int(0,99)),15,8);

            $file = Excel::create($filename,function($excel) use ($out){
                $excel->sheet('data', function($sheet) use ($out){
                    $sheet->rows($out);
                });
            })->store($request->filetype,storage_path('excel/exports'));
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
