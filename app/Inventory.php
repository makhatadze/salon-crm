<?php

namespace App;
use App\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Inventory extends Model
{
    use SoftDeletes;
    protected $fillable = ['product_id', 'quantity'];
    protected $table = 'inventories';
    public function inventoriable(){
        return $this->morphTo();
    }
    public function getProductUnit(){
        $unit = Product::find($this->product_id)->first();
        if($unit){
            if($unit == "unit"){
                return "ერთეული";
            }elseif($unit == "gram"){
                return "გრამი";
            }else if($unit == "metre"){
                return "მეტრი";
            }
            return;
        }
        return;
    }
}
