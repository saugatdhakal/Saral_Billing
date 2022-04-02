<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Http\Requests\SaleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Config;


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
        ->get();

        $saleItems = DB::table('sale_items')
        ->where('sale_items.sales_id',$id)
        ->join('products','products.id','=','sale_items.product_id')
        ->select(['sale_items.id','products.unit','products.name','sale_items.quantity','sale_items.rate','sale_items.amount','sale_items.discount_amount'])
        ->get();
        return view('Sale.salesItem',compact('sales','product','saleItems'));
    }

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
        //
    }
}
