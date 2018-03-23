<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class MemberController extends BackController
{
    public $title = 'Member Manager';

    public function index(){
        return view('back.member.index');
    }

    public function add(){
        return view('back.member.edit');
    }
}
