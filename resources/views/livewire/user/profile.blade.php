<div>
    <div class="w-full py-3 px-4 bg-white flex items-center">
        <input wire:model="search" type="text" class="focus:outline-none w-full text-xs font-normal" placeholder="მოძებნეთ კლიენტი..">
        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
            <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
          </svg>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4">
        <div class="col-span-1 py-2">
            <div class="bg-white p-3 text-left">
                <h6 class="font-bold text-xs">@lang('profile.date') <small>[@lang('profile.till')]</small></h6>
                <input type="date" wire:model="datefrom" class=" font-normal text-xs appearance-none block w-56 mt-1 bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"> 
            </div>
        </div>
        <div class="col-span-1 py-2">
            <div class="bg-white p-3 text-left">
                <h6 class="font-bold text-xs"> @lang('profile.date') <small>[@lang('profile.from')]</small></h6>
                <input type="date" wire:model="datetill"  class=" font-normal text-xs appearance-none block w-56 mt-1 bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"> 
            </div>
        </div>
        <div class="col-span-1 ml-2 py-2">
            <div class="bg-white p-3">
                <h6 class="font-bold text-xs">@lang('profile.type')</h6>
                <div class="relative w-56">
                    <select wire:model="type" class="font-normal text-xs appearance-none block w-56 mt-1 bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                      <option>@lang('profile.all')</option>
                      <option value="full">@lang('profile.complated')</option>
                      <option value="consignation">@lang('profile.dept')</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                      <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                    </div>
                  </div>
            </div>
        </div>
    </div>
    
    <div class="w-full mt-2 py-3 px-4 bg-white flex items-center">
        <div class="w-full md:w-1/4">
            <h6 class="font-medium text-xs">@lang('profile.client')</h6>
        </div>
        <div class="w-full md:w-1/4">
            <h6 class="font-medium text-xs">@lang('profile.date')</h6>
        </div>
        <div class="w-full md:w-1/4 flex items-center justify-center">
            <span class="font-bold text-green-700 text-xs">+{{number_format($income/100, 2)}}</span>
            <span class="font-bold text-red-700 text-xs ml-1">-{{number_format($dept/100, 2)}}</span>
        </div>
        <div class="w-full md:w-1/4 flex items-center justify-center">
            <h6 class="font-medium text-xs">@lang('profile.salary')</h6>
        </div>
    </div>
   @if ($clientservices)
    @foreach ($clientservices as $item)
    @if ($item->service)
    <a @if ($item->sale) href="{{route('showSale', $item->sale_id)}}" @else  href="{{route('showService', $item->service_id)}}"  @endif class="w-full mt-2 py-3 px-4 bg-white flex items-center">
        <div class="w-full md:w-1/4">
                @if ($item->sale)
                <h2 class="font-bolder text-xs text-gray-700">{{$item->sale->client->full_name_ge }}</h2>
                <div class="flex items-center">
                    <svg width="0.7em" height="0.7em" viewBox="0 0 16 16" class="bi bi-basket-fill" fill="#444" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M5.071 1.243a.5.5 0 0 1 .858.514L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H15v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9H.5a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 .5 6h1.717L5.07 1.243zM3.5 10.5a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3z"/>
                    </svg>
                    <h6 class="ml-1 font-medium font-caps text-gray-600" style="font-size: 0.65rem">{{$item->sale->client->number}}</h6>
                </div>
                @else
                <h2 class="font-bolder text-xs text-gray-700">{{$item->service ? $item->service->clinetserviceable->full_name_ge : '' }}</h2>
                <div class="flex items-center">
                    <svg width="0.7em" height="0.7em" viewBox="0 0 16 16" class="bi bi-scissors" fill="#444" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M3.5 3.5c-.614-.884-.074-1.962.858-2.5L8 7.226 11.642 1c.932.538 1.472 1.616.858 2.5L8.81 8.61l1.556 2.661a2.5 2.5 0 1 1-.794.637L8 9.73l-1.572 2.177a2.5 2.5 0 1 1-.794-.637L7.19 8.61 3.5 3.5zm2.5 10a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm7 0a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                    </svg>
                    <h6 class="ml-1 font-medium font-caps text-gray-600" style="font-size: 0.65rem">{{$item->service ? $item->service->clinetserviceable->number : ''}}</h6>
                </div>
                @endif
            </div>
            <div class="w-full md:w-1/4">
                @if ($item->sale)
                <h6 class="font-bolder text-xs text-gray-700">@lang('profile.buy_date')</h6>
                <span class=" font-medium font-caps text-gray-600" style="font-size: 0.65rem">{{$item->created_at}}</span>
                @else 
                <h6 class="font-bolder text-xs text-gray-700">@lang('profile.book_date')</h6>
                <span class=" font-medium font-caps text-gray-600" style="font-size: 0.65rem">{{$item->service ? $item->service->created_at : $item->service}}</span>
                @endif
            </div>
            <div class="w-full md:w-1/4 flex items-center justify-center">
                <div>
                    @if ($item->sale)
                    <h6 class="font-bolder text-xs text-green-700">+{{number_format($item->sale->paid/100, 2)}} </h6>
                    @if ($item->sale->total > $item->sale->paid)
                    <h6 class="font-bolder text-xs text-red-700"> -{{number_format(($item->sale->total - $item->sale->paid)/100 ,2)}}</h6>
                    @endif
                @else 
                    @if ($item->service  && $item->service->status == 1)
                        <h6 class="font-bolder text-xs text-green-700">+{{number_format($item->service->paid/100, 2)}}</h6>
                        @if ( $item->service->new_price > $item->service->paid)
                        <h6 class="font-bolder text-xs text-red-700">-{{number_format(($item->service->new_price - $item->service->paid)/100 ,2)}}</h6>
                        @endif
                    @endif
                @endif
                </div>
            </div>
            <div class="w-full flex items-center justify-center md:w-1/4">
                <div>
                    <span class="font-xs text-gray-700">
                        <small class="font-bold">{{$item->percent}}% =</small> {{number_format(($item->service_price * $item->percent/100)/100 ,2)}}
                    </span>
                </div>
            </div>
        </a>
    @endif
   
    @endforeach
    <div class="w-full mt-2">
        {{$clientservices->links('vendor.pagination.custom')}}
    </div>
   @endif
</div>
