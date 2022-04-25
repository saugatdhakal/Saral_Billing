<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;

class ActivityLogsController extends Controller
{
    public function index(){
        return DB::table('activity_log')->get();

        return view('activityLog.index');
    }
}
