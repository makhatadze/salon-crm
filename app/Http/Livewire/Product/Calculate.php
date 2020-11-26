<?php

namespace App\Http\Livewire\Product;

use App\ProductInventory;
use Livewire\Component;

class Calculate extends Component
{
    public $product;
    public $amout = 0;
    public $error = '';
    public function mount($product)
    {
        $this->$product = $product;
        $this->amout = 0;
    }
    public function addproductinventory()
    {
        if (intval($this->amout) < 0) {
            $this->error = __('product.notlessthenzero');
            return;
        }elseif($this->product->productinventory()->where('status', '=', 0)->count() > 0){
            $this->error = __('product.notcomplated');
            return;
        }else{
            $this->product->productinventory()->create([
                'old' => $this->product->stock,
                'real' => $this->amout,
            ]);
        }
    }
    public function deleteinventory(ProductInventory $inventory)
    {
        if ($inventory->status == 0) {
            $inventory->delete();
        }
    }
    public function approveinventory(ProductInventory $inventory)
    {
        if ($inventory->status == 0) {
            $inventory->status = 1;
            $inventory->save();
            $product = $inventory->product;
            $product->stock = $inventory->real;
            $product->save();
        }
       
    }
    public function render()
    {
        $unit = "";
        if ($this->product->unit == "gram"){
            $unit = __('product.gram');
        }elseif ($this->product->unit == "metre"){
            $unit = __('product.centimetr');
        }elseif ($this->product->unit == "unit"){
                $unit = __('product.unit');
        }
        $message = __('product.willleft').' '.($this->product->stock - ($this->amout ? intval($this->amout) : 0)).' '.$unit; 
        $inventories = $this->product->productinventory()->orderBy('id', 'desc')->get();
        return view('livewire.product.calculate', compact('message', 'inventories'));
    }
}
