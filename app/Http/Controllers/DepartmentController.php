<?php

namespace App\Http\Controllers;

use App\Department;
use App\Company;
use App\Office;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::whereNull('deleted_at')->paginate(10);
        return view('theme.template.company.departments', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = "create";
        $companies = Company::select('id', 'title_ge', 'title_ru', 'title_en')->whereNull('deleted_at')->get();
        return view('theme.template.company.add_department', compact('action', 'companies'));
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
            'department-name-ge' => 'required|string',
            'address-ge' => 'required|string',
            'department-name-ru' => '',
            'address-ru' => '',
            'department-name-en' => '',
            'address-en' => '',
            'office-id' => 'required|integer',
        ]);
        $office = Office::findOrFail($request->input('office-id'));

        if($office){
            $office->departments()->create([
                'name_ge' => $request->input('department-name-ge'),
                'address_ge' => $request->input('address-ge'),
                'name_ru' => $request->input('department-name-ru'),
                'address_ru' => $request->input('address-ru'),
                'name_en' => $request->input('department-name-en'),
                'address_en' => $request->input('address-en'),
            ]);
        }
        return redirect('/companies/departments');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        $department->deleted_at = Carbon::now('Asia/Tbilisi');
        $department->save();
        return redirect('/companies/departments');
    }
}
