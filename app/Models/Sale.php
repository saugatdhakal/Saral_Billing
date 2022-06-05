<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Wildside\Userstamps\Userstamps;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
class Sale extends Model
{
    use HasFactory,LogsActivity;
    use SoftDeletes;
    use Userstamps;
    protected $datas=['deleted_at'];
     protected $fillable=[
        'created_by',
        'updated_by',
        'account_id',
        'transection_date',
        'sales_date',
        'invoice_number',
        'total_amount',
        'discount_amount',
        'extra_charges',
        'rounding',
        'net_amount',
    ];
     public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->useLogName('sales')
        ->logOnly(['invoice_number', 'sales_date', 'createBy.name']);
        // Chain fluent methods for configuration options
    }

   public function createBy()
    {
        return $this->belongsTo(User::class,'created_by');
    }
    public function updatedBy()
    {
        return $this->belongsTo(User::class,'updated_by');
    }
     public function Saleitems()
    {
        return $this->hasMany(SaleItem::class,'sales_id');
    }

    public function storeSale($sale,$request){
        
        $sale->account_id = $request->accountId;
        $sale->transaction_date = getNepaliDate($request->transactionDate);
        $sale->sales_date = $request->saleDate;
        $sale->save();
    }

    public static function saleInvoiceData($id){
         $sale = DB::table('sales')
        ->where('sales.id',$id)
        ->join('accounts','accounts.id','=','sales.account_id')
        ->get(['sales.id','sales.sales_date','sales.transaction_date','sales.invoice_number','accounts.name','accounts.home_address','sales.sales_type',
        'sales.printed_by','sales.total_amount','sales.discount_amount','sales.rounding','sales.extra_charges','sales.net_amount'])
        ->first();

        $saleItem =DB::table('sale_items')
        ->where('sale_items.sales_id',$id)
        ->join('products','products.id','=','sale_items.product_id')
        ->join('stocks','stocks.id','=','sale_items.stock_id')
        ->select(['products.name','products.product_code','products.unit','stocks.batch_number','sale_items.quantity','sale_items.rate','sale_items.amount','sale_items.discount_amount'])
        ->get();

        return [$sale,$saleItem];
    }


}
