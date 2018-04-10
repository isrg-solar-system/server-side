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

    public function update(Request $request){
        $allreports = Auth::user()->reports->toArray();
        foreach ($request->reports as $report){

            // 查看那些被刪除
            try {
                $index = array_search($report['id'], array_column($allreports, 'id')) + 1;
                if($index != false){
                    unset($allreports[array_search($report['id'], array_column($allreports, 'id'))]);
                }
            } catch (ErrorException $e) {

            }

            try {
                $a = Report::find($report['id']);
            } catch (ErrorException $e) {
                $a = new Report();
                $a->user_id = Auth::id();
            }
            $a->title = $report['title'];
            $a->x = $report['x'];
            $a->y = $report['y'];
            $a->width = $report['width'];
            $a->height = $report['height'];
            $a->chart = $report['chart'];
            $a->datefrom = Carbon::parse($report['datefrom'], 'Asia/Taipei')->toDateString();
            $a->dateto = Carbon::parse($report['dateto'], 'Asia/Taipei')->toDateString();
            $a->group = $report['group'];
            $a->name = $report['name'];
            $a->save();

        }

        foreach ($allreports as $report){
            $del = Report::find($report['id']);
            $del->delete();
        }
        return json_encode($allreports);
    }
}
