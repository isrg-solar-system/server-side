<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    //
    public $title = 'Web Setting';
    public function index(){
        return view('back.report.index');
    }
}
