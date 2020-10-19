<?php

namespace App\Http\Controllers;
use App\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;
class WarehouseController extends Controller
{
    public function departmentToHouse(Request $request, $id){
        $this->validate($request,[
            'dept_id' => 'required|integer',
            'user_id' => 'required|integer'
            
        ]);
        $prod = Product::findOrFail(intval($id));
        if($prod->type == 1){
            $this->validate($request,[
                'expluatation_date' => '',
                'expluatation_days' => '',
                'unlimited_expluatation' => '',
                'typeamout' => 'required',
            ]);
            $date = Carbon::parse($request->expluatation_date);
            if($prod->stock < $request->typeamout){
                return redirect()->back();
            }
            if($prod->type == 1){
                for ($i = 0; $i < intval($request->typeamout); $i++) { 
                    $product = new Product;

                    if(isset($request->unlimited_expluatation)){
                        $product->unlimited_expluatation = true;
                    }else{
                        $product->expluatation_date = $request->input('expluatation_date');
                        $product->expluatation_days = $request->input('expluatation_days');
                    }

                    $product->title_ge = $prod->title_ge;
                    $product->description_ge = $prod->description_ge;
                    $product->price = $prod->price;
                    $product->type = $prod->type; 
                    $product->stock = 1;
                    $product->unit = $prod->unit;
                    $product->purchase_id = $prod->purchase_id;
                    $product->department_id = $request->dept_id;
                    $product->brand_id = $prod->brand_id;
                    $product->category_id = $prod->category_id;
                    $product->currency_type = $prod->currency_type;
                    $product->user_id = $request->user_id;
                    $product->warehouse = false;
                    $product->expluatation_date = $date;
                    $product->expluatation_days = intval($request->expluatation_days);
                    $product->save();
                }
                $thisprod = $prod;
                if($thisprod->stock == $request->typeamout){
                    $thisprod->stock = $thisprod->stock - $request->typeamout;
                    $thisprod->save();
                    $thisprod->delete();
                }else{
                    $thisprod->stock = $thisprod->stock - $request->typeamout;
                    $thisprod->save();
                }
            }

        }elseif($prod->type == 2){
            $prod->department_id = $request->dept_id;
            $prod->warehouse = false;
            $prod->user_id = $request->user_id;
            $prod->save();
        }        
        return redirect()->back();
    }
}
