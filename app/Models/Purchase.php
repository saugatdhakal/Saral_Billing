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
}
