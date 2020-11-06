<?php

namespace App\Http\Controllers;

use App\Exports\PayMethodExport;
use App\PayController;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PayControllerController extends Controller
{
    public function exportmethod(PayController $pay)
    {
        return Excel::download(new PayMethodExport($pay->id), 'Service.xlsx');
    }
}
