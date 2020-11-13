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
        $products = Product::where('warehouse', 0)->get(); 
        foreach($products as $prod){
            unset($prod['category_id']);
            unset($prod['description_ge']);
            unset($prod['description_ru']);
            unset($prod['description_en']);
            unset($prod['deleted_at']);
            $prod->price = number_format($prod->price/100,2);
            $prod->buy_price = number_format($prod->buy_price/100,2);
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
            unset($prod['fromwarehouse']);
            unset($prod['boughtamout']);
            unset($prod['currency_type']);
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
            __('productexport.name'),
            __('productexport.price'),
            __('productexport.type'),
            __('productexport.quantity'),
            __('productexport.unit'),
            __('productexport.status'),
            __('productexport.createdate'),
            __('productexport.updatedate'),
            __('productexport.expstart'),
            __('productexport.expduration'),
            __('productexport.expunlimited'),
            __('productexport.buyprice'),
            __('productexport.productcode'),
            __('productexport.buynumber'),
            __('productexport.department'),
            __('productexport.brand'),
            __('productexport.storage'),
            __('productexport.author'),
        ];
    }
}
