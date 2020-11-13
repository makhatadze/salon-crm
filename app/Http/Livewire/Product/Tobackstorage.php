<?php

namespace App\Http\Livewire\Product;

use App\StorageHistory;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Tobackstorage extends Component
{
    public $product;

    public $takefromstorage;
    public $backtostorage;

    public function takefromstorage()
    {
        if (floatval($this->takefromstorage) > 0 & $this->product->parent->product->stock >= floatval($this->takefromstorage)) {
            $parent = $this->product->parent->product;
            $parent->stock = $parent->stock - floatval($this->takefromstorage);
            $thisproduct = $this->product;
            $thisproduct->stock = $thisproduct->stock + floatval($this->takefromstorage);
            if ($parent->stock == 0) {
                $parent->writedown = 0;
            }
            $thisproduct->save();
            $parent->save();
            StorageHistory::create([
                'storage_id' => $this->product->storage_id,
                'stock' => floatval($this->takefromstorage),
                'user_id' => Auth::user()->id,
                'department_id' => $this->product->department_id,
                'product_id' => $this->product->id,
                'price' => $this->product->sell_price*100,
                'description' => 'takefromstorage'
            ]);
        }
        $this->takefromstorage = null;
       
    }
    public function backtostorage()
    {
        
        if (floatval($this->backtostorage) > 0 & $this->product->stock >= floatval($this->backtostorage)) {
            $parent = $this->product->parent->product;
            if ($parent->writedown == 0) {
                $parent->writedown = 1;
            }
            $parent->stock = $parent->stock + floatval($this->backtostorage);
            $thisproduct = $this->product;
            $thisproduct->stock = $thisproduct->stock - floatval($this->backtostorage);
            $thisproduct->save();
            $parent->save();
            StorageHistory::create([
                'storage_id' => $this->product->storage_id,
                'stock' => floatval($this->backtostorage),
                'user_id' => Auth::user()->id,
                'department_id' => $this->product->department_id,
                'product_id' => $this->product->id,
                'price' => $this->product->sell_price*100,
                'description' => 'backtostorage'
            ]);
        }
        $this->backtostorage = null;
    }
    public function render()
    {
        return view('livewire.product.tobackstorage');
    }
}
