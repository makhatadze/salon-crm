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

use Illuminate\Http\Request;
use App\Service;
use App\Category;
class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::paginate(30);
        return view('theme.template.service.services', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $action = "post";
        return view('theme.template.service.add_service', compact('action', 'categories'));
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
            'title-ge' => 'required',
            'title-en' => '',
            'title-ru' => '',
            'editor-ge' => 'required',
            'editor-en' => '',
            'editor-ru' => '',
            'duration-ge' => '', 
            'duration-en' => '', 
            'duration-ru' => '', 
            'price' => 'required|between:0,99.99',
            'unit-ge' => '',
            'unit-en' => '',
            'unit-ru' => '',
            'file' => 'image'
         ]);
         $service = new Service;
         $service->title_ge = $request->input('title-ge');
         $service->title_en = $request->input('title-en');
         $service->title_ru = $request->input('title-ru');
         $service->body_ge = $request->input('editor-ge');
         $service->body_en = $request->input('editor-en');
         $service->body_ru = $request->input('editor-ru');
         $service->duration_ge = $request->input('duration-ge');
         $service->duration_ru = $request->input('duration-ru');
         $service->duration_en = $request->input('duration-en');
         $service->unit_ge = $request->input('unit-ge');
         $service->unit_ru = $request->input('unit-ru');
         $service->unit_en = $request->input('unit-en');
         $service->price = intval($request->input('price')*100);
         $service->save();
         
         if($request->input('category-ge') || $request->input('category-en') || $request->input('category-ru')){

            $service->category()->create([
                'title' => $request->input('category-ge'),
                'title_ru' => $request->input('category-ru'),
                'title_en' => $request->input('category-en'),
             ]);
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
        return view('theme.template.service.edit_service', compact('service',));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {

        $this->validate($request,[
            'title-ge' => 'required',
            'title-en' => '',
            'title-ru' => '',
            'editor-ge' => 'required',
            'editor-en' => '',
            'editor-ru' => '',
            'duration-ge' => '', 
            'duration-en' => '', 
            'duration-ru' => '', 
            'price' => 'required|between:0,99.99',
            'unit-ge' => '',
            'unit-en' => '',
            'unit-ru' => '',
            'file' => 'image'
         ]);
     $service->title_ge = $request->input('title-ge');
     $service->title_en = $request->input('title-en');
     $service->title_ru = $request->input('title-ru');
     $service->body_ge = $request->input('editor-ge');
     $service->body_en = $request->input('editor-en');
     $service->body_ru = $request->input('editor-ru');
     $service->duration_ge = $request->input('duration-ge');
     $service->duration_ru = $request->input('duration-ru');
     $service->duration_en = $request->input('duration-en');
     $service->unit_ge = $request->input('unit-ge');
     $service->unit_ru = $request->input('unit-ru');
     $service->unit_en = $request->input('unit-en');
     $service->price = intval($request->input('price')*100);
     dd($service->category()->first());
      
     $service->save();
         if($request->input('category-ge') || $request->input('category-en') || $request->input('category-ru')){

            $service->category()->first()->delete();
            $service->category()->create([
                'title' => $request->input('category-ge'),
                'title_ru' => $request->input('category-ru'),
                'title_en' => $request->input('category-en'),
             ]);
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect('/services');
    }

    //Service Turn off

    public function turn(Service $service, $status){
        $service->published = $status;
        $service->save();
        return redirect('/services');
    }

    //For Ajax
    public function getcategory(Request $request){
        $data = Category::where('title', 'like', '%'.$request->input('value').'%')->take(4);

         return response()->json($data);
    }
    //Service Categories
    public function categories(){
        $categories = Category::paginate(50);
        return view('theme.template.main.categories', compact('categories'));
    }
    public function removecategory($id){
        $Category = Category::findorfail($id);
        $Category->delete();
        return redirect('/servicecategories');
    }

}
