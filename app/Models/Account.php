<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Account extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Userstamps;
    protected $datas=['deleted_at'];
    protected $fillable=[
        'name',
        'home_address',
        'shoe_address',
        'contact_number_1',
        'contact_number_2',
        'email',
        'vat_number',
        'pan_number',
        'remark',
        'status',
    ];
}
