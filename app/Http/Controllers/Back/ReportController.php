<?php

namespace App\Http\Controllers\Back;

use App\Report;
use Carbon\Carbon;
use ErrorException;
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

    public function create(Request $request){
        $a = new Report();
        $a->title = $request->title;
        $a->x = $request->x;
        $a->y = $request->y;
        $a->width = $request->width;
        $a->height = $request->height;
        $a->chart = $request->chart;
        $a->datefrom = Carbon::parse($request->datefrom, 'Asia/Taipei')->toDateString();
        $a->dateto = Carbon::parse($request->dateto, 'Asia/Taipei')->toDateString();
        $a->group = $request->group;
        $a->name = $request->name;
        $a->chart = $request->chart;
        $a->user_id = Auth::id();
        $a->save();
        return json_encode(['status'=>1]);
    }
    
    public function update(Request $request){
        $allreports = Auth::user()->reports->toArray();
        foreach ($request->reports as $report){
            $a = Report::find($report['id']);
            $a->title = $report['title'];
            $a->x = $report['x'];
            $a->y = $report['y'];
            $a->chart = $report['chart'];
            $a->width = $report['width'];
            $a->height = $report['height'];
            $a->chart = $report['chart'];
            $a->datefrom = Carbon::parse($report['datefrom'], 'Asia/Taipei')->toDateString();
            $a->dateto = Carbon::parse($report['dateto'], 'Asia/Taipei')->toDateString();
            $a->group = $report['group'];
            $a->name = $report['name'];
            $a->save();
        }
        return json_encode(['status'=>1]);
    }

    public function delete(Request $request){
        $del = Report::find($request->id);
        $del->delete();
        return json_encode(['status'=>1]);
    }
}
