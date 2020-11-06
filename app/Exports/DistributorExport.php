<?php

namespace App\Exports;

use App\DistributionCompany;
use App\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DistributorExport implements FromCollection, WithHeadings
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
        $purchases = DistributionCompany::findOrFail($this->id)->purchases()->select('id')->get();
        $productids = [];
        foreach ($purchases as $item) {
            $productids += $item->products()->select('id')->where([['warehouse', 0], ['writedown', 0]])->get()->toArray();
        }
        $products = Product::whereIn('id', $productids)->get();
        foreach($products as $prod){
            
            unset($prod['category_id']);
            unset($prod['description_ge']);
            unset($prod['description_ru']);
            unset($prod['description_en']);
            unset($prod['deleted_at']);
            $prod->title_ge = $prod->title_ge;
            unset($prod['title_ru']);
            unset($prod['title_en']);
            if($prod->type == 2){
                $prod->type = "ხარჯთმასალა";
            }elseif($prod->type == 1){
                $prod->type = "ძირითადი საშუალება";
            }
            if($prod->unit == "gram"){
                $prod->unit = "გრამი";
            }elseif($prod->unit == "metre"){
                $prod->unit = "მეტრი";
            }elseif($prod->unit == "unit"){
                $prod->unit = "ერთეული";
            }
            $prod['purchase'] = $prod->purchase->overhead_number ? $prod->purchase->overhead_number : $prod->purchase->purchase_number;
            unset($prod['purchase_id']);
            $prod['department'] = $prod->department->name_ge;
            unset($prod['department_id']);
            unset($prod['warehouse']);
            $prod['brand'] = $prod->brand->name;
            $prod['storage'] = $prod->storage->name;
            unset($prod['brand_id']);
            unset($prod['storage_id']);
            unset($prod['writedown']);
            $prod['author'] = $prod->getResponsiblePerson();
            unset($prod['user_id']);
        }
        return $products;
    }
    public function headings(): array
    {
        return [
            '#',
            'სახელი',
            'ფასი',
            'ტიპი',
            'რაოდენობა',
            'ერთეული',
            'სტატუსი',
            'დამატების თარიღი',
            'განახლების თარიღი',
            'ვატულა',
            'ექსპლუატაციის დაწყების თარიღი',
            'ექსპლუატაციის ხანგრძლივობა(დღე)',
            'შეუზღუდავი ექსპლუატაცია',
            'შესყიდვის ფასი',
            'შესყიდვის ნომერი',
            'დეპარტამენტი',
            'ბრენდი',
            'საწყობი',
            'ვინ დაამატა',
        ];
    }
}
