<?php

namespace App\Http\Livewire\Client;

use App\PayController;
use Livewire\Component;

class Servicepay extends Component
{
    public $item;
    public function render()
    {
        $paymethods = PayController::all();
        return view('livewire.client.servicepay', compact('paymethods'));
    }
}
