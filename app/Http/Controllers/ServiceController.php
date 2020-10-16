<?php
/**
 *  app/Http/Controllers/ServiceController.php
 *
 * User:
 * Date-Time: 31.08.20
 * Time: 13:55
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Service;
use App\ClientService;
use App\Category;
use App\Exports\ServiceExport;
use App\Product;
use App\Image;
use App\Inventory;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $queries = [
            'title',
            'unit',
            'pricefrom',
            'pricetill'
        ];
        $services = Service::orderBy('id', 'DESC');
        foreach ($queries as $req) {
            if(request($req)){
                if($req == 'title'){
                    $services = $services->where('title_'.app()->getLocale(), 'like', '%'.request($req).'%');
                }elseif($req == "unit"){
                    $services = $services->where('unit_'.app()->getLocale(), 'like', '%'.request($req).'%');
                }elseif($req == "pricefrom"){
                    $services = $services->where('price', '>=', request($req)*100);
                }elseif($req == "pricetill"){
                    $services = $services->where('price', '<=', request($req)*100);
                }
                $queries[$req] = request($req);
            }
        }
        $services = $services->paginate(30)->appends($queries);
        return view('theme.template.service.services', compact('services', 'queries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('model_name', 'App\Service')->get();
        $inventories = Product::where([['published', true], ['type', 2], ['warehouse', false]])->get();
        $action = "post";
        return view('theme.template.service.add_service', compact('action', 'categories', 'inventories'));
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
            'title_ge' => 'required',
            'title_en' => '',
            'title_ru' => '',
            'editor-ge' => 'required',
            'editor-en' => '',
            'editor-ru' => '',
            'duration_hours' => 'required|integer|min:0',
            'duration_minutes' => 'required|integer|min:0|max:60',
            'category' => '',
            'price' => 'required|between:0,9999.99|numeric',
            'unit-ge' => '',
            'unit-en' => '',
            'unit-ru' => '',
            'file' => 'image',
            'currency' => 'required|string',
            'inventory' => '',
            'quantity' => '',
            'new_category' => ''
        ]);
        $duration = ($request->input('duration_hours')*60)+$request->input('duration_minutes');
        $service = new Service;
        if($request->input('new_category') != ""){
         $category = new Category;
         $category->title_ge = $request->input('new_category');
         $category->model_name = "App\Service";
         $category->save();
         $service->category_id = $category->id;
        }else{
         $service->category_id = $request->input('category');
        }
        $service->title_ge = $request->input('title_ge');
        $service->title_en = $request->input('title_en');
        $service->title_ru = $request->input('title_ru');
        $service->body_ge = $request->input('editor-ge');
        $service->body_en = $request->input('editor-en');
        $service->body_ru = $request->input('editor-ru');
        $service->currency_type = $request->input('currency');
        $service->duration_count = $duration;
        $service->unit_ge = $request->input('unit-ge');
        $service->unit_ru = $request->input('unit-ru');
        $service->unit_en = $request->input('unit-en');
        $service->price = intval($request->input('price')*100);


        $service->save();
        $array = array();
        if($request->input('inventory') && $request->input('quantity')){
            foreach($request->input('inventory') as $key => $item){
                $array[] =[
                    'product_id' => $request->input('inventory')[$key],
                    'quantity' => $request->input('quantity')[$key],
                ];
            }
            $service->inventories()->createMany($array);
        }

        if($request->hasFile('file')){
            $imagename = date('Ymhs').$request->file('file')->getClientOriginalName();
            $destination = base_path() . '/storage/app/public/serviceimg';
            $request->file('file')->move($destination, $imagename);
            $service->image()->create([
                'name' => $imagename
            ]);
        }
        return redirect('/services');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        $categories = Category::where('model_name', 'App\Service')->get();
        $inventories = Product::where([['published', true], ['type', 2], ['warehouse', false]])->get();
        return view('theme.template.service.edit_service', compact('service', 'inventories', 'categories'));
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
        $service = Service::findOrFail($id);
        $this->validate($request,[
            'title_ge' => 'required',
            'title_en' => '',
            'title_ru' => '',
            'editor-ge' => 'required',
            'editor-en' => '',
            'editor-ru' => '',
            'duration_hours' => 'required|integer|min:0',
            'duration_minutes' => 'required|integer|min:0|max:60',
            'category' => '',
            'price' => 'required|between:0,9999.99|numeric',
            'currency' => 'required|string',
            'unit-ge' => '',
            'unit-en' => '',
            'unit-ru' => '',
            'file' => 'image',
            'inventory' => '',
            'quantity' => '',
            'new_category' => ''
        ]);
        
        $duration = ($request->input('duration_hours')*60)+$request->input('duration_minutes');
        if($request->input('new_category') != ""){
         $category = new Category;
         $category->title_ge = $request->input('new_category');
         $category->model_name = "App\Service";
         $category->save();
         $service->category_id = $category->id;
        }else{
         $service->category_id = $request->input('category');
        }
        $service->title_ge = $request->input('title_ge');
        $service->title_en = $request->input('title_en');
        $service->title_ru = $request->input('title_ru');
        $service->body_ge = $request->input('editor-ge');
        $service->body_en = $request->input('editor-en');
        $service->currency_type = $request->input('currency');
        $service->body_ru = $request->input('editor-ru');
        $service->duration_count = $duration;
        $service->unit_ge = $request->input('unit-ge');
        $service->unit_ru = $request->input('unit-ru');
        $service->unit_en = $request->input('unit-en');
        $service->price = intval($request->input('price')*100);


        $service->save();
        $array = array();
        if($request->input('inventory') && $request->input('quantity')){
            foreach($request->input('inventory') as $key => $item){
                $array[] =[
                    'product_id' => $request->input('inventory')[$key],
                    'quantity' => $request->input('quantity')[$key],
                ];
            }
            $service->inventories()->createMany($array);
        }

        if($request->hasFile('file')){
            $imagename = date('Ymhs').$request->file('file')->getClientOriginalName();
            $destination = base_path() . '/storage/app/public/serviceimg';
            $request->file('file')->move($destination, $imagename);
            Storage::delete('public/serviceimg/'.$service->image->name);
            
            if($service->image){
                $firstimg = $service->image;
                $firstimg->name = $imagename;
                $firstimg->save();
            }else{
                $service->image()->create([
                    'name' => $imagename
                ]);
            }
        }
        return redirect('/services');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Service::findOrFail((int)$id);
        $clientservices = ClientService::where('service_id', (int)$id)->whereNull('deleted_at')->get();
        foreach($clientservices as $serv){
            $serv->deleted_at = Carbon::now('Asia/Tbilisi');
            $serv->save();
        }
        $service->deleted_at = Carbon::now('Asia/Tbilisi');
        $service->save();
        return redirect('/services');
    }

    //Service Turn off

    public function turn(Service $service, $status){
        $service->published = $status;
        $service->save();
        return redirect('/services');
    }


    //Get Unit Name for Inventory Product
    public function getunitname($id){
        $unit = Product::findOrFail($id);
        return response()->json(array('status'=>true, 'data' => $unit->unit));
    }

    //Remove Inventory
    public function removeinventory(Request $request){
        $this->validate($request, [
            'invid' => 'required|integer'
        ]);
        $inventory = Inventory::findOrFail($request->invid);
        if($inventory->delete()){
            return response()->json(array('status' => true));
        }
        return;
    }

    //Remove Image
    public function removeimage(Request $request){
        $this->validate($request, [
            'imgid' => 'required|integer'
        ]);
        $image = Image::findOrFail($request->imgid);
        if($image->delete()){
            return response()->json(array('status' => true));
        }
        return;
    }

    // Export Service
    public function exportservice($id)
    {
        return Excel::download(new ServiceExport($id), 'Service.xlsx');
    }
}
