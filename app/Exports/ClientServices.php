<?php

namespace App\Exports;

use App\Client;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ClientServices implements FromCollection, WithHeadings
{
    public $id;
    
    function __construct($id) {
        $this->id = $id;
}
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $Client = Client::findOrFail($this->id);
        $services = $Client->clientservices()->get();
        foreach ($services as  $item) {
            $item['service_name'] = $item->service->{"title_".app()->getLocale()};
            $item['client'] = $item->clinetserviceable->{'full_name_'.app()->getLocale()};
            $item['worker'] = $item->user->profile->first_name .' '. $item->user->profile->last_name;;
            $item['service_price'] = $item->service->price/100;
            $item['start_tyime'] = $item->session_start_time;
            $item['end_time'] = $item->getEndTime();
            unset($item->id);
            unset($item->clinetserviceable_type);
            unset($item->created_at);
            unset($item->updated_at);
            unset($item->deleted_at);
            unset($item->clinetserviceable_id);
            unset($item->user_id);
            unset($item->session_start_time);
            unset($item->service_id);
            unset($item->department_id);
        }
        return $services;
    }
    public function headings(): array
    {
        return [
            'სტატუსი',
            'გადახდის მეთოდი',
            'სერვისის სახელი',
            'კლიენტი',
            'მიმღები',
            'ფასი',
            'მისვლის დრო',
            'სესსის დასრულების დრო',
        ];
    }
}
