<?php

/**
 *  app/Http/Controllers/ProductController.php
 *
 * User:
 * Date-Time: 31.08.20
 * Time: 13:57
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */

namespace App\Http\Controllers;

use App\Brand;
use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Department;
use App\DistributionCompany;
use Carbon\Carbon;
use App\Image;
use App\Client;
use App\Sale;
use App\Order;
use App\Purchase;
use App\Exports\ProductExport;
use App\Exports\SaleExport;
use App\Field;
use App\PayController;
use App\SalaryToService;
use App\Unit;
use Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('theme.template.product.products');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $distributions = DistributionCompany::all();
        $departments = Department::all();
        $categories = Category::where('model_name', 'App\Product')->get();
        return view('theme.template.product.add_product', compact('departments', 'categories', 'distributions'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $distributions = DistributionCompany::whereNull('deleted_at')->get();
        $categories = Category::where('model_name', 'App\Product')->get();
        $departments = Department::all();
        $brands = Brand::all();
        return view('theme.template.product.edit_product', compact('departments', 'categories', 'product', 'distributions', 'brands', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::wherenull('deleted_at')->findOrFail($id);
        $this->validate($request, [
            'title_ge' => 'required|string',
            'title_ru' => '',
            'title_en' => '',
            'get_category' => '',
            'department' => 'required|integer',
            'get_type' => 'required|string',
            'unit' => 'required|string',
            'stock' => 'required|between:0,99.99|min:0',
            'editor-ge' => 'required',
            'editor-ru' => '',
            'new_category' => '',
            'editor-en' => '',
            'price' => 'required|between:0,99.99|min:0',
            'currency' => 'required|string',
            'images[]' => 'image',
            'expluatation_date' => '',
            'expluatation_days' => '',
            'unlimited_expluatation' => '',
            'brand' => '',
            'new_brand' => '',
            'field_name' => '',
            'field_description' => ''
        ]);
        $fields = array();
        
        if($request->input('new_category') != ""){
         $category = new Category;
         $category->title_ge = $request->input('new_category');
         $category->model_name = "App\Product";
         $category->save();
         $product->category_id = $category->id;
        }else{
         $product->category_id = $request->input('get_category');
        }
        if($request->input('field_name') && $request->input('field_description')){
            foreach ($request->input('field_name') as $key => $value) {
                $fields[] = [
                    'name' => $request->input('field_name')[$key],
                    'description' => $request->input('field_description')[$key],
                ];
            }
        }
        if($request->input('new_brand') != "" && is_string($request->input('new_brand'))){
            $brand = new Brand;   
            $brand->name = $request->input('new_brand');
            $brand->save();
            $product->brand_id = $brand->id;
        }else{
            $product->brand_id = $request->input('brand');
        }
        $product->title_ge = $request->input('title_ge');
        $product->title_ru = $request->input('title_ru');
        $product->title_en = $request->input('title_en');
        $product->description_ge = $request->input('editor-ge');
        $product->description_ru = $request->input('editor-ru');
        $product->description_en = $request->input('editor-en');
        $product->type = $request->input('get_type');
        $product->department_id = $request->input('department');

        if(isset($request->unlimited_expluatation)){
            $product->unlimited_expluatation = true;
        }else{
            $product->expluatation_date = $request->input('expluatation_date');
            $product->expluatation_days = $request->input('expluatation_days');
            $product->unlimited_expluatation = false;
        }

        if($product->type == 1  && $product->warehouse == 0){
        }else{

            $product->unit = $request->input('unit');
            $product->stock = $request->input('stock');
        }
        $product->price = intval($request->input('price') * 100);
        $product->currency_type = $request->input('currency');
        $product->save();
        $product->fields()->createMany($fields);
        if ($request->file('images')) {
            foreach ($request->file('images') as $image) {
                $imagename = date('Ymhs') . $image->getClientOriginalName();
                $destination = base_path() . '/storage/app/public/productimage';
                $image->move($destination, $imagename);
                $product->images()->create([
                    'name' => $imagename
                ]);
            }
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect('/products');
    }
    public function removeimg(Request $request)
    {
        $this->validate($request, [
            'imgid' => 'required|integer'
        ]);
        $img = Image::findOrFail($request->input('imgid'));
        Storage::delete('public/productimage/'.$img->name);
        $img->delete();
        return response()->json(array('status' => true), 200);
    }
    public function turn(Product $product, $status)
    {

        $product->published = $status;
        $product->save();
        return redirect()->back();
    }
    public function getproductsajax(Request $request)
    {
        $lang = app()->getLocale();
        $products = Product::where('warehouse', 0)->where('title_' . app()->getLocale(), 'like', '%' . $request->input('val') . '%')->whereNull('deleted_at')->orderBy('id', 'desc')->take(30)->get();
        foreach ($products as $key => $prod) {
            if ($prod->category_id) {
                $prod['category_name'] = $prod->getCategoryName($prod->category_id);
            }
            if ($prod->images()->count() > 0) {
                $prod['product_images[]'] = $prod->images()->whereNull('deleted_at')->take(3)->get();
            }
        }
        return response()->json(array('status' => true, 'data' => $products, 'lang' => $lang));
    }

    public function productexport()
    {
        return Excel::download(new ProductExport, 'products.xlsx');
    }

    public function removeproductajax($id)
    {
        $product = Product::findOrFail(intval($id));
        $product->delete();
        return response()->json(array('status' => true), 200);
    }
    // Remove Field
    public function removefield(Field $field)
    {
        $field->delete();
        return response()->json(array('status' => true), 200);
    }
    //View Render
    public function addtocartget(){
        $user_id = Auth()->user()->id;
        $cart = Cart::session($user_id)->getContent();
        $products = Product::where([['warehouse', 0], ['type', '!=', 1]])->get();
        $cartsum = 0;
        foreach ($cart as $item) {
            $cartsum += $item->price * $item->quantity;
        }
        $clients = Client::all();
        $paymethods = PayController::all();
        return view('theme.template.product.add_to_cart', compact('products', 'cart', 'paymethods', 'cartsum', 'clients'));
    }
    public function removefromCart(Product $product){
        $user_id = Auth()->user()->id;
        Cart::session($user_id)->remove($product->id);
        
        $cartsum = 0;
        $cart = Cart::session($user_id)->getContent();
        foreach ($cart as $item) {
            $cartsum += $item->price * $item->quantity;
        }
        $cartsum = $cartsum/100;
        return response()->json(array('status' => true, 'cartsum' => $cartsum));
    }
    public function addtocartupdate(Request $request, $id){

        $this->validate($request, [
            'quantity' => 'required|min:0',
        ]);
        $product = Product::findOrFail($id);
        $user_id = Auth()->user()->id;
        $currentquantity = Cart::session($user_id)->getContent($id);
        // განახლების დროს დამატებული რაოდენობა მეტია
        if($currentquantity->first()){
            if($product->stock <  $request->quantity){
                return redirect()->back()->with('error', 'არასაკმარისი რაოდენობა. სულ:'.$product->stock);
            }
        }
        Cart::session($user_id)->update($id,[
            'quantity' => array(
                'relative' => false,
                'value' => $request->quantity, 
            ),
        ]);
        return redirect()->route('AddToCart');
    }
    public function addtocart(Request $request)
    {
        $user_id = Auth()->user()->id;
        $method = $request->method();

        if ($request->isMethod('post')){
            $this->validate($request, [
                'select_product' => 'required|integer',
                'prod_unit' => 'required|string',
                'quantity' => 'required|min:0',
            ]);
            $product = Product::findOrFail($request->select_product);
            $currentquantity = Cart::session($user_id)->getContent($product->id);
            if($currentquantity->first()){
                if($product->stock < $currentquantity->first()->quantity + $request->quantity){
                    return redirect()->back()->with('error', 'არასაკმარისი რაოდენობა. სულ:'.$product->stock);
                }
            }else if($product->stock < $request->quantity){
                return redirect()->back()->with('error', 'არასაკმარისი რაოდენობა. დარჩენილია:'.$product->stock);
            }
                $addtocart = [
                    'id' => $product->id,
                    'name' => $product->{'title_' . app()->getLocale()},
                    'price' => $product->price  ,
                    'quantity' =>  $request->quantity,
                    'attributes' => array(
                        'unit' => $product->unit,
                        'currency' => $product->currency_type
                    ),
                ];
                Cart::session($user_id)->add($addtocart);
          
        }
        return redirect()->route('AddToCart');
    }
    //Store
    public function addtosales(Request $request){
        
        $this->validate($request, [
            'client_id' => 'required|integer',
            'address' => 'required|string',
            'paymethod' => 'required'
        ]);
        // Check Cart 
        $user_id = Auth()->user()->id;
        $total = Cart::session($user_id)->getTotal();
        if($total == 0){
            return redirect()->back()->with('danger', 'კალათა ცარიელია');
        }
        // Check Pay Method
        $client = Client::findOrFail($request->client_id);
        $cart = Cart::session($user_id)->getContent();
        $sale = new Sale();
            if ($request->paymethod != 'consignation') {
                $paymethods = PayController::findOrFail($request->paymethod);
                if(!$paymethods){
                    return redirect()->back()->with('danger', 'გადახდის მეთოდი არ მოიძებნა');
                }
                $sale->pay_method_id = $paymethods->id;
                $sale->pay_method = $paymethods->{"name_".app()->getLocale()};
            }else{
                $sale->paid = intval($request->paid*100);
                $sale->pay_method = "consignation";
            }
        $sale->client_id = $request->client_id;
        $sale->address = $request->address;
        $sale->total = $total;
        $sale->seller_id = Auth()->user()->id;
        $sale->save();
        SalaryToService::create([
            'user_id' => Auth::user()->id,
            'sale_id' => $sale->id,
            'service_price' => $total,
            'percent' => auth()->user()->profile->percent_from_sales ?? 0
        ]);
        foreach($cart as $order){
            $product = Product::findOrFail($order->id);
            $item = new Order;
            $item->sale_id = $sale->id;
            $item->product_id = $order->id;
            $item->quantity = $order->quantity;
            $item->price = $order->price;
            $item->save();
            $product->stock = $product->stock - $order->quantity;
            $product->save();
            Cart::session($user_id)->remove($order->id);
        }

        return redirect()->route('Sales');
    }
    // Choosing Product for cart
    public function chooseforcart(Request $request){
        $this->validate($request, [
            'product_id' => 'required|integer'
        ]);
        $lang = app()->getLocale();
        $product = Product::findOrFail($request->product_id);
        return response()->json(array('status' => true, 'product' => $product, 'lang' => $lang));
    }
    // Sale Export
    public function saleexport(Sale $sale)
    {
        return Excel::download(new SaleExport($sale->id), 'sale.xlsx');
    }
    // Units
    public function units(){
        $units = Unit::all();
        return view('theme.template.unit.index', compact('units'));
    }
    public function storeunits(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|string'
        ]);
        $unit = new Unit;
        $unit->name = $request->input('name');
        $unit->save();
        return redirect()->back();
    }
}
