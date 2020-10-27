@extends('theme.layout.layout')

@section('content')
<div class="grid grid-cols-12 gap-6">

    <div class="col-span-12 xxl:col-span-9 grid grid-cols-12  mt-4">
        @if ($sales)
        @foreach ($sales as $sale) 
                <div class="col-span-12" id="removesale{{$sale->id}}">
                    <div class=" mt-1" >
                        <div class=" w-full  relative bg-white z-10 py-3 px-4 flex">
                            <a href="/clients/edit/{{$sale->client_id}}" class="w-3/12">
                            <h4 class="font-bold text-xs">{{$sale->client->{"full_name_".app()->getLocale()} }}</h4>
                            <div class="font-normal text-xs">
                                <span>+995{{$sale->client->number}}</span> <br>
                                {{-- <span>{{$sale->address}}</span> --}}
                            </div>
                            </a>
                            <div class="w-3/12">
                            <h4 class="font-bolder text-xs"> {{number_format($sale->total/100, 2)}} <sup>₾</sup> @if($sale->pay_method == "consignation" && $sale->paid < $sale->total) <small>/ {{number_format($sale->paid/100, 2)}} <sup>₾</sup></small> @endif </h4>
                                <span class="font-normal text-xs">რაოდენობა: {{$sale->orders->sum('quantity')}}</span> <br>
                                {{-- <span class="font-normal text-xs">გადახდის მეთოდი: {{$sale->pay_method == 'consignation' ? 'კონსიგნაცია' : $sale->pay_method}} </span> --}}
                            </div>
                            <a href="/user/showprofile/{{$sale->seller_id}}" class="w-3/12">
                                <h4 class="font-bolder text-xs"> {{$sale->user->profile->first_name .' '. $sale->user->profile->last_name}} </h4>
                            <span class="font-normal text-xs">თარიღი: {{$sale->created_at}}</span>
                            </a>
                            <div class="w-3/12 flex items-center justify-center">
                                <a  href="{{route('showSale', $sale->id)}}" class=" p-2 rounded-md bg-gray-200"  >
                                    <svg  width="0.9em" height="0.9em" viewBox="0 0 16 16" class="bi bi-info-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM8 5.5a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                                    </svg>
                                </a>
                                <a href="/sale/export/{{$sale->id}}" class="p-2 rounded-md ml-2 bg-gray-200">
                                <svg width="0.9em" height="0.9em" viewBox="0 0 16 16" class="bi bi-file-arrow-down-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM8 5a.5.5 0 0 1 .5.5v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 1 1 .708-.708L7.5 9.293V5.5A.5.5 0 0 1 8 5z"/>
                                </svg>
                                </a>
                                <button class="p-2 rounded-md bg-gray-200 ml-2 removesale" id="{{$sale->id}}">
                                    <svg  width="0.9em" height="0.9em" viewBox="0 0 16 16" class="bi bi-trash2-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2.037 3.225l1.684 10.104A2 2 0 0 0 5.694 15h4.612a2 2 0 0 0 1.973-1.671l1.684-10.104C13.627 4.224 11.085 5 8 5c-3.086 0-5.627-.776-5.963-1.775z"/>
                                        <path fill-rule="evenodd" d="M12.9 3c-.18-.14-.497-.307-.974-.466C10.967 2.214 9.58 2 8 2s-2.968.215-3.926.534c-.477.16-.795.327-.975.466.18.14.498.307.975.466C5.032 3.786 6.42 4 8 4s2.967-.215 3.926-.534c.477-.16.795-.327.975-.466zM8 5c3.314 0 6-.895 6-2s-2.686-2-6-2-6 .895-6 2 2.686 2 6 2z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
        @endforeach
        {{$sales->links('vendor.pagination.custom')}}
        @endif
    </div>
    <div class="col-span-12 xxl:col-span-3 mt-4 -mb-10 pb-10">
        <div class="bg-white p-3">
            <form action="">
                <div class="flex">
                    <div class="w-full md:w-1/2 p-2">
                        <label for="client_name" class="font-bolder text-gray-700 text-xs">კლიენტი</label>
                        <input type="text" @if (isset($queries['client_name'])) value="{{$queries['client_name']}}" @endif class="bg-gray-200 mt-2 text-gray-800 p-2 font-normal rounded-sm text-xs w-full" name="client_name" id="client_name" placeholder="სახელი, ნომერი">
                    </div>
                    <div class="w-full md:w-1/2 p-2">
                        <label for="worker_name" class="font-bolder text-gray-700 text-xs">თანამშრომელი</label>
                        <input type="text" @if (isset($queries['worker_name'])) value="{{$queries['worker_name']}}" @endif class="bg-gray-200 mt-2 text-gray-800 p-2 font-normal rounded-sm text-xs w-full" name="worker_name" id="worker_name" placeholder="სახელი, ნომერი">
                    </div>
                </div>
                <div class="flex">
                    <div class="w-full md:w-1/2 p-2">
                        <label for="price_from" class="font-bolder text-gray-700 text-xs">ფასი <small>[დან]</small></label>
                        <input type="number" min="0" step="0.01" @if (isset($queries['price_from'])) value="{{$queries['price_from']}}" @endif class="bg-gray-200 mt-2 text-gray-800 p-2 font-normal rounded-sm text-xs w-full" name="price_from" id="price_from" placeholder="00.00">
                    </div>
                    <div class="w-full md:w-1/2 p-2">
                        <label for="price_till" class="font-bolder text-gray-700 text-xs">ფასი <small>[მდე]</small></label>
                        <input type="number" min="0" step="0.01" @if (isset($queries['price_till'])) value="{{$queries['price_till']}}" @endif class="bg-gray-200 mt-2 text-gray-800 p-2 font-normal rounded-sm text-xs w-full" name="price_till" id="price_till" placeholder="00.00">
                    </div>
                </div>
                <div class="flex">
                    <div class="w-full md:w-1/2 p-2 flex items-center justify-center">
                        <input type="checkbox" name="consignation" id="consignation" class="mt-6" @if (isset($queries['consignation'])) checked @endif>
                        <label for="consignation" class="font-normal ml-3 text-gray-700 text-xs mt-6">კონსიგნაცია</label>
                    </div>
                    <div class="w-full md:w-1/2 p-2">
                        <label for="price_till" class="font-bolder text-gray-700 text-xs">თარიღი</label>
                        <input data-daterange="true" name="date" @if (isset($queries['date'])) value="{{$queries['date']}}" @endif class="datepicker input w-full text-xs border block mx-auto"> 
                    </div>
                </div>
                <div class="flex">
                    <button type="submit" class="w-2/3 mt-2 block appearance-none flex items-center justify-center font-bold font-caps bg-indigo-500 text-xs text-white bg-gray-200 border border-gray-200  py-3 px-4  rounded leading-tight">
                        ძებნა
                    </button>
                    
                  <a href="{{url()->current()}}" class="w-1/3 mt-2 block appearance-none flex items-center justify-center font-bold font-caps bg-red-500 text-xs text-white bg-gray-200 border border-gray-200  py-3 px-4  rounded leading-tight">
                    <svg width="1.3em" height="1.3em" viewBox="0 0 16 16" class="bi bi-x-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                      </svg>
                    </a>  
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('custom_scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.side-menu').removeClass('side-menu--active');
            $('.side-menu[data-menu="shop"]').addClass('side-menu--active');
            $('#menushop ul').addClass('side-menu__sub-open');
            $('#menushop ul').css('display', 'block');
            $('.removesale').click(function(){
                let id = $(this).attr('id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "/removesale/"+id,
                    method: 'get',
                    success: function(result) {
                        if (result.status == true) {
                            $('#removesale' + id).remove();
                        }
                    }
                });
            });
        });

    </script>
@endsection
