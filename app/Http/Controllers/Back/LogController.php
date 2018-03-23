<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LogController extends BackController
{
    //
    public $title = 'System Log';
    public function index(){
        return view('back.log.index');
    }


}
