<?php

namespace App\Http\Livewire;

use App\PayController;
use Livewire\Component;

class Paymethods extends Component
{
    // Modal
    public $success = false;
    // Form
    public $name_ge;
    public $name_ru;
    public $name_en;
    // Update
    public $update_id;

    // Validate
    protected $rules = [
        'name_ge' => 'required|min:2',
    ];

    protected $messages = [
        'name_ge.required' => 'სახელი ქართულად სავალდებულოა.',
        'name_ge.min' => 'სახელი უნდა იყოს მინიმუმ :min ასო.',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function savePaymethod()
    {
        $validatedData = $this->validate();
        if(PayController::create($validatedData)){
            $this->success = true;
        }
    }
    public function resetsuccess()
    {   
        $this->name_ge = "";
        $this->name_ru = "";
        $this->name_en = "";
        $this->update_id = "";
        $this->success = false;
    }
    public function delete(PayController $payController){
        $payController->delete();
    }
    public function setupdate(PayController $payController){
        $this->update_id = $payController;
        $this->name_ge = $payController->name_ge;
        $this->name_ru = $payController->name_ru;
        $this->name_en = $payController->name_en;
    }
    public function update(PayController $payController){
        $validatedData = $this->validate();
        $payController->name_ge = $this->name_ge;
        $payController->name_ru = $this->name_ru;
        $payController->name_en = $this->name_en;
        $this->success = true;
    }
    public function render()
    {
        $payments = PayController::all();
        return view('livewire.paymethods', compact('payments'));
    }
}
