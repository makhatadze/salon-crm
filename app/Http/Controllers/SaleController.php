<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sale;
class SaleController extends Controller
{
    public function index(){
        $sales = Sale::all();
        return view('theme.template.sale.index', compact('sales'));
    }
    public function destroy($id){
        $sale = Sale::findOrFail(intval($id));
        $sale->delete();
        return response()->json(array('status'=>true));
    }
}
