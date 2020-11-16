<div>
    <div x-data="{modal: false}">
        <button @click="modal = true" class="p-2 @if($purchase->paidpurchases()->sum('paid') == $purchase->getPrice()) {{$purchase->paidpurchases()->sum('paid') == $purchase->getPrice()}} bg-green-400 @else bg-orange-400 @endif rounded-lg ml-2">
          <svg width="1.18em" height="1.18em" viewBox="0 0 16 16" class="bi bi-credit-card-2-front-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2.5 1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h2a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-2zm0 3a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1zm3 0a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1zm3 0a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1zm3 0a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1z"/>
          </svg>
        </button>
        <x-modal x-show="modal">
          @if (($this->purchase->getPrice() - $purchase->paidpurchases()->sum('paid'))/100 > 0)
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/2 px-3">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" >
                        @lang('purchase.dept')  {{number_format($purchase->getPrice()/100 - $purchase->paidpurchases()->sum('paid')/100, 2)}}
                      </label>
                      <input  class="font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="number"  wire:model="paid" min="0" max="{{($purchase->getPrice() - $purchase->paidpurchases()->sum('paid')) < ($money ?? 0) ? round(($purchase->getPrice() - $purchase->paidpurchases()->sum('paid'))/100, 2) : number_format($money/100 ,2)}}" step="0.01" placeholder="@lang('purchase.depttime')">
                      @error('paid')
                        <p class="font-normal text-xs text-red-500">
                            {{$message}}      
                        </p>
                      @enderror
                    </div>
                    <div class="w-full md:w-1/2 px-3">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                        @lang('purchase.paymethod')
                      </label>
                      <div class="relative">
                        <select wire:model="cashier_id" class="font-normal text-xs block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" >
                            <option value="">@lang('purchase.choosepaymethod')</option>
                            @foreach ($cashiers as $cashier)
                                <option value="{{$cashier->id}}">{{$cashier->name == "main" ? __('paymethod.miancashier') : $cashier->name}}</option>
                            @endforeach
                        </select>
                        @if ($money)
                        <small>{{number_format($money/100 ,2)}} <sup> @lang('money.icon')</sup></small>
                        @endif
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                          <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                      </div>
                      @error('methodid')
                        <p class="font-normal text-xs text-red-500">
                            {{$message}}      
                        </p>
                      @enderror
                    </div>
                    <div class="px-3 mt-3 w-full">
                          
                        <button wire:click="payPurchase" class="bg-indigo-500 block w-full py-3 text-center text-xs font-bold text-white">
                          @lang('purchase.update')
                      </button>
                    </div>
                  </div>
                  @endif
                  @foreach ($paidpurchases as $pay)
                    <div class="flex items-center justify-between py-3 bg-gray-200 px-4">
                        <div class="flex items-center">
                            <img src="{{asset('../img/cheked.svg')}}" class="w-5 h-5 object-contain shadow-none" style="box-shadow: none;">
                            <div class="ml-3 text-xs">
                                <h6 class="font-bolder">
                                    {{number_format($pay->paid/100, 2)}} <sup>@lang('money.icon')</sup>
                                </h6>
                                <small class="font-normal text-xs text-gray-600">
                                        {{$pay->pay->name ? ($pay->pay->name == "main" ? __('paymethod.miancashier') : $pay->pay->name) : ($pay->pay_name == "consignation" ? __('purchase.consignation') : $pay->pay_name) }}
                                        <br>
                                        
                                    {{$pay->created_at}}
                                </small>
                            </div>
                        </div>
                        <div class="ml-3 text-xs text-right">
                            <h6 class="font-bolder">
                                {{$pay->user->profile->first_name .' '. $pay->user->profile->last_name}}
                            </h6>
                            <small class="font-normal text-xs text-gray-600"> @lang('purchase.depttime'): {{number_format($pay->dept/100, 2)}} <sup> @lang('money.icon')</sup></small>
                        </div>
                    </div>
                  @endforeach
        </x-modal>  
      </div>
</div>
