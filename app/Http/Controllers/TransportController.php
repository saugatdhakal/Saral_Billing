<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transport;
use Illuminate\Support\Facades\DB;
use DataTables;
class TransportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('transport.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('transport.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $request->validate([
        'name' => 'required|max:255',
        'address' => 'required|max:255',
        'number'=> 'required|min:10|max:10',
        ]);
        $transport = new Transport;
        $transport->name = $request->name;
        $transport->contact_number = $request->number;
        $transport->address = $request->address;
        $transport->remark = empty($request->remark)? "Empty" : $request->remark;
        $transport->save();
        
        return redirect()->route('transport.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
         
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $transport = DB::table('transports')->select('id','name',
        'address',
        'contact_number',
        'remark',)->find($id);
       
        return view('transport.edit',['transport'=>$transport]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $request->validate([
        'name' => 'required|max:255',
        'address' => 'required|max:255',
        'number'=> 'required|min:10|max:10',
        ]);
        $transport = Transport::find($id);
        $transport->name = $request->name;
        $transport->address = $request->address;
        $transport->contact_number = $request->number;
        $transport->remark = $request->remark;
        $transport->save();
        return redirect()->route('transport.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $transport = Transport::find($id);
        $transport->status = 'INACTIVE';
        $transport->delete();
        return "DeleteSuccess";
    }

    public function yajraTableIndex(){
        $data = DB::table('transports')->where('deleted_by',NULL)->get(['id','name','address','contact_number','remark']);
            
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action',function($row){
                $actionBtn =' 
                <a class="btnEdit" href="/transport/'.$row->id.'/edit" >
                <i class="far fa-edit fa-lg"></i> 
                </a>
                 &#160
                <a data-toggle="modal" class="viewTransport" id="'.$row->id.'"  data-target="#transportModel">
                 <i class="far fa-eye fa-lg"></i>
                </a>
                &#160
                <a  class="deleteTransport" id="'.$row->id.'">
                <i class="fas fa-trash-alt fa-lg"></i>
                </a>
                ';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    
    public function trash(){
        return view('transport/trash');
    }
    public function trashDataTable(){
        $data = DB::table('transports')->whereNotNull('deleted_by')->get(['id','name','address','contact_number','remark']);
        return DataTables::of($data)
         ->addIndexColumn()
            ->addColumn('action',function($row){
                $actionBtn =' 
                <a class="btnEdit" href="/transport/'.$row->id.'/edit"" >
                <i class="far fa-edit fa-lg"></i> 
                </a>
                 &#160
                 <a class="restoreTrash" id="'.$row->id.'">
                 <i class="fas fa-undo-alt fa-lg"></i>
                </a>
                &#160
                <a class="deleteTransport" id="'.$row->id.'">
                    <i class="fas fa-trash-alt fa-lg"></i>
                </a>
                ';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function viewModel($id){
        $data = DB::table('transports')->where('id', $id)->where('deleted_by',NULL)->get(['id','name','address','contact_number','remark'])->first();
        return $data;
    }
    public function restoreTransport($id){
        $transport = Transport::withTrashed()->find($id);
        $transport->status = 'ACTIVE';
        $transport->restore();
        return "DataRestore";
    }

    public function forceDeleteTransport($id){
        
        Transport::onlyTrashed()->find($id)->forceDelete();
        // Account::find($id)->forceDelete();
        return "DeleteSuccess";
    }
}
