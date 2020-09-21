<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function index(){
        $users = User::role('user')->whereNull('deleted_at')->get();
        return view('theme.template.company.statistics', compact('users'));
    }
}
