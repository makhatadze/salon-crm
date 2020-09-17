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
use Carbon\Carbon;
use App\Image;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::whereNull('deleted_at')->orderBy('id', 'DESC')->paginate(25);
        return view('theme.template.product.products', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::whereNull('deleted_at')->get();
        $categories = Category::where('categoryable_type', 'App\Product')->whereNull('deleted_at')->get();
        return view('theme.template.product.add_product', compact('departments', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title_ge' => 'required|string',
            'title_ru' => '',
            'title_en' => '',
            'get_department' => '',
            'get_type' => 'required|string',
            'unit' => 'required|string',
            'stock' => 'required|between:0,99999.99',
            'get_category' => '',
            'new_category-ge' => '',
            'new_category-ru' => '',
            'new_category-en' => '',
            'editor-ge' => 'required',
            'editor-ru' => '',
            'editor-en' => '',
            'price' => 'required',
            'images[]' => 'image'
        ]);
        $product = new Product;
        $product->title_ge = $request->input('title_ge');
        $product->title_ru = $request->input('title_ru');
        $product->title_en = $request->input('title_en');
        $product->description_ge = $request->input('editor-ge');
        $product->description_ru = $request->input('editor-ru');
        $product->description_en = $request->input('editor-en');
        $product->type = $request->input('get_type');
        $product->stock = $request->input('stock');
        $product->unit = $request->input('unit');
        $product->department_id = $request->input('get_department');
        $product->price = intval($request->input('price')*100);
        $product->save();
        if($request->input('new_category_ge') || $request->input('new_category_ru') || $request->input('new_category_en')){
            $cat = $product->category()->create([
                'title_ge' => $request->input('new_category_ge'),
                'title_ru' => $request->input('new_category_ru'),
                'title_en' => $request->input('new_category_en'),
            ]);
            $product->category_id = $cat->id;
            $product->save();
        }else if($request->input('get_category')){
            $product->category_id = (int)$request->input('get_category');
            $product->save();
        }
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
        $departments = Department::whereNull('deleted_at')->get();
        $categories = Category::where('categoryable_type', 'App\Product')->whereNull('deleted_at')->get();
        return view('theme.template.product.edit_product', compact('departments', 'categories', 'product'));
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
            'get_department' => '',
            'get_category' => '',
            'get_type' => 'required|string',
            'unit' => 'required|string',
            'stock' => 'required|between:0,99999.99',
            'new_category-ge' => '',
            'new_category-ru' => '',
            'new_category-en' => '',
            'editor-ge' => 'required',
            'editor-ru' => '',
            'editor-en' => '',
            'price' => 'required',
            'images[]' => 'image'
        ]);
        $product->title_ge = $request->input('title_ge');
        $product->title_ru = $request->input('title_ru');
        $product->title_en = $request->input('title_en');
        $product->description_ge = $request->input('editor-ge');
        $product->description_ru = $request->input('editor-ru');
        $product->description_en = $request->input('editor-en');
        $product->type = $request->input('get_type');
        $product->unit = $request->input('unit');
        $product->stock = $request->input('stock');
        $product->department_id = $request->input('get_department');
        $product->price = intval($request->input('price')*100);
        $product->save();
        if($request->input('new_category_ge') || $request->input('new_category_ru') || $request->input('new_category_en')){
            $cat = $product->category()->create([
                'title_ge' => $request->input('new_category_ge'),
                'title_ru' => $request->input('new_category_ru'),
                'title_en' => $request->input('new_category_en'),
            ]);
            $product->category_id = $cat->id;
            $product->save();
        }else if($request->input('get_category')){
            $product->category_id = (int)$request->input('get_category');
            $product->save();
        }
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
        $product->deleted_at = Carbon::now('Asia/Tbilisi');
        $product->save();
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
}
