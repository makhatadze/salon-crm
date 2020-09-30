<?php

namespace App\Http\Controllers;

use App\Purchase;
use App\Office;
use App\Profile;
use App\Product;
use App\Department;
use App\Category;
use App\DistributionCompany;

use App\Exports\PurchaseExport;
use Maatwebsite\Excel\Facades\Excel;

use Carbon\Carbon;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $queries = [
            'code',
            'distributor',
        ];
        
        $purchases = Purchase::whereNull('deleted_at');
        foreach($queries as $req){
           
            if(request($req)){
                if($req == "code"){
                    $purchases = $purchases->where('purchase_number', 'like', '%'.request($req).'%')
                    ->orWhere('overhead_number', 'like', '%'.request($req).'%');
                }elseif($req == "distributor"){
                    $purchases = $purchases->where('distributor_id', 'like', '%'.intval(request($req)).'%');
                }
                $queries[$req] = request($req);
            }
        }
        
        $purchases = $purchases->paginate(25)->appends($queries);

        $distributors = DistributionCompany::whereNull('deleted_at')->get();
        return view('theme.template.purchase.purchases', compact('purchases', 'distributors', 'queries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::whereNull('deleted_at')->get();
        $offices = Office::whereNull('deleted_at')->get();
        return view('theme.template.purchase.create_purchase', compact('offices', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'purchase_type' => 'required|string',
            'overhead_number' => '',
            'purchases_number' => '',
            'distributor_id' => 'required|integer',
            'purchase_date' => 'required|date',
            'dgg' => '',
            //array
            'ability_type' => '',
            'title' => '',
            'unit_price' => '',
            'currency' => '',
            'unit' => '',
            'quantity' => '',
            'category' => '',
            'body' => '',
        ],[
            'responsible_person_id.required' => 'აირჩიეთ პასუხისმგებელი პირი',
            'getter_person_id.required' => 'აირჩიეთ მიმღები პირი',
            'distributor_id.required' => 'აირჩიეთ მომწოდებელი',
        ]);
        $json = array();
        if($request->input('ability_type') && $request->input('title') && $request->input('unit') && $request->input('quantity') && $request->input('unit_price') && $request->input('currency') && $request->input('category') && $request->input('body')){
            foreach($request->input('ability_type') as $key => $item){
                $json[] =[
                    'ability_type' => $request->input('ability_type')[$key],
                    'title' => $request->input('title')[$key],
                    'unit' => $request->input('unit')[$key],
                    'unit_price' => $request->input('unit_price')[$key]*100,
                    'currency' => $request->input('currency')[$key],
                    'quantity' => $request->input('quantity')[$key],
                    'category' => $request->input('category')[$key],
                    'body' => $request->input('body')[$key],
                ];
            }
        }
        $purchase= new Purchase;
        $purchase->purchase_type = $request->input('purchase_type');
        if($request->input('purchase_type') == "overhead"){
            $purchase->overhead_number = $request->input('overhead_number');
        }else{
            $purchase->purchase_number = $request->input('purchases_number');
        }
        $purchase->purchase_date = Carbon::parse($request->input('purchase_date'));
        $purchase->distributor_id = $request->input('distributor_id');
        if($request->input('dgg')){
            $purchase->dgg = true;
        }else{
            $purchase->dgg = false;
        }
        if($purchase->save()){
            
            foreach ($json as $key => $product) {
                Product::create([
                    'title_ge' => $product['title'],
                    'price' => $product['unit_price'],
                    'currency_type' => $product['currency'],
                    'unit' => $product['unit'],
                    'stock' => $product['quantity'],
                    'category_id' => $product['category'],
                    'description_ge' => $product['body'],
                    'type' => $product['ability_type'],
                    'purchase_id' => $purchase->id
                ]);
            }
        }
        return redirect('/purchases');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::whereNull('deleted_at')->get();
        $purchase = Purchase::wherenull('deleted_at')->findOrFail($id);
        $offices = Office::whereNull('deleted_at')->get();
        $departments = Department::where('departmentable_id', $purchase->office_id)->whereNull('deleted_at')->get();
        return view('theme.template.purchase.edit_purchase', compact('offices', 'purchase', 'departments', 'categories'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        $this->validate($request,[
            'purchase_type' => 'required|string',
            'overhead_number' => '',
            'purchases_number' => '',
            'distributor_id' => 'required|integer',
            'purchase_date' => 'required|date',
            'dgg' => '',
            //array
            'ability_type' => '',
            'title' => '',
            'unit_price' => '',
            'currency' => '',
            'unit' => '',
            'quantity' => '',
            'category' => '',
            'body' => '',
        ],[
            'responsible_person_id.required' => 'აირჩიეთ პასუხისმგებელი პირი',
            'getter_person_id.required' => 'აირჩიეთ მიმღები პირი',
            'distributor_id.required' => 'აირჩიეთ მომწოდებელი',
        ]);
        $json = array();
        if($request->input('ability_type') && $request->input('title') && $request->input('unit') && $request->input('quantity') && $request->input('unit_price') && $request->input('currency') && $request->input('category') && $request->input('body')){
            foreach($request->input('ability_type') as $key => $item){
                $json[] =[
                    'ability_type' => $request->input('ability_type')[$key],
                    'title' => $request->input('title')[$key],
                    'unit' => $request->input('unit')[$key],
                    'unit_price' => $request->input('unit_price')[$key]*100,
                    'currency' => $request->input('currency')[$key],
                    'quantity' => $request->input('quantity')[$key],
                    'category' => $request->input('category')[$key],
                    'body' => $request->input('body')[$key],
                ];
            }
        }
        $purchase->purchase_type = $request->input('purchase_type');
        if($request->input('purchase_type') == "overhead"){
            $purchase->overhead_number = $request->input('overhead_number');
        }else{
            $purchase->purchase_number = $request->input('purchases_number');
        }
        $purchase->purchase_date = Carbon::parse($request->input('purchase_date'));
        $purchase->distributor_id = $request->input('distributor_id');
       if($request->input('dgg')){
            $purchase->dgg = true;
        }else{
            $purchase->dgg = false;
        }
        if($purchase->save()){
            
            foreach ($json as $key => $product) {
                Product::create([
                    'title_ge' => $product['title'],
                    'price' => $product['unit_price'],
                    'currency_type' => $product['currency'],
                    'unit' => $product['unit'],
                    'stock' => $product['quantity'],
                    'category_id' => $product['category'],
                    'description_ge' => $product['body'],
                    'type' => $product['ability_type'],
                    'purchase_id' => $purchase->id
                ]);
            }
        }
        return redirect('/purchases');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        $purchase->delete();
        return redirect('/purchases');
    }
    //Get Departments by office
    public function getdepartments(Request $request){
        $departments = Department::where('departmentable_id', intval($request->input('office_id')))->whereNull('deleted_at')->get();
        return response()->json(array('status' => true, 'data' => $departments));
    }
    //Ajax For Distributor
    public function getdistributors(Request $request){
        $distributors = DistributionCompany::where('code', 'like', intval($request->input('value')).'%')
        ->orWhere('name_'.app()->getLocale(), 'like', '%'.strval($request->input('value')).'%')
        ->whereNull('deleted_at')->get();
        return response()->json(array('status' => true, 'data' => $distributors));
    }
    //Ajax for Responsible and Getter Person
    public function getprofiles(Request $request){
        $profiles = Profile::where('pid', 'like', strval($request->input('value')).'%')
        ->orWhere('first_name', 'like', '%'.strval($request->input('value')).'%')
        ->orWhere('last_name', 'like', '%'.strval($request->input('value')).'%')
        ->get();
        return response()->json(array('status' => true, 'data' => $profiles));
    }
    //Purchase Export
    public function purchaseexport(){
        return Excel::download(new PurchaseExport, 'purchases.xlsx');
    }
}
