<div>
   @if ($purchases)
   <div class="w-full p-2 bg-white flex items-center my-1">
       <input type="text" class="w-full font-normal text-xs focus:outline-none" wire:model="search" placeholder="#@lang('distributor.number')">
       <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
        <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
      </svg>
   </div>
   <div class="p-1 flex items-center">
       <input type="checkbox" id="dept" wire:model="dept">
       <label for="dept" class="font-normal text-xs ml-2">@lang('distributor.dept')</label>
   </div>
   @foreach ($purchases as $purchase)
   <a href="/purchases/edit/{{$purchase->id}}" class="my-2 @if($purchase->getPrice() != $purchase->paid) border-l-2 border-red-400 pl-2 @endif zoom-in flex items-center justify-between">
       <div>
           @if ($purchase->purchase_type == "overhead")
           <h6 class="font-bolder text-xs text-black">#{{$purchase->overhead_number}}</h6>
           <small class="font-normal">@lang('distributor.overheadnumber')</small>
           @elseif($purchase->purchase_type == "purchase")
           <h6 class="font-bolder text-black">#{{$purchase->purchase_number}}</h6>
           <small class="font-normal">@lang('distributor.purchasenumber')</small>
           @endif
       </div>
       @if ($purchase->getPrice() != $purchase->paid)
           <div>
               <h6 class="font-bolder text-xs text-black">{{number_format(($purchase->getPrice() - $purchase->paid)/100,2)}}</h6>
               <small class="font-normal">@lang('distributor.dept')</small>
           </div>
       @endif
       <div>
           <h6 class="font-bolder text-xs text-black">{{$purchase->distributor->name_ge }}</h6>
       <small class="font-normal">{{$purchase->updated_at}}</small>
       </div>
   </a>
   <hr>
   @endforeach
   <div class="w-full">
       {{$purchases->links()}}
   </div>
   @endif
</div>
