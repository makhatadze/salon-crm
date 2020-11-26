<?php

namespace App\Http\Livewire;

use App\Voucher as AppVoucher;
use Livewire\Component;
use Livewire\WithPagination;

class Voucher extends Component
{
    use WithPagination;
    public $code;
    public $money;
    public $search = '';
    
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
            'money' => 'required'
        ]);
        
        if (strlen($this->code) >= 5) {
            AppVoucher::create([
                'code' => intval($this->code),
                'money' => intval($this->money * 100),
            ]);
        }
       
    }
    public function deletevoucher(AppVoucher $voucher)
    {
        if ($voucher->voucherHistory()->count() == 0) {
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
        return view('livewire.voucher', compact('vouchers'));
    }
}
