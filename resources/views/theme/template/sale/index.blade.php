@extends('theme.layout.layout')

@section('content')
<div class="grid grid-cols-12 gap-6">

    <div class="col-span-12 xxl:col-span-9 grid grid-cols-12 gap-6 mt-4">
       @foreach ($sales as $sale) 
            <div class="col-span-12" id="removesale{{$sale->id}}">
                <div class=" mt-3" >
                    <div class=" w-full  relative">
                    <div id="{{$sale->id}}" class="removesale h-5 w-5 text-white z-50 absolute top-0 right-0 zoom-in duration-300 hover:bg-red-700 bg-red-400 rounded-full flex justify-center items-center font-bold">x</div>
                        <a  href="javascript:;" class="box z-10 py-3 px-4 flex"  data-toggle="modal" data-target="#sale{{$sale->id}}" >
                        <div class="w-3/12">
                        <h4 class="font-bold font-caps">{{$sale->client->{"full_name_".app()->getLocale()} }}</h4>
                        <div class="font-normal text-xs">
                            <span>{{$sale->client->number}}</span> <br>
                            <span>{{$sale->address}}</span>
                        </div>
                        </div>
                        <div class="w-3/12">
                            <h4 class="font-bolder font-caps"> {{$sale->getTotalPrice()}} <sup>₾</sup> </h4>
                        <span class="font-normal text-xs">რაოდენობა: {{$sale->orders->count()}}</span>
                        </div>
                    </a>
                    </div>
                </div>
            <div class="modal" id="sale{{$sale->id}}">
                <div class="modal__content modal__content--xl p-10 text-center"> 
                    <div class="flex justify-between">
                        <h6 class="text-lg font-bold font-caps">შეკვეთები</h6>
                        <h6 class="text-lg font-bold font-caps">ჯამი: {{$sale->getTotalPrice()}} <sup>₾</sup></h6>
                    </div>
                    @foreach ($sale->orders as $item)
                    <div class="bg-gray-300 rounded-lg shadow w-full py-2 px-2 mt-3 flex justify-between">
                        <div class="text-left">
                        <h6 class="m-0 font-bold font-caps">{{$item->product->{"title_".app()->getLocale()} }}</h6>
                        <span class="font-normal">
                            {{$item->quantity}}
                            @if($item->product->unit == "kilo") კილოგრამი @elseif($item->product->unit == "metre") მეტრი @elseif($item->product->unit== "unit") ერთეული @endif
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
            $('.side-menu[data-menu="products"]').addClass('side-menu--active');
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
