<?php

namespace App\Http\Livewire\Product;

use Livewire\Component;

class Calculate extends Component
{
    public $product;
    public $amout;
    public function mount($product)
    {
        $this->$product = $product;
        $this->amout = 1;
    }

    public function render()
    {
        $unit = "";
        if ($this->product->unit == "gram"){
            $unit = "გრამი";
        }elseif ($this->product->unit == "metre"){
            $unit = "მეტრი";
        }elseif ($this->product->unit == "unit"){
                $unit = "ცალი";
        }
        $message = "დარჩება ".($this->product->stock - ($this->amout ? intval($this->amout) : 1)).' '.$unit; 

        return view('livewire.product.calculate', compact('message'));
    }
}
