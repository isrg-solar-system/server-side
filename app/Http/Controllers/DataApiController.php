<?php

namespace App\Http\Controllers;

use App\Events\InputData;
use Illuminate\Http\Request;

class DataApiController extends Controller
{
    //

    public function input(Request $request){
        $data = $request->get('data');
        event(new InputData($data));
    }
}
