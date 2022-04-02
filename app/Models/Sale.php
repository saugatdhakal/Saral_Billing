<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;
class Sale extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Userstamps;
    protected $datas=['deleted_at'];
     protected $fillable=[
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

    public function storeSale($sale,$request){
        
        $sale->account_id = $request->accountId;
        $sale->transaction_date = getNepaliDate($request->transactionDate);
        $sale->sales_date = $request->saleDate;
        $sale->sales_type = $request->saleType;
        $sale->save();
    }

}
