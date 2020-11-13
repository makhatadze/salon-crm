<?php

namespace App\Http\Livewire\Distributor;

use App\DistributionCompany;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $search;
    public function render()
    {
        $distcompanies = DistributionCompany::where('name_ge', 'LIKE', '%'.$this->search.'%')
                        ->paginate(25);
        return view('livewire.distributor.index', compact('distcompanies'));
    }
}
