<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use DataTables;


use Illuminate\Http\Request;

class ActivityLogsController extends Controller
{
    public function index(){
        // return DB::table('activity_log')
        //  ->select(['id','log_name','event','subject_type',
        //  'subject_id','created_at','updated_at'])
        //  ->get();
        return view('activityLog.index');
    }

    public function ajaxActivityData(){
         $data =DB::table('activity_log')
         ->select(['id','log_name','event','subject_type','subject_id','created_at','updated_at'])
         ->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action',function($row){

                $actionBtn=
                ' 
                    <a class="restoreTrash" id="'.$row->id.'">
                    <i class="fa-solid fa-eye fa-xl" ></i>
                    </a>
                    &#160
                     &#160
                    <a  class="deleteSale" id="'.$row->id.'">
                        <i class="fa-solid fa-trash-can-list fa-xl"></i>
                    </a>
                ';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
