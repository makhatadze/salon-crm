<?php

namespace App\Http\Livewire;

use App\Cashier;
use App\Voucher as AppVoucher;
use Livewire\Component;
use Livewire\WithPagination;

class Voucher extends Component
{
    use WithPagination;
    public $code;
    public $money;
    public $search = '';
    public $cashier = '';
    
    public function mount()
    {
        $this->code = rand(100000,9999999);
    }
    public function changestatus(AppVoucher $voucher)
    {
        $voucher->status = !$voucher->status;
        $voucher->save();
    }
    public function createvoucher()
    {
        $this->validate([
            'code' => 'required|unique:vouchers',
            'money' => 'required',
            'cashier' => 'required|integer'
        ]);
        
            $selectedcashier = Cashier::findOrFail(intval($this->cashier));
            if(strlen($this->code) >= 5 && $selectedcashier){
                $voucher = AppVoucher::create([
                    'code' => intval($this->code),
                    'money' => intval($this->money * 100),
                    'cashier_id' => $selectedcashier->id
                ]);
                $selectedcashier->amout += $voucher->money;
                $selectedcashier->save();
            }
            $this->code = rand(100000,9999999);
            $this->money = '';
            $this->cashier = '';
       
    }
    public function deletevoucher(AppVoucher $voucher)
    {
        if ($voucher->voucherHistory()->count() == 0) {
            $cashier = Cashier::findOrFail($voucher->cashier_id);
            $cashier->amout = $cashier->amout - $voucher->money;
            $cashier->save();
            $voucher->delete();
        }
    }
    public function render()
    {
        $vouchers = AppVoucher::orderBy('id', 'desc');
        if ($this->search != '') {
            $vouchers = $vouchers->where('code', 'LIKE', '%'.intval($this->search).'%');
        }
        $vouchers = $vouchers->paginate(5);
        $cashiers = Cashier::all();
        return view('livewire.voucher', compact('vouchers', 'cashiers'));
    }
}
