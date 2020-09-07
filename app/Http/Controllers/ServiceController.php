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
use App\ServiceCategory;
class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('theme.template.service.services');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('theme.template.service.add_service');
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
           'title' => 'required',
           'editor' => 'required',
           'duration' => '', 
           'price' => '',
           'unit' => '',
           'file' => 'image'
        ],
    [
        'title.required' => 'სათაური არ არის შეყვანილი',
        'editor.required' => 'აღწერა არ არის შეყვანილი',
    ]);
    $units = implode( ',', $request->input('unit'));
        $service = new Service;
        $service->title = $request->input('title');
        $service->body = $request->input('editor');
        $service->duration = $request->input('duration');
        $service->price = $request->input('price');
        $service->unit = $units;
        $service->save();
        if($request->input('category')){

            $service->servicecategories()->create([
                'title' => $request->input('category')
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
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getcategory(Request $request){
        $search = ServiceCategory::select('title')->where('title', 'like', '%'.$request->input('value').'%')->groupby('title')->take(3);
        return response()->json(['status' => true, 'result' => $search]);
    }

}
