<div>
    <div class="bg-white p-3">
        <div class="flex items-center">
          <input type="text" wire:model="name" autofocus class="w-full font-normal text-xs focus:outline-none" placeholder="მოძებნეთ პროდუქტნის სახელით..">
        <svg width="1.18em" height="1.18em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
          <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
        </svg>
        </div>
      </div>
      <div class="flex mt-2">
          <div class="bg-white w-1/2 p-2">
            <span class="font-bolder font-caps text-xs">ფასი</span> <small class="font-normal text-gray-600">_დან</small>
            <input wire:model="pricefrom" type="number" step="0.01" min="0" class="font-normal w-full text-xs focus:outline-none" placeholder="00.00">
          </div>
          <div class="w-1/2 bg-white ml-2 p-2">
            <span  class="font-bolder font-caps text-xs">ფასი</span> <small class="font-normal text-gray-600">_მდე</small>
            <input type="number" wire:model="pricetill" step="0.01" min="0" class="font-normal w-full text-xs focus:outline-none" placeholder="00.00">
          </div>
          <div class="bg-white w-1/2 p-2 ml-2">
            <span  class="font-bolder font-caps text-xs">რაოდენობა</span> <small class="font-normal text-gray-600">_მდე</small>
            <input wire:model="stocktill" type="number" step="1" min="0" class="font-normal w-full text-xs focus:outline-none" placeholder="XXXX">
          </div>
          <div class="w-1/2 bg-white ml-2 p-2">
            <span class="font-bolder font-caps text-xs">ბრენდი</span>
            <select wire:model="brand" class="w-full focus:outline-none font-normal text-xs">
              <option value="">აირჩიეთ</option>
              @foreach ($brands as $brand)
                <option value="{{$brand->id}}">{{$brand->name}}</option>
              @endforeach
            </select>
          </div>
          <div class="w-1/2 bg-white ml-2 p-2">
            <span class="font-bolder font-caps text-xs">ერთეული</span>
            <select wire:model="unit" class="w-full focus:outline-none font-normal text-xs">
              <option value="">აირჩიეთ</option>
              <option value="unit">ერთეული</option>
              <option value="metre">მეტრი</option>
              <option value="gram">გრამი</option>
            </select>
          </div>
      </div>
  
      <div class="grid font-medium text-xs grid-cols-12 bg-white p-3 block shadow-sm w-full mt-3">
        <div class="col-span-2">
          სურათები
        </div>
        <div class="col-span-2">
          დასახელება
        </div>
        <div class="col-span-2">
          ბრენდი
        </div>
        <div class="col-span-2">
          რაოდენობა
        </div>
        <div class="col-span-2">
          ფასი
        </div>
        <div class="col-span-2">
          ფუნქციები
        </div>
      </div>
      @if ($products)
      @foreach ($products as $item)
      <div class="flex items-center bg-white p-3 block shadow-sm w-full mt-3">
        <div class="w-2/12 flex">
          @foreach ($item->images as $key => $img)
            <img src="{{asset('../storage/productimage/'.$img->name)}}" class="w-8 h-8 object-cover rounded-full shadow -ml-1">
            @if ($key == 3)
                @break
            @endif
          @endforeach
        </div>
        <div class="w-2/12">
          <h6 class="font-medium text-black text-xs">
            {{$item->{'title_'.app()->getLocale()} }}
          </h6>
        </div>
        <div class="w-2/12 font-bolder font-caps uppercase text-xs">
          {{$item->brand->name}}
        </div>
        <div class="w-2/12 font-normal text-xs">
          {{$item->stock}} 
          @if($item->unit == "unit")
          ერთეული
          @elseif($item->unit == "gram")
          გრამი
          @elseif($item->unit == "metre")
          სანტიმეტრი
          @endif
        </div>
        <div class="w-2/12 font-normal text-xs">
          <h6>{{$item->price/100}}
            @if ($item->currency_type == 'gel')
            ₾
            @elseif($item->currency_type == 'usd')
            $
            @elseif($item->currency_type == 'eur')
            €
            @endif</h6>
          @if ($item->purchase->dgg)
          <small>დღგ: {{($item->price*1.8/100)/100}}
          
            @if ($item->currency_type == 'gel')
            ₾
            @elseif($item->currency_type == 'usd')
            $
            @elseif($item->currency_type == 'eur')
            €
            @endif</small>
          @endif
        </div>
        <div x-data="{modal: false}" class="w-2/12">
          <div class="flex items-center">
            <a href="{{ route('ProductEdit', $item->id) }}" class="cursor-pointer p-2  bg-gray-200 rounded">
              <svg width="1.18em" height="1.18em" viewBox="0 0 16 16" class="bi bi-pencil-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
              </svg>
            </a>
            @if ($item->type == 1)
              <button @click="modal = true" class="ml-3 cursor-pointer p-2 bg-gray-200 rounded">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                  <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                </svg>
              </button>
            @endif
          </div>
          @if($item->type == 1)
          <x-modal x-show="modal">
  
            @if ($item->unlimited_expluatation)
            <p class="text-center font-normal text-xs">
              ექსპლუატაციის პერიოდი უსასრულოა.
            </p>
           @else
              {{-- Calcluated Info --}}
              <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                  <label class="text-left block uppercase tracking-wide text-gray-700 text-xs font-medium mb-2">
                    ექსპლუატაციის დაწყება
                  </label>
                <input value="{{Carbon\Carbon::parse($item->expluatation_date)->isoFormat('DD-MM-Y')}}"
                   class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"  type="text" readonly>
                </div>
                <div class="w-full md:w-1/2 px-3">
                  <label class="text-left block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                    ექსპლუატაციის დასრულება
                  </label>
                  <input value="{{Carbon\Carbon::parse($item->expluatation_date)->addDays(intval($item->expluatation_days))->isoFormat('DD-MM-Y')}}"
                   class="
                   @if(Carbon\Carbon::parse($item->expluatation_date)->addDays(intval($item->expluatation_days)) < Carbon\Carbon::now())
                   bg-red-500 text-white font-bold
                   @else 
                   bg-gray-200 text-gray-700 font-normal
                   @endif
                   appearance-none block w-full border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:text-gray-700 focus:bg-white focus:border-gray-500"  type="text" readonly>
                </div>
              </div>
             
              <div class="flex flex-wrap -mx-3 mb-2">
                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                  <label class="text-left block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                    ცვეთა <small>(დღე)</small>
                  </label>
                  <input value="{{$item->expluatation_days}}"
                   class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"  type="text" readonly>
                </div>
                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                  <label class="text-left block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                    თვითღირებულება
                  </label>
                  <input value="{{$item->price/100}} @if ($item->currency_type == 'gel')₾@elseif($item->currency_type == 'usd')$@elseif($item->currency_type == 'eur') €@endif"
                  class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"  type="text" readonly>
                </div>
                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                  <label class="text-left block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                    ცვეთის ფასი
                  </label>
                  <input value="{{number_format(($item->price/100)/$item->expluatation_days,2)}}"
                  class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"  type="text" readonly>
                  
               </div>
              </div>
              @endif
  
          </x-modal>
          @endif
        </div>
            
          </div>
      @endforeach
          {{$products->links()}}
      @endif
</div>
