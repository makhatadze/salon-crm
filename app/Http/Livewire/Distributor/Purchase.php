<?php

namespace App\Http\Livewire\Distributor;

use App\DistributionCompany;
use App\Purchase as AppPurchase;
use Livewire\Component;
use Livewire\WithPagination;

class Purchase extends Component
{
    use WithPagination;
    public $distributor;
    public $search;
    public $dept;
    public function mount($distributor)
    {
        $this->distributor = $distributor;
    }
    public function render()
    {
        $purchases = DistributionCompany::findOrFail(intval($this->distributor))
        ->purchases();
        if ($this->search) {
            $purchases = $purchases->where('overhead_number', 'like', '%'.$this->search.'%')
                                    ->orWhere('purchase_number', 'like', '%'.$this->search.'%');
        }
        if ($this->dept) {
            $deptids = array();
            foreach (AppPurchase::select('id', 'paid')->get() as $item) {
                if ($item->getPrice() != $item->paid) {
                    $deptids[] = $item->id;
                }
            }
            $purchases = $purchases->whereIn('id', $deptids);
        }
        $purchases = $purchases->paginate(5);
        return view('livewire.distributor.purchase', compact('purchases'));
    }
}
