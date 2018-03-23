<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class BackController extends Controller
{
    //

    public $list = [
        'Web Setting' => ['url'=>'MemberList','icon'=>'ti-settings'],
        'Member Manage' =>  ['url'=> 'MemberList','icon'=>'ti-user'],
        'Report View' =>  ['url'=>'MemberList','icon'=>'ti-bar-chart-alt'],
        'Data Download' =>  ['url'=>'MemberList','icon'=>'ti-download'],
        'System Log' =>  ['url'=>'LogList','icon'=>'ti-clipboard'],
        'Warning Setting' => ['url'=>'MemberList','icon'=>'ti-comment'],
    ];

    public $title = "";

    function __construct()
    {
        $this->middleware(function ($request, $next) {
//            if(Auth::check()){
                View::share('lists', $this->list);
                View::share('title', $this->title);
//            }
            return $next($request);
        });
    }
}
