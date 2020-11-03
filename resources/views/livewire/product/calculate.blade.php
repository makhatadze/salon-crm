<div>
    <div x-data="{modal:false}">
        <span @click="modal = true" class="bg-gray-200 p-2 cursor-pointer rounded mr-2 block">
            <svg width="1.18em" height="1.18em" viewBox="0 0 16 16" class="bi bi-calculator-fill" fill="#444" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm2 .5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-2zm0 4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zM4.5 9a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zM4 12.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zM7.5 6a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zM7 9.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm.5 2.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zM10 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm.5 2.5a.5.5 0 0 0-.5.5v4a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-4a.5.5 0 0 0-.5-.5h-1z"/>
              </svg>
        </span>
        <x-modal x-show="modal">
            <div class="flex flex-wrap -mx-3 mb-2">
                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0  flex items-center justify-center">
                  <div>
                    <small class="text-xs font-normal">დარჩენილი</small>
                    <h6 class="font-bold text-xs">
                      {{$product->stock}}
                      @if ($product->unit == "gram")
                          გრამი
                      @elseif ($product->unit == "metre")
                          მეტრი
                      @elseif ($product->unit == "unit")
                          ცალი
                      @endif
                    </h6>
                  </div>
                  
                </div>
                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0 flex items-center justify-center">
                  <div>
                    <input class="font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" wire:model="amout" type="number" min="1" step="1" max="{{$product->stock}}" value="1">
                    <p class="w-full block font-normal @if($product->stock - ($amout ? intval($amout) : 1) < 0) text-red-500 @endif" style="font-size: 0.7rem">
                        {{$message}}
                    </p>
                  </div>
                </div>
                <div class="w-full font-normal text-xs md:w-1/3 px-3 mb-6 md:mb-0  flex items-center justify-center">
                    @if ($product->unit == "gram")
                    გრამი
                    @elseif ($product->unit == "metre")
                        მეტრი
                    @elseif ($product->unit == "unit")
                        ცალი
                    @endif = <span class="font-bold ml-1 text-sm">
                                {{($amout ? intval($amout) : 1) * $product->price/100}}
                            </span> <sup class="ml-1"> ₾</sup>
                  </div>
              </div>
        </x-modal>
    </div>
</div>
