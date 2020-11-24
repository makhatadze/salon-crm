<div>
    <div class="flex items-center">
        <div class="w-full bg-white flex items-center p-5 mr-2">
          <input type="text" wire:model="name" autofocus class="w-full font-normal text-xs focus:outline-none" placeholder="@lang('product.search')">
        <svg width="1.18em" height="1.18em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
          <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
        </svg>
        </div>
        <div class="w-64 bg-white ml-2 p-2">
          <span class="font-bolder font-caps text-xs">@lang('product.storage')</span>
          <select wire:model="storage" class="w-full focus:outline-none font-normal text-xs">
            <option value="">@lang('product.choose')</option>
            @foreach ($storages as $storage)
              <option value="{{$storage->id}}">{{$storage->name}}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="flex mt-2">
          <div class="bg-white w-1/2 p-2">
            <span class="font-bolder font-caps text-xs">@lang('product.price')</span> <small class="font-normal text-gray-600"> [@lang('product.from')]</small>
            <input wire:model="pricefrom" type="number" step="0.01" min="0" class="font-normal w-full text-xs focus:outline-none" placeholder="00.00">
          </div>
          <div class="w-1/2 bg-white ml-2 p-2">
            <span  class="font-bolder font-caps text-xs">@lang('product.price')</span> <small class="font-normal text-gray-600"> [@lang('product.till')]</small>
            <input type="number" wire:model="pricetill" step="0.01" min="0" class="font-normal w-full text-xs focus:outline-none" placeholder="00.00">
          </div>
          <div class="bg-white w-1/2 p-2 ml-2">
            <span  class="font-bolder font-caps text-xs">@lang('product.quantity')</span> <small class="font-normal text-gray-600"> [@lang('product.till')]</small>
            <input wire:model="stocktill" type="number" step="1" min="0" class="font-normal w-full text-xs focus:outline-none" placeholder="XXXX">
          </div>
          <div class="w-1/2 bg-white ml-2 p-2">
            <span class="font-bolder font-caps text-xs">@lang('product.brand')</span>
            <select wire:model="brand" class="w-full focus:outline-none font-normal text-xs">
              <option value="">@lang('product.choose')</option>
              @foreach ($brands as $brand)
                <option value="{{$brand->id}}">{{$brand->name}}</option>
              @endforeach
            </select>
          </div>
          <div class="w-1/2 bg-white ml-2 p-2">
            <span class="font-bolder font-caps text-xs">@lang('product.department')</span>
            <select wire:model="department" class="w-full focus:outline-none font-normal text-xs">
              <option value="">@lang('product.choose')</option>
              @foreach ($departments as $dept)
                  <option value="{{$dept->id}}">{{$dept->name_ge }}</option>
              @endforeach
            </select>
          </div>
      </div>
  
      <div class="grid font-medium text-xs grid-cols-12 bg-white p-3 block shadow-sm w-full mt-3">
        <div class="col-span-2">
          @lang('product.images')
        </div>
        <div class="col-span-2">
          @lang('product.name')
        </div>
        <div class="col-span-2">
          @lang('product.brand')
        </div>
        <div class="col-span-2">
          @lang('product.quantity')
        </div>
        <div class="col-span-2">
          @lang('product.price')
        </div>
        <div class="col-span-2">
          @lang('product.functions')
        </div>
      </div>
      @if ($products)
      @foreach ($products as $item)
      <div class="grid grid-cols-6  items-center @if($item->stock <= 1 && $item->type != 1) bg-red-500 @else bg-white @endif @if($item->type == 1) border-l-4 border-orange-300 @endif p-3 block shadow-sm w-full mt-3">
        <div class="col-span-2 md:col-span-1 flex">
          @foreach ($item->images as $key => $img)
            <img src="{{asset('../storage/productimage/'.$img->name)}}" class="w-8 h-8 object-cover rounded-full shadow -ml-1">
            @if ($key == 3)
                @break
            @endif
          @endforeach
        </div>
        <div class="col-span-2 md:col-span-1">
          <h6 class="font-medium text-black text-xs">
            {{$item->title_ge }}
          </h6>
        </div>
        <div class="col-span-2 md:col-span-1 font-bolder font-caps  text-xs">
          <h6 class="uppercase">{{$item->brand->name}}</h6>
          <small class="font-normal">{{$item->storage->name}}</small>
        </div>
        <div class="col-span-2 md:col-span-1 font-normal text-xs">
          {{$item->stock}} 
          @if($item->unit == "unit")
          @lang('product.unit')
          @elseif($item->unit == "gram")
          @lang('product.gram')
          @elseif($item->unit == "metre")
          @lang('product.centimeter')
          @endif <br>
          @if ($item->unit == "gram")
              <small>1 @lang('product.unit') = {{$item->gramunit}} @lang('product.gram')</small>
          @endif
        </div>
        <div class="col-span-1 md:col-span-2 lg:col-span-1 font-normal text-xs">
          <h6>{{$item->price/100}}
            @if ($item->currency_type == 'gel')
            @lang('money.icon')
            @endif</h6>
          @if ($item->purchase->dgg)
          <small>@lang('product.dgg'): {{($item->price*1.8/100)/100}}
          
            @if ($item->currency_type == 'gel')
            @lang('money.icon')
            @endif</small>
          @endif
        </div>
        <div x-data="{modal: false}" class="col-span-2 md:col-span-1">
          <div class="flex items-center">
            @php
                $randomKey = rand(1, 999999).$item->id;
                $randomKey2 = rand(1, 999999).$item->id;
                $randomKey3 = rand(1, 999999).$item->id;
            @endphp
            <livewire:product.writedown :product="$item" :key="$randomKey">
            <livewire:product.calculate :product="$item" :key="$randomKey2">
            <livewire:product.tobackstorage :product="$item" :key="$randomKey3">
            <a href="{{ route('ProductEdit', $item->id) }}" class="cursor-pointer p-2  bg-gray-200 rounded">
              <svg width="1.18em" height="1.18em" viewBox="0 0 16 16" class="bi bi-pencil-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
              </svg>
            </a>
              <button @click="modal = true" class="ml-3 cursor-pointer p-2 bg-gray-200 rounded">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                  <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                </svg>
              </button>
          </div>
          <x-modal x-show="modal">
  
            @if($item->type == 1)
            @if ($item->unlimited_expluatation)
            <p class="text-center font-normal text-xs">
              @lang('product.expunlimited')
            </p>
           @else
              {{-- Calcluated Info --}}
              <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                  <label class="text-left block uppercase tracking-wide text-gray-700 text-xs font-medium mb-2">
                    @lang('product.expstart')
                  </label>
                <input value="{{Carbon\Carbon::parse($item->expluatation_date)->isoFormat('DD-MM-Y')}}"
                   class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"  type="text" readonly>
                </div>
                <div class="w-full md:w-1/2 px-3">
                  <label class="text-left block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                    @lang('product.expend')
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
                    @lang('product.cveta')
                  </label>
                  <input value="{{$item->expluatation_days}}"
                   class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"  type="text" readonly>
                </div>
                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                  <label class="text-left block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                    @lang('product.buyprice')
                  </label>
                  <input value="{{$item->buy_price/100}} @if ($item->currency_type == 'gel') @lang('money.icon') @endif"
                  class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"  type="text" readonly>
                </div>
                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                  <label class="text-left block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                    @lang('product.cvetaprice')
                  </label>
                  <input value="{{number_format(($item->buy_price/100)/($item->expluatation_days == 0 ? 1 : $item->expluatation_days),7)}}"
                  class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"  type="text" readonly>
                  
               </div>
              </div>
              @endif
              @elseif($item->type == 2)
              <div class="flex">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                  <label class="text-left block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                    @lang('product.buyprice')
                  </label>
                  <input value="{{$item->buy_price/100}} @if ($item->currency_type == 'gel') @lang('money.icon') @endif"
                  class="appearance-none block  font-normal text-xs w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"  type="text" readonly>
                </div>
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                  <label class="text-left block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                    @lang('product.department')
                  </label>
                  <input value="{{$item->getDepartmentName()}}"
                  class="appearance-none font-normal text-xs block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"  type="text" readonly>
                </div>
              </div>
              @endif
          </x-modal>
        </div>
            
          </div>
      @endforeach
          {{$products->links()}}
      @endif
</div>
