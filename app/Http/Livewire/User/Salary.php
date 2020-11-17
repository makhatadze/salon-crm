<?php

namespace App\Http\Livewire\User;

use App\Cashier;
use App\Salary as AppSalary;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Salary extends Component
{
    use WithPagination;
    public $user;

    public $salaryperiod;
    public $userearn;
    public $date;
    public $salarytype;
    public $moneyincashier = null;
    public $cashier;
    public function mount($user)
    {
        $this->salaryperiod = "today";
        $this->user = $user;
        foreach ($user->SalaryToServices()->whereDate('created_at', Carbon::today())->get() as $item) {
            $this->userearn += $item->service_price * $item->percent/100;
        }
    }
    public function addAvans(AppSalary $salary, $val)
    {
        $amout = intval($val*100);
        $cashier = $salary->cashier;
        $cashier->amout = $cashier->amout - $salary->avansi_complate;
        if($salary->type == "avansi" && $amout && $salary->salary >= $amout){
            $salary->avansi_complate = $amout;
            $cashier->amout += $amout;
            $salary->save();
            if ( $cashier->save()) {
                $cashier->paid()->create([
                    'description' => __('paymethod.avansichange') .' ID: '.$salary->id,
                    'amout' => $amout
                ]);
            }
        }
    }
    public function render()
    {
        if ($this->salaryperiod == "today") {
            $this->userearn = 0;
            foreach ($this->user->SalaryToServices()
                    ->whereDate('created_at', Carbon::today())
                    ->get() as $item) {
                    if ($item->service_id) {
                        $this->userearn += ($item->service->unchanged_service_price * $item->percent/100) + ($item->service->products()->sum('newproductprice') * $item->sale_percent/100);
                    }elseif($item->sale_id){
                        $this->userearn += $item->service_price * $item->sale_percent/100; 
                    } 
            }
        }elseif ($this->salaryperiod == "week") {
            $this->userearn = 0;
            foreach ($this->user->SalaryToServices()
                ->whereDate('created_at', '<=', Carbon::today())
                ->whereDate('created_at', '>=', Carbon::now()->subDays(7))
                ->get() as $item) {
                    if ($item->service_id) {
                        $this->userearn += ($item->service->unchanged_service_price * $item->percent/100) + ($item->service->products()->sum('newproductprice') * $item->sale_percent/100);
                    }elseif($item->sale_id){
                        $this->userearn += $item->service_price * $item->sale_percent/100; 
                    } 
            }
        }elseif ($this->salaryperiod == "month") {
            $this->userearn = 0;
            foreach ($this->user->SalaryToServices()
            ->whereMonth('created_at', Carbon::now()->isoFormat('MM'))
            ->get() as $item) {
                if ($item->service_id) {
                    $this->userearn += ($item->service->unchanged_service_price * $item->percent/100) + ($item->service->products()->sum('newproductprice') * $item->sale_percent/100);
                }elseif($item->sale_id){
                    $this->userearn += $item->service_price * $item->sale_percent/100; 
                } 
            }
        }elseif ($this->salaryperiod == "all") {
            $this->userearn = 0;
            foreach ($this->user->SalaryToServices as $item) {
                if ($item->service_id) {
                    $this->userearn += ($item->service->unchanged_service_price * $item->percent/100) + ($item->service->products()->sum('newproductprice') * $item->sale_percent/100);
                }elseif($item->sale_id){
                    $this->userearn += $item->service_price * $item->sale_percent/100; 
                } 

            }
        }
        $salaries = $this->user->salaries();
        if ($this->salarytype) {
            if (in_array($this->salarytype, ['earn', 'salary', 'avansi', 'uncomplatedavansi'])) {
                if ($this->salarytype == 'uncomplatedavansi') {
                    $salaries = $salaries->where('type', 'like', 'avansi')->whereColumn('salary', '>', 'avansi_complate');
                }else{
                    $salaries = $salaries->where('type', 'like', $this->salarytype);
                }
            }
        }
        if ($this->date) {
            $salaries = $salaries->whereDate('updated_at', Carbon::parse($this->date));
        }
        $cashiers = Cashier::all();
        $salaries = $salaries->orderBy('id', 'desc')->paginate(5);
        if ($this->cashier && $this->cashier != '') {
            $this->moneyincashier = number_format(Cashier::findOrFail(intval($this->cashier))->amout/100, 2);
        }else{
            $this->moneyincashier = null;
        }

        return view('livewire.user.salary' , compact('salaries', 'cashiers'));
    }
}
