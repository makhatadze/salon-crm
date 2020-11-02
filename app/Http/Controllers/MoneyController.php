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
        return view('theme.template.company.money');
    }
}
