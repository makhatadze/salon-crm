<?php

namespace App\Http\Livewire\Product;

use App\Brand;
use App\Category as AppCategory;
use App\SubCategory;
use Livewire\Component;

class Category extends Component
{
    public $title_ge;
    public $title_en;
    public $title_ru;
    public $brand_name;

    public function addCategory()
    {
        $validatedData = $this->validate([
            'title_ge' => 'required|string',
            'title_en' => '',
            'title_ru' => '',
        ]);
        $validatedData['model_name'] = 'App\Product';

        if (AppCategory::create($validatedData)) {
            $this->title_ge = '';
            $this->title_en = '';
            $this->title_ru = '';
        }
    }
    public function addSubCat(AppCategory $category, $name)
    {
        $fields = [
            'category_id' => $category->id,
            'name' => $name,
        ];
        SubCategory::create($fields);
    }
    public function addBrand(SubCategory $subcategory, $name)
    {
        $fields = [
            'name' => $name,
            'category_id' => $subcategory->id
        ];
        Brand::create($fields);
    }
    public function render()
    {
        $categories = AppCategory::all();
        return view('livewire.product.category', compact('categories'));
    }
}
