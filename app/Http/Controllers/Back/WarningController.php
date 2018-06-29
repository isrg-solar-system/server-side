<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Back\BackController;
use App\SettingWarning;
use Illuminate\Http\Request;

class WarningController extends BackController
{
    //
    public $title = 'Warning Setting';
    public function index(){
        return view('back.warning.index');
    }

    public function lists(){
        $re = SettingWarning::all();
        return json_encode($re);
    }

    public function update(Request $request){
        $up = SettingWarning::find($request->id);
        $up->operate = $request->operate;
        $up->value = $request->value;
        $up->save();
        return json_encode(['status'=>'1']);
    }

    public function create(Request $request){
        $up = new SettingWarning();
        $up->name = $request->name;
        $up->operate = $request->operate;
        $up->value = $request->value;
        $up->save();
        return json_encode(['status'=>'1']);
    }

    public function delete(Request $request){
        $up = SettingWarning::find($request->id);
        $up->delete();
        return json_encode(['status'=>'1']);
    }
}
