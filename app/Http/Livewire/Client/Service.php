<?php

namespace App\Http\Livewire\Client;

use App\Service as AppService;
use Livewire\Component;
use Livewire\WithPagination;

class Service extends Component
{
    use WithPagination;
    public $client;
    public $search;
    public $consignationserv;
    public function mount($client)
    {
        $this->client = $client;
    }


    public function render()
    {
        $clientservices = $this->client->clientservices()->where('status', 1);
        if ($this->search) {
            $services = AppService::select('id')->where('title_'.app()->getLocale(), 'LIKE', '%'.$this->search.'%')->get()->toArray();
            $clientservices = $clientservices->whereIn('id', $services);
        }
        if ($this->consignationserv) {
            $clientservices = $clientservices->whereColumn('new_price', '>', 'paid');
        }
        $clientservices = $clientservices->paginate(5);
        return view('livewire.client.service', compact('clientservices'));
    }
}
