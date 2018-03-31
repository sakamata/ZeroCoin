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


        return view('index.index');
    }

}
