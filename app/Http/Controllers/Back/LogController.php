<?php

namespace App\Http\Controllers\Back;

use App\Warning;
use Carbon\Carbon;
use http\Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LogController extends BackController
{
    //
    public $title = 'System Log';
    public function index(){
        $log = Warning::orderBy('created_at', 'desc')->paginate(15);
        return view('back.log.index')->with('log',$log)->with('page',1);;
    }

    public function search(Request $request){
        $key = explode(",",$request->key);
        if(count($key) > 1){
            $log = Warning::where('created_at', 'like','%'.$key[1].'%')->where('dataname', 'like','%'.$key[0].'%')->orderBy('created_at', 'desc')->get();
        }else{
            if($this->isDate($request->key)){
                $log = Warning::where('created_at', 'like','%'.$request->key.'%')->orderBy('created_at', 'desc')->get();
            }else{
                $log = Warning::where('dataname', 'like','%'.$request->key.'%')->orderBy('created_at', 'desc')->get();
            }
        }


        return view('back.log.index')->with('log',$log)->with('page',0);
    }

    function isDate($value)
    {
        if (!$value) {
            return false;
        }

        try {
            new \DateTime($value);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }


}
