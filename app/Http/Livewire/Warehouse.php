<?php

namespace App\Http\Livewire;

use App\Product;
use App\Department;
use App\Storage;
use App\User;

use Livewire\Component;
use Livewire\WithPagination;

class Warehouse extends Component
{
    use WithPagination;
    //Filter
    public $name;
    public $storage;
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
    
    public $storagename;
    
    //Initialize
    public function mount(){
        $this->pricefrom = Product::min('buy_price')/100;
        $this->pricetill = Product::max('buy_price')/100;
        $this->amout = Product::max('stock');
    }

    // Product Delete
    public function delete($id){
        Product::findOrFail($id)->delete();
    }
    public function addstorage()
    {
        Storage::create([
            'name' => $this->storagename
        ]);
        $this->storagename = "";
    }
    //Update
    public function updatedTypeamout(){
        $product =  Product::findOrFail($this->updateId);
        $this->error = "";
        if($this->typeamout > $product->stock){
            $this->error = "არჩეული რაოდენობა მეტია პროდუქტის რაოდენობაზე!";
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
            ['storage_id', 'like', '%'.$this->storage.'%'],
            ['writedown', 0]])
        ->whereBetween('buy_price', [$this->pricefrom*100 != "" ? $this->pricefrom*100 : 1, $this->pricetill != "" ? $this->pricetill*100 : 1])
        ->paginate(15);
        $departments = Department::all();
        $storages = Storage::all();
        $users = User::Permission('admin', 'user')->get();
        return view('livewire.warehouse', compact('products', 'storages', 'departments', 'users'));
    }
}
