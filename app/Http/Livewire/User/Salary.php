<?php

namespace App\Http\Livewire\User;

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
    public $salarytype;
    public function mount($user)
    {
        $this->user = $user;
        foreach ($user->SalaryToServices()->whereDate('created_at', Carbon::today())->get() as $item) {
            $this->userearn += $item->service_price * $item->percent/100;
        }
    }
    public function addAvans(AppSalary $salary, $val)
    {
        $amout = intval($val*100);
        if($salary->type == "avansi" && $amout && $salary->salary >= $amout){
            $salary->avansi_complate = $amout;
            $salary->save();
        }
    }
    public function render()
    {
        if ($this->salaryperiod == "today") {
            $this->userearn = 0;
            foreach ($this->user->SalaryToServices()
                                ->whereDate('created_at', Carbon::today())
                                    ->get() as $item) {
                                        $this->userearn += $item->service_price * $item->percent/100;
            }
        }elseif ($this->salaryperiod == "week") {
            $this->userearn = 0;
            foreach ($this->user->SalaryToServices()
                                ->whereDate('created_at', '<=', Carbon::today())
                                ->whereDate('created_at', '>=', Carbon::now()->subDays(7))
                                ->get() as $item) {
                $this->userearn += $item->service_price * $item->percent/100;
            }
        }elseif ($this->salaryperiod == "month") {
            $this->userearn = 0;
            foreach ($this->user->SalaryToServices()
            ->whereMonth('created_at', Carbon::now()->isoFormat('MM'))
            ->get() as $item) {
                $this->userearn += $item->service_price * $item->percent/100;
            }
        }elseif ($this->salaryperiod == "all") {
            $this->userearn = 0;
            foreach ($this->user->SalaryToServices as $item) {
                $this->userearn += $item->service_price * $item->percent/100;
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
        $salaries = $salaries->orderBy('id', 'desc')->paginate(5);
        return view('livewire.user.salary' , compact('salaries'));
    }
}
