<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Back\BackController;
use Illuminate\Http\Request;

class WarningController extends BackController
{
    //
    public $title = 'Warning Setting';
    public function index(){
        return view('back.warning.index');
    }
}
