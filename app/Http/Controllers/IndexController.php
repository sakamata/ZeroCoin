<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

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

    public function post(Request $request)
    {
        $user = Auth::user();
        if (!$user) { return view('welcome'); }

        // ToDo 異常時のerror処理 エラーメッセージ等を表示させる
        // 1以上の整数でない場合は撥ねる
        if (!ctype_digit($request->send_point)) {
            Log::info(print_r('↓send_point 整数じゃない',1));
            Log::info(print_r($request->send_point,1));
            return view('welcome');
        }
        if ($request->send_point  <= 0) {
            Log::info(print_r('↓send_point 0以下',1));
            Log::info(print_r($request->send_point,1));
            return view('welcome');
        }

        // 残高以上の額を送信をしようとした場合
        if ($request->send_point  >  $user->now_point) {
            Log::info(print_r('↓send_point 残高以上の額送信だった',1));
            Log::info(print_r($request->send_point,1));
            return view('welcome');
        }

        // DB更新 通帳table 用params
        $passbooks = [
            'send_user_id' => $user->id,
            'receve_user_id' => $request->receve_user_id,
            'send_point' => $request->send_point * -1,
            'receve_point' => $request->send_point,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        // 各tableのrecord更新のためトランザクション
        $status = DB::transaction(function () use ($passbooks, $user, $request)
        {
            // DB更新 通帳table
            $pass_id = DB::table('passbooks')->insertGetId($passbooks);
            // 送信 DB更新 user table now_point
            DB::table('users')->where('id', $user->id)
                ->decrement('now_point', $request->send_point);
            DB::table('users')->where('id', $request->receve_user_id)
                ->increment('now_point', $request->send_point);

            // balance(残高) tableへ２ユーザーの現在の残高をinsertする
            $send = DB::table('users')->where('id', $user->id)->first();
            $receve = DB::table('users')->where('id', $request->receve_user_id)->first();

            $blance_send = [
                'passbook_id' => $pass_id,
                'user_id' => $user->id,
                'balance' => $send->now_point,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
            DB::table('balance')->insert($blance_send);

            $blance_receve = [
                'passbook_id' => $pass_id,
                'user_id' => $request->receve_user_id,
                'balance' => $receve->now_point,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
            DB::table('balance')->insert($blance_receve);

            // 表示に必要な要素を取得 $status として返り値に
            return array(
                'pass_id' => $pass_id,
                'receve_user' => $receve,
                'now_point' => $send->now_point,
            );
        }, 5); // transaction実行回数

        // 画面表示
        $sent_book = DB::table('passbooks')
            ->where('id', $status['pass_id'])->first();
        $param = [
            'user' => $user,
            'now_point' => $status['now_point'],
            'receve_user' => $status['receve_user'],
            'sent_book' => $sent_book,
        ];
        return view('index.post', $param);
    }
}
