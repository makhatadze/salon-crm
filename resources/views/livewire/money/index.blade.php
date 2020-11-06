<div>
    <div class="grid grid-cols-4 mt-3">
        <div class="col-span-1 px-4">
            <div class="bg-white p-3">
                <div class="flex items-center justify-between">
                    <a target="_blank" href="/purchases" class="font-bolder font-caps text-xs" style="color: #173858">@lang('finance.purchase')</a>
                    
                    <div class="relative ">
                        <select wire:model="purchasetime" class="block bg-gray-200 w-24 p-2 font-normal text-xs appearance-none pr-8 focus:outline-none" id="grid-state">
                          <option>@lang('finance.all')</option>
                          <option value="month">@lang('finance.month')</option>
                          <option value="today">@lang('finance.day')</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                          <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                      </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 py-3 gap-4">
                    <div class="col-span-1 flex items-center">
                        <img src="{{asset('../img/cheked.svg')}}" class="w-6 h-6 object-contain">
                        <div class="ml-2">
                            <span class="font-normal text-xs text-gray-600">@lang('finance.total')</span>
                            <h6 class="font-bolder text-sm text-gray-800">{{number_format($purchase/100, 2)}}</h6>
                        </div>
                    </div>
                    <div class="col-span-1 flex items-center">
                        <img src="{{asset('../img/warning.svg')}}" class="w-6 h-6 object-contain">
                        <div class="ml-2">
                            <span class="font-normal text-xs text-gray-600">@lang('finance.dept')</span>
                            <h6 class="font-bolder text-sm text-gray-800">{{number_format($purchasedept/100, 2)}}</h6>
                        </div>
                    </div>
                    <div class="col-span-1 px-3">
                        <a target="_blank" href="/purchases" class="border border-gray-400 py-2 px-4 font-medium font-caps text-xs text-center block w-full" style="color:#0075ff">@lang('finance.redirect')</a>
                    </div>
                    <div class="col-span-1 px-3">
                        <a target="_blank" href="{{route('PurchaseExport')}}" class="border border-gray-400 py-2 px-4 font-medium font-caps text-xs text-center w-full block text-white" style="background: #0075ff">@lang('finance.export')</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-1 px-4">
            <div class="bg-white p-3">
                <div class="flex items-center justify-between">
                    <a target="_blank" href="/products" class="font-bolder font-caps text-xs" style="color: #173858">@lang('finance.product')</a>
                    
                    <div class="relative ">
                        <select wire:model="productstime" class="block bg-gray-200 w-24 p-2 font-normal text-xs appearance-none pr-8 focus:outline-none" id="grid-state">
                            <option>@lang('finance.all')</option>
                            <option value="month">@lang('finance.month')</option>
                            <option value="today">@lang('finance.day')</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                          <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                      </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 py-3 gap-4">
                    <div class="col-span-1 flex items-center">
                        <img src="{{asset('../img/cheked.svg')}}" class="w-6 h-6 object-contain">
                        <div class="ml-2">
                            <span class="font-normal text-xs text-gray-600">@lang('finance.total')</span>
                            <h6 class="font-bolder text-sm text-gray-800">{{number_format($products/100, 2)}}</h6>
                        </div>
                    </div>
                    <div class="col-span-1 flex items-center">
                        <img src="{{asset('../img/warning.svg')}}" class="w-6 h-6 object-contain">
                        <div class="ml-2">
                            <span class="font-normal text-xs text-gray-600">@lang('finance.sold')</span>
                            <h6 class="font-bolder text-sm text-gray-800">{{number_format($soldproducts/100, 2)}}</h6>
                        </div>
                    </div>
                    <div class="col-span-1 px-3">
                        <a target="_blank" href="/products" class="border border-gray-400 py-2 px-4 font-medium font-caps text-xs text-center block w-full" style="color:#0075ff">@lang('finance.redirect')</a>
                    </div>
                    <div class="col-span-1 px-3">
                        <a target="_blank" href="{{route('ProductExport')}}" class="border border-gray-400 py-2 px-4 font-medium font-caps text-xs text-center w-full block text-white" style="background: #0075ff">@lang('finance.export')</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-1 px-4">
            <div class="bg-white p-3">
                <div class="flex items-center justify-between">
                    <a target="_blank" href="/clients" class="font-bolder font-caps text-xs" style="color: #173858">@lang('finance.service')</a>
                    
                    <div class="relative ">
                        <select wire:model="servicetime" class="block bg-gray-200 w-24 p-2 font-normal text-xs appearance-none pr-8 focus:outline-none" id="grid-state">
                            <option>@lang('finance.all')</option>
                            <option value="month">@lang('finance.month')</option>
                            <option value="today">@lang('finance.day')</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                          <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                      </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 py-3 gap-4">
                    <div class="col-span-1 flex items-center">
                        <img src="{{asset('../img/cheked.svg')}}" class="w-6 h-6 object-contain">
                        <div class="ml-2">
                            <span class="font-normal text-xs text-gray-600">@lang('finance.total')</span>
                            <h6 class="font-bolder text-sm text-gray-800">{{number_format($services/100, 2)}}</h6>
                        </div>
                    </div>
                    <div class="col-span-1 flex items-center">
                        <img src="{{asset('../img/warning.svg')}}" class="w-6 h-6 object-contain">
                        <div class="ml-2">
                            <span class="font-normal text-xs text-gray-600">@lang('finance.sold')</span>
                            <h6 class="font-bolder text-sm text-gray-800">{{number_format($servicessold/100, 2)}}</h6>
                        </div>
                    </div>
                    <div class="col-span-1 px-3">
                        <a target="_blank" href="/clients" class="border border-gray-400 py-2 px-4 font-medium font-caps text-xs text-center block w-full" style="color:#0075ff">@lang('finance.redirect')</a>
                    </div>
                    <div class="col-span-1 px-3">
                        <a target="_blank" href="{{route('ServiceExport')}}" class="border border-gray-400 py-2 px-4 font-medium font-caps text-xs text-center w-full block text-white" style="background: #0075ff">@lang('finance.export')</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-1 px-4">
            <div class="bg-white p-3">
                <div class="flex items-center justify-between">
                    <a target="_blank" href="/clients" class="font-bolder font-caps text-xs" style="color: #173858">@lang('finance.clients')</a>
                    
                    <div class="relative ">
                        <select wire:model="clientstime" class="block bg-gray-200 w-24 p-2 font-normal text-xs appearance-none pr-8 focus:outline-none" id="grid-state">
                            <option>@lang('finance.all')</option>
                            <option value="month">@lang('finance.month')</option>
                            <option value="today">@lang('finance.day')</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                          <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                      </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 py-3 gap-4">
                    <div class="col-span-1 flex items-center">
                        <img src="{{asset('../img/cheked.svg')}}" class="w-6 h-6 object-contain">
                        <div class="ml-2">
                            <span class="font-normal text-xs text-gray-600">@lang('finance.paid')</span>
                            <h6 class="font-bolder text-sm text-gray-800">{{number_format($clients/100, 2)}}</h6>
                        </div>
                    </div>
                    <div class="col-span-1 flex items-center">
                        <img src="{{asset('../img/warning.svg')}}" class="w-6 h-6 object-contain">
                        <div class="ml-2">
                            <span class="font-normal text-xs text-gray-600">@lang('finance.dept')</span>
                            <h6 class="font-bolder text-sm text-gray-800">{{number_format($clientsdept/100, 2)}}</h6>
                        </div>
                    </div>
                    <div class="col-span-1 px-3">
                        <a target="_blank" href="/clients" class="border border-gray-400 py-2 px-4 font-medium font-caps text-xs text-center block w-full" style="color:#0075ff">@lang('finance.redirect')</a>
                    </div>
                    <div class="col-span-1 px-3">
                        <a target="_blank" href="{{route('ClientExport')}}" class="border border-gray-400 py-2 px-4 font-medium font-caps text-xs text-center w-full block text-white" style="background: #0075ff">@lang('finance.export')</a>
                    </div>
                </div>
            </div>
        </div>





        
    </div>
</div>
