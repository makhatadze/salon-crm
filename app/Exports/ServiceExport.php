<?php

namespace App\Exports;

use App\Service;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ServiceExport implements FromCollection, WithHeadings
{
    protected $id;

    function __construct($id) {
            $this->id = $id;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $services = Service::findOrFail($this->id)->clientsOnService;
        foreach ($services as  $item) {
            $item['service_name'] = $item->service->title_ge;
            $item['service_price'] = $item->service->price/100;
            $item['service_endtime'] = $item->getEndTime();
            $item['user_name'] = $item->user->profile->first_name .' '. $item->user->profile->last_name;
            $item['department_name'] = $item->user->getDepartmentName();
            $item['author_name'] = $item->getAuthorName();
            $item['updated_price'] = $item->new_price / 100;
            $item['client_number'] = $item->clinetserviceable->number;
            $item['client_name'] = $item->clinetserviceable->full_name_ge;
            unset($item->user_id);
            unset($item->service_id);
            unset($item->new_price);
            unset($item->paid);
            unset($item->currency_type);
            unset($item->department_id);
            unset($item->pay_method_id);
            unset($item->author);
            unset($item->clinetserviceable_type);
            unset($item->session_endtime);
            unset($item->clinetserviceable_id);
            unset($item->updated_at);
            unset($item->deleted_at);
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
            __('serviceexport.duration'),
            __('serviceexport.service'),
            __('serviceexport.serviceoriginalprice'),
            __('serviceexport.endtime'),
            __('serviceexport.employee'),
            __('serviceexport.department'),
            __('serviceexport.author'),
            __('serviceexport.newprice'),
            __('serviceexport.clientnumber'),
            __('serviceexport.clientname'),
        ];
    }
}
