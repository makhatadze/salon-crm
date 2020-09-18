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
            $service['service_name'] = $service->getServiceName();
            $service['worker_name'] = $service->getWorkerName();
            $service['client_name'] = $service->clinetserviceable()->first()->{'full_name_'.app()->getLocale()};
            $service['client_phone'] = $service->clinetserviceable()->first()->number;
            $service['client_address'] = $service->clinetserviceable()->first()->address;
            unset($service['user_id']);
            unset($service['service_id']);
            unset($service['deleted_at']);
            unset($service['clinetserviceable_id']);
            unset($service['clinetserviceable_type']);
        }
        return $services;
    }
    public function headings(): array
    {
        return [
            '#',
            'სესიის თარიღი',
            'სტატუსი',
            'რეგისტრაციის თარიღი',
            'განახლების თარიღი',
            'სერვისის სახელი',
            'მიმღები',
            'კლიენტის სახელი',
            'მობილური',
            'მისამართი'
        ];
    }
}
