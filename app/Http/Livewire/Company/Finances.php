<?php

namespace App\Http\Livewire\Company;

use App\Client;
use App\Profile;
use App\SalaryToService;
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
            $finances = $finances->whereNull('service_id');
        }elseif($this->project == "serv"){
            $finances = $finances->whereNull('sale_id');
        }
        $finances = $finances->paginate(30);
        $users = Profile::all();
        return view('livewire.company.finances', compact('finances', 'users'));
    }
}