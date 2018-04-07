<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class HistoryController extends Controller
{
    public function all(Request $request)
    {
        $items = DB::table('passbooks AS p')
            ->select('s.id', 's.user_id', 'p.send_user_id', 's.name', 'r.user_id AS r_user_id', 'r.name AS r_name', 'p.receve_point', 'p.created_at')
            ->leftJoin('users AS s','p.send_user_id', '=', 's.id')
            ->leftJoin('users AS r','p.receve_user_id', '=', 'r.id')
            ->orderBy('p.id', 'desc')->paginate(100);
        $param =[
            'items' => $items,
        ];
        return view('history.history_all', $param);
    }

    public function user(Request $request)
    {
        $tagetUser = DB::table('users')->where('user_id', $request->user_id)->first();
        if (!$tagetUser) { return view('welcome'); }

        $tagetUserId = $request->user_id;

        $items = DB::table('passbooks AS p')
            ->select('s.id', 's.user_id', 'p.send_user_id', 's.name', 'r.user_id AS r_user_id', 'r.name AS r_name', 'p.send_point', 'p.receve_point', 'p.created_at')
            ->leftJoin('users AS s','p.send_user_id', '=', 's.id')
            ->leftJoin('users AS r','p.receve_user_id', '=', 'r.id')
            ->where('s.user_id', $tagetUserId)
            ->orWhere('r.user_id', $tagetUserId)
            ->orderBy('p.id', 'desc')->paginate(100);
        $param = [
            'items' => $items,
            'tagetUser' => $tagetUser,
        ];
        return view('history.history', $param);
    }
}
