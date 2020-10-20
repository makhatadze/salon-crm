<?php

namespace App;
use App\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
class Inventory extends Model implements Auditable
{
    use SoftDeletes, \OwenIt\Auditing\Auditable;
    protected $fillable = ['category_id',];
    protected $table = 'inventories';
    public function inventoriable(){
        return $this->morphTo();
    }
    //ინვენტარებში პროდუქტის 
    public function getProductUnit(){
        $unit = Product::find($this->product_id)->first();
        if($unit){
            if($unit == "unit"){
                return "ერთეული";
            }elseif($unit == "gram"){
                return "გრამი";
            }else if($unit == "metre"){
                return "სანტიმეტრი";
            }
            return;
        }
        return;
    }
}
