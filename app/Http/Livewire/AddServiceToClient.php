<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AddServiceToClient extends Component
{
    // Client
    public $client_name;
    public $client_phone;
    public $client_sex;
    // Services
    public $service = array();
    public $personal = array();
    public $date = array();
    public $time = array();
    public $duration = array();
    public $price = array();
    
    public function render()
    {
        return view('livewire.add-service-to-client');
    }
}
