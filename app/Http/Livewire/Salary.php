<?php

namespace App\Http\Livewire;

use App\Salary as AppSalary;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Salary extends Component
{
    public $search;
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
                    'salaries.created_at')
                    ->where('first_name', 'LIKE', '%'.$this->search.'%')
                    ->orWhere('last_name', 'LIKE', '%'.$this->search.'%')
                    ->join('users', 'salaries.user_id', '=', 'users.id')
                    ->join('profiles', 'users.id', '=', 'profiles.profileable_id')
                    ->paginate(20);
        return view('livewire.salary', compact('salaries'));
    }
}
