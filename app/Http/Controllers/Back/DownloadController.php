<?php

namespace App\Http\Controllers\Back;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use TrayLabs\InfluxDB\Facades\InfluxDB;


class DownloadController extends BackController
{
    //
    public $title = 'Data Download';

    public function index(){
        return view('back.download.index');
    }



    public function getDownloadFile(){
        $path = storage_path('excel/exports/data.csv');

        return response()->download($path);
    }
}
