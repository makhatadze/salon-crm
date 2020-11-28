<div>
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 xxl:col-span-3 -mb-10 pb-10">
            <div class="col-span-12 md:col-span-6 xl:col-span-4 xxl:col-span-12 mt-3 xxl:mt-8">
                <div class="box p-2 items-center flex justify-center">
                @if ($success)
                    <div class="grid-col-12">
                        <div class="flex justify-between w-full ">
                            <div>
                            <svg width="1.8rem" height="1.8rem" viewBox="0 0 16 16" class="bi bi-credit-card-2-front-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2.5 1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h2a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-2zm0 3a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1zm3 0a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1zm3 0a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1zm3 0a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1z"/>
                            </svg>
                            </div>
                            <div class="text-left ml-3">
                                <h4 class="font-bolder">@lang('paymethod.title')</h4>
                                <p class="font-normal text-gray-600 font-normal text-xs">@lang('paymethod.text')</p>
                            </div>
                            
                        </div>
                        <input wire:click="resetsuccess" class="font-bolder cursor-pointer text-xs font-caps appearance-none block w-full bg-gray-200 mt-3 text-gray-800 border border-gray-200 rounded py-3 px-4 leading-tight" type="button" value=" @lang('paymethod.addagain')">
                    </div>    
                @else 
                <form class="block w-full" @if($update_id == "") wire:submit.prevent="savePaymethod"@else wire:submit.prevent="update({{$update_id}})" @endif >
                        <div class="w-full p-2">
                           
                            <div class="flex flex-wrap -mx-3 mb-3">
                                <div class="w-full px-3">
                                  <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                                    @lang('paymethod.name')
                                  </label>
                                  <input required wire:model="name_ge" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"type="text" placeholder="xxxxxxxxxxxxxxx">
                                </div>
                              </div>
                            
                            <div class="w-full mb-4 mt-3 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                                    @lang('paymethod.cashier')
                                </label>
                                <div class="relative">
                                  <select wire:model="cashier_id" required class="block font-normal text-xs appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" >
                                    <option value="">@lang('paymethod.choose')</option>
                                    @foreach ($cashiers as $cashier)
                                    <option value="{{$cashier->id}}">{{$cashier->name == "main" ? __('paymethod.miancashier') : $cashier->name}}</option>
                                    @endforeach
                                  </select>
                                  <div x-data="{modal:false}" class="z-40 cursor-pointer absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg @click="modal=true" width="1.18em" height="1.18em" viewBox="0 0 16 16" class="bi bi-plus-circle-fill" fill="#72b597" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                                      </svg>
                                      <x-modal x-show="modal">
                                        <div class="flex flex-wrap -mx-3 mb-6">
                                            <div class="w-full px-3">
                                              <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" >
                                                @lang('paymethod.cashier')
                                              </label>
                                              <input wire:model="cashier" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 text-xs font-normal rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="xxxxxxxxxxxx">
                                              <button wire:click="addcashier" class="appearance-none block w-full bg-indigo-500 text-white border font-bold text-xs rounded py-3 px-4 mb-3" type="button">
                                                @lang('paymethod.add')                                                 
                                              </button>
                                            </div>
                                          </div>
                                      </x-modal>
                                  </div>
                                </div>
                              </div>
                        </div>
                    <input class="font-bolder text-xs font-caps appearance-none block w-full bg-indigo-500 mt-3 text-white border border-gray-200 rounded py-3 px-4 leading-tight" type="submit" @if($update_id == "") value="@lang('paymethod.add')" @else value="@lang('paymethod.update')" @endif>    
                </form>
                @endif
                </div>
            </div>
            <div class="col-span-12 xxl:col-span-3 -mb-10 pb-10">
                <div class="col-span-12 md:col-span-6 xl:col-span-4 xxl:col-span-12 mt-3 xxl:mt-8">
                    <div class="mt-5">
                        @foreach ($payments as $pay)
                            <div class="intro-x">
                                <div class="bg-white z-10 px-5 py-3 mb-3 flex items-center zoom-in">
                                    <div class="ml-4 mr-auto">
                                        <div class="font-bold">{{$pay->name_ge }}</div>
                                        <div class="text-gray-600 font-normal" style="font-size: 0.67rem"> @lang('paymethod.added'): {{$pay->created_at}}</div>
                                    </div>
                                    <div class="text-theme-9 flex items-center">
                                        <a href="{{route('exportmethod', $pay->id)}}" class="block h-8 w-8 rounded-md bg-gray-200 p-2">
                                            <svg width="1.18em" height="1.18em" viewBox="0 0 16 16" class="bi bi-file-arrow-down-fill" fill="#404040" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM8 5a.5.5 0 0 1 .5.5v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 1 1 .708-.708L7.5 9.293V5.5A.5.5 0 0 1 8 5z"/>
                                            </svg>
                                        </a>
                                        <div wire:click="delete({{$pay->id}})" class="block h-8 w-8 rounded-md bg-gray-200 p-2 ml-3">
                                            <svg width="1.18em" height="1.18em" viewBox="0 0 16 16" class="bi bi-trash2-fill" fill="#404040" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M2.037 3.225l1.684 10.104A2 2 0 0 0 5.694 15h4.612a2 2 0 0 0 1.973-1.671l1.684-10.104C13.627 4.224 11.085 5 8 5c-3.086 0-5.627-.776-5.963-1.775z"/>
                                                <path fill-rule="evenodd" d="M12.9 3c-.18-.14-.497-.307-.974-.466C10.967 2.214 9.58 2 8 2s-2.968.215-3.926.534c-.477.16-.795.327-.975.466.18.14.498.307.975.466C5.032 3.786 6.42 4 8 4s2.967-.215 3.926-.534c.477-.16.795-.327.975-.466zM8 5c3.314 0 6-.895 6-2s-2.686-2-6-2-6 .895-6 2 2.686 2 6 2z"/>
                                              </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                       
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-span-12 xxl:col-span-3 -mb-10 pb-10">
            <div class="col-span-12 grid grid-cols-1 md:col-span-6 mt-8 ">
                @foreach ($cashiers as $cashier)
                    <div class="box col-span-1 mb-2 flex items-center justify-between py-3 px-4">
                        <div>
                            <h6 class="font-bold text-sm ">{{$cashier->name == "main" ? __('paymethod.miancashier') : $cashier->name}}</h6>
                            <small class="text-gray-600 font-normal">@lang('paymethod.money'): {{number_format($cashier->amout/100, 2)}}</small>
                        </div>
                        <div class="flex items-center">
                            @if ($cashier->paid()->count() == 0)
                            <span wire:click="removecashier({{$cashier->id}})" class="bg-gray-200 cursor-pointer block  p-2 rounded">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash2-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2.037 3.225l1.684 10.104A2 2 0 0 0 5.694 15h4.612a2 2 0 0 0 1.973-1.671l1.684-10.104C13.627 4.224 11.085 5 8 5c-3.086 0-5.627-.776-5.963-1.775z"/>
                                    <path fill-rule="evenodd" d="M12.9 3c-.18-.14-.497-.307-.974-.466C10.967 2.214 9.58 2 8 2s-2.968.215-3.926.534c-.477.16-.795.327-.975.466.18.14.498.307.975.466C5.032 3.786 6.42 4 8 4s2.967-.215 3.926-.534c.477-.16.795-.327.975-.466zM8 5c3.314 0 6-.895 6-2s-2.686-2-6-2-6 .895-6 2 2.686 2 6 2z"/>
                                  </svg>
                            </span>
                            @endif
                            
                            <div x-data="{modal:false}" class="block ml-2">
                                <span @click="modal = true" class="bg-gray-200 cursor-pointer block p-2 rounded">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                        <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                      </svg>
                                </span>
                                <x-modal x-show="modal">
                                    @foreach ($cashier->paid as $item)
                                        <div class="w-full p-3 bg-gray-200 mb-2">
                                            <h6 class="font-bold text-xs">{{number_format($item->amout/100,2)}} <sup>@lang('money.icon')</sup> </h6>
                                            <p class="font-normal text-xs">{{$item->description}}</p>
                                        </div>
                                    @endforeach
                                </x-modal>
                            </div>
                            <div x-data="{modal:false}" class="block ml-2">
                                <span @click="modal=true" class="block bg-gray-200 cursor-pointer p-2 rounded">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-credit-card-2-back-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v5H0V4zm11.5 1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h2a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-2z"/>
                                        <path d="M0 11v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-1H0z"/>
                                      </svg>
                                </span>
                                <x-modal x-show="modal">
                                    <form wire:submit.prevent="transfermoney({{$cashier->id}})">
                                        <div class="flex flex-wrap -mx-3 mb-1">
                                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                              <label class="font-caps text-xs block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                                @lang('paymethod.amout')
                                              </label>
                                              <input wire:model="amout" required class="appearance-none font-normal text-xs block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"  type="number" step="0.01" min="0" max="{{number_format($cashier->amout/100, 2)}}" placeholder="xxx.xx">
                                            </div>
                                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                                <label class="block uppercase font-caps text-xs tracking-wide text-gray-700 text-xs font-bold mb-2">
                                                    @lang('paymethod.cashier')
                                                </label>
                                                <div class="relative">
                                                <select wire:model="cash_id" required class="block font-normal text-xs appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                                                    <option value="">@lang('paymethod.choose')</option>
                                                    @foreach ($cashiers as $item)
                                                        @if ($cashier->id != $item->id)
                                                            <option value="{{$item->id}}">{{$item->name == "main" ? __('paymethod.miancashier') : $item->name}}</option>                                                            
                                                        @endif
                                                    @endforeach
                                                </select>
                                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        <div class=" w-full block">
                                            <button @click="modal = false" type="submit" class="py-3 w-full font-normal text-xs block px-4 bg-indigo-500 text-white font-caps text-xs ">
                                                @lang('paymethod.transfer')
                                            </button>
                                        </div>
                                    </form>
                                </x-modal>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
