<?php

namespace App\Http\Livewire\Product;

use App\Brand;
use App\Category;
use App\Department;
use App\Product;
use App\Storage;
use App\SubCategory;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $name = null;
    public $pricefrom = null;
    public $pricetill = null;
    public $stocktill = null;
    public $brand = '';
    public $storage = null;
    public $department = null;
    public $brandarray = array();

    public function mount()
    {

        $this->name = '';
        $this->pricefrom = Product::min('price')/100;
        $this->pricetill = Product::max('price')/100;
        $this->stocktill = Product::max('stock');
    }
    public function render()
    {
        if(request('getbrand')){
            $this->brandarray[] = intval(request('getbrand'));
        }else if(request('getsubcat')){
            foreach (SubCategory::findOrFail(intval(request('getsubcat')))->brands()->select('id')->get() as $item) {
                $this->brandarray[] = $item->id;
            }
        }else if(request('getcat')){
            foreach (Category::findOrFail(intval(request('getcat')))->subcategories as $subcat) {
                foreach ($subcat->brands()->select('id')->get() as $item) {
                    $this->brandarray[] = $item->id;
                }
            }
        }
        $products = Product::where('warehouse', 0)
                    ->where('title_ge', 'LIKE', '%'.$this->name.'%')
                    ->where('price', '>=', $this->pricefrom ? $this->pricefrom*100 : 0)
                    ->where('price', '<=', $this->pricetill ? $this->pricetill*100 : 0)
                    ->where('stock', '<=', $this->stocktill ?? 0)
                    ->where('brand_id', 'LIKE', '%'.$this->brand.'%')
                    ->where('storage_id', 'LIKE', '%'.$this->storage.'%');
                    if ($this->department) {
                        $products = $products->where('department_id', $this->department);
                    }
                    if (request('getbrand') || request('getsubcat') || request('getcat')) {
                        $products = $products->whereIn('brand_id', $this->brandarray);
                    }
                    
                    $products = $products->paginate(30);
                    $brands = Brand::all();
                    $storages = Storage::all();
                    $departments = Department::all();
        return view('livewire.product.index', compact('brands', 'products', 'departments', 'storages'));
    }
}
