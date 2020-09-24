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
            unset($purchase->updated_at);
            unset($purchase->deleted_at);
            if($purchase->purchase_type == "overhead"){
                $purchase->purchase_type = 'ზედნადები';
                unset($purchase->purchase_number);
            }else if($purchase->purchase_type == "purchase"){
                $purchase->purchase_type = 'შესყიდვის აქტით';
                unset($purchase->overhead_number);
            }
            $purchase['distributor_name'] = $purchase->distributor->{"name_".app()->getLocale()};
            $purchase['department_name'] = $purchase->department->{"name_".app()->getLocale()};
            $purchase['responsible_person'] = $purchase->getPersonName($purchase->responsible_person_id);
            $purchase['getter_person'] = $purchase->getPersonName($purchase->getter_person_id);
            unset($purchase->responsible_person_id);
            unset($purchase->getter_person_id);
            unset($purchase->office_id);
            unset($purchase->department_id);
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
            'შექმნის თარიღი',
            'დისტრიბუტორი',
            'დეპარტამენტი',
            'პასუხისმგებელი პირი',
            'მიმღები პირი',
        ];
    }
}
