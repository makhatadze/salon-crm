<?php

namespace App\Http\Livewire;

use App\Brand as AppBrand;
use Livewire\Component;
use Livewire\WithPagination;

class Brand extends Component
{
    use WithPagination;
    // Filter
    public $search;

    public function render()
    {
        $brands = AppBrand::where('name', 'like', '%'.$this->search.'%')->paginate(30);
        return view('livewire.brand', compact('brands'));
    }
}
