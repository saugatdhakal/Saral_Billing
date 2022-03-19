<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Purchase extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Userstamps;
    public $timestamps = false;
    protected $datas=['deleted_at'];
    protected $fillable=[
        'invoice_number',
        'transaction_date',
        'bill_date',
        'bill_no',
        'lr_no',
        'purchase_date',
        'gts',
        'total_amount',
        'discount_amount',
        'extra_charges',
        'rounding',
        'net_amount',
        'purchase_type',
        'remark',
        'status'

    ];
     public function items()
    {
        return $this->hasMany(PurchaseItem::class);
    }
     public function supplier()
    {
        return $this->belongsTo(Suppliers::class);
    }
    public function invoiceData($id){
        return Purchase::where('id',$id)
        ->with([
        'supplier' => function ($supp) {
            $supp->select('id','name','address','contact_number');
        },
        'items' => function ($query) {
              $query->select('product_id','id','purchase_id','quantity','rate','amount','discount_percent','discount_amount','wholesale_price');     
        },
         'items.stock',
        'items.product' => function ($prod) {
             $prod->select('id','name','product_code','unit');
        },
        ])
        ->first();
    }
}
