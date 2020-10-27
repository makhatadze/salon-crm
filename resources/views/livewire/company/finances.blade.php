<div>
    <div class="grid grid-cols-12 gap-6 p-3 mt-3">
        <div class="col-span-12 xxl:col-span-9 grid grid-cols-10">
            <div class="col-span-10 grid grid-cols-10 font-normal text-xs bg-white p-3">
                <div class="col-span-1  flex items-center justify-center">
                    თარიღი
                </div>
                <div class="col-span-1 flex items-center justify-center">
                    საერთო
                </div>
                <div class="col-span-1 flex items-center justify-center">
                    დანახარჯი
                </div>
                <div class="col-span-1 flex items-center justify-center">
                    ხელფასზე
                </div>
                <div class="col-span-1 flex items-center justify-center">
                    გადახდილი
                </div>
                <div class="col-span-3 flex items-center justify-center">
                    ბანკი
                </div>
                <div class="col-span-1 flex items-center justify-center">
                    სუფთა
                </div>
            </div>
            @foreach ($finances  as $item)
            <div class="col-span-10 grid grid-cols-10 mt-2 font-normal text-xs p-3 bg-white">
                <div class="col-span-1 flex items-center justify-center">
                    {{$item->created_at}}
                </div>
                <div class="col-span-1 flex items-center justify-center">
                    {{$item->service_price/100}}
                </div>
                {{-- გასასწორებელია სერვისზე პროდუქტის დამატების შემდეგ ~ ხარჯი --}}
                <div class="col-span-1 flex items-center justify-center">
                    0
                </div>
                <div class="col-span-1 flex items-center justify-center">
                    {{$item->service_price * ($item->percent/100)/100}}
                </div>
                <div class="col-span-1 flex items-center justify-center">
                    <h6>{{$item->sale ? ($item->sale->pay_method == "consignation" ? 'კონსიგნაცია' : $item->sale->pay_method) : ($item->service->pay_method == "consignation" ? 'კონსიგნაცია' : $item->service->pay_method)}}</h6>
                </div>
                <div class="col-span-3  flex items-center justify-center">
                    ბანკი
                </div>
                {{-- გასასწორებელია სერვისზე პროდუქტის დამატების შემდეგ ~ სუფთა მოგება --}}
                <div class="col-span-1  flex items-center justify-center">
                    @if($item->sale)
                        @if (($item->service_price - $item->sale->totalOriginalPrice())/100 > 0)
                            <span class="text-green-700 font-bold">
                                + {{($item->service_price - $item->sale->totalOriginalPrice())/100}}
                            </span>
                        @else 
                            <span class="text-red-700 font-bold">
                                - {{($item->service_price - $item->sale->totalOriginalPrice())/100}}
                            </span>
                        @endif
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        <div class="col-span-12 xxl:col-span-3 -mb-10 pb-10">
            
        </div>
    </div>
</div>
