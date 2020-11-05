<?php

namespace App\Http\Livewire\Purchase;

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

    public function mount($purchase)
    {
        $this->purchase = $purchase;
    }
    protected $rules = [
        'methodid' => 'required|string',
        'paid' => 'required|numeric',
    ];
    public function payPurchase()
    {
        if ($this->paid > ($this->purchase->getPrice() - $this->purchase->paidpurchases()->sum('paid'))/100) {
            $error = \Illuminate\Validation\ValidationException::withMessages([
                'paid' => ['The paid may not be greater than '.number_format(($this->purchase->getPrice() - $this->purchase->paid)/100,2)],
             ]);
             throw $error;
        }
        $this->validate();
        if ($this->methodid == "consignation") {
            $methodname = "consignation";
            PayPurchase::create([
                'purchase_id' => intval($this->purchase->id),
                'user_id' => Auth::user()->id,
                'pay_name' => $methodname,
                'paid' => intval($this->paid*100),
                'dept' => intval($this->purchase->getPrice() - $this->paid*100)
            ]);
        }else{
            $methodname = PayController::findOrFail(intval($this->methodid));
            PayPurchase::create([
                'purchase_id' => intval($this->purchase->id),
                'user_id' => Auth::user()->id,
                'payment_id' => intval($this->methodid),
                'pay_name' => $methodname->{'name_'.app()->getLocale()},
                'paid' => intval($this->paid*100),
                'dept' => intval($this->purchase->getPrice() - $this->paid*100)
            ]);
        }
        $this->purchase->paid = $this->purchase->paidpurchases()->sum('paid');
        $this->purchase->save();
        $this->methodid = '';
        $this->paid = '';
    }
    public function render()
    {
        $methods = PayController::all();
        $paidpurchases = $this->purchase->paidpurchases()->orderBy('id', 'desc')->get();
        return view('livewire.purchase.pay', compact('methods', 'paidpurchases'));
    }
}
