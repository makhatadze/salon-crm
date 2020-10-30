<?php

namespace App\Http\Livewire\Main;

use App\Client;
use App\ClientService;
use App\Product;
use App\SalaryToService;
use App\Sale;
use App\Service;
use Carbon\Carbon;
use Livewire\Component;

class Calculate extends Component
{
    public $totalclientsget;
    public $totalsalaryget;
    public $soldservicesget;
    public $totalproductcostget;
    public function render()
    {
        $totalproductcost = new Sale;
        if($this->totalproductcostget){
            if($this->totalproductcostget == "today"){
                $totalproductcost = $totalproductcost->whereDate('created_at', Carbon::today());
            }elseif($this->totalproductcostget == "month"){
                $totalproductcost = $totalproductcost->whereMonth('created_at', Carbon::now()->isoFormat('MM'));
            }
        }
        $totalproductcost = $totalproductcost->sum('paid')/100;
        $totalsalary = 0;
        // Total Salary
        $salaryservices = new SalaryToService;
        if ($this->totalsalaryget) {
            if($this->totalsalaryget == "today"){
                $salaryservices = $salaryservices->whereDate('created_at', Carbon::today());
            }elseif($this->totalsalaryget == "month"){
                $salaryservices = $salaryservices->whereMonth('created_at', Carbon::now()->isoFormat('MM'));
            }
        }
        $salaryservices = $salaryservices->get();
        foreach ($salaryservices as $item) {
            $totalsalary += $item->service_price * $item->percent/100;
        }
        // Total Clients
        $totalclients = ClientService::select('clinetserviceable_id')
                                    ->groupBy('clinetserviceable_id');
        if ($this->totalclientsget) {
            if($this->totalclientsget == "today"){
                $totalclients = $totalclients->whereDate('created_at', Carbon::today());
            }elseif($this->totalclientsget == "month"){
                $totalclients = $totalclients->whereMonth('created_at', Carbon::now()->isoFormat('MM'));
            }
        }
        
        $totalclients = $totalclients->count();
        // Sold Services
        $soldservices = ClientService::where('status', true);
        if ($this->soldservicesget) {
            if($this->soldservicesget == "today"){
                $soldservices = $soldservices->whereDate('created_at', Carbon::today());
            }elseif($this->soldservicesget == "month"){
                $soldservices = $soldservices->whereMonth('created_at', Carbon::now()->isoFormat('MM'));
            }
           
        }
        $soldservices = $soldservices->sum('new_price')/100;

        return view('livewire.main.calculate', compact('totalsalary', 'totalproductcost', 'totalclients', 'soldservices'));
    }
}
