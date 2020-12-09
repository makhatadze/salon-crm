<div>
    <div class="mx-auto mt-3" style="max-width: 900px">
            <div class="bg-white w-full flex items-center py-3 px-4">
                <input wire:model="search" type="text" class="w-full focus:outline-none font-normal text-xs" placeholder="@lang('warehosuehistory.search')">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                    <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                </svg>
            </div>
            <div class="grid grid-cols-4 mt-2 gap-3">
                <div class="col-span-4 md:col-span-1 p-2 pl-1">
                    <div class="bg-white py-3 px-4 w-full">
                        <label for="pricefrom" class="font-bold text-xs font-caps">@lang('warehosuehistory.date') <small class="text-gray-600">[@lang('warehosuehistory.from')]</small></label>
                        <input type="date" class="w-full mt-2 focus:outline-none" wire:model="datefrom"  id="datefrom">
                    </div>
                </div>
                <div class="col-span-4 md:col-span-1 p-2 pl-1">
                    <div class="bg-white py-3 px-4 w-full">
                        <label for="pricefrom" class="font-bold text-xs font-caps">@lang('warehosuehistory.date') <small class="text-gray-600">[@lang('warehosuehistory.till')]</small></label>
                        <input type="date" class="w-full mt-2 focus:outline-none"  wire:model="datetill"  id="datetill">
                    </div>
                </div>
                <div class="col-span-4 md:col-span-1 p-2 pl-1">
                    <div class="bg-white py-3 px-4 w-full">
                        <label for="pricefrom" class="font-bold text-xs font-caps">@lang('warehosuehistory.price') <small class="text-gray-600">[@lang('warehosuehistory.from')]</small></label>
                        <input type="number" class="w-full mt-2 focus:outline-none" step="0.01" min="0" wire:model="pricefrom"  id="pricefrom">
                    </div>
                </div>
                <div class="col-span-4 md:col-span-1 p-2">
                    <div class="bg-white py-3 px-4 w-full">
                        <label for="pricetill" class="font-bold text-xs font-caps">@lang('warehosuehistory.price') <small class="text-gray-600">[@lang('warehosuehistory.till')]</small></label>
                        <input data-daterange="true" class="w-full mt-2 focus:outline-none" step="0.01" min="0" wire:model="pricetill" id="pricetill" class="mt-2 datepicker input w-full p-0 m-0 focus:outline-none block mx-auto">
                    </div>
                </div>
            </div>
        @if ($histories)
            @foreach ($histories as $history)
            
                <div class="mt-2 grid grid-cols-2 sm:grid-cols-4 md:grid-cols-8 bg-white py-3 px-4">
                    <div class="col-span-2">
                        <h6 class="font-bold text-xs">{{$history->product ? $history->product->title_ge : ''}}</h6>
                        <span class="text-xs font-normal">{{$history->stock}} 
                            @if ($history->product->unit == "unit")
                            @lang('warehosuehistory.unit')
                            @elseif ($history->product->unit == "gram")
                            @lang('warehosuehistory.gram')
                            @elseif ($history->product->unit == "metre")
                            @lang('warehosuehistory.centimeter')
                        @endif</span>
                    </div>
                    <div class="col-span-2">
                        <h6 class="font-bold text-xs">{{$history->department->name_ge}}</h6>
                        <span class="text-xs font-normal">@lang('warehosuehistory.mitprice'): {{number_format($history->price/100, 2)}}
                        @if ($history->product->currency_type == "gel")
                        @lang('money.icon')
                        @endif    
                        </span>
                    </div>
                    <div class="col-span-2">
                        <h6 class="font-bold text-xs">{{$history->storage->name}}</h6>
                        <span class="text-xs font-normal">
                            @if ($history->description == "fromstorage")
                                @lang('product.fromstoragetext')
                            @elseif ($history->description == "backtostorage")
                                @lang('product.backtostoragetext')
                            @elseif ($history->description == "takefromstorage")
                                @lang('product.takefromstoragetext')
                            @endif
                            : {{Carbon\Carbon::parse($history->created_at)->isoFormat('Y-MM-DD')}}
                        </span>
                    </div>
                    <div class="col-span-2">
                        <h6 class="font-bold text-xs">{{$history->user->profile->first_name .' '. $history->user->profile->last_name}}</h6>
                        <span class="text-xs font-normal">+995{{$history->user->profile->phone}}</span>
                    </div>
                </div>
            
            @endforeach
            <div class="w-full">
                {{$histories->links()}}
            </div>
        @endif
    
        </div>
</div>
