<div>
  <div class="grid grid-cols-12 gap-6 mt-5">
    @if (session('error'))
    <p class="mx-auto bg-red-400 px-8 col-span-12 font-normal text-xs py-2 text-white relative" id="error">
    <span onclick="$('#error').remove()" class="text-red-400 cursor-pointer bg-white p-1 rounded-full absolute top-0 right-0 -ml-2 -mt-2 flex items-center justify-center shadow h-6 w-6">-</span>
      {{session('error')}}
    </p>
    @endif
      <div class="col-span-12 xxl:col-span-9 grid grid-cols-12 gap-6">

          {{-- Modal --}}
          @if($modalState)
          <div class="modal overflow-y-auto show" style="padding-left: 0px; margin-top: 0px; margin-left: 0px; z-index: 51;">
          @else 
          <div class="modal">
          @endif
              <div class="modal__content modal__content--xl p-10 text-center">
                  
              <form @if($updateId) action="{{ route('departmentToHouse', $updateId) }}" @endif method="POST">
                  @csrf
                  <div class="flex flex-wrap -mx-3 mb-2">
                      
                      <div class="w-full @if($isUnit) md:w-1/3 @endif px-3 mb-6 md:mb-0">
                          <label class="block font-caps text-left uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                            @lang('warehouse.choosedept')
                          </label>
                          <div class="relative">
                            <select name="dept_id" required class="block appearance-none font-normal text-xs w-full bg-gray-200 border border-gray-200 text-gray-700 py-4 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" >
                              <option value="">@lang('warehouse.choosedept')</option>
                              @foreach ($departments as $dept)
                            <option value="{{$dept->id}}">{{$dept->name_ge }}</option>
                              @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                              <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                          </div>
                        </div>
                        @if($isUnit)
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                      <label class="block text-left font-caps uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" >
                        @lang('warehouse.expluatationstart')
                      </label>
                      <input class="appearance-none block w-full text-xs font-normal bg-gray-200 text-gray-700 border border-gray-200 rounded py-4 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" required type="date" name="expluatation_date" value="<?php echo date("Y-m-d"); ?>">
                    </div>
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                      <label class="block text-left font-caps uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" >
                        @lang('warehouse.expduration')
                      </label>
                      <input class="appearance-none block w-full text-xs font-normal bg-gray-200 text-gray-700 border border-gray-200 rounded py-4 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" value="1" name="expluatation_days" required type="number" min="1" step="1">
                    </div>
                    @endif
                    <div class="mt-3 flex w-full">
                      <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                          <label class="block text-left font-caps uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" >
                            @lang('warehouse.amout')
                          </label>
                          <input required max="{{$maxunit}}" class="appearance-none block w-full text-xs font-normal bg-gray-200 text-gray-700 border border-gray-200 rounded py-4 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" value="1"  wire:model="typeamout" name="typeamout"  required type="number" min="1" step="1">
                          <p class="text-xs text-left font-normal text-red-500">
                          {{$error}}
                          </p>
                        </div>
                        <div class="w-full @if($isUnit) md:w-1/3 @endif px-3 mb-6 md:mb-0">
                          <label class="block font-caps text-left uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                            @lang('warehouse.chooseresp')
                          </label>
                          <div class="relative">
                            <select name="user_id" required class="block appearance-none font-normal text-xs w-full bg-gray-200 border border-gray-200 text-gray-700 py-4 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" >
                              <option value="">@lang('warehouse.choose')</option>
                              @foreach ($users as $user)
                            <option value="{{$user->id}}">{{$user->profile->first_name .' '. $user->profile->last_name}}</option>
                              @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                              <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                          </div>
                        </div>
                        @if($isUnit)
                        <div class="w-full md:w-1/3">
                        
                          <label class="block font-caps text-left uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                            @lang('warehouse.expluatation')
                          </label>
                          <div class="flex font-normal text-xs items-center py-3">
                            <input type="checkbox" id="unlimited_expluatation" class="mr-3" name="unlimited_expluatation">
                            <label for="unlimited_expluatation">
                              @lang('warehouse.unlimitedexp')
                            </label>
                          </div> 
                        </div>
                        @endif
                    </div>
                  </div>
                  <div class="flex">
                    <div class="w-full md:w-1/4">
                      <input type="number" step="0.01" min="{{number_format($minprice/100, 2)}}" required name="sell_price" placeholder="@lang('warehouse.sellprice')" class="text-xs rounded font-normal py-3 px-4 text-center bg-gray-200">
                    </div>
                    <div class="w-full md:w-3/4">
                      <input type="submit" value="@lang('warehouse.add')" class="appearance-none block w-full text-xs font-bold font-caps bg-indigo-500  text-white border border-gray-200 rounded py-3 px-4 leading-tight">
                    </div>
                  </div>
              </form>
           </div>
          </div>

          @if($products)
          <div class="w-full col-span-12 scroll-horizontal">
            <table class="table table-report -mt-2 col-span-12  warehouse-min-w">
                <thead>
                <tr>
                    <th class="whitespace-no-wrap font-bold font-caps text-xs text-gray-700">@lang('warehouse.name')</th>
                    <th class="text-center whitespace-no-wrap font-bold font-caps text-xs text-gray-700">@lang('warehouse.price')</th>
                    <th class="text-center whitespace-no-wrap font-bold font-caps text-xs text-gray-700">@lang('warehouse.dept')</th>
                    <th class="text-center whitespace-no-wrap font-bold font-caps text-xs text-gray-700">@lang('warehouse.status')</th>
                    <th class="text-center whitespace-no-wrap"></th>
                </tr>
                </thead>
                <tbody id="products">
                @foreach ($products as $prod)
                    <tr class="intro-x {{$prod->stock < 2 ? 'bg-warning' : ''}}">
                        <td @if($prod->stock == 0)  style="background-color: #ffaeae" @endif>
                            <a href=""
                               class="font-medium whitespace-no-wrap font-bold text-black">{{$prod->title_ge }}</a>
                            <div class="text-gray-600 text-xs whitespace-no-wrap font-normal"></div>
                        </td>
                        <td @if($prod->stock == 0)  style="background-color: #ffaeae"
                            @endif class="text-center font-normal">
                            <h6>{{$prod->buy_price/100}} @lang('money.icon')</h6>
                            @if ($prod->unit == "gram")
                                <span class="text-xs font-normal"> 1 @lang('warehouse.gram') = {{number_format(($prod->buy_price/($prod->gramunit ?? 1))/100 ,2)}}</span>
                            @endif
                        </td>
                          <td @if($prod->stock == 0)  style="background-color: #ffaeae" @endif class="text-center font-normal ">
          
                                    <div class=" relative" wire:click="update({{$prod->id}})">
                                        <button type="submit" class="block appearance-none flex items-center  w-full bg-green-500 bottom-0 text-center justify-center text-xs font-medium border border-gray-200 text-white py-3 px-4 rounded">
                                          <svg width="1.18em" height="1.18em" stroke="white" stroke-width="1" viewBox="0 0 16 16" class="mr-2 bi bi-check" fill="#fff" xmlns="http://www.w3.org/2000/svg">
                                              <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"/>
                                            </svg>
                                            @lang('warehouse.add')
                                        </button>
                                    </div>
                          </td>
                          <td @if($prod->stock == 0)  style="background-color: #ffaeae" @endif class="text-center ">
                              <span class="m-0 font-medium text-xs">
                                @if ($prod->unit == "gram")
                                {{$prod->stock}} @lang('warehouse.unit')= {{$prod->stock * $prod->gramunit}} 
                                @else
                                {{$prod->stock}} 
                                @endif  
                                  @if($prod->unit == "unit")
                                  @lang('warehouse.unit')
                                  @elseif($prod->unit == "gram")
                                  @lang('warehouse.gram')
                                  @elseif($prod->unit == "metre")
                                  @lang('warehouse.centimeter')
                                  @endif
                              </span>
                                  <br>
                                      <span class="text-xs font-normal">
                                          @if ($prod->type == "1")
                                          @lang('warehouse.ziritadi')
                                          @elseif($prod->type == "2")
                                          @lang('warehouse.xarjmasala')
                                          @endif
                                      </span>
                                
                              </td>
                              <td @if($prod->stock == 0)  style="background-color: #ffaeae" @endif class="w-40 font-bold font-caps text-xs">
                                  @if ($prod->published)
                              <a href="/products/turn/{{$prod->id}}/0" class="flex items-center justify-center text-theme-6"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square w-4 h-4 mr-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg> @lang('warehouse.off') </a>
                                  @else 
                                  <a href="/products/turn/{{$prod->id}}/1" class="flex items-center justify-center text-green-500"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square w-4 h-4 mr-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg> @lang('warehouse.on') </a>
                                  @endif
                              </td>
                              <td @if($prod->stock == 0)  style="background-color: #ffaeae" @endif class="table-report__action w-56">
                                  <div class="flex justify-center items-center">
                                
                                    <a href=" {{route('ProductEdit', $prod->id)}} "  class="p-2 bg-gray-300 rounded-lg ml-2" href="javascript:;"> 
                                      <svg width="1.18em" height="1.18em" viewBox="0 0 16 16" class="bi bi-pencil-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                          <path fill-rule="evenodd" d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                        </svg>
                                    </a>
                                        {{-- <button type="button" wire:click="delete({{$prod->id}})"  class="p-2 bg-gray-300 rounded-lg ml-2" href="javascript:;" data-toggle="modal" data-target="#delete-confirmation-modal">
                                            <svg width="1.18em" height="1.18em" viewBox="0 0 16 16" class="bi bi-trash2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M3.18 4l1.528 9.164a1 1 0 0 0 .986.836h4.612a1 1 0 0 0 .986-.836L12.82 4H3.18zm.541 9.329A2 2 0 0 0 5.694 15h4.612a2 2 0 0 0 1.973-1.671L14 3H2l1.721 10.329z"/>
                                                <path d="M14 3c0 1.105-2.686 2-6 2s-6-.895-6-2 2.686-2 6-2 6 .895 6 2z"/>
                                                <path fill-rule="evenodd" d="M12.9 3c-.18-.14-.497-.307-.974-.466C10.967 2.214 9.58 2 8 2s-2.968.215-3.926.534c-.477.16-.795.327-.975.466.18.14.498.307.975.466C5.032 3.786 6.42 4 8 4s2.967-.215 3.926-.534c.477-.16.795-.327.975-.466zM8 5c3.314 0 6-.895 6-2s-2.686-2-6-2-6 .895-6 2 2.686 2 6 2z"/>
                                              </svg>
                                          </button> --}}
                                          @if ($prod->children()->count() == 0)
                                          <a href=" {{route('DeleteProduct', $prod->id)}} "  class="p-2 bg-gray-300 rounded-lg ml-2" href="javascript:;"> 
                                            <svg width="1.18em" height="1.18em" viewBox="0 0 16 16" class="bi bi-trash2-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                              <path d="M2.037 3.225l1.684 10.104A2 2 0 0 0 5.694 15h4.612a2 2 0 0 0 1.973-1.671l1.684-10.104C13.627 4.224 11.085 5 8 5c-3.086 0-5.627-.776-5.963-1.775z"/>
                                              <path fill-rule="evenodd" d="M12.9 3c-.18-.14-.497-.307-.974-.466C10.967 2.214 9.58 2 8 2s-2.968.215-3.926.534c-.477.16-.795.327-.975.466.18.14.498.307.975.466C5.032 3.786 6.42 4 8 4s2.967-.215 3.926-.534c.477-.16.795-.327.975-.466zM8 5c3.314 0 6-.895 6-2s-2.686-2-6-2-6 .895-6 2 2.686 2 6 2z"/>
                                            </svg>
                                          </a>
                                          @endif
                                      </div>
                              </td>
                      </tr> 
                    @endforeach
                </tbody>
            </table>
          </div>
          <div class="w-full col-span-12">
              {{$products->links()}}
          </div>
          @endif
      </div>
      <div class="col-span-12 px-4 xxl:col-span-3 xxl:border-l border-theme-5 -mb-10 pb-10">
          <h6 class="mt-5 font-bolder font-caps text-xs text-gray-700">@lang('warehouse.filter')</h6>
          <div class="mt-4 p-4 box">
              <form method="GET">
                  <div class="flex flex-wrap -mx-3 mb-1">
                      <div class="w-full md:w-1/2 px-3 mb-1 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="productname">
                          @lang('warehouse.name')
                        </label>
                        <input wire:model="name" class="appearance-none block w-full font-normal text-xs bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="productname" name="productname" type="text" placeholder="@lang('warehouse.name')">
                      </div>
                      <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="product_category">
                            @lang('warehouse.storage')
                          </label>
                          <div class="relative">
                            <select wire:model="storage" class="block font-normal text-xs appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="product_category" name="product_category">
                              <option value="">@lang('warehouse.all')</option>
                              @foreach ($storages as $storage)
                              <option value="{{$storage->id}}">{{$storage->name}}</option>
                              @endforeach
                              </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                              <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"></path></svg>
                            </div>
                          </div>
                        </div>
                    </div>
                      <div class="flex mt-3 flex-wrap -mx-3 mb-1">
                          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label for="pricefrom" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                              @lang('warehouse.price') <small>@lang('warehouse.from')</small>
                            </label>
                              <input wire:model="pricefrom" name="pricefrom" placeholder="xxxxxxxx" type="number"
                                     step="0.01" min="1" id="pricefrom"
                                     class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white">
                          </div>
                          <div class="w-full md:w-1/2 px-3">
                              <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                     for="pricetill">
                                  @lang('warehouse.price') <small>@lang('warehouse.till')</small>
                              </label>
                              <input type="number" placeholder="xxxxxxxx" step="0.01" min="1" id="pricetill"
                                     wire:model="pricetill" name="pricetill"
                                     class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                          </div>
                      </div>
                  <div class="flex flex-wrap -mx-3 mb-1">
                      <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                              @lang('finance.date') <small>[@lang('finance.from')]</small>
                          </label>
                          <input wire:model="datefrom"
                                 class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                 type="date">
                      </div>
                      <div class="w-full md:w-1/2 px-3">
                          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                              @lang('finance.date') <small>[@lang('finance.till')]</small>
                          </label>
                          <input wire:model="datetill"
                                 class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                 type="date">
                      </div>
                  </div>
                  <div class="flex flex-wrap -mx-3 mb-1">
                      <div class="w-full md:w-1/2 px-3 mb-1 md:mb-0">
                          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                 for="grid-first-name">
                              @lang('warehouse.amout')
                          </label>
                          <input type="number" placeholder="xxxxxxxx" step="0.01" id="amout" wire:model="amout"
                                 name="amout"
                                 class="appearance-none block w-full font-normal text-xs bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white">
                      </div>
                      <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                 for="grid-state">
                              @lang('warehouse.units')
                              </label> 
                              <div class="relative">
                                <select name="unit" wire:model="unit" class="block font-normal text-xs appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                                  <option value="">@lang('warehouse.all')</option>
                                  <option value="gram">@lang('warehouse.gram')</option>
                                  <option value="unit">@lang('warehouse.unit')</option>
                                  <option value="metre">@lang('warehouse.centimeter')</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                  <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"></path></svg>
                                </div>
                              </div>
                            </div>
                            <p class="px-3 text-gray-600 text-xs italic font-normal">@lang('warehouse.unittext')</p>
                        </div>
              </form>
          </div>
          
          <h6 class="font-bold font-caps text-gray-700 mt-3 text-xs">@lang('warehouse.storage')</h6>
          <div class="box p-2">
          <form wire:submit.prevent="addstorage">
              <div class="flex">
                <div class="w-full md:w-1/2 p-2">
                  <input class="font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="storagename" wire:model="storagename" type="text" placeholder="@lang('warehouse.storagename')">
                </div>
                <div class="w-full md:w-1/2 p-2">
                  <input class="appearance-none block w-full bg-indigo-500 font-bold font-caps text-xs text-white border border-gray-200 rounded py-3 px-4" value="@lang('warehouse.add')" type="submit">
                </div>
              </div>
            </form>
          </div>
      </div>
  </div>
</div>
