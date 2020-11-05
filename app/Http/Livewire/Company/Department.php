<?php

namespace App\Http\Livewire\Company;

use Livewire\Component;

class Department extends Component
{
    public $office;
    // Form
    public $name_ge;
    public $address_ge;
    public function mount($office)
    {
        $this->office = $office;
    }
    public function addDepartment()
    {
        $validatedData = $this->validate([
            'name_ge' => 'required|string',
            'address_ge' => 'required|string',
        ]);
        $this->office->departments()->create($validatedData);
        $this->name_ge = '';
        $this->address_ge = '';
    }
    public function render()
    {
        $departments = $this->office->departments()->get();
        return view('livewire.company.department', compact('departments'));
    }
}
