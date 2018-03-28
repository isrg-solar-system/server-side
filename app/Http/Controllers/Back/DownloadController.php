<?php

namespace App\Http\Controllers\Back;



use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
}
