<?php

namespace App\Http\Controllers;
use App\Purchase;
use App\User;
use App\ClientService;
use App\Client;
use App\Order;
use App\Product;
use App\Profile;
use Illuminate\Http\Request;

class MoneyController extends Controller
{
    //This is a controller where you can see all incomes and all paied money
    public function index(){
        //Purchases
        $units = 0;
        $cost = 0;
        foreach(Purchase::all() as $purchase){
            $units += $purchase->products->count();
            $cost += $purchase->products->sum('price')/100;
        }
        $purchase =[
            'total' => Purchase::whereNull('deleted_at')->count(),
            'units' => $units,
            'cost' => $cost
        ];
        //Products
        $orders = 0;
        foreach (Order::all() as  $item) {
            $orders += $item->quantity * $item->price;
        }
        $products = [
            'total' => Product::whereNull('deleted_at')->count(),
            'sum' => Product::whereNull('deleted_at')->sum('price')/100,
            'orders'=> $orders/100
        ];
        //Personal
        $users = User::whereNull('users.deleted_at')
        ->join('salary_to_services', 'salary_to_services.user_id', '=', 'users.id')
        ->get();
        $salary = Profile::where('salary_status', true)->sum('salary');
        $userearn = 0;
        foreach($users as $user){
            if($user->service_price && $user->percent){
                $userearn += $user->service_price * $user->percent/100;
            }
        }

        $users = [
            'total' => Profile::where('salary_status', true)->count(),
            'salary' => $salary,
            'userearn' => round($userearn/100,2)
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
