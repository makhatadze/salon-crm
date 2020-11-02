<?php

namespace App\Http\Livewire\Money;

use App\ClientService;
use App\Product;
use App\Purchase;
use App\SalaryToService;
use App\Sale;
use App\Service;
use Carbon\Carbon;
use Livewire\Component;

class Index extends Component
{
    public $purchasetime;
    public $productstime;
    public $clientstime;
    public $servicetime;
    public function render()
    {
        // Purchases
        $purchase = 0;
        $purchasedept = 0;
        $purchaseprods = new Purchase;
        if ($this->purchasetime) {
            if ($this->purchasetime == "today") {
                $purchaseprods = $purchaseprods->whereDate('updated_at', Carbon::today());
            }else if ($this->purchasetime == "month") {
                $purchaseprods = $purchaseprods->whereMonth('updated_at', Carbon::now()->isoFormat('MM'));
            }
        }
        $purchaseprods = $purchaseprods->get();
        foreach ($purchaseprods as $item) {
            $purchase += $item->getPrice();
            $purchasedept += $item->getPrice() - $item->paid;
        }
        
        // Products
        $products = 0;
        $productsprod = new Product;
        if ($this->productstime) {
            if ($this->productstime == "today") {
                $productsprod = $productsprod->whereDate('created_at', Carbon::today());
                $soldproducts = Sale::whereDate('created_at', Carbon::today())->sum('paid');
            }else if($this->productstime == "month") {
                $productsprod = $productsprod->whereMonth('created_at', Carbon::now()->isoFormat('MM'));
                $soldproducts = Sale::whereMonth('created_at', Carbon::now()->isoFormat('MM'))->sum('paid');
            }else{
                $soldproducts = Sale::sum('paid');
            }
        }else{
            $soldproducts = Sale::sum('paid');
        }
        $productsprod = $productsprod->get();

        foreach ($productsprod as $item) {
            $products += $item->stock * $item->price;
        }
        // Clients
        
       
        $clientsdept = 0;
        $clientsales = Sale::select('total', 'paid');
        $clientserv = ClientService::select('new_price', 'paid')
                                    ->where('status', 1);
                                    if ($this->clientstime) {
                                        if ($this->clientstime == "today") {
                $clientserv = $clientserv->whereDate('created_at', Carbon::today());
                $clientsales = $clientsales->whereDate('created_at', Carbon::today());
                $clients = Sale::whereDate('created_at', Carbon::today())->sum('paid') + ClientService::whereDate('created_at', Carbon::today())->sum('paid');
            }else if($this->clientstime == "month") {
                $clientserv = $clientserv->whereMonth('created_at', Carbon::now()->isoFormat('MM'));
                $clientsales = $clientsales->whereMonth('created_at', Carbon::now()->isoFormat('MM'));
                $clients = Sale::whereMonth('created_at', Carbon::now()->isoFormat('MM'))->sum('paid') + ClientService::whereMonth('created_at', Carbon::now()->isoFormat('MM'))->sum('paid');
            }else{
                $clients = Sale::sum('paid') + ClientService::sum('paid');
            }
        }else{
            $clients = Sale::sum('paid') + ClientService::sum('paid');
        }
        $clientserv = $clientserv->get();
        $clientsales = $clientsales->get();
        foreach ($clientsales as $item) {
            $clientsdept += $item->total - $item->paid; 
        }
        foreach ($clientserv as $item) {
            $clientsdept += $item->new_price - $item->paid; 
        }
        // Services
        if ($this->servicetime) {
            if ($this->servicetime == "today") {
                $services = Service::whereDate('created_at', Carbon::today())->sum('price');
                $servicessold = ClientService::where('status', '1')->whereDate('created_at', Carbon::today())->sum('paid');
            }else if ($this->servicetime == "month") {
                $services = Service::whereMonth('created_at', Carbon::now()->isoFormat('MM'))->sum('price');
                $servicessold = ClientService::where('status', '1')->whereMonth('created_at', Carbon::now()->isoFormat('MM'))->sum('paid');
            }else{
                $services = Service::sum('price');
                $servicessold = ClientService::where('status', '1')->sum('paid');
            }
        }else{
            $services = Service::sum('price');
            $servicessold = ClientService::where('status', '1')->sum('paid');
        }
        
        return view('livewire.money.index', compact('purchase', 'products', 'soldproducts', 'clients', 'clientsdept', 'purchasedept', 'services', 'servicessold'));
    }
}
