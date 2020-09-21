<?php

namespace App\Exports;

use App\ClientService;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FinanceExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $clientServices = ClientService::whereNull('deleted_at')->get();
        foreach ($clientServices as $clService) {
            $status = $clService['status'];
            $payMethod = $clService['pay_method'];
            $startTime = $clService['session_start_time'];
            unset($clService['session_start_time']);
            unset($clService['status']);
            unset($clService['pay_method']);
            unset($clService['created_at']);
            unset($clService['updated_at']);

            $clService['full_name'] = $clService->clinetserviceable()->first()->{"full_name_" . app()->getLocale()};
            $clService['service_name'] = $clService->getServiceName();
            $clService['price'] = $clService->getServicePrice();
            $clService['pay_method'] = __('pay.' . $payMethod);
            $clService['session_start_time'] = $startTime;
            if ($status) {
                $clService['status'] = 'მიღებულია';
            } else if (Carbon\Carbon::now() > $startTime) {
                $clService['status'] = 'არ მოსულა';
            } else if (Carbon\Carbon::now() < $startTime) {

                $clService['status'] = 'ველოდებით';

            }
            unset($clService['deleted_at']);
            unset($clService['id']);
            unset($clService['user_id']);
            unset($clService['service_id']);
            unset($clService['clinetserviceable_type']);
            unset($clService['clinetserviceable_id']);
        }
        return $clientServices;


    }

    public function headings(): array
    {
        return [
            'კლიენტის სახელი',
            'სერვისი',
            'თანხა',
            'გადახდის მეთოდი',
            'გადახდის დრო',
            'სტატუსი',
        ];
    }
}
