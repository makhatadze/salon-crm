<?php

namespace App\Http\Livewire\Product;

use App\Brand;
use App\Product;
use Livewire\Component;

class Index extends Component
{
    public $name;
    public $pricefrom;
    public $pricetill;
    public $stocktill;
    public $brand;
    public $unit;
    public function mount()
    {
        $this->name = '';
        $this->pricefrom = Product::min('price')/100;
        $this->pricetill = Product::max('price')/100;
        $this->stocktill = Product::max('stock');
    }
    public function render()
    {
        $products = Product::where('warehouse', 0)
                    ->where('title_'.app()->getLocale(), 'LIKE', '%'.$this->name.'%')
                    ->where('price', '>=', $this->pricefrom*100)
                    ->where('price', '<=', $this->pricetill*100)
                    ->where('brand_id', 'like', '%'.$this->brand.'%')
                    ->where('unit', 'LIKE', '%'.$this->unit.'%')
                    ->paginate(30);
        $brands = Brand::all();
        return view('livewire.product.index', compact('brands', 'products'));
    }
}
