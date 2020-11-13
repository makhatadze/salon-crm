<?php

namespace App\Exports;

use App\Purchase;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class PurchaseExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $purchases = Purchase::whereNull('deleted_at')->get();
        foreach($purchases as $purchase){
            unset($purchase->array);
            unset($purchase->deleted_at);
            if($purchase->purchase_type == "overhead"){
                $purchase->purchase_type = 'ზედნადები';
                unset($purchase->purchase_number);
            }else if($purchase->purchase_type == "purchase"){
                $purchase->purchase_type = 'შესყიდვის აქტით';
                unset($purchase->overhead_number);
            }
            $purchase['dept'] = number_format($purchase->getPrice()/100, 2);
            $purchase['distributor_name'] = $purchase->distributor->name_ge;
            $purchase->paid = number_format($purchase->paid/100,2);
            unset($purchase->responsible_person_id);
            unset($purchase->getter_person_id);
            unset($purchase->office_id);
            unset($purchase->created_at);
            unset($purchase->pay_name);
            unset($purchase->department_id);
            unset($purchase->payment_id);
            unset($purchase->distributor_id);
        }
        return $purchases;
    }
    public function headings(): array
    {
        return [
            '#',
            __('purchaseexport.type'),
            __('purchaseexport.number'),
            __('purchaseexport.date'),
            __('purchaseexport.dgg'),
            __('purchaseexport.updated'),
            __('purchaseexport.paid'),
            __('purchaseexport.dept'),
            __('purchaseexport.distributor'),
        ];
    }
}
