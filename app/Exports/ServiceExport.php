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
            $item['service_name'] = $item->service->{"title_".app()->getLocale()};
            $item['service_price'] = $item->service->price/100;
            $item['service_currency'] = $item->service->currency_type;
            $item['service_endtime'] = $item->getEndTime();
            $item['user_name'] = $item->user->profile->first_name .' '. $item->user->profile->last_name;
            $item['department_name'] = $item->user->getDepartmentName();
            $item['author_name'] = $item->getAuthorName();
            $item['updated_price'] = $item->new_price / 100;
            $item['client_number'] = $item->clinetserviceable->number;
            $item['client_name'] = $item->clinetserviceable->{'full_name_'.app()->getLocale()};
            unset($item->user_id);
            unset($item->service_id);
            unset($item->new_price);
            unset($item->paid);
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
            'სერვისის დაწყების დრო',
            'სტატუსი',
            'რეგისტრაციის დრო',
            'გადახდის მეთოდი',
            'ხანგრძლივობა (წთ)',
            'სერვისი',
            'სერვისის ორიგინალი ფასი',
            'სერვისის ფასის ვალუტა',
            'დასრულების დრო',
            'თანამშრომელი',
            'დეპარტამენტი',
            'ავტორი',
            'განახლებული ფასი',
            'კლიენტის ნომერი',
            'კლიენტის სახელი',
        ];
    }
}
