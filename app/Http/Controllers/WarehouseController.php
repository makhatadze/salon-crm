<?php

namespace App\Http\Controllers;
use App\Product;
use App\StorageHistory;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class WarehouseController extends Controller
{
    public function departmentToHouse(Request $request, $id){
        $this->validate($request,[
            'dept_id' => 'required|integer',
            'user_id' => 'required|integer',
            'typeamout' => 'required|min:1',
            'sell_price' => 'required'
        ]);

        $prod = Product::findOrFail(intval($id));
        if ($prod->stock < $request->typeamout) {
            return redirect()->back()->with('error', __('warehouse.message1'));
        }

//        if($prod->buy_price < $request->sell_price){
//            return redirect()->back()->with('error', __('warehouse.message2'));
//        }

        if (Product::where('department_id', $request->dept_id)->whereIn('id', $prod->children()->select('child_id')->get()->toArray())->count() > 0) {
            return redirect()->back()->with('error', __('warehouse.message3'));
        }
        if ($prod->type == 1) {
            $this->validate($request, [
                'expluatation_date' => '',
                'expluatation_days' => '',
                'unlimited_expluatation' => '',
            ]);
            $date = Carbon::parse($request->expluatation_date);
            if($prod->type == 1){
                for ($i = 0; $i < intval($request->typeamout); $i++) { 
                    $newprod = $prod->replicate();

                    if(isset($request->unlimited_expluatation)){
                        $newprod->unlimited_expluatation = true;
                    }else{
                        $newprod->expluatation_date = $request->input('expluatation_date');
                        $newprod->expluatation_days = intval($request->expluatation_days);
                    }
                    $newprod->warehouse = false;
                    $newprod->stock = 1;
                    $newprod->price = $request->sell_price*100;
                    $newprod->expluatation_date = $date;
                    $newprod->fromwarehouse = true;
                    $newprod->department_id = $request->dept_id;
                    $newprod->user_id = $request->user_id;
                    $newprod->save();
                    $newprod->parent()->create([
                        'child_id' => $newprod->id,
                        'parent_id' => $prod->id
                    ]);
                }
                $thisprod = $prod;
                if($thisprod->stock == $request->typeamout){
                    $thisprod->stock = $thisprod->stock - $request->typeamout;
                    $thisprod->writedown = 0;
                    $thisprod->save();
                }else{
                    $thisprod->stock = $thisprod->stock - $request->typeamout;
                    $thisprod->save();
                }
            }

        }elseif($prod->type == 2){
            
            $newprod = $prod->replicate();
            $newprod->department_id = $request->dept_id;
            $newprod->warehouse = false;
            $newprod->user_id = $request->user_id;
            $newprod->stock = ($newprod->unit == "gram") ? $request->typeamout * $newprod->gramunit : $request->typeamout;
            $newprod->price =  intval(round($request->sell_price, 2) * 100);
            $newprod->fromwarehouse = true;
            $newprod->save();
            $newprod->parent()->create([
                'child_id' => $newprod->id,
                'parent_id' => $prod->id
            ]);

            $thisprod = $prod;
            if($thisprod->stock == $request->typeamout){
                $thisprod->stock = $thisprod->stock - $request->typeamout;
                $thisprod->writedown = 0;
                $thisprod->save();
            }else{
                $thisprod->stock = $thisprod->stock - $request->typeamout;
                $thisprod->save();
            }
        }        
        StorageHistory::create([
            'storage_id' => $prod->storage_id,
            'stock' => $request->typeamout,
            'user_id' => Auth::user()->id,
            'department_id' => $request->dept_id,
            'product_id' => $prod->id,
            'price' => $request->sell_price*100,
            'description' => 'fromstorage'
        ]);
        return redirect()->back();
    }
}
