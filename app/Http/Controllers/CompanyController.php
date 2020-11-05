<?php

namespace App\Http\Controllers;

use App\Company;
use App\Office;
use App\DistributionCompany;
use App\Exports\DistributorExport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::wherenull('deleted_at')->findOrFail($id);
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
        $company = Company::wherenull('deleted_at')->findOrFail($id);
        $this->validate($request, [
            'title-ge' => 'required|string|min:3',
            'title-ru' => '',
            'title-en' => '',
            'code' => '',
            'editor-ge' => 'required',
            'editor-ru' => '',
            'editor-en' => '',
        ]);
        $company->title_ge = $request->input('title-ge');
        $company->title_ru = $request->input('title-ru');
        $company->title_en = $request->input('title-en');
        $company->code = $request->input('code');
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
        $company = Company::wherenull('deleted_at')->findOrFail($id);
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
    //Show Registered Offices
    public function getoffices(){
        $companies = Company::wherenull('deleted_at')->get();
        return view('theme.template.company.offices', compact('companies'));
    }
    public function removeoffice($id){
        $office = Office::wherenull('deleted_at')->findOrFail($id);
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
    //Distribution Company
    public function distcompany(){
        $distcompanies = DistributionCompany::whereNull('deleted_at')->paginate(25);
        return view('theme.template.company.dist_company', compact('distcompanies'));
    }
    public function distcreate(){
        return view('theme.template.company.add_dist_company');
    }
    public function distedit($id){
        $distribution = DistributionCompany::wherenull('deleted_at')->findOrFail($id);
        return view('theme.template.company.edit_dist_company', compact('distribution'));
    }
    public function diststore(Request $request){
        $this->validate($request, [
            'code' => 'required',
            'name_ge' => 'required',
            'name_ru' => '',
            'name_en' => '',
            'address' => '',
            'phone' => '',
            'contact_to' => '',
        ]);

        $discompany = new DistributionCompany;
        $discompany->code = $request->input('code');
        $discompany->name_ge = $request->input('name_ge');
        $discompany->name_ru = $request->input('name_ru');
        $discompany->name_en = $request->input('name_en');
        $discompany->address = $request->input('address');
        $discompany->phone = $request->input('phone');
        $discompany->contact_to = $request->input('contact_to');
        $discompany->save();
        return redirect('/companies/distcompany');
    }
    public function distupdate(Request $request, $id){
        $this->validate($request, [
            'code' => 'required',
            'name_ge' => 'required',
            'name_ru' => '',
            'name_en' => '',
            'address' => '',
            'phone' => '',
            'contact_to' => '',
        ]);
        $discompany = DistributionCompany::wherenull('deleted_at')->findOrFail($id);
        $discompany->code = $request->input('code');
        $discompany->name_ge = $request->input('name_ge');
        $discompany->name_ru = $request->input('name_ru');
        $discompany->name_en = $request->input('name_en');
        $discompany->address = $request->input('address');
        $discompany->phone = $request->input('phone');
        $discompany->contact_to = $request->input('contact_to');
        $discompany->save();
        return redirect('/companies/distcompany');
    }
    public function distdelete($id){
        $discompany = DistributionCompany::wherenull('deleted_at')->findOrFail($id);
        $discompany->deleted_at = Carbon::now('Asia/Tbilisi');
        $discompany->save();
        return redirect('/companies/distcompany');
    }
    public function distributorexport(DistributionCompany $distcompany)
    {
        
        return Excel::download(new DistributorExport($distcompany->id), $distcompany->{'name_'.app()->getLocale()}.'.xlsx');
    }
}
