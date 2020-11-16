<?php

namespace App\Http\Controllers;

use App\Cashier;
use App\Client;
use App\Product;
use App\Profile;
use Illuminate\Http\Request;
use App\Sale;
use Carbon\Carbon;

class SaleController extends Controller
{
    public function index(){
        $queries = [
            "client_name",
            "worker_name",
            "price_from",
            "price_till",
            "consignation",
            "date",
        ];
        $sales = new Sale();
        foreach($queries as $req){
            if(request($req)){
                if ($req == "client_name" && request($req) != '') {
                    $profiles = Client::select('id')
                    ->where('full_name_'.app()->getLocale(), 'LIKE', '%'.request($req).'%')
                    ->orWhere('number', 'LIKE', '%'.request($req).'%')
                    ->get();
                    $sales = $sales->whereIn('client_id', $profiles);
                }elseif($req == "worker_name" && request($req) != ''){
                    $profiles = Profile::select('id')
                    ->where('first_name', 'LIKE', '%'.request($req).'%')
                    ->orWhere('last_name', 'LIKE', '%'.request($req).'%')
                    ->orWhere('phone', 'LIKE', '%'.request($req).'%')
                    ->get();
                    $sales = $sales->whereIn('seller_id', $profiles);
                }elseif($req == "price_from" && request($req) != ''){
                    $sales = $sales->where('total', '>=', request($req)*100);
                }elseif($req == "price_till" && request($req) != ''){
                    $sales = $sales->where('total' ,'<=', request($req)*100);
                }elseif(isset(request()['consignation'])){
                    $sales = $sales->where('pay_method' ,'LIKE', 'consignation')
                                    ->whereColumn('total', '>', 'paid');
                }elseif($req == "date"){
                    dd(request('date'));
                    dd('daa');
                    list($first, $second) = explode(" - ", request($req));
                    $sales = $sales->whereDate('updated_at', '>=', Carbon::parse($first))
                                    ->whereDate('updated_at', '<=', Carbon::parse($second));
                }
                $queries[$req] = request($req);
            }
        }
        $sales = $sales->paginate(25)->appends($queries);
        return view('theme.template.sale.index', compact('sales', 'queries'));
    }
    public function show(Sale $sale)
    {
        return view('theme.template.sale.show', compact('sale'));
    }
    public function updateSale(Request $request, Sale $sale)
    {
        $this->validate($request, [
            'money' => 'required'
        ]);
        if($sale->pay_method == 'consignation' && $sale->total > $sale->paid){
            $cashier = Cashier::where('id', 1)->first();
            $cashier->amout = $cashier->amout - $sale->paid;
            $sale->paid = intval($request->money*100);
            $cashier->amout += $sale->paid;
            $sale->save();
            if ($cashier->save()) {
                $cashier->paid()->create([
                    'description' => __('paymethod.change_sale_consignation') .' ID: '.$sale->id,
                    'amout' => $sale->paid
                ]);
            }
        }
        return redirect()->back();
    }
    public function destroy($id){
        $sale = Sale::findOrFail(intval($id));
        $sale->delete();
        return response()->json(array('status'=>true));
    }

}
