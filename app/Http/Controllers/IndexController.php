<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        if (!$user) { return view('welcome'); }
        $param = [
            'user' => $user,
        ];

        return view('index.index', $param);
    }

    public function send(Request $request)
    {
        $send_user = DB::table('users')->where('user_id', $request->user_id)->first();
        $user = Auth::user();
        // ToDo 各エラー時の処理　現状は初期ページに飛ばすのみ
        if (!$user || !$send_user) { return view('welcome'); }
        if ($user->id == $send_user->id) { return view('welcome'); }

        $param = [
            'user' => $user,
            'send_user' => $send_user,
        ];

        return view('index.send', $param);
    }

}
