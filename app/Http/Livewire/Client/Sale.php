<?php

namespace App\Http\Livewire\Client;

use Livewire\Component;
use Livewire\WithPagination;

class Sale extends Component
{
    use WithPagination;
    public $client;
    public $consignation;
    public function mount($client)
    {
        $this->client = $client;
    }

    public function render()
    {
        $sales = $this->client->sales();
            if ($this->consignation) {
                $sales = $sales->whereColumn('total', '>', 'paid');
            }
        $sales = $sales->paginate(5);
        return view('livewire.client.sale', compact('sales'));
    }
}
