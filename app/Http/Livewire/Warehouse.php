<?php

namespace App\Http\Livewire;

use App\Product;
use App\Department;
use App\User;

use Livewire\Component;
use Livewire\WithPagination;

class Warehouse extends Component
{
    use WithPagination;
    //Filter
    public $name;
    public $category;
    public $pricefrom;
    public $pricetill;
    public $amout;
    public $unit;
    //Update ID
    public $typeamout;
    public $error;
    public $isUnit = false;
    public $updateId;
    public $modalState = false;
    
    //Initialize
    public function mount(){
        $this->pricefrom = Product::min('price')/100;
        $this->pricetill = Product::max('price')/100;
        $this->amout = Product::max('stock');
    }

    // Product Delete
    public function delete($id){
        Product::findOrFail($id)->delete();
    }
    //Update
    public function updatedTypeamout(){
        $product =  Product::findOrFail($this->updateId);
        $this->error = "";
        if($this->typeamout > $product->stock){
            $this->error = "არჩეული რაოდენობა მეტია პროდუქტის!";
        }
    }
    public function update(Product $product)
    {
        $this->modalState = true;
        $this->updateId = $product->id;
        $this->isUnit = false;
        if($product->type == 1){
            $this->isUnit = true;
        }
    
    }
    public function render()
    {
        $products = Product::where([
            ['warehouse', true], 
            ['title_'.app()->getLocale(), 'LIKE', '%'.$this->name.'%'], 
            ['unit', 'LIKE', '%'.$this->unit.'%'], 
            ['stock', '<=', floatval($this->amout)], 
            ['category_id', 'like', '%'.$this->category.'%']])
        ->whereBetween('price', [$this->pricefrom*100, $this->pricetill*100])
        ->paginate(15);
        $departments = Department::all();
        $users = User::role('user')->get();
        return view('livewire.warehouse', compact('products', 'departments', 'users'));
    }
}
