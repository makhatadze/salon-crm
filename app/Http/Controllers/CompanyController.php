<?php

namespace App\Http\Controllers;

use App\Company;
use App\Office;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::whereNull('deleted_at')->paginate(10);
        return view('theme.template.company.companies', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = 'create';
        return view('theme.template.company.add_company', compact('action'));
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
            'title-ge' => 'required|string',
            'title-ru' => '',
            'title-en' => '',
            'editor-ge' => 'required',
            'editor-ru' => '',
            'editor-en' => '',
            'office-name-ge' => 'required|string',
            'address-ge' => 'required|string',
            'office-name-en' => '',
            'address-en' => '',
            'office-name-ru' => '',
            'address-ru' => '',
        ]);
        $company = new Company;
        $company->title_ge = $request->input('title-ge');
        $company->title_ru = $request->input('title-ru');
        $company->title_en = $request->input('title-en');
        $company->description_ge = $request->input('editor-ge');
        $company->description_ru = $request->input('editor-ru');
        $company->description_en = $request->input('editor-en');
        $company->save();
        $company->offices()->create([
            'name_ge' => $request->input('office-name-ge'),
            'address_ge' => $request->input('address-ge'),
            'name_en' => $request->input('office-name-en'),
            'address_en' => $request->input('address-en'),
            'name_ru' => $request->input('office-name-ru'),
            'address_ru' => $request->input('address-ru'),
        ]);
        return redirect('/companies');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::findOrFail($id);
        if($company->deleted_at != null){
            return redirect('/companies');
        }
        return view('theme.template.company.edit_company', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $company = Company::findOrFail($id);
        if($company->deleted_at != null){
            return redirect('/companies');
        }
        $this->validate($request, [
            'title-ge' => 'required|string|min:3',
            'title-ru' => '',
            'title-en' => '',
            'editor-ge' => 'required',
            'editor-ru' => '',
            'editor-en' => '',
        ]);
        $company->title_ge = $request->input('title-ge');
        $company->title_ru = $request->input('title-ru');
        $company->title_en = $request->input('title-en');
        $company->description_ge = $request->input('editor-ge');
        $company->description_ru = $request->input('editor-ru');
        $company->description_en = $request->input('editor-en');
        $company->save();
        return redirect('/companies');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        if($company->deleted_at != null){
            return redirect('/companies');
        }
        foreach($company->offices('deleted_at', null)->get() as $office){
            foreach($office->departments('deleted_at', null)->get() as $dept){
                $dept->deleted_at = Carbon::now('Asia/Tbilisi');
                $dept->save();
            }
            $office->deleted_at = Carbon::now('Asia/Tbilisi');
            $office->save();
        }
        $company->deleted_at = Carbon::now('Asia/Tbilisi');
        $company->save();
        return redirect('/companies');
    }
    //Office Controllers
    public function createoffice($id){
        $company = Company::findOrFail($id);
        if($company->deleted_at != null){
            return redirect('/companies');
        }
        return view('theme.template.company.add_office', compact('company'));
    }
    public function storeoffice(Request $request, $id){
        $this->validate($request, [
            'office-name-ge' => 'required|string',
            'office-name-en' => '',
            'office-name-ru' => '',
            'address-ge' => 'required|string',
            'address-ge' => '',
            'address-ge' => '',
        ]);
        $id = (int)$id;
        $company = Company::findOrFail($id);
        if($company->deleted_at != null){
            return redirect('/companies');
        }
        $company->offices()->create([
            'name_ge' => $request->input('office-name-ge'),
            'address_ge' => $request->input('address-ge'),
            'name_en' => $request->input('office-name-en'),
            'address_en' => $request->input('address-en'),
            'name_ru' => $request->input('office-name-ru'),
            'address_ru' => $request->input('address-ru'),
        ]);
        return redirect('/companies');
    }
    //Show Registered Offices
    public function getoffices(){
        $companies = Company::wherenull('deleted_at')->get();
        return view('theme.template.company.offices', compact('companies'));
    }
    public function removeoffice($id){
        $office = Office::findOrFail($id);
        if(Office::where('officeable_id', $office->officeable_id)->count() == 1){
            return redirect('/companies/offices');
        }
        foreach($office->departments()->where('deleted_at', null)->get() as $dept){
            $dept->deleted_at = Carbon::now('Asia/Tbilisi');
            $dept->save();
        }
        $office->deleted_at = Carbon::now('Asia/Tbilisi');
        $office->save();
        return redirect('/companies/offices');
    }
}
