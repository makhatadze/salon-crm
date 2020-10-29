<?php

namespace App\Http\Livewire;

use App\Department;
use App\Product;
use App\Profile;
use App\Storage;
use App\StorageHistory as AppStorageHistory;
use Carbon\Carbon;
use Livewire\Component;

class Storagehistory extends Component
{
    public $search;
    public $datefrom;
    public $datetill;
    public $date;
    public $pricefrom;
    public $pricetill;
    public function mount()
    {
        $this->datefrom = Carbon::parse(AppStorageHistory::min('created_at'))->isoFormat('DD-MM-Y');
        $this->datetill = Carbon::parse(AppStorageHistory::max('created_at'))->isoFormat('DD-MM-Y');
        $this->pricefrom = AppStorageHistory::min('price')/100;
        $this->pricetill = AppStorageHistory::max('price')/100;
    }
    public function render()
    {
        $histories = new AppStorageHistory;
        if ($this->search != '') {
            $products = Product::select('id')->where('title_'.app()->getLocale(), 'like', '%'.$this->search.'%')->get()->toArray();
            $storages = Storage::select('id')->where('name', 'like', '%'.$this->search.'%')->get()->toArray();
            $profiles = Profile::select('profileable_id')
                            ->where('first_name', 'like', '%'.$this->search.'%')
                            ->orWhere('last_name', 'like', '%'.$this->search.'%')
                            ->get()->toArray();
            $departments = Department::select('id')->where('name_'.app()->getLocale(), 'like', '%'.$this->search.'%')->get()->toArray();
            $histories = $histories->whereIn('product_id', $products)
                                    ->orWhereIn('storage_id', $storages)
                                    ->orWhereIn('user_id', $profiles)
                                    ->orWhereIn('department_id', $departments);
        }
        if ($this->pricefrom) {
            $histories = $histories->where('price', '>=', $this->pricefrom*100);
        }
        if ($this->pricetill) {
            $histories = $histories->where('price', '<=', $this->pricetill*100);
        }
        if ($this->datefrom) {
            $histories = $histories->whereDate('created_at', '>=', Carbon::parse($this->datefrom));
        }
        if ($this->datetill) {
            $histories = $histories->whereDate('created_at', '<=', Carbon::parse($this->datetill));
        }
        $histories = $histories->paginate(30);
        return view('livewire.storagehistory', compact('histories'));
    }
}
