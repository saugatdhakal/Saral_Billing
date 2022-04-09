<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Http\Requests\SaleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Config;
use DataTables;
use PDF;
use Illuminate\Support\Facades\Storage;


class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        
        return view('sale.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $salesInvoice = getSalesInvoice(); 
        return view('sale.create',compact('salesInvoice'));
    }

    public function ajaxIndex(){
         $data =DB::table('sales')
         ->where('sales.deleted_by',NULL)
         ->join('accounts','sales.account_id','=','accounts.id')
         ->select(['sales.id','sales.invoice_number','sales.transaction_date','sales.sales_date','sales.net_amount','sales.sales_type','sales.paymode','accounts.name','sales.status'])
         ->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action',function($row){
                $actionBtn='';

                if ($row->status == 'RUNNING') {
                $actionBtn.=
                ' 
                    <a class="btnEdit" href="'.route('sales.salesItem',["id"=>$row->id]).'" >
                    <i class="fa-solid fa-money-check-pen fa-xl"></i>
                    </a>
                    &#160
                ';
                }
                else if ($row->status == 'COMPLETED') {
                $actionBtn.=
                ' 
                    <a class="btnComplete" href="'.route('sales.invoiceView',["id"=>$row->id]).'" >
                   <i class="fa-solid fa-file-invoice fa-xl"></i>
                    </a>
                    &#160
                ';
                }
                
                $actionBtn.=' 
                    <a data-toggle="modal" class="viewSale" id="'.$row->id.'"  data-target="#modal">
                        <i class="fa-solid fa-eye fa-xl"></i>
                    </a>
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
    public function invoiceView($id){

        $config = getConfig();
        $saleDetails = Sale::saleInvoiceData($id);
        $sale= $saleDetails[0];
        $saleItem = $saleDetails[1];
        return view('sale.invoiceLayout',compact('sale','config','saleItem'));
        
    }
     public function print($id){   
       $config = getConfig();    
         $saleDetails = Sale::saleInvoiceData($id);
        $sale= $saleDetails[0];
        $saleItem = $saleDetails[1];
        return view('salesInvoice.export',compact('sale','config','saleItem'));
    }
     public function domPdf($id)
    {
        $config = getConfig();    
        $saleDetails = Sale::saleInvoiceData($id);
        $sale= $saleDetails[0];
        $saleItem = $saleDetails[1];
        $pdf = PDF::loadView('salesInvoice.pdf', compact('sale','config','saleItem'));
        $pdf->setPaper('A3', 'landscape'); 
         return $pdf->stream();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaleRequest $request)
    {
        $fiscal=getFiscalYear();
        $sale = new Sale();
        
        \DB::transaction(function()use($request,$fiscal,$sale){
        $sale->fiscal_year = '0'.$fiscal[0].'/'.'0'.$fiscal[1];
        $sale->invoice_number =getSalesInvoice();   
        $sale->storeSale($sale,$request);
        $config = Config::get()->first();
        $config->sales_bill_number = $config->sales_bill_number + 1;
        $config->save();
        });
       
        
        return redirect()->route('sales.salesItem',['id'=>$sale->id]);
    }
    public function moduleView($id)
    {
        return DB::table('sales')
        ->where('sales.id',$id)
         ->join('accounts','sales.account_id','=','accounts.id')
         ->select([
         'sales.invoice_number',
         'sales.transaction_date',
         'sales.sales_date',
         'sales.invoice_number',
         'sales.total_amount',
         'sales.discount_amount',
         'sales.net_amount',
         'accounts.name',
         'sales.status',
         'sales.extra_charges',
         'sales.sales_type'
         ])
         ->get()->first(); 
    }

    /**
     * Display the specified resource.  
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function salesItem($id)
    {
        $sales = DB::table('sales')
        ->where('sales.id',$id)
        ->join('accounts', 'accounts.id','=','sales.account_id')
        ->select(['sales.id','accounts.name','accounts.home_address','accounts.shop_address','sales.transaction_date','sales.sales_date','sales.invoice_number'])
        ->get()->first();
        //Selecting product details from stocks
        $product = DB::table('stocks')
        ->join('purchase_items', 'purchase_items.id','=','stocks.purchase_item_id')
        ->join('products','products.id','=','purchase_items.product_id')
        ->select(['products.id','products.name','products.unit','products.product_code'])
        ->distinct() // ? Getting unique product from stocks
        ->get();

        $saleItems = DB::table('sale_items')
        ->where('sale_items.sales_id',$id)
        ->join('products','products.id','=','sale_items.product_id')
        ->select(['sale_items.id','products.unit','products.name','sale_items.quantity','sale_items.rate','sale_items.amount','sale_items.discount_amount'])
        ->get();
        return view('Sale.salesItem',compact('sales','product','saleItems'));
    }

    //  public function trashDelete($id)
    // {  
    //     try {
    //     Sale::find($id)->delete();
    //     return "DeleteSuccess";
    //     }
    //     catch (\Exception $e) {
    //        //! Not returning back with error message 
    //     //  return redirect()->back()->withFail(['Code Match with other product','Please use default code']);// can add multiple value on error
    //     }
    // }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        try {
         $sale->delete();
         return "DeleteSuccess";
         }
        catch (\Exception $e) 
        {
             //! Not returning back with error message 
            //  return redirect()->back()->withFail(['Code Match with other product','Please use default code']);// can add multiple value on error
        }
    }
        
}
