<?php

namespace App\Http\Controllers;

use App\Department;
use App\Company;
use App\Exports\DepartmentExport;
use App\Exports\DepartmentServices;
use App\Office;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DepartmentController extends Controller
{
    /**
     * 
     * @param \App\Department $department  
     * @return excel
     */
    public function exportdepartment(Department $department)
    {
        return Excel::download(new DepartmentExport($department->id), $department->{"name_".app()->getLocale()}.'-Users.xlsx');
    }
    /**
     * 
     * @param App\Department $department
     * @return excel
     */
    public function exportservices(Department $department)
    {
        return Excel::download(new DepartmentServices($department->id), $department->{"name_".app()->getLocale()}.'-Services.xlsx');
    }
}
