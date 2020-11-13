<?php

namespace App\Exports;

use App\ClientService;
use App\Service;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ServicesExport implements FromCollection, WithHeadings
{
       /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $services = ClientService::all();
        foreach($services as $serv){
            $serv['worker'] = $serv->user->profile->first_name .' '.$serv->user->profile->last_name;
            unset($serv->user_id);
            $serv['servicename'] = $serv->service->title_ge;
            unset($serv->service_id);
            $serv['clientname'] = $serv->clinetserviceable->full_name_ge;
            unset($serv->clinetserviceable_type);
            unset($serv->clinetserviceable_id);
            unset($serv->updated_at);
            unset($serv->deleted_at);
            unset($serv->pay_method_id);
            unset($serv->department_id);
            $serv['author'] = $serv->getAuthorName();
            $serv->new_price = $serv->new_price/100;
            $serv->paid = $serv->paid/100;
            unset($serv->author);
            $serv['spendonproducts'] = number_format($serv->spendonproducts()/100, 2);
            $serv['getspendonproducts'] = number_format($serv->getspendonproducts()/100, 2);
        }
        return $services;
    }
    public function headings(): array
    {
        return [
            '#',
            __('serviceexport.servicestart'),
            __('serviceexport.status'),
            __('serviceexport.register'),
            __('serviceexport.pay'),
            __('serviceexport.newprice'),
            __('serviceexport.duration'),
            __('serviceexport.endtime'),
            __('serviceexport.paid'),
            __('serviceexport.author'),
            __('serviceexport.service'),
            __('serviceexport.clientname'),
            __('serviceexport.spendonproducts'),
            __('serviceexport.getspendonproducts'),
        ];
    }
}
