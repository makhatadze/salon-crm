<?php

namespace App\Http\Livewire\User;

use App\Client;
use App\ClientService;
use App\SalaryToService;
use App\Sale;
use Carbon\Carbon;
use Livewire\Component;

class Profile extends Component
{
    public $getuser;
    public $search;
    public $datefrom;
    public $datetill;
    public $type;


    public function render()
    {
        $clientservices = $this->getuser->SalaryToServices();
        if ($this->search) {
            $clients = Client::select('id')->
                                where('full_name_'.app()
                                ->getLocale(), 'LIKE', '%'.$this->search.'%')
                                ->get()
                                ->toArray();
            $sales = $this->getuser->sales()
            ->select('id')
                        ->whereIn('client_id', $clients)
                        ->get()
                        ->toArray();
            $services = $this->getuser->clientservices()
                        ->select('id')
                        ->whereIn('clinetserviceable_id', $clients)
                        ->get()
                        ->toArray();
                        $clientservices = $clientservices->whereIn('sale_id', $sales)
                                                        ->orWhereIn('service_id', $services);
        }
        if ($this->type){
            $typesales = $this->getuser->sales()->select('id');
            $typeservices = $this->getuser->clientservices()->select('id');
            if ($this->type == "consignation") {
                $typesales = $typesales->where('pay_method', 'consignation')
                            ->whereColumn('total', '>', 'paid');
                $typeservices = $typeservices->where('pay_method', 'consignation')
                                ->whereColumn('new_price', '>', 'paid');
            }
            if ($this->type == "full") {
                $typesales = $typesales->whereColumn('total', 'paid');
                $typeservices = $typeservices->whereColumn('new_price', 'paid');
            }
            $typesales = $typesales->get()->toArray();
            $typeservices = $typeservices->get()->toArray();
            $clientservices = $clientservices->whereIn('sale_id', $typesales)
                                            ->orWhereIn('service_id', $typeservices);
        }
        if ($this->datefrom) {
            $clientservices = $clientservices->whereDate('created_at', '>=', Carbon::parse($this->datefrom));
        }
        if ($this->datetill) {
            $clientservices = $clientservices->whereDate('created_at', '<=', Carbon::parse($this->datetill));
        }
        $clientservices = $clientservices->paginate(30);
        $income = 0;
        $dept = 0;
        foreach ($clientservices as $item) {
            if ($item->sale) {
                if ($item->sale->total > $item->sale->paid) {
                    $income += $item->sale->paid;
                    $dept += $item->sale->total - $item->sale->paid;
                }else{
                    $income += $item->sale->paid;
                }
            }else if($item->service){

                if ($item->service->new_price > $item->service->paid) {
                    $income += $item->service->paid;
                    $dept += $item->service->new_price - $item->service->paid;
                }else{
                    $income += $item->service->paid;
                }
            }
        }
        return view('livewire.user.profile', compact('clientservices', 'income', 'dept'));
    }
}
