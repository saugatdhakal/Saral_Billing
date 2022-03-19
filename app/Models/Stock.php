<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $fillable=[
        'batch_number',
        'product_shop_code',
        'quantity',
        'wholeSale_price',
        'purchase_item_id',
        'status'
    ];
    
}
