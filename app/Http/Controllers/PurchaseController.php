<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PurchaseValidateRequest;
use DataTables;
use PDF;


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
    public function ajaxIndex(){
         $data =DB::table('purchases')
         ->where('purchases.deleted_by',NULL)
         ->join('suppliers','purchases.supplier_id','=','suppliers.id')
         ->select(['purchases.id','purchases.invoice_number','purchases.transaction_date','purchases.bill_date','purchases.bill_no','purchases.lr_no','purchases.net_amount','suppliers.name','purchases.status'])
         ->get(); 
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action',function($row){
                $actionBtn='';

                if ($row->status == 'RUNNING') {
                $actionBtn.=
                ' 
                    <a class="btnEdit" href="'.route('purchase.purchaseOrderView',["id"=>$row->id]).'" >
                    <i class="fa-solid fa-money-check-pen fa-xl"></i>
                    </a>
                    &#160
                ';
                }
                else if ($row->status == 'COMPLETED') {
                $actionBtn.=
                ' 
                    <a class="btnComplete" href="'.route('purchase.invoice',["id"=>$row->id]).'" >
                   <i class="fa-solid fa-file-invoice fa-xl"></i>
                    </a>
                    &#160
                ';
                }
                
                $actionBtn.=' 
                    <a data-toggle="modal" class="viewSuppliers" id="'.$row->id.'"  data-target="#modal">
                        <i class="fa-solid fa-eye fa-xl"></i>
                    </a>
                    &#160
                    <a  class="deleteSupplier" id="'.$row->id.'">
                        <i class="fa-solid fa-trash-can-list fa-xl"></i>
                    </a>
                ';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            
            ->make(true);
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
       $fiscal=getFiscalYear();
       $purchase = new Purchase();
       $purchase->invoice_number = getPurchaseInvoice();//Helper
       $purchase->fiscal_year = '0'.$fiscal[0].'/'.'0'.$fiscal[1];
       $purchase->transaction_date = $request->transactionDate;
       $purchase->bill_date = $request->billDate;
       $purchase->lr_no= $request->lrNo;
       $purchase->bill_no = $request->billNo;
       $purchase->supplier_id = $request->supplierId;
       $purchase->save();  

       $config = Config::get()->first();
       $config->purchase_bill_number = $config->purchase_bill_number + 1;
       $config->save();
       return redirect()->route('purchase.purchaseOrderView',['id' => $purchase->id]);
    }

    public function invoice($id){
      
        $config = getConfig();    
        $obj = new Purchase();
        $purchase = $obj->invoiceData($id);
        
        return view('purchase.invoice2',['purchase'=>$purchase,'config'=>$config]);
    }

    public function print($id){   
       $config = getConfig();    
        $obj = new Purchase();
        $purchase = $obj->invoiceData($id);
        return view('invoice.export',['purchase'=>$purchase,'config'=>$config]);
    }
    public function pdf($id){ 

       $config = getConfig();    
        $obj = new Purchase();
        $purchase = $obj->invoiceData($id);

     
          
        $pdf = PDF::loadView('invoice.export', ['purchase'=>$purchase,'config'=>$config]);
    
        return $pdf->download('saral.pdf');
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
         
        // start_measure('render','Time for rendering');
        $purchase =   DB::table('purchases')
            ->where('purchases.deleted_by','=',NULL)
            ->where('purchases.id', $id)
            ->join('suppliers','purchases.supplier_id','=','suppliers.id')
            ->select('purchases.id as purchase_id','purchases.invoice_number','purchases.transaction_date','purchases.bill_date','purchases.lr_no','purchases.bill_no','suppliers.id as supplier_id','suppliers.name as supplier_name','suppliers.address')
            ->get()->first();
            
        $product = DB::table('products')->where('status','ACTIVE')->where('products.deleted_by','=',NULL)->get(['id','name','unit','product_code']);
        // Debugbar::startMeasure("Purchase Item DB");
       
        $list = DB::table('purchase_items')
        ->where('purchase_items.purchase_id',$id)
        ->join('products','purchase_items.product_id','=','products.id')
        ->select('purchase_items.id','products.product_code','products.name','products.unit','purchase_items.discount_percent','purchase_items.quantity','purchase_items.rate','purchase_items.amount','purchase_items.wholesale_price','purchase_items.margin_total','purchase_items.discount_amount')
        ->get();
    //   
    // stop_measure('render');

        return view('purchase.purchaseOrder',['data'=>$purchase,'product'=>$product,'list'=>$list]);
    }






}
