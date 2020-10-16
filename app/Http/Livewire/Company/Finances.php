<?php

namespace App\Http\Livewire\Company;

use App\SalaryToService;
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
        $finances = SalaryToService::select(
            'salary_to_services.id',
            'salary_to_services.service_id',
            'salary_to_services.sale_id',
            'salary_to_services.percent',
            'salary_to_services.service_price',
            'clients.full_name_ge',
            'clients.full_name_ru',
            'clients.full_name_en',
            'clients.id as clientid',
            'clients.number',
            'sales.seller_id',
            'client_services.user_id',
            'client_services.pay_method as pay1',
            'sales.pay_method as pay2',
            'client_services.new_price',
            'profiles.first_name',
            'profiles.last_name',
            'profiles.profileable_id as getuser',

        )
            ->leftJoin('client_services', function($join) {
                $join->on('client_services.id','=','salary_to_services.service_id');
        })->leftJoin('sales', function($join_second){
            $join_second->on('sales.id', '=', 'salary_to_services.sale_id');
        })->join('clients', function($three_join){
            $three_join->on('clients.id', '=', 'sales.client_id');
            $three_join->orOn('clients.id', '=','client_services.clinetserviceable_id');
        })->join('profiles', function($four_join){
            $four_join->orOn('profiles.profileable_id', '=', 'sales.seller_id');
            $four_join->orOn('profiles.profileable_id', '=','client_services.user_id');
        })
        ->where('clients.full_name_ge', 'like', '%'.$this->clientname.'%')
        ->orWhere('clients.full_name_ru', 'like', '%'.$this->clientname.'%')
        ->orWhere('clients.full_name_en', 'like', '%'.$this->clientname.'%')
        ->orWhere('profiles.first_name', 'like', '%'.$this->membername.'%')
        ->whereBetween('salary_to_services.service_price', [$this->pricefrom != "" ? $this->pricefrom*100 : 1, $this->pricetill != "" ? $this->pricetill*100 : 1])
        ->get();
        
            return view('livewire.company.finances', compact('finances'));
    }
}
