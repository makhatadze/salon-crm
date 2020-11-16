<?php

namespace App\Http\Livewire;

use App\Cashier;
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
    public $cashier;
    public $cashier_id;
    // Update
    public $update_id;
    // Transfer
    public $amout;
    public $cash_id;

    // Validate
    protected $rules = [
        'name_ge' => 'required|min:2',
        'cashier_id' => 'required|integer|min:0'
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
    public function addcashier()
    {
        $validatedData = $this->validate([
            'cashier' => 'required|string',
        ]);
        Cashier::create([
            'name' => $this->cashier,
            'amout' => 0
        ]);
        $this->cashier = "";
    }
    public function transfermoney(Cashier $cashier)
    {
        $validatedData = $this->validate([
            'amout' => 'required',
            'cash_id' => 'required|integer'
        ]);
        $cash = Cashier::findOrFail(intval($this->cash_id));
        $money = intval($this->amout * 100);
        if ($cashier->amout >= $money) {
            $cashier->amout = $cashier->amout - $money;
            $cash->amout += $money;
            if ($cashier->save()) {
                $cashier->paid()->create([
                    'description' => __('paymethod.transfer_from') .' ID: '.$cash->id,
                    'amout' => $money 
                ]);
            };
            if ($cash->save()) {
                $cash->paid()->create([
                    'description' => __('paymethod.transfer_to') .' ID: '.$cashier->id,
                    'amout' => $money 
                ]);
            };
            
        }
        $this->cash_id = '';
        $this->amout = '';
    }
    public function removecashier(Cashier $cashier)
    {
        if ($cashier->paid()->count() == 0) {
            $cashier->delete();
        }
    }
    public function resetsuccess()
    {   
        $this->name_ge = "";
        $this->name_ru = "";
        $this->name_en = "";
        $this->update_id = "";
        $this->cashier = "";
        $this->success = false;
    }
    public function delete(PayController $payController){
        $payController->delete();
    }
    public function setupdate(PayController $payController){
        $this->update_id = $payController;
        $this->name_ge = $payController->name_ge;
    }
    public function update(PayController $payController){
        $validatedData = $this->validate();
        $payController->name_ge = $this->name_ge;
        $this->success = true;
    }
    public function render()
    {
        $payments = PayController::all();
        $cashiers = Cashier::all();
        return view('livewire.paymethods', compact('payments', 'cashiers'));
    }
}
