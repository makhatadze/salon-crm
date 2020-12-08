<?php

namespace App\Http\Livewire\Company;

use App\Client;
use App\ClientService;
use App\Profile;
use App\SalaryToService;
use App\Sale;
use App\User;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Finances extends Component
{
    use WithPagination;
    // ფილტრი
    public $user;
    public $project;
    public $datefrom;
    public $datetill;
    public $totalclearearn;
    public $totalearn;
    public $totalsalary;
    public function mount()
    {
        $this->datefrom = Carbon::parse(SalaryToService::min('created_at'))->isoFormat('Y-MM-DD');
        $this->datetill = Carbon::parse(SalaryToService::max('created_at'))->isoFormat('Y-MM-DD');

    }

    public function render()
    {

        $finances = SalaryToService::whereDate('created_at', '>=', $this->datefrom)
                                    ->whereDate('created_at', '<=', $this->datetill);
        if($this->user){
            $finances = $finances->where('user_id', intval($this->user));
        }

        if($this->project == "prod"){
            $this->totalclearearn = 0;
            $this->totalearn = 0;
            $this->totalsalary = 0;
            foreach (SalaryToService::whereNull('service_id')->get() as $item) {
                if ($item->service_id) {
                    $this->totalsalary += ($item->service->unchanged_service_price * $item->percent/100) + ($item->service->productclearprice() * $item->sale_percent/100);
                }elseif($item->sale_id){
                    $this->totalsalary += $item->service_price * $item->sale_percent/100; 
                } 
            }
            
            $finances = $finances->whereNull('service_id');
            foreach (Sale::all() as $item) {
                $this->totalclearearn += $item->totalOriginalPrice() - ($item->total - $item->paid);
            }
            $this->totalearn =  Sale::sum('paid');

        }elseif($this->project == "serv"){
            $this->totalclearearn = 0;
            $this->totalearn = 0;
            $this->totalsalary = 0;
            foreach (SalaryToService::whereNull('sale_id')->get() as $item) {
                if ($item->service_id) {
                    $this->totalsalary += ($item->service->unchanged_service_price * $item->percent/100) + ($item->service->productclearprice() * $item->sale_percent/100);
                }else{
                    $this->totalsalary += $item->service_price * $item->sale_percent/100; 
                }
            }
            
            $finances = $finances->whereNull('sale_id');
            
            foreach (ClientService::where('status', 1)->get() as $item) {
                $this->totalclearearn += $item->new_price - $item->paid;
            }
            $this->totalearn =  ClientService::where('status', 1)->sum('paid');

        }else{
            $this->totalclearearn = 0;
            $this->totalearn = 0;
            $this->totalsalary = 0;
            foreach (SalaryToService::where('salary_status', 1)->get() as $item) {
                if ($item->service_id) {
                    $this->totalsalary += ($item->service->unchanged_service_price * $item->percent/100) + ($item->service->productclearprice() * $item->sale_percent/100);
                }else{
                    $this->totalsalary += $item->service_price * $item->sale_percent/100; 
                }
                  
            }
            //სუფთა მოგება
            foreach (Sale::all() as $item) {
                $this->totalclearearn += $item->totalOriginalPrice() - ($item->total - $item->paid);
            }
            foreach (ClientService::where('status', 1)->get() as $item) {
                $this->totalclearearn += $item->paid - $item->productsbuyprice();
            }
            $this->totalearn =  Sale::sum('paid') + ClientService::where('status', 1)->sum('paid');
        }
        $finances = $finances->paginate(30);
        $users = Profile::all();
        return view('livewire.company.finances', compact('finances', 'users'));
    }
}