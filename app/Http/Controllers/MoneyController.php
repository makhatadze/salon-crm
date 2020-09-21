<?php

namespace App\Http\Controllers;
use App\Purchase;
use App\User;
use App\ClientService;
use App\Client;
use App\Product;
use Illuminate\Http\Request;

class MoneyController extends Controller
{
    //This is a controller where you can see all incomes and all paied money
    public function index(){
        //Purchases
        $units = 0;
        $cost = 0;
        foreach(Purchase::whereNull('deleted_at')->get() as $purchase){
            $units += count(json_decode($purchase->array));
            foreach(json_decode($purchase->array) as $unit){
                $cost += $unit->quantity + $unit->unit_price/100;
            }
        }
        $purchase =[
            'total' => Purchase::whereNull('deleted_at')->count(),
            'units' => $units,
            'cost' => $cost
        ];
        //Products
        $products = [
            'total' => Product::whereNull('deleted_at')->count(),
            'sum' => Product::whereNull('deleted_at')->sum('price')/100
        ];
        //Personal
        $salary = 0;
        foreach(User::whereNull('deleted_at')->get() as $user){
            if($user->profile()->first()){
               $salary += $user->profile()->first()->salary;
            }
        }
        $users = [
            'total' => User::whereNull('deleted_at')->count(),
            'salary' => $salary,
        ];
        //Clients
        $earn = 0;
        foreach(ClientService::where('status', true)->whereNull('deleted_at')->get() as $service){
            $earn += $service->getServicePrice();
         }
        $clients = [
            'total' => Client::whereNull('deleted_at')->count(),
            'services' => ClientService::whereNull('deleted_at')->count(),
            'earn' => $earn
        ];
        return view('theme.template.company.money', compact('purchase', 'products', 'users', 'clients'));
    }
}
