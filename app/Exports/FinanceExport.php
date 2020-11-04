<?php

namespace App\Exports;

use App\Client;
use App\ClientService;
use App\Sale;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FinanceExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $sales = Sale::all();
        foreach ($sales as $sale) {
            $sale['clientname'] = $sale->client->{"full_name_".app()->getLocale()};
            $sale['seller'] = $sale->user->profile->first_name .' '. $sale->user->profile->last_name;
            unset($sale->client_id);
            unset($sale->deleted_at);
            unset($sale->pay_method_id);
            unset($sale->seller_id);
            $sale->total = number_format($sale->total/100, 2);
            $sale->paid = number_format($sale->paid/100, 2);
        }
        return $sales;


    }

    public function headings(): array
    {
        return [
            '#',
            'მისამართი',
            'შექმნის დრო',
            'განახლების დრო',
            'გადახდის მეთოდი',
            'ფასი',
            'გადახდილი',
            'კლიენტი',
            'მოლარე',
        ];
    }
}
