<div>
    <h6 class="w-full font-bold mb-2 font-caps text-xs">@lang('clients.sales')  <small class="font-normal ml-1">( {{$client->sales()->count()}} )</small></h6>
    <div class="p-2 bg-gray-200 flex items-center justify-center">
        <input type="checkbox" name="consignation" id="consignation" wire:model="consignation">
        <label for="consignation" class="font-normal text-xs ml-2">@lang('clients.consignation')</label>
    </div>
    @if ($sales)
        @foreach ($sales as $item)
            <a target="_blank" href="{{route('showSale', $item->id)}}" class="w-full @if($item->pay_method == "consignation" && $item->total > $item->paid) border-l-2 border-red-500 @endif mt-2 bg-gray-200 p-2 flex items-center justify-between">
                <div>
                    <small class="font-normal">{{$item->created_at}}</small> <br>
                    @if($item->pay_method == "consignation" && $item->total > $item->paid) <small class="font-normal">@lang('clients.dept')</small> @endif
                </div>
                <span class="font-normal text-xs">
                    {{$item->total/100}} <sup>@lang('money.icon')</sup>
                </span>
            </a>
        @endforeach
        {{$sales->links()}}
    @endif
</div>
