@extends('theme.layout.layout')
@section('content')
<div class="bg-white mx-auto py-3 px-4 mt-3 grid  grid-cols-3" style="width: 50%">
    <div class="col-span-1">
        <small class="font-normal">პერსონალი</small>
        <h6 class="font-bold text-xs text-gray-800">{{$sale->user->profile->first_name .' '. $sale->user->profile->last_name}}</h6>
        <small>მისამართი</small>
        <h6 class="font-medium text-xs text-gray-800">{{$sale->address}}</h6>
        <small>გადახდის დრო</small>
        <h6 class="font-medium text-xs text-gray-800">{{$sale->created_at}}</h6>
    </div>
    <div class="col-span-1">
        <small class="font-normal">კლიენტი</small>
        <h6 class="font-bold text-xs text-gray-800">{{$sale->client->{'full_name_'.app()->getLocale()} }}</h6>
        <small class="font-normal">ფასი</small>
        <h6 class="font-medium text-xs text-gray-800">{{number_format($sale->total/100, 2)}} <sup>₾</sup></h6>
        <small class="font-normal">გადახდის დრო</small>
        <h6 class="font-medium text-xs text-gray-800">{{$sale->pay_method == "consignation" ? 'კონსიგნაცია' : $sale->pay_method}}</h6>
    </div>
        <div class="col-span-1">
            @if ($sale->pay_method == 'consignation')
            <small class="font-normal">კონსიგნაცია</small>
            <form @if ($sale->pay_method == 'consignation' && $sale->total > $sale->paid) action="{{route('updateSale', $sale->id)}}" method="POST" @endif class="w-full flex mt-2">
                @csrf
                @method('PUT')
                <input type="number" name="money" required min="0" step="0.01" max="{{number_format($sale->total/100, 2)}}" value="{{number_format($sale->paid/100, 2)}}" class="py-1 px-4 w-18 bg-gray-200">
                @error('money')
                <p class="text-normal text-xs">{{$message}}</p>
                @enderror
                @if ($sale->pay_method == 'consignation' && $sale->total != $sale->paid)
                <input type="submit" class="py-1 px-4 w-18 bg-indigo-500 text-center font-bold text-xs text-white"  value="განახლება">
                 @endif
            </form>
            @endif
            @foreach ($sale->orders as $item)
                <div class="bg-gray-200 p-2 block w-full mt-2 justify-between flex">
                    <div class="text-xs">
                        <small class="font-normal">რაოდენობა x ფასი</small>
                        <h6 class="font-normal">{{intval($item->quantity)}} x {{number_format($item->price/100, 2)}} = {{number_format((intval($item->quantity) * $item->price/100), 2)}} 
                            <sup>
                            @if ($item->product->currency_type == "gel")
                                ₾
                            @elseif ($item->product->currency_type == "usd")
                                $
                            @ელსეif ($item->product->currency_type == "eur")
                                €
                            @endif    
                            </sup></h6>
                            <small class="font-normal">მოგება</small>
                        <h6 class="font-normal">
                            @if (($item->price - $item->product->buy_price)*$item->quantity/100 > 0)
                                <span class="text-green-700 font-bold">
                                    + {{($item->price - $item->product->buy_price)*$item->quantity/100}}
                                </span>
                            @else 
                            <span class="text-red-700 font-bold">
                                - {{($item->price - $item->product->buy_price)*$item->quantity/100}}
                            </span>
                            @endif
                            <sup>
                            @if ($item->product->currency_type == "gel")
                                ₾
                            @elseif ($item->product->currency_type == "usd")
                                $
                            @ელსეif ($item->product->currency_type == "eur")
                                €
                            @endif    
                            </sup>
                        </h6>
                            
                    </div>
                    <div class="text-xs">
                        <small class="font-normal">ყიდვის</small>
                            <h6 class="font-normal">{{$item->product->buy_price/100}}
                                @if ($item->product->currency_type == "gel")
                                ₾
                            @elseif ($item->product->currency_type == "usd")
                                $
                            @ელსეif ($item->product->currency_type == "eur")
                                €
                            @endif </h6>
                    </div>
                </div>
            @endforeach
        </div>
</div>
@endsection