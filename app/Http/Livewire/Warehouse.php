<?php

namespace App\Http\Livewire;

use App\Product;
use App\Department;
use App\Storage;
use App\User;

use Carbon\Carbon;
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
    public $datefrom;
    public $datetill;
    //Update ID
    public $typeamout;
    public $error;
    public $maxunit;
    public $minprice;
    public $isUnit = false;
    public $updateId;
    public $modalState = false;

    public $storagename;
    
    //Initialize
    public function mount()
    {
        $this->pricefrom = Product::min('buy_price') / 100;
        $this->pricetill = Product::max('buy_price') / 100;
        $this->amout = Product::max('stock');
        $this->datefrom = Carbon::parse(Product::min('created_at'))->isoFormat('Y-MM-DD');
        $this->datetill = Carbon::parse(Product::max('created_at'))->isoFormat('Y-MM-DD');
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
            $this->error = __('warehouse.warning');
        }
    }
    public function update(Product $product)
    {
        $this->modalState = true;
        $this->updateId = $product->id;
        $this->isUnit = false;
        $this->maxunit = $product->stock;
        $this->minprice = ($product->unit == "gram") ? $product->buy_price/$product->gramunit : $product->buy_price;
        if($product->type == 1){
            $this->isUnit = true;
        }
    
    }
    public function render()
    {
        $dateTill = Carbon::parse($this->datetill)->addDay();
        $dateFrom = Carbon::parse($this->datefrom)->addDay(-1);

        $products = Product::where([
            ['created_at', '>=', $dateFrom],
            ['created_at', '<=', $dateTill],
            ['warehouse', true],
            ['title_ge', 'LIKE', '%' . $this->name . '%'],
            ['unit', 'LIKE', '%' . $this->unit . '%'],
            ['stock', '<=', floatval($this->amout)],
            ['storage_id', 'like', '%' . $this->storage . '%'],
            ['writedown', true]])
            ->whereBetween('buy_price', [$this->pricefrom * 100 != "" ? $this->pricefrom * 100 : 1, $this->pricetill != "" ? $this->pricetill * 100 : 1])
            ->orderBy('updated_at', 'DESC')
            ->paginate(15);
            $departments = Department::all();
            $storages = Storage::all();
            $users = User::Permission('admin', 'user')->get();
            return view('livewire.warehouse', compact('products', 'storages', 'departments', 'users'));
    }
}
