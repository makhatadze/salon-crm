@extends('theme.layout.layout')
@section('content')
<div class="bg-white mx-auto py-3 px-4 mt-3 grid  grid-cols-3" style="width: 50%">
    <div class="col-span-1">
        <small class="font-normal">პერსონალი</small>
        <h6 class="font-bold text-xs text-gray-800">{{$clientservice->user->profile->first_name .' '. $clientservice->user->profile->last_name }}</h6>
        <small class="font-normal">ჩაწერის თარიღი</small>
        <h6 class="font-bold text-xs text-gray-800">{{$clientservice->created_at }}</h6>
        <small class="font-normal">სესიის თარიღი</small>
        <h6 class="font-bold text-xs text-gray-800">{{$clientservice->session_start_time }}</h6>
    </div>
    <div class="col-span-1">
        <small class="font-normal">კლიენტი</small>
        <h6 class="font-bold text-xs text-gray-800">{{$clientservice->clinetserviceable->{'full_name_'.app()->getLocale()} }}</h6>
        <small class="font-normal">ფასი</small>
        <h6 class="font-bold text-xs text-gray-800">{{number_format($clientservice->new_price/100, 2)}}
            @if ($clientservice->service->currency_type == "gel")
            ₾
            @elseif ($clientservice->service->currency_type == "usd")
            $
            @elseif ($clientservice->service->currency_type == "eur")
            €
            @endif
    </h6>
        <small class="font-normal">გადახდის მეთოდი</small>
        <h6 class="font-bold text-xs text-gray-800">{{$clientservice->pay_method == "consignation" ? 'კონსიგნაცია' : $clientservice->pay_method }}</h6>
    </div>
    <div class="col-span-1">
        @if ($clientservice->pay_method == 'consignation')
        <small class="font-normal">კონსიგნაცია</small>
        <form @if ($clientservice->pay_method == 'consignation' && $clientservice->new_price > $clientservice->paid) action="{{route('addconsignation', $clientservice->id)}}" method="POST" @endif class="w-full flex mt-2">
            @csrf
            <input type="number" name="paid" required min="0" step="0.01" max="{{number_format($clientservice->new_price/100, 2)}}" value="{{number_format($clientservice->paid/100, 2)}}" class="py-1 px-4 w-18 bg-gray-200">
            @error('money')
            <p class="text-normal text-xs">{{$message}}</p>
            @enderror
            @if ($clientservice->pay_method == 'consignation' && $clientservice->new_price > $clientservice->paid)
            <input type="submit" class="py-1 px-4 w-18 bg-indigo-500 text-center font-bold text-xs text-white" value="განახლება">
            @endif
        </form>
        @endif
      
    </div>
</div>
@endsection