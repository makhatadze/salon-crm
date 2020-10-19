<?php

namespace App\Http\Controllers;

use App\Salary;
use App\User;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function index(){
        
        return view('theme.template.company.statistics');
    }
}
