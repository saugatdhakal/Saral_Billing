<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class SalesReturn extends Model
{
    protected $datas=['deleted_at'];
   
    protected $fillable=[
        'account_id',
        'transection_date',
        'sales_return_date',
        'invoice_number',
        'total_amount',
        'rounding',
        'net_amount',
    ];

    

    public function storeSaleReturn($saleReturn,$request,$account){
        $saleReturn->transaction_date = getNepaliDate($request->transactionDate);
        $saleReturn->sales_return_date = $request->saleReturnDate;
        $saleReturn->sales_id = $request->salesId;
        $saleReturn->account_id = $account->account_id;
        $saleReturn->save();
    }

    public static function storeSaleItem($request,$id){
        \DB::transaction(function()use($request,$id){
         $quantity=0;
        //* Getting stock_id of sale_items selected from select-input-field
       $saleItem = SaleItem::where('id',$request->saleItem_id)
       ->get(['id','stock_id','sales_return_id','rate','product_id'])->first();

       $stock = Stock::where('id',$saleItem->stock_id)
       ->get(['id','quantity'])
       ->first();

       //* Checking Input field Quantity is empty or not 
       if(empty($request->quantity)){
       $quantity = $stock->quantity;
       }else{
       $quantity = $request->quantity;
       }
       // ? Checking wheather input-field qunatity is greater then stock quantity
       if($quantity > $stock->quantity){
            return redirect()->back()->withFail(['Return Quantity Can Not Be Greater Then Purchase Quantity']);     
       }
       // *Increased Stock quantity
       $stock->quantity = $stock->quantity + $quantity;

       //? inserting sale return id into sale_item 
       $saleItem->sales_return_id = $id;
       $saleItem->sales_order_type = "RETURN";

       $stock->save();
       $saleItem->save();

       $salesReturnItems = new SalesReturnItems();
       $salesReturnItems->product_id = $saleItem->product_id;
       $salesReturnItems->sales_returns_id =$id;
       $salesReturnItems->rate = $saleItem->rate;
       $salesReturnItems->quantity = $quantity; 
       $salesReturnItems->amount = $salesReturnItems->rate * $salesReturnItems->quantity;
       $salesReturnItems->stock_id = $stock->id;
       $salesReturnItems->sale_items_id =$saleItem->id;
       $salesReturnItems->save();
    });
    }

    public static function deleteOperation($id)
    {
        \DB::transaction(function()use($id){

            $returnItem = SalesReturnItems::
            where('id',$id)
            ->get()->first();

            $saleItems = SaleItem::where('id',$returnItem->sale_items_id)->get()->first();
            $saleItems->sales_return_id = null;
            $saleItems->save();
            
            $stock = Stock::
            where('id',$returnItem->stock_id)
            ->get(['id','quantity'])->first();
            
            $stock->quantity = $stock->quantity - $returnItem->quantity;

            $stock->save();
            $returnItem->delete();
        });
    }

}


