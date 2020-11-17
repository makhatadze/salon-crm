<?php

namespace App\Http\Livewire;

use App\Cashier;
use App\Salary as AppSalary;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Salary extends Component
{
    use WithPagination;
    public $search;

    public $standard = null;
    public $earn = null;
    public $cashier = null;
    public $avansi = null;

    public function render()
    {
        $salaries = AppSalary::select(
                    'profiles.first_name',
                    'profiles.last_name',
                    'salaries.type',
                    'salaries.bonus',
                    'salaries.salary', 
                    'salaries.description', 
                    'salaries.made_salary',
                    'salaries.created_at');

                    if ($this->standard) {
                        if ($this->avansi || $this->earn) {
                            $salaries = $salaries->orWhere('salaries.type', 'salary');
                        }else{
                            $salaries = $salaries->where('salaries.type', 'salary');
                        }
                    }
                    if ($this->earn) {
                        if ($this->standard || $this->avansi) {
                            $salaries = $salaries->orWhere('salaries.type', 'earn');
                        }else{
                            $salaries = $salaries->where('salaries.type', 'earn');
                        }
                    }
                    if ($this->cashier) {
                        $salaries = $salaries->orWhere('salaries.cashier_id', 'LIKE', '%'.intval($this->cashier).'%');
                    }
                    if ($this->avansi) {
                        if ($this->standard || $this->earn) {
                            $salaries = $salaries->orWhere('salaries.type', 'avansi');
                        }else{
                            $salaries = $salaries->where('salaries.type', 'avansi');
                        }
                    }
        $salaries = $salaries->join('users', 'salaries.user_id', '=', 'users.id')
        ->join('profiles', 'users.id', '=', 'profiles.profileable_id')
        ->paginate(20);
        $cashiers = Cashier::all();
        return view('livewire.salary', compact('salaries', 'cashiers'));
    }
}
