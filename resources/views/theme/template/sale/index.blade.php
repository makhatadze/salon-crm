@extends('theme.layout.layout')

@section('content')
<div class="grid grid-cols-12 gap-6">

    <div class="col-span-12 xxl:col-span-9 grid grid-cols-12 gap-6 mt-4">
       @foreach ($sales as $sale) 
            <div class="col-span-12" id="removesale{{$sale->id}}">
                <div class=" mt-3" >
                    <div class=" w-full  relative box z-10 py-3 px-4 flex">
                        <div class="w-3/12">
                        <h4 class="font-bold font-caps">{{$sale->client->{"full_name_".app()->getLocale()} }}</h4>
                        <div class="font-normal text-xs">
                            <span>{{$sale->client->number}}</span> <br>
                            <span>{{$sale->address}}</span>
                        </div>
                        </div>
                        <div class="w-3/12">
                            <h4 class="font-bolder font-caps"> {{$sale->getTotalPrice()}} <sup>₾</sup> </h4>
                            <span class="font-normal text-xs">რაოდენობა: {{$sale->orders->sum('quantity')}}</span> <br>
                            <span class="font-normal text-xs">გადახდის მეთოდი: {{$sale->pay_method}} </span>
                        </div>
                        <div class="w-3/12">
                            <h4 class="font-bolder font-caps"> {{$sale->getSellerName()}} </h4>
                        <span class="font-normal text-xs">თარიღი: {{$sale->created_at}}</span>
                        </div>
                        <div class="w-3/12 flex items-center justify-center">
                            <a  href="javascript:;" class=" p-2 rounded-md bg-gray-200"  data-toggle="modal" data-target="#sale{{$sale->id}}" >
                                <svg width="1.18em" height="1.18em" viewBox="0 0 16 16" class="bi bi-info-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM8 5.5a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                                </svg>
                            </a>
                            <a href="/sale/export/{{$sale->id}}" class="p-2 rounded-md ml-2 bg-gray-200">
                            <svg width="1.18em" height="1.18em" viewBox="0 0 16 16" class="bi bi-file-arrow-down-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM8 5a.5.5 0 0 1 .5.5v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 1 1 .708-.708L7.5 9.293V5.5A.5.5 0 0 1 8 5z"/>
                              </svg>
                            </a>
                            <button class="p-2 rounded-md bg-gray-200 ml-2 removesale" id="{{$sale->id}}">
                                <svg width="1.18em" height="1.18em" viewBox="0 0 16 16" class="bi bi-trash2-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2.037 3.225l1.684 10.104A2 2 0 0 0 5.694 15h4.612a2 2 0 0 0 1.973-1.671l1.684-10.104C13.627 4.224 11.085 5 8 5c-3.086 0-5.627-.776-5.963-1.775z"/>
                                    <path fill-rule="evenodd" d="M12.9 3c-.18-.14-.497-.307-.974-.466C10.967 2.214 9.58 2 8 2s-2.968.215-3.926.534c-.477.16-.795.327-.975.466.18.14.498.307.975.466C5.032 3.786 6.42 4 8 4s2.967-.215 3.926-.534c.477-.16.795-.327.975-.466zM8 5c3.314 0 6-.895 6-2s-2.686-2-6-2-6 .895-6 2 2.686 2 6 2z"/>
                                  </svg>
                            </button>
                        </div>
                    </div>
                </div>
            <div class="modal" id="sale{{$sale->id}}">
                <div class="modal__content modal__content--xl p-10 text-center"> 
                    <div class="flex justify-between">
                        <h6 class="text-lg font-bold font-caps">შეკვეთები</h6>
                        <h6 class="text-lg font-bold font-caps">ჯამი: {{$sale->getTotalPrice()}} <sup>₾</sup></h6>
                    </div>
                    @foreach ($sale->orders as $item)
                    <div class="bg-gray-200 rounded-md shadow w-full py-2 px-2 mt-3 flex justify-between">
                        <div class="text-left">
                        <h6 class="m-0 font-bolder">{{$item->product->{"title_".app()->getLocale()} }}</h6>
                        <span class="font-normal text-xs">
                            {{$item->quantity}}
                            @if($item->product->unit == "gram") გრამი @elseif($item->product->unit == "metre") სანტიმეტრი @elseif($item->product->unit== "unit") ერთეული @endif
                        </span>
                        </div>
                        <div>
                        <h6 class="m-0 font-bold font-caps">{{round(($item->quantity * $item->price)/100, 2)}} <sup>₾</sup></h6>
                        <span class="font-normal">{{$item->price/100}}₾</span>
                        </div>
                    </div>   
                    @endforeach
                </div>
            </div>
            </div>
       @endforeach
    </div>
    <div class="col-span-12 xxl:col-span-3 mt-4 -mb-10 pb-10">

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
