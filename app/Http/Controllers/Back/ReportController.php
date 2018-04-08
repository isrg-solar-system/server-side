<?php

namespace App\Http\Controllers\Back;

use App\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReportController extends BackController
{
    //
    public $title = 'Report View';
    public function index(){
        return view('back.report.index');
    }

    public function lists(){
        $re = Auth::user()->reports;
        return json_decode($re);
    }

    public function update(Request $request){
        foreach ($request->reports as $report){
            $a = Report::find($report['id']);
            $a->title = $report['title'];
            $a->x = $report['x'];
            $a->y = $report['y'];
            $a->width = $report['width'];
            $a->height = $report['height'];
            $a->chart = $report['chart'];
            $a->datefrom = $report['datefrom'];
            $a->dateto = $report['dateto'];
            $a->group = $report['group'];
            $a->name = $report['name'];
            $a->save();
        }

        return json_encode(['status'=>1]);
    }
}
