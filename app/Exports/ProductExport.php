<?php

namespace App\Exports;

use App\Product;
use App\Inventory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class ProductExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $products = Product::whereNull('deleted_at')->get(); 
        foreach($products as $prod){
            unset($prod['description_ge']);
            unset($prod['description_ru']);
            unset($prod['description_en']);
            unset($prod['distributor_id']);
            unset($prod['deleted_at']);
            $prod['price'] = $prod->price/100;
            $prod['category_id'] = $prod->category->{"title_".app()->getLocale()};
            $prod['department_id'] = $prod->purchase->department->{"name_".app()->getLocale()};
            if($prod->purchase->purchase_type == "overhead"){
            $prod['purchase_number'] = $prod->purchase->overhead_number;
            }elseif($prod->purchase->purchase_type == "purchase"){
                $prod['purchase_number'] = $prod->purchase->purchase_number;}
            if($prod->type == 2){
                $prod->type = "ხარჯთმასალა";
            }elseif($prod->type == 1){
                $prod->type = "ძირითადი საშუალება";
            }
            foreach(Inventory::where('product_id', $prod->id)->get() as $service){
                $prod['services'] .= ", ".$service->inventoriable()->first()->{'title_'.app()->getLocale()};
            }
            unset($prod['purchase_id']);
        }
        return $products;
    }
    public function headings(): array
    {
        return [
            '#',
            'კატეგორიის სახელი',
            'სახელი ქართულად',
            'სახელი რუსულად',
            'სახელი ინგლისურად',
            'ფასი',
            'ტიპი',
            'რაოდენობა',
            'ერთეული',
            'სტატუსი',
            'დამატების თარიღი',
            'განახლების თარიღი',
            'ვატულა',
            'დეპარტამენტი',
            'შესყიდვის ნომერი',
            'დაკავშირებული სერვისებთან',
        ];
    }
}
