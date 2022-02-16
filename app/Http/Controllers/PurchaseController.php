<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PurchaseValidateRequest;
use DataTables;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        return view('Purchase.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
       $purchaseInvoice = getPurchaseInvoice(); //number
        return view('purchase.create',compact('purchaseInvoice'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PurchaseValidateRequest $request)
    {   
        //  $request->validate([
        // 'billNo' => 'required',
        // 'billDate'=> 'required',
        // 'transactionDate'=>'required',
        // 'purchaseDate'=> 'required',
        // 'lrNo'=> 'required',
        // ]); 
         $request->validated(); // validating with request form 

       $fiscal=getFiscalYear();
       $purchase = new Purchase();
       $purchase->invoice_number = getPurchaseInvoice();//Helper
       $purchase->fiscal_year = '0'.$fiscal[0].'/'.'0'.$fiscal[1];
       $purchase->transaction_date = $request->transactionDate;
       $purchase->bill_date = $request->billDate;
       $purchase->purchase_date = $request->purchaseDate;
       $purchase->lr_no= $request->lrNo;
       $purchase->bill_no = $request->billNo;
       $purchase->supplier_id = $request->supplierId;
       $purchase->save();  

       $config = Config::get()->first();
       $config->purchase_bill_number = $config->purchase_bill_number + 1;
       $config->save();
       return redirect()->route('purchase.purchaseOrderView',['id' => $purchase->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        //
    }


    public function purchaseOrderView($id){
       
        
        $purchase = DB::table('purchases')
        ->where('purchases.deleted_by','=',NULL)
        ->where('purchases.id', $id)
        ->join('suppliers','purchases.supplier_id','=','suppliers.id')
        ->select('purchases.id as purchase_id','purchases.invoice_number','purchases.transaction_date','purchases.bill_date','purchases.purchase_date','purchases.lr_no','purchases.bill_no','suppliers.id as supplier_id','suppliers.name as supplier_name','suppliers.address')
        ->get()->first();

        $product = DB::table('products')->where('products.deleted_by','=',NULL)->get(['id','name','unit','product_code']);

        $list = DB::table('purchase_items')
        ->where('purchase_items.purchase_id',$id)
        ->join('products','purchase_items.product_id','=','products.id')
        ->select('purchase_items.id','products.product_code','products.name','products.unit','purchase_items.quantity','purchase_items.rate','purchase_items.amount','purchase_items.wholesale_price','purchase_items.margin_total')
        ->get();

        $totalAmount = DB::table('purchase_items')
        ->where('purchase_items.purchase_id',$id)
        ->sum('purchase_items.amount' );

        return view('purchase.purchaseOrder',['data'=>$purchase,'product'=>$product,'list'=>$list,'total'=>$totalAmount]);
    }






}
