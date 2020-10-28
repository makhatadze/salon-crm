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
        //მთლიანი შემოსავალი
        $this->totalearn = Sale::sum('paid');
        $this->totalearn += ClientService::sum('paid');

    

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
            $this->totalsalary = 0;
            foreach (SalaryToService::whereNull('service_id')->get() as $item) {
                $this->totalsalary += $item->service_price * $item->percent/100;   
            }
            foreach (Sale::all() as $sale) {
                $this->totalclearearn += $sale->totalOriginalPrice();
            }
            
            $this->totalclearearn = $this->totalclearearn - $this->totalsalary;

            $finances = $finances->whereNull('service_id');
        }elseif($this->project == "serv"){
            
            $this->totalclearearn = 0;
            $this->totalsalary = 0;
            foreach (SalaryToService::whereNull('sale_id')->get() as $item) {
                $this->totalsalary += $item->service_price * $item->percent/100;   
            }
            foreach (ClientService::all() as $serv) {
                    $this->totalclearearn += $serv->new_price;
            }
            
            $this->totalclearearn = $this->totalclearearn - $this->totalsalary;
            $finances = $finances->whereNull('sale_id');
        }else{
            $this->totalclearearn = 0;
            $this->totalsalary = 0;
            foreach (SalaryToService::all() as $item) {
                $this->totalsalary += $item->service_price * $item->percent/100;   
            }
            //სუფთა მოგება
            foreach (Sale::all() as $sale) {
                $this->totalclearearn += $sale->totalOriginalPrice();
            }
            foreach (ClientService::all() as $serv) {
                    $this->totalclearearn += $serv->new_price;
            }
            $this->totalclearearn = $this->totalclearearn - $this->totalsalary;
        }
        $finances = $finances->paginate(30);
        $users = Profile::all();
        return view('livewire.company.finances', compact('finances', 'users'));
    }
}