<?php

namespace App\Http\Controllers\Back;

use App\Report;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;

class MemberController extends BackController
{
    public $title = 'Member Manager';

    public function index(){
        return view('back.member.index');
    }

    public function add(Request $request){
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->level = $request->level;
        $user->save();
        return 1;
    }

    public function update(Request $request){
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        if(!is_null($request->password)){
            $user->password = Hash::make($request->password);
        }
        $user->level = $request->level;
        $user->save();
        return 1;
    }

    public function delete(Request $request){
        $user = User::find($request->id);
        $user->delete();
        return 1;
    }

    public function lists(){
        if(Auth::user()->level == 1){
            return json_encode(User::all());
        }else{
            abort(500);
        }
    }
}
