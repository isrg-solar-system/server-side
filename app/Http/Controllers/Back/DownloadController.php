<?php

namespace App\Http\Controllers\Back;



use App\CacheDownload;
use App\Events\DownloadStatus;
use App\Jobs\DownloadMaker;
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

//         session(['downloadstatus' => [ 'status'=>'Finished','val'=> 100 ,'filename'=>'2018-04-271R1dONUM.csv']]);
        $bkey = Session('downloadbroadkey');
        $sql = CacheDownload::where('key', json_encode($request->all()))->first();
        if(!is_null($sql)){
            $filename = $sql->first()->filename;
            event(new DownloadStatus($bkey,['downloadstatus' => [ 'status'=>'Finished(From Cache)','val'=> 100 ,'filename'=>$filename]]));
//            session(['downloadstatus' => [ 'status'=>'Finished','val'=> 100 ,'filename'=>$filename]]);
        }else{
            DownloadMaker::dispatch($bkey,$request->all())->onQueue('download');
        }

    }

    public function downloadstatus(){
        return json_encode(session('downloadstatus'));
    }
}
