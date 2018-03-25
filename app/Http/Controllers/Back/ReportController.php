<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends BackController
{
    //
    public $title = 'Report View';
    public function index(){
        return view('back.report.index');
    }

}
