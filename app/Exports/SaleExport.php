<?php

namespace App\Exports;

use App\Order;
use App\Product;
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
        $orders = Order::select('product_id')->where('sale_id', $this->id)->get()->toArray();
        $products = Product::whereIn('id', $orders)->get(); 
        foreach($products as $prod){
            
            unset($prod['category_id']);
            unset($prod['description_ge']);
            unset($prod['description_ru']);
            unset($prod['description_en']);
            unset($prod['deleted_at']);
            $prod->title_ge = $prod->{'title'.app()->getLocale()};
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
            $prod['department'] = $prod->department->{'name_'.app()->getLocale()};
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
