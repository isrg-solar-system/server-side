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

    public function update(Request $request){
        foreach ($request->all() as $key => $value){
            $query = Websetting::where('key',$key)->first();
            $query->value = $value;
            $query->save();
        }
        return 1;
    }
}
