<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SaleItem;
use App\Models\Sale;
use App\Models\Cheque;
use App\Models\Stock;
use App\Http\Requests\SaleItemRequest;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;


class SaleItemController extends Controller
{
    public function store(SaleItemRequest $request,$id){
        $saleItem = new SaleItem();
        \DB::transaction(function()use($saleItem,$request,$id){
            $saleItem->storeUpdate($saleItem,$request,$id);
            $stock = Stock::where('id',$request->stockId)->get(['id','quantity'])->first();
            $stock->quantity = $stock->quantity - $request->quantity;
            $stock->save();
        });
        Toastr::success('hello','msg');
        return redirect()->back();
    }

    public function updateSalesItem(SaleItemRequest $request)
    {
        $saleItem = SaleItem::find($request->id);
        $stock = Stock::where('id',$request->stockId)->get(['id','quantity'])->first();
         \DB::transaction(function()use($saleItem,$request,$stock){
            $stock = Stock::where('id',$request->stockId)->get(['id','quantity'])->first();
            $quantityOriginal = $stock->quantity + $saleItem->quantity; // ? Retutn to original quantity of stock
            $stock->quantity = $quantityOriginal - $request->quantity;
            $stock->save();
            $saleItem->storeUpdate($saleItem,$request,$saleItem->sales_id);
         });
        return back();
    } 

    public function deleteSaleItem($id){
    \DB::transaction(function()use($id){
      $saleItem = SaleItem::find($id);
      $stock = Stock::where('id',$saleItem->stock_id)->get(['id','quantity'])->first();
      $stock->quantity = $stock->quantity + $saleItem->quantity;
      $stock->save();
      $saleItem->delete();
    });
    
   }

    public function stockSelect($id){
       return  DB::table('stocks')
        ->where('stocks.status','ACTIVE')
        ->join('purchase_items','purchase_items.id','=','stocks.purchase_item_id')
        ->where('purchase_items.product_id',$id)
        ->select(['stocks.id as stock_id','purchase_items.id as product_id','stocks.batch_number','stocks.quantity','stocks.wholesale_price'])
        ->get();
    }

    public function stockEdit($id){
        return DB::table('sale_items')
        ->where('sale_items.id',$id)
        ->get(['id','stock_id','rate','quantity','product_id','discount_amount'])->first();
        
    }
    public function completeSales(Request $request,$id){
        SaleItem::completeSalesInvoice($request,$id);
        
        return redirect()->route('sale.index');
    }
}
