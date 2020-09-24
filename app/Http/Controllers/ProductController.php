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

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Department;
use App\DistributionCompany;
use Carbon\Carbon;
use App\Image;
use App\Purchase;
use App\Exports\ProductExport;
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
        $queries = [
        "productname",
        "product_category",
        "departments",
        "pricefrom",
        "pricetill",
        "amout",
        "unit"
    ];
        $products = Product::whereNull('deleted_at');

        foreach ($queries as $key => $req) {
            if(request($req)){
                if($req == "productname"){
                    $products = $products->where('title_'.app()->getLocale(), 'like', '%'.request($req).'%');
                }elseif($req == "product_category"){
                    $products = $products->where('category_id', request($req));
                }elseif($req == "departments"){
                    $products = $products->where('department_id', request($req));
                }elseif($req == "pricefrom"){
                    $products = $products->where('price', '>=', request($req)*100);
                }elseif($req == "pricetill"){
                    $products = $products->where('price', '<=', request($req)*100);
                }elseif($req == "amout"){
                    $products = $products->where('stock', '<=', request($req));
                }elseif($req == "unit"){
                    $products = $products->where('unit', request($req));
                }
                $queries[$req] = request($req);
            }
        }
        $products = $products->orderBy('id', 'DESC')->paginate(30)->appends($queries);
        $departments = Department::whereNull('deleted_at')->get();
        $categories = Category::whereNull('deleted_at')->get();
        return view('theme.template.product.products', compact('products', 'categories', 'departments', 'queries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $distributions = DistributionCompany::whereNull('deleted_at')->get();
        $departments = Department::whereNull('deleted_at')->get();
        $categories = Category::where('categoryable_type', 'App\Product')->whereNull('deleted_at')->get();
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
        $departments = Department::whereNull('deleted_at')->get();
        $categories = Category::all();
        $purchases = Purchase::all();
        return view('theme.template.product.edit_product', compact('departments', 'categories', 'product', 'distributions', 'purchases'));
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
            'purchase' => 'required|integer',
            'get_type' => 'required|string',
            'unit' => 'required|string',
            'stock' => 'required|between:0,99.99|min:0',
            'editor-ge' => 'required',
            'editor-ru' => '',
            'editor-en' => '',
            'price' => 'required|between:0,99.99|min:0',
            'currency' => 'required|string',
            'images[]' => 'image'
        ]);
        $product->title_ge = $request->input('title_ge');
        $product->title_ru = $request->input('title_ru');
        $product->title_en = $request->input('title_en');
        $product->description_ge = $request->input('editor-ge');
        $product->description_ru = $request->input('editor-ru');
        $product->description_en = $request->input('editor-en');
        $product->type = $request->input('get_type');
        $product->purchase_id = $request->input('purchase');
        $product->unit = $request->input('unit');
        $product->stock = $request->input('stock');
        $product->category_id = intval($request->input('get_category'));
        $product->price = intval($request->input('price')*100);
        $product->currency_type = $request->input('currency');
        $product->save();

        if($request->file('images')){
            foreach($request->file('images') as $image){
                $imagename = date('Ymhs').$image->getClientOriginalName();
                $destination = base_path() . '/storage/app/public/productimage';
                $image->move($destination, $imagename);
                $product->images()->create([
                    'name' => $imagename
                ]);
            }
        }
        return redirect('/products');
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
    public function removeimg(Request $request){
        $this->validate($request, [
           'imgid' => 'required|integer' 
        ]);
        $img = Image::findOrFail($request->input('imgid'));
        $img->deleted_at = Carbon::now('Asia/Tbilisi');
        $img->save();
        return response()->json(array('status'=> true), 200);
    }
    public function turn(Product $product, $status){
        
        $product->published = $status;
        $product->save();
        return redirect('/products');
    }
    public function getproductsajax(Request $request){
        $lang = app()->getLocale();
        $products = Product::where('title_'.app()->getLocale(), 'like', '%'.$request->input('val').'%')->whereNull('deleted_at')->orderBy('id', 'desc')->take(30)->get();
        foreach ($products as $key => $prod) {
            if($prod->category_id){
                $prod['category_name'] = $prod->getCategoryName($prod->category_id);
            } 
            if($prod->images()->count() > 0){
                $prod['product_images[]'] = $prod->images()->whereNull('deleted_at')->take(3)->get();
            }
        }
        return response()->json(array('status'=>true, 'data'=>$products, 'lang'=>$lang));
    }
    public function productexport() 
    {
        return Excel::download(new ProductExport, 'products.xlsx');
    }
    public function removeproductajax($id){
        $product = Product::findOrFail(intval($id));
        $product->delete();
        return response()->json(array('status'=> true), 200);
    }
}
