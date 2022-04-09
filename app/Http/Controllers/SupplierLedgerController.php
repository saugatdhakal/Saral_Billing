<?php

namespace App\Http\Controllers;

use App\Models\SupplierLedger;
use App\Models\Purchase;

use Illuminate\Http\Request;
use DataTables;
use PDF;
use Illuminate\Support\Facades\DB;

class SupplierLedgerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $supplier= SupplierLedger::getSuppliers();

       return view('supplierLedger.index',
        [
            'supplier'=>$supplier,
            'supplierDetails'=>null,
            'supplierLedger'=>null,
            'drAmount'=>null,
            'crAmount'=>null,
            'purchases'=>null
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchLedger(Request $request)
    {
        $request->validate(
            [
                'supplier_id'=>'required'
            ]
        );
        $purchases= Purchase::where('supplier_id',$request->supplier_id)->with('items.product')->get();
        // return $purchases;
        $supplier= SupplierLedger::getSuppliers();
        $searchedSupplier = DB::table('suppliers')->where('id',$request->supplier_id)
        ->get(['id','name','contact_number','email'])->first();
        $supplierLedger=null;
        if(empty($request->fromDate) && empty($request->toDate)){
            $supplierLedger = DB::table('supplier_ledgers')->where('supplier_id',$request->supplier_id)
        ->get(['date','purchase_type','invoice_number','debit_amount','credit_amount','balance','purchase_id']);
        }
        else{
           $supplierLedger = DB::table('supplier_ledgers')
           ->where('supplier_id',$request->supplier_id)
           ->whereBetween('date',[$request->fromDate,$request->toDate])
            ->get(['date','purchase_type','invoice_number','debit_amount','credit_amount','balance','purchase_id']);
        }
        
        $drAmount =$supplierLedger->sum('debit_amount');
        $crAmount =$supplierLedger->sum('credit_amount');

        return view('supplierLedger.index',
        [
            'supplier'=>$supplier,
            'supplierDetails'=>$searchedSupplier,
            'supplierLedger'=>$supplierLedger,
            'drAmount'=>$drAmount,
            'crAmount'=>$crAmount,
            'purchases'=>$purchases
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SupplierLedger  $supplierLedger
     * @return \Illuminate\Http\Response
     */
    public function show(SupplierLedger $supplierLedger)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SupplierLedger  $supplierLedger
     * @return \Illuminate\Http\Response
     */
    public function edit(SupplierLedger $supplierLedger)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SupplierLedger  $supplierLedger
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SupplierLedger $supplierLedger)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SupplierLedger  $supplierLedger
     * @return \Illuminate\Http\Response
     */
    public function destroy(SupplierLedger $supplierLedger)
    {
        //
    }
}
