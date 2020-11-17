<div>
    <div class="flex items-center justify-center mx-auto ">
        <div class="mt-3 mx-auto md:col-span-5" style="width: 70%">
            <div class="bg-white p-2 w-full block">
                <div class="flex items-center">
                    <input wire:model="search" class="font-normal text-xs appearance-none block w-full bg-white text-gray-700 py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="@lang('salary.search')">
                <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                    <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                  </svg>
                </div>
            </div>
            <div class="grid py-3 grid-cols-2 md:grid-cols-5 font-normal text-xs">
                <div class="col-span-1 flex items-center justify-center">
                    <input type="checkbox" wire:model="standard" id="standard">
                    <label for="standard" class="ml-2">@lang('salary.standard')</label>
                </div>
                <div class="col-span-1 flex items-center justify-center">
                    <input type="checkbox" wire:model="earn" id="earn">
                    <label for="earn" class="ml-2">@lang('salary.earn')</label>
                </div>
                <div class="col-span-1 flex items-center justify-center">
                    <input type="checkbox" wire:model="avansi" id="avansi">
                    <label for="avansi" class="ml-2">@lang('salary.dept')</label>
                </div>
                <div class="col-span-1 flex items-center justify-center">
                        <div class="relative">
                          <select wire:model="cashier" class="block appearance-none w-full  border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight  focus:outline-none" style="background-color:#f1f5f8">
                            <option value="">@lang('paymethod.choose') @lang('paymethod.cashier')</option>
                            @foreach ($cashiers as $cashier)
                                <option value="{{$cashier->id}}">{{$cashier->name == "main" ? __('paymethod.miancashier') : $cashier->name  }}</option>
                            @endforeach
                          </select>
                          <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                          </div>
                        </div>
                </div>
                <div class="col-span-1 flex items-center justify-center">
                    <a href="{{route('exportsalary')}}" class="flex items-center">
                        <svg width="1.18em" height="1.18em" viewBox="0 0 16 16" class="bi bi-cloud-arrow-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.406 3.342A5.53 5.53 0 0 1 8 2c2.69 0 4.923 2 5.166 4.579C14.758 6.804 16 8.137 16 9.773 16 11.569 14.502 13 12.687 13H3.781C1.708 13 0 11.366 0 9.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383zm.653.757c-.757.653-1.153 1.44-1.153 2.056v.448l-.445.049C2.064 6.805 1 7.952 1 9.318 1 10.785 2.23 12 3.781 12h8.906C13.98 12 15 10.988 15 9.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 4.825 10.328 3 8 3a4.53 4.53 0 0 0-2.941 1.1z"/>
                            <path fill-rule="evenodd" d="M7.646 10.854a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 9.293V5.5a.5.5 0 0 0-1 0v3.793L6.354 8.146a.5.5 0 1 0-.708.708l2 2z"/>
                          </svg>
                          <span class="ml-2">
                            @lang('finance.export')
                          </span>
                    </a>
                </div>
            </div>
            @if ($salaries)
                @foreach ($salaries as $item)
                <div class="bg-white p-3 w-full block mt-2 grid grid-cols-12 ">
                    <div class="col-span-3">
                        <small class="font-normal text-xs">@lang('salary.employee')</small>
                        <h6 class="font-bolder text-xs text-gray-700">{{$item->first_name .' '. $item->last_name}}</h6>
                    </div>
                    <div class="col-span-2">
                        @if ($item->type == "avansi" || $item->type == "salary")
                        <small class="font-normal text-xs">@if($item->type == "avansi")@lang('salary.dept') @elseif($item->type == "salary") @lang('salary.standard') @endif</small>
                        <h6 class="font-bolder text-xs text-gray-700">{{number_format($item->salary/100 ,2)}} <sup>@lang('money.icon')</sup> </h6>   
                        @endif
                    </div>
                    <div class="col-span-2">
                        @if ($item->type == "earn")
                                <small class="font-normal text-xs">@lang('salary.earn')</small>
                                <h6 class="font-bolder text-xs text-gray-700"> {{number_format($item->made_salary/100, 2)}} <sup>@lang('money.icon')</sup> </h6>
                        @endif
                    </div>
                    <div class="col-span-2">
                        @if($item->type == "salary")
                            <small class="font-normal text-xs">@lang('salary.bonus')</small>
                            <h6 class="font-bolder text-xs text-gray-700">{{number_format($item->bonus/100 ,2)}} <sup>₾</sup> </h6>
                        @endif
                    </div>
                    <div class="col-span-2">
                        <small class="font-normal text-xs">@lang('salary.type')</small>
                        <h6 class="font-bold text-xs text-gray-700">
                            @if ($item->type == 'salary')
                            @lang('salary.standard')
                            @elseif ($item->type == 'avansi')
                            @lang('salary.dept')
                            @elseif ($item->type == 'earn')
                            @lang('salary.earn')
                            @endif
                        </h6>
                    </div>
                    <div class="col-span-1">
                        <small class="font-normal text-xs">@lang('salary.date')</small>
                        <h6 class="font-bolder text-xs text-gray-700">{{Carbon\Carbon::parse($item->created_at)->isoFormat('Y-MM-DD')}}</h6>
                    </div>
                    <div class="col-span-12 mt-1">
                        <p>{{$item->description}}</p>
                    </div>
                </div>
                @endforeach
                <div class="w-full mt-2">
                    {{$salaries->links()}}
                </div>
            @endif
        </div>
    </div>
</div>
