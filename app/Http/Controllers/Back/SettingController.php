<?php

namespace App\Http\Controllers\Back;

use App\Websetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mailgun\Mailgun;

class SettingController extends BackController
{
    //
    public $title = 'Web Setting';
    public function index(){
        $setting = Websetting::all();

        return view('back.setting.index')->with('setting',$setting);
    }
}
