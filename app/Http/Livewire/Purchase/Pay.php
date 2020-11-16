<?php

namespace App\Http\Livewire\Purchase;

use App\Cashier;
use App\PayController;
use App\PayPurchase;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Pay extends Component
{
    public $purchase;
    // Form
    public $methodid;
    public $paid;
    public $max;
    public $cashier_id;

    public function mount($purchase)
    {
        $this->purchase = $purchase;
    }
    protected $rules = [
        'paid' => 'required|string',
        'cashier_id' => 'required|numeric',
    ];
    public function payPurchase()
    {
        $money = 0;
        if (isset($this->cashier_id) && $this->cashier_id != '') {
            $casher = Cashier::findOrFail(intval($this->cashier_id));
            $money = $casher->amout;
        }
        $max = 0;
        if ($money > ($this->purchase->getPrice() - $this->purchase->paidpurchases()->sum('paid'))) {
            $max = $this->purchase->getPrice() - $this->purchase->paidpurchases()->sum('paid');
        }else{
            $max = $money;
        }
        if ($this->paid > $max/100) {
            $error = \Illuminate\Validation\ValidationException::withMessages([
                'paid' => ['The paid may not be greater than '.number_format($max/100,2)],
             ]);
             throw $error;
        }
        if ($this->paid == 0) {
            $error = \Illuminate\Validation\ValidationException::withMessages([
                'paid' => ['The paid can not be 0'],
             ]);
             throw $error;
        }
        $this->validate();
        $this->purchase->paid = $this->purchase->paidpurchases()->sum('paid');
        $casher->amout = $casher->amout - intval($this->paid*100);
        PayPurchase::create([
            'purchase_id' => intval($this->purchase->id),
            'user_id' => Auth::user()->id,
            'cashier_id' => $casher->id,
            'pay_name' => $casher->name,
            'paid' => intval($this->paid*100),
            'dept' => intval($this->purchase->getPrice() - $this->paid*100)
        ]);
        $this->purchase->save();
        if ($casher->save()) {
            $casher->paid()->create([
                'description' => __('paymethod.paypurchase') .' ID: '.$this->purchase->id,
                'amout' => intval($this->paid*100) 
            ]);
        };
        $this->cashier_id = '';
        $this->paid = '';
    }
    public function render()
    {
        $money = null;
        if (isset($this->cashier_id) && $this->cashier_id != '') {
            $money = Cashier::findOrFail(intval($this->cashier_id))->amout;
        }
        $cashiers = Cashier::all();
        $paidpurchases = $this->purchase->paidpurchases()->orderBy('id', 'desc')->get();
        return view('livewire.purchase.pay', compact('cashiers', 'paidpurchases', 'money'));
    }
}
