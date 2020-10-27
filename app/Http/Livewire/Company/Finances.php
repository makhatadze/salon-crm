<?php

namespace App\Http\Livewire\Company;

use App\Client;
use App\SalaryToService;
use App\User;
use Livewire\Component;

class Finances extends Component
{
    // ფილტრი
    public $clientname;
    public $clientnumber;
    public $membername;
    public $pricefrom;
    public $pricetill;

    public function mount(){
        $this->pricefrom = SalaryToService::min('service_price')/100;
        $this->pricetill = SalaryToService::max('service_price')/100;
    }
    public function render()
    {
        $finances = SalaryToService::all();
        
            return view('livewire.company.finances', compact('finances'));
    }
}