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
            $service['service_name'] = $service->service->title_ge;
            $service['worker_name'] = $service->user->profile->first_name .' '. $service->user->profile->last_name;
            $service['client_name'] = $service->clinetserviceable->full_name_ge;
            $service['client_phone'] = $service->clinetserviceable->number;
            $service['client_address'] = $service->clinetserviceable->address;
            $service['serviceprice'] = $service->service->price/100;
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
            __('clientexport.sessiondate'),
            __('clientexport.status'),
            __('clientexport.createdate'),
            __('clientexport.updatedate'),
            __('clientexport.paymethod'),
            __('clientexport.name'),
            __('clientexport.personal'),
            __('clientexport.clientname'),
            __('clientexport.phone'),
            __('clientexport.address'),
            __('clientexport.price'),
        ];
    }
}
