<?php

namespace App\Http\Controllers;

use App\Models\Suppliers;
use App\Models\SupplierLedger;
use Illuminate\Http\Request;
use App\Http\Requests\SupplierPaymentRequest;
use Illuminate\Support\Facades\DB;
use DataTables;

class SuppliersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('suppliers.index');

        
        // return view('suppliers.index',["suppliers"=>$suppliers]);
    }

    public function paymentView(){
        return view('suppliers.payment');
    }
    public function paymentStore(SupplierPaymentRequest $request){

        $supplier = DB::table('purchases')->where('id',$request->purchase_id)->get(['invoice_number'])->first();
        
         $old_supplierLedger = DB::table('supplier_ledgers')
         ->where('supplier_id',$request->supplier_id)
         ->get('balance')
         ->last();
        if ($old_supplierLedger->balance < $request->amount) {
            // return redirect()->back()->with('Error', 'Amount is Greater then Balance');
             return redirect()->back()->withFail(['Amount is Greater then Balance','Check your balance']);// can add multiple value on error
        }
        $ledger = new SupplierLedger();
        $ledger->date = $request->payment_date;
        $ledger->purchase_type = $request->pay_mode;
        $ledger->debit_amount = $request->amount;
        $ledger->credit_amount = 0;
        $ledger->balance= $old_supplierLedger->balance - $request->amount;
        $ledger->supplier_id = $request->supplier_id;
        $ledger->invoice_number = $supplier->invoice_number;
        $ledger->save();
        return redirect()->route('supplierLedger.index');
    }

    public function invoiceSearch($id){
       return DB::table('purchases')->where('id',$id)->get(['id','invoice_number','bill_date']);
    }

    public function getSuppliers(Request $request){
        // if($request->ajax()){
            $data = DB::table('suppliers')->where('deleted_by',NULL)->get(['id','name','address','contact_number','contact_person','email','remark']);
            
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action',function($row){
                $actionBtn =' 
                <a class="btnEdit" href="'.route('supplier.edit',["id"=>$row->id]).'" >
                <i class="far fa-edit fa-lg"></i> 
                </a>
                 &#160
                <a data-toggle="modal" class="viewSuppliers" id="'.$row->id.'"  data-target="#modal">
                 <i class="far fa-eye fa-lg"></i>
                </a>
                &#160
                <a  class="deleteSupplier" id="'.$row->id.'">
                <i class="fas fa-trash-alt fa-lg"></i>
                </a>
                ';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
        // }
        // return view('suppliers.index');
    }

    public function getTrash(Request $request){
        // if($request->ajax()){
            $data = DB::table('suppliers')->whereNotNull('deleted_by')->get(['id','name','address','contact_number','contact_person','email','remark']);
            
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action',function($row){
                $actionBtn =' 
                <a class="btnEdit" href="'.route('supplier.edit',["id"=>$row->id]).'" >
                <i class="far fa-edit fa-lg"></i> 
                </a>
                 &#160
                 <a class="restoreTrash" id="'.$row->id.'">
                 <i class="fas fa-undo-alt fa-lg"></i>
                </a>
                &#160
                <a class="deleteSupplier" id="'.$row->id.'">
                    <i class="fas fa-trash-alt fa-lg"></i>
                </a>
                ';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
        // }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      
        return view('suppliers.create');
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $suppliers = new Suppliers();
        $suppliers->name= $request->supplier_name;
        $suppliers->address= $request->address;
        $suppliers->contact_person = empty($request->contact_person_name)? null:$request->contact_person_name;
        $suppliers->email= empty($request->email)? null: $request->email;
        $suppliers->contact_number = empty($request->contact_number)? null: $request->contact_number;
        $suppliers->remark = empty($request->remark)? null: $request->remark;
        $suppliers->save();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function trash(Suppliers $suppliers)
    {
        return view('suppliers.trash');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $suppliers = DB::table('suppliers')->select('id','name',
        'address',
        'contact_number',
        'contact_person',
        'email',
        'remark',)->find($id);
        return view('suppliers.edit',['suppliers'=>$suppliers]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $suppliers = Suppliers::find($id);

        $suppliers->name = $request->supplier_name;

        $suppliers->address = $request->address;

        $suppliers->contact_number = empty($request->contact_number)? null:$request->contact_number;

        $suppliers->contact_person = empty($request->contact_person_name)?  null: $request->contact_person_name;

        $suppliers->remark= empty($request->remark)?null:$request->remark;
        
        $suppliers-> save();

        return redirect()->route('supplier.index');
    }

    public function view($id){  
        $suppliers= Suppliers::with('creator','editor')
        ->where('id',$id)
        ->get(['name','address','contact_number','email','contact_person','remark','created_by','updated_by'])
        ->first();
        // $suppliers = DB::table('suppliers')->select('name','address','contact_number','email','contact_person','remark')->find($id);
        return $suppliers;  
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $suppliers = Suppliers::find($id);
        $suppliers->status = 'INACTIVE';
        $suppliers->delete();
        return "DeleteSuccess";
    }

    public function restoreSupplier($id){
        $suppliers = Suppliers::withTrashed()->find($id);
        $suppliers->status = 'ACTIVE';
        $suppliers->restore();
        return "DataRestore";
    }
    public function trashSupplier($id){
        Suppliers::onlyTrashed()->find($id)->forceDelete();
        // Account::find($id)->forceDelete();
        return "DeleteSuccess";
    }
}
