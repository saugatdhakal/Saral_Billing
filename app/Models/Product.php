<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;
use Illuminate\Support\Facades\DB;
class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Userstamps;
    protected $datas=['deleted_at'];
    protected $fillable=[
        'product_code',
        'name',
        'unit',
        'category'
    ];
    public static function generateUniqueNumber()
    {
        do {
            $code = random_int(100000, 999999);
        } while (Product::where("product_code", "=", $code)->first());
  
        return $code;
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public static function isCodeUniqueCheck($requestCode)
    {
        $code= DB::table('products')->select('product_code')->where('product_code','=',$requestCode)->get()->first();
        //If db doesnot find duilicate code
        if($code == ''){
            $code='0';
            return true; 
        }
        else{
              return false;
        } 
    }
}
