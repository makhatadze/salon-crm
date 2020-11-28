<div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="col-span-12 md:col-span-3">
            <div class="bg-gray-300 w-full text-center font-bolder text-xs py-2 px-3 font-caps">
               @lang('voucher.createvoucher')
            </div>
            <form wire:submit.prevent="createvoucher" class="bg-white p-3">
                <div class="flex flex-wrap -mx-3">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                      <label class="font-caps text-xs block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                        @lang('voucher.code')
                      </label>
                      <input wire:model.lazy="code" class="font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" readonly  type="text" placeholder="Jane">
                      
                      @error('code')
                        <p class="font-normal text-xs text-red-500">{{$message}}</p>
                      @enderror
                    </div>
                    <div class="w-full md:w-1/2 px-3">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 font-caps text-xs">
                        @lang('voucher.money')
                      </label>
                      <input wire:model.lazy="money" class="font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" min="0" step="0.01" type="number" placeholder="x,xxx.xx">
                      
                      @error('money')
                        <p class="font-normal text-xs text-red-500">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="w-full  mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="cashier">
                        @lang('voucher.cashier')
                    </label>
                    <div class="relative">
                      <select wire:model="cashier" required class="block font-normal appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="cashier" >
                        <option value="" selected>@lang('voucher.choose')</option>
                        @foreach ($cashiers as $cashier)
                        <option value="{{$cashier->id}}">{{$cashier->name == "main" ? __('paymethod.miancashier') : $cashier->name}}</option>
                        @endforeach
                      </select>
                      <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                      </div>
                      @error('cashier')
                        <p class="font-normal text-xs text-red-500">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                  <button type="submit" class="font-bold mt-2 text-xs w-full py-2 px-3 bg-indigo-500 text-white">
                    @lang('voucher.create')
                  </button>
            </form>
            @if ($vouchers)
                <div class="bg-white p-2 w-full flex items-center mt-2">
                    <input type="text" class="w-full p-2 font-normal text-xs focus:outline-none" placeholder="@lang('voucher.code').." wire:model="search">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                        <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                      </svg>
                </div>
                @foreach ($vouchers as $item)
                    <div class="mt-3 bg-white p-3 flex items-center justify-between">
                        <div>
                            <h6 class="font-bolder text-xs">{{$item->code}}</h6>
                            <span class="font-normal text-gray-600" style="font-size: 0.7rem">@lang('voucher.date'): {{number_format($item->money/100,2)}}</span>
                        </div>
                        <div class="flex items-center">
                            @if ($item->voucherHistory()->count() == 0)
                                <span wire:click="deletevoucher({{$item->id}})" class="ml-2 cursor-pointer bg-gray-200 p-2 rounded-md">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash2-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2.037 3.225l1.684 10.104A2 2 0 0 0 5.694 15h4.612a2 2 0 0 0 1.973-1.671l1.684-10.104C13.627 4.224 11.085 5 8 5c-3.086 0-5.627-.776-5.963-1.775z"/>
                                        <path fill-rule="evenodd" d="M12.9 3c-.18-.14-.497-.307-.974-.466C10.967 2.214 9.58 2 8 2s-2.968.215-3.926.534c-.477.16-.795.327-.975.466.18.14.498.307.975.466C5.032 3.786 6.42 4 8 4s2.967-.215 3.926-.534c.477-.16.795-.327.975-.466zM8 5c3.314 0 6-.895 6-2s-2.686-2-6-2-6 .895-6 2 2.686 2 6 2z"/>
                                    </svg>
                                </span>
                            @endif
                            @if ($item->money != 0)
                            <span wire:click="changestatus({{$item->id}})" class="ml-2 cursor-pointer bg-gray-200 p-2 rounded-md">
                                <svg  width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-circle-fill " fill="@if($item->status == 1) #3dad82 @else #eb5257 @endif" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="8" cy="8" r="8"/>
                                </svg>
                            </span>
                            @endif
                            @if ($item->voucherhistory()->count() > 0)
                                <div x-data="{modal:false}">
                                    <span @click="modal=true" class="ml-2 block cursor-pointer bg-gray-200 p-2 rounded-md">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                            <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                        </svg>
                                    </span>
                                    <x-modal x-show="modal">
                                        @foreach ($item->voucherhistory as $item)
                                            <div class="col-span-1 w-full bg-gray-200 mb-2 p-2 flex items-center justify-between">
                                                <div>
                                                    <h6 class="font-medium text-xs">{{number_format($item->paid/100,2)}} <sup>@lang('money.icon')</sup></h6>
                                                    <span class="font-normal text-xs text-gray-600">@lang('voucher.pay')</span>
                                                </div>
                                                <div>
                                                    <h6 class="font-medium text-xs">{{$item->created_at}}</h6>
                                                    <span class="font-normal text-xs text-gray-600">@lang('voucher.date')</span>
                                                </div>
                                                <div>
                                                <p class="font-medium text-xs">{{$item->description}}</p>
                                                <span class="font-normal text-xs text-gray-600">@lang('voucher.reason')</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </x-modal>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach

                <div class="w-full">
                    {{$vouchers->links()}}
                </div>
            @endif
        </div>
    </div>
</div>
