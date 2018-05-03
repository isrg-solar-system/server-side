<?php

namespace App\Http\Controllers\Back;

use App\Warning;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LogController extends BackController
{
    //
    public $title = 'System Log';
    public function index(){
        $log = Warning::paginate(15);
        return view('back.log.index')->with('log',$log);
    }


}
