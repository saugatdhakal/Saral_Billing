<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Suppliers extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Userstamps;

    protected $datas=['deleted_at'];

    protected $fillable=[
        'name',
        'address',
        'contact_number',
        'contact_person',
        'email',
        'remark',
    ];

    
}
