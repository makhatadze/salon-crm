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
            unset($prod['deleted_at']);
            $prod['price'] = $prod->price/100;
            $prod['category_id'] = $prod->getCategoryName();
            $prod['department_id'] = $prod->getDepartmentName();
            foreach(Inventory::where('product_id', $prod->id)->get() as $service){
                $prod['services'] .= $service->inventoriable()->first()->{'title_'.app()->getLocale()};
            }
        }
        return $products;
    }
    public function headings(): array
    {
        return [
            '#',
            'სახელი ქართულად',
            'სახელი რუსულად',
            'სახელი ინგლისურად',
            'ფასი',
            'ტიპი',
            'რაოდენობა',
            'ერთეული',
            'სტატუსი',
            'კატეგორია',
            'დეპარტამენტი',
            'დამატების თარიღი',
            'განახლების თარიღი',
            'დაკავშირებული სერვისებთან',
        ];
    }
}
