<?php

namespace App\Http\Livewire\Company;

use App\Office as AppOffice;
use Livewire\Component;
use Livewire\WithPagination;

class Office extends Component
{
    use WithPagination;
    public $company;
    // Form
    public  $name_ge;
    public  $address_ge;
    public  $dname_ge;
    public  $daddress_ge;
    public function addCompany()
    {
        $validatedData = $this->validate([
            'name_ge' => 'required|string',
            'address_ge' => 'required|string',
        ]);
        $this->company->offices()->create($validatedData);
        $this->name_ge = '';
        $this->address_ge = '';
        return redirect('/companies');
    }
    public function addDepartment($office)
    {
        $validatedData = $this->validate([
            'dname_ge' => 'required|string',
            'daddress_ge' => 'required|string',
        ]);
        $model = AppOffice::findOrFail($office);
        $model->departments()->create([
            'name_ge' => $validatedData['dname_ge'],
            'address_ge' => $validatedData['daddress_ge'],
        ]);
        $this->dname_ge = '';
        $this->daddress_ge = '';
        return redirect('/companies');
    }
    public function render()
    {
        $offices = $this->company->offices;
        return view('livewire.company.office', compact('offices'));
    }
}
