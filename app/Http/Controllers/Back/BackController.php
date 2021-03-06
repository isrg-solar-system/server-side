<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class BackController extends Controller
{
    //

    public $list = [
        'Web Setting' => ['url'=>'SettingIndex','icon'=>'ti-settings'],
        'Member Manage' =>  ['url'=> 'MemberIndex','icon'=>'ti-user'],
        'Report View' =>  ['url'=>'ReportIndex','icon'=>'ti-bar-chart-alt'],
        'Data Download' =>  ['url'=>'DownloadIndex','icon'=>'ti-download'],
        'Warning Setting' => ['url'=>'WarningIndex','icon'=>'ti-comment'],
        'System Log' =>  ['url'=>'LogList','icon'=>'ti-clipboard'],
    ];

    public $title = "";

    function __construct()
    {
        $this->middleware(function ($request, $next) {
//            Auth::attempt(['email' => 'img21326@gmail.com', 'password' => 'password']); //測試用 自動登入

            if(Auth::check()){
                if(Auth::user()->level){
                    $this->list = [
                        'Member Manage' =>  ['url'=> 'MemberIndex','icon'=>'ti-user'],
                        'Report View' =>  ['url'=>'ReportIndex','icon'=>'ti-bar-chart-alt'],
                        'Data Download' =>  ['url'=>'DownloadIndex','icon'=>'ti-download'],
                        'Warning Setting' => ['url'=>'WarningIndex','icon'=>'ti-comment'],
                        'System Log' =>  ['url'=>'LogList','icon'=>'ti-clipboard'],
                        'Web Setting' => ['url'=>'SettingIndex','icon'=>'ti-settings'],

                    ];
                }else{
                    $this->list = [
                        'Report View' =>  ['url'=>'ReportIndex','icon'=>'ti-bar-chart-alt'],
                        'Data Download' =>  ['url'=>'DownloadIndex','icon'=>'ti-download'],
                        'System Log' =>  ['url'=>'LogList','icon'=>'ti-clipboard'],
                    ];
                }
                View::share('lists', $this->list);
                View::share('title', $this->title);
                return $next($request);
            }else{
                return abort(404);
            }

        });
    }
}
