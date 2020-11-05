<?php

namespace App\Http\Livewire\Service;

use App\Service;
use Livewire\Component;

class Index extends Component
{
    public $search;

    public function changeStatus(Service $serv)
    {
        $serv->published = !$serv->published ;
        $serv->save();
    }
    public function render()
    {
        $services = Service::where('title_ge', 'LIKE', '%'.$this->search.'%')->get();
        return view('livewire.service.index', compact('services'));
    }
}
