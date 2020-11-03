<?php

namespace App\Http\Livewire\Product;

use Livewire\Component;

class Writedown extends Component
{
    public $product;
    public function mount($product)
    {
        $this->product = $product;
    }
    public function statusturn()
    {
        if ($this->product->writedown == 1) {
            $this->product->writedown = 0;
        }else{
            $this->product->writedown = 1;
        }
        
        $this->product->save();
    }
    public function render()
    {
        return view('livewire.product.writedown');
    }
}
