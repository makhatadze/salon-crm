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
            $serv['servicename'] = $serv->service->{'title_'.app()->getLocale()};
            unset($serv->service_id);
            $serv['clientname'] = $serv->clinetserviceable->{'full_name_'.app()->getLocale()};
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
        }
        return $services;
    }
    public function headings(): array
    {
        return [
            '#',
            'დაწყების დრო',
            'სტატუსი',
            'დაჯავშნის დრო',
            'გადახდის მეთოდი',
            'ფასი',
            'ხანგრძლივობა (წთ)',
            'დასრულების დრო',
            'გადახდილი',
            'პერსონალი',
            'სერვისი',
            'კლიენტი',
        ];
    }
}
