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
        $service = Service::findOrFail($this->id);
        $export = $service->clientsOnService;
        foreach ($export as  $item) {
            $item['service_name'] = $item->getServiceName();
            $item['client'] = $item->clinetserviceable()->first()->{'full_name_'.app()->getLocale()};
            $item['worker'] = $item->getWorkerName();
            $item['service_price'] = $item->getServicePrice();
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
        }
        return $export;
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
