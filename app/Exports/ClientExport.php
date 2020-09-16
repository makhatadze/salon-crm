<?php

namespace App\Exports;

use App\ClientService;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class ClientExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $array = array();
        $services =  ClientService::all();
        foreach($services as $service){
            unset($service['created_at']);
        }
        dd($services);
        return $array;
    }
    public function headings(): array
    {
        return [
            'სერვისის სახელი',
            'რეგისტრაციის თარიღი',
            'სესიის თარიღი',
            'სტატუსი',
            'მიმღები',
            'კლიენტის სახელი',
            'მობილური',
            'მისამართი'
        ];
    }
}
