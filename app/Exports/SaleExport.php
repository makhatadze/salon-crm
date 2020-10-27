<?php

namespace App\Exports;

use App\Order;
use App\Sale;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SaleExport implements FromCollection, WithHeadings
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
        $orders = Order::where('sale_id', $this->id)->get();
        foreach ($orders as $key => $item) {
            $item['client_name'] = $item->sale->client->{"full_name_".app()->getLocale()};
            $item['client_number'] = $item->sale->client->number;
            $item['product_name'] = $item->product->{"title_".app()->getLocale()};
            $item['product_price'] = $item->product->price/100;
            $item['currency'] = $item->product->currency_type;
            $item['seller'] = $item->sale->user->profile->first_name .' '. $sale->user->profile->last_name;
            $item['quant'] = $item->quantity;
            $item['currency'] = $item->product->unit;
            unset($item['id']);
            unset($item['sale_id']);
            unset($item['product_id']);
            unset($item['quantity']);
            unset($item['price']);
            unset($item['updated_at']);
            unset($item['deleted_at']);
        }
        return $orders;
    }
    public function headings(): array
    {
        return [
            'დრო',
            'კლიენტი',
            'კლიენტის ნომერი',
            'პროდუქტი',
            'პროდუქტის ფასი',
            'პროდუქტის ერთეული',
            'გამყიდველი',
            'რაოდენობა',
        ];
    }
}
