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
            $purchase['distributor_name'] = $purchase->distributor->{"name_".app()->getLocale()};
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
            'შესყიდვის ტიპი',
            'შესყიდვის ნომერი',
            'შესყიდვის თარიღი',
            'დღღ',
            'ბოლო განახლება',
            'გადახდილი',
            'დავალიანება',
            'დისტრიბუტორი',
        ];
    }
}
