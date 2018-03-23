<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DownloadController extends BackController
{
    //
    public $title = 'Data Download';

    public function index(){
        return view('back.download.index');
    }
}
