<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        return view('stock.index');
    }
     public function getIndexAjax(Request $request){
        // if($request->ajax()){
           $data = DB::table('stocks')
            ->join('purchase_items','purchase_items.id','=','stocks.purchase_item_id')
            ->join('products','products.id','=','purchase_items.product_id')
            ->select(['stocks.id','products.name as product_name','stocks.batch_number','stocks.product_shop_code','stocks.quantity','stocks.wholeSale_price','stocks.status'])
            ->get()
            ; 
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action',function($row){
                $actionBtn ='';
                if($row->status == 'ACTIVE'){
                $actionBtn.='
               <div class="form-check form-switch form-switch-md">
                <input class="form-check-input" type="checkbox" data-id="'.$row->id.'" id="statusSwitch" >
                
                </div>
                 &#160
                ';
                }else{
                   $actionBtn.='
               <div class="form-check form-switch form-switch-md">
                <input class="form-check-input" type="checkbox" data-id="'.$row->id.'" id="statusSwitch" checked>
                </div>
                 &#160
                '; 
                }
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
        // }
        // return view('suppliers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function statusSwitch($id)
    {
        $stock = Stock::find($id);
        if($stock->status == 'ACTIVE'){
            $stock->status = "INACTIVE";
        }else{
            $stock->status = 'ACTIVE';
        }
        $stock->save();
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
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function show(Stock $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stock $stock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
        //
    }
}
