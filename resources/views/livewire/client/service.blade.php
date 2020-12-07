<div>
    
    <h6 class="w-full font-bold mb-2 font-caps text-xs">@lang('clients.services')  <small class="font-normal ml-1">( {{$client->clientservices()->where('status', 1)->count()}} )</small></h6>
    <div class="p-2 bg-gray-200 flex items-center justify-between">
        <input wire:model="search" type="text" class="bg-gray-200 font-normal text-xs w-full focus:outline-none" placeholder="@lang('clients.search')..">
        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
            <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
          </svg>
        </div>
        <div class="p-2 mt-2 bg-gray-200 flex items-center justify-center">
            <input type="checkbox" name="consignationserv" id="consignationserv" wire:model="consignationserv">
            <label for="consignationserv" class="font-normal text-xs ml-2">@lang('clients.consignation')</label>
        </div>
        @if ($clientservices)
            @foreach ($clientservices as $item)
                <a href="{{route('showService', $item->id)}}" target="_blank" class="w-full border-l-2 @if($item->pay_method == 'consignation' && $item->new_price > $item->paid) border-yellow-500 @else border-green-400 @endif mt-2 bg-gray-200 p-2 flex justify-between">
                    <div>
                        <h6 class="font-bold text-xs">
                            {{$item->service->title_ge }}
                        </h6>
                        <small class="font-normal">{{$item->session_endtime}}</small> <br>
                        @if($item->pay_method == 'consignation' && $item->new_price > $item->paid) <small class="font-normal">@lang('clients.dept')</small> @endif
                    </div>
                    <span class="font-normal text-xs">
                        {{$item->new_price/100}} @if ($item->service->currency_type == "gel") @lang('money.icon') @endif
                    </span>
                </a>
            @endforeach
            <div class="w-full mt-2">
                {{$clientservices->links()}}
            </div>
        @endif
</div>
