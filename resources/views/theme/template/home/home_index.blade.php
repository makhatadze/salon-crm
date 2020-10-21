@extends('theme.layout.layout')

@section('content')
    <div class="col-span-12 xxl:col-span-9 grid grid-cols-12 gap-6">
        <div class="col-span-12 mt-8">
            <div class="grid grid-cols-12 gap-6 mt-5">
                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                    <div class="report-box zoom-in">
                        <div class="box p-5">
                            <div class="flex">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                     stroke-linejoin="round"
                                     class="feather feather-shopping-cart report-box__icon text-theme-10">
                                    <circle cx="9" cy="21" r="1"></circle>
                                    <circle cx="20" cy="21" r="1"></circle>
                                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                                </svg>
                                <div class="ml-auto">
                                    <div class="text-gray-600 font-normal mt-1 text-xs">პროდუქტების ჯამური ფასი</div>
                                </div>
                            </div>
                            <div class="text-3xl font-bold leading-8 mt-6">{{$totalproductcost}}<sup class="text-sm">₾</sup></div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                    <div class="report-box zoom-in">
                        <div class="box p-5">
                            <div class="flex">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                     stroke-linejoin="round"
                                     class="feather feather-credit-card report-box__icon text-theme-11">
                                    <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                                    <line x1="1" y1="10" x2="23" y2="10"></line>
                                </svg>
                                <div class="ml-auto">
                                    <div class="text-gray-600 font-normal mt-1 text-xs">შემოსავალი სერვისები</div>
                                </div>
                            </div>
                            <div class="text-3xl font-bold leading-8 mt-6">{{$income}}<sup class="text-sm"> ₾</sup>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                    <div class="report-box zoom-in">
                        <div class="box p-5">
                            <div class="flex">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                     stroke-linejoin="round"
                                     class="feather feather-monitor report-box__icon text-theme-12">
                                    <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                                    <line x1="8" y1="21" x2="16" y2="21"></line>
                                    <line x1="12" y1="17" x2="12" y2="21"></line>
                                </svg>
                                <div class="ml-auto">
                                    <div class="text-gray-600 font-normal mt-1 text-xs"> სერვისების ჯამური ფასი</div>
                                </div>
                            </div>
                        <div class="text-3xl font-bold leading-8 mt-6">{{$totalServiceCost}}<sup class="text-sm"> ₾</sup></div>

                        </div>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                    <div class="report-box zoom-in">
                        <div class="box p-5">
                            <div class="flex">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-user report-box__icon text-theme-9">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                <div class="ml-auto">
                                    <div class="text-gray-600 font-normal mt-1 text-xs">დარეგისტრირებული კლიენტები</div>
                                </div>
                            </div>
                            <div class="text-3xl font-bold leading-8 mt-6">{{$totalclients}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-12 my-3 container mx-auto">
            @include('inc.message')
        </div>
        <!-- Table -->
        <div class="col-span-12 xxl:col-span-9 grid grid-cols-12 gap-6">
            
            
            @foreach ($users as $user)
                <div class="col-span-4 p-2">
                    <div class="box p-4">
                        <div class="border-b py-2">
                            <div class="flex items-center justify-between">
                                <a href="/user/showprofile/{{$user->id}}" class="font-bold font-caps text-sm">
                                    {{$user->profile->first_name .' '.$user->profile->last_name}}
                                </a>
                                <a href="{{ route('userTimeTable', $user->id) }}" class="bg-gray-200 p-2 rounded">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-calendar-date-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zm-6.664-1.21c-1.11 0-1.656-.767-1.703-1.407h.683c.043.37.387.82 1.051.82.844 0 1.301-.848 1.305-2.164h-.027c-.153.414-.637.79-1.383.79-.852 0-1.676-.61-1.676-1.77 0-1.137.871-1.809 1.797-1.809 1.172 0 1.953.734 1.953 2.668 0 1.805-.742 2.871-2 2.871zm.066-2.544c.625 0 1.184-.484 1.184-1.18 0-.832-.527-1.23-1.16-1.23-.586 0-1.168.387-1.168 1.21 0 .817.543 1.2 1.144 1.2zm-2.957-2.89v5.332H5.77v-4.61h-.012c-.29.156-.883.52-1.258.777V8.16a12.6 12.6 0 0 1 1.313-.805h.632z"/>
                                      </svg>
                                </a>
                            </div>
                                @if ($user->isUser())
                                    <span class="font-normal text-xs text-gray-700">სტილისტი</span>
                                @endif
                        </div>
                    <div class="relative" id="div{{$user->id}}" onmouseover="$('#mouse{{$user->id}}').css('display', 'block');" onmouseout="$('#mouse{{$user->id}}').css('display', 'none');"  onmousemove="dragtime({{$user->id}}, event)">
                    <a  href="javascript:;" data-toggle="modal" data-target="#checkmodal{{$user->id}}" class="hidden absolute bg-red-500 z-10 cursor-pointer" id="mouse{{$user->id}}" style="height: 40px; width:calc(100% - 45px); margin-left:45px; ">

                            </a>
                            <div class="modal" id="checkmodal{{$user->id}}">
                                <div class="modal__content modal__content--lg p-10 text-center">



                                    <form class="w-full relative" action=" {{route('AddClientService')}} " method="POST">
                                        @csrf
                                        <div class="flex flex-wrap -mx-3 mb-2">
                                            <div class="w-full md:w-1/2 px-3 mb-2 md:mb-0">
                                          <input class="appearance-none block font-normal text-xs w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="full_name_ge" type="text" placeholder="კლიენტის სახელი" name="full_name_ge">
                                        </div>
                                        <div class="w-full md:w-1/2 px-3">
                                          <input minlength="9" onkeyup="this.value = this.value.replace(/[^0-9\.]/g, '');" maxlength="9" class="font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="client_number" type="text" placeholder="კლიენტის ნომერი" name="client_number">
                                        </div>
                                      </div>
                                      <p class="font-normal text-xs mb-2">დაარეგისტრირეთ ან აირჩიეთ კლიენტი</p>
                                      <div class="flex flex-wrap -mx-3 mb-6">
                                        <div class="w-full  px-3 mb-6 md:mb-0">
                                        <div class="relative">
                                        <select name="client" class="block appearance-none font-normal text-xs w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                            <option value="">აირჩიეთ კლიენტი</option>
                                            @if ($clients)
                                            @foreach ($clients as $client)
                                                <option value="{{$client->id}}" >{{$client->{"full_name_".app()->getLocale()} }}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                          <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                        </div>
                                      </div>
                                    </div>
                                      </div>
                                      <br>
                                      <div class="flex flex-wrap -mx-3 mb-6">
                                        <div class="w-full px-3">
                                          <div class="flex justify-between items-center">
                                              <h6 class="font-bold">
                                                  სერვისის დამატება
                                              </h6>
                                            <button id="service{{$user->id}}" data-userid="{{$user->id}}" class="addnewservice bg-gray-200 font-bold p-2 rounded-md h-8 w-8 focus:outline-none flex items-center justify-center" type="button">+</button>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="mt-1 bg-gray-200 relative p-2 flex flex-wrap -mx-3 mb-2">
                                        <div class="w-full md:w-1/3 px-3 flex items-center justify-center">
                                            <div class="flex items-center justify-center relative">
                                            <input type="hidden" name="personal" id="personal{{$user->id}}" value="{{$user->id}}">
                                              <select required onchange="selectservice({{$user->id}})" name="service[]" id="getservice{{$user->id}}" class="bg-gray-200 block text-xs font-normal appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                                <option value="">აირჩიეთ</option>
                                                @foreach($user->services($user->id) as $serv)
                                                <option value="{{$serv->id}}">{{ $serv->{'title_'.app()->getLocale()} }}</option>
                                                @endforeach
                                              </select>
                                              <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                              </div>
                                            </div>
                                          </div>
                                          
                                          <div class="w-full md:w-1/3 px-3 flex items-center justify-center">
                                            <div class="relative text-left">
                                            <input required name="date[]" class="bg-gray-200" id="getdate{{$user->id}}" type="date" value="{{Carbon\Carbon::now()->isoFormat('Y-MM-DD')}}">
                                              <div class="font-medium flex items-center">
                                                  <input required type="time" class="bg-gray-200"  min="09:00" max="19:00" name="time[]"  id="getthistime{{$user->id}}" onchange="gettime({{$user->id}})" value="{{Carbon\Carbon::now('Asia/Tbilisi')->isoFormat('HH:MM')}}"> 
                                                  - 
                                                  <span id="settime{{$user->id}}"></span> </div>
                                              <div class="flex items-center font-normal text-xs justify-content-start">
                                                <h4 class="mr-3"><input required type="number" value="30" min="0" name="duration[]" class="w-10 bg-gray-200 focus:outline-none" readonly id="duration{{$user->id}}"> მინ</h4>
                                                <span onclick="minustime({{$user->id}})" class="bg-gray-300 h-5 w-5 flex items-center justify-center hover:bg-gray-400 cursor-pointer"> - </span>
                                                <span onclick="addtime({{$user->id}})" class="bg-gray-300 h-5 w-5  flex items-center justify-center hover:bg-gray-400 cursor-pointer"> + </span>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="w-full md:w-1/3 px-3 flex items-center justify-center">
                                            <div class="flex items-center">
                                                <span class="font-normal text-xs">₾</span><input required name="price[]" id="price{{$user->id}}" type="number" min="0" step="0.01" class="bg-gray-200 w-16 text-sm ml-2 font-bolder" value="30">
                                            </div>
                                          </div>
                                    </div>
                                    <p class="font-normal w-full text-xs text-red-500" id="text{{$user->id}}"> </p>
                                      <div  id="service{{$user->id}}add">
      
                                      </div>
                                      <div class="mt-3 w-full ">
                                          <button class="w-full py-3  text-center bg-indigo-500 text-white font-bold">
                                              დამატება
                                          </button>
                                      </div>
                                    </form>


                                </div>
                            </div>
                            @forelse ($user->clientServices()
                        ->whereDate('session_start_time', Carbon\Carbon::parse($date))
                        ->orderBy('session_start_time', 'asc')->get() as $item)
                                            <a href="javascript:;" data-toggle="modal" data-target="#modal{{$item->id}}"
                                                style="
                                                height: <?php
                                                $actual_start_at = Carbon\Carbon::parse($item->session_start_time);
                                                $actual_end_at   = Carbon\Carbon::parse($item->session_start_time)->addminutes($item->duration);
                                                $mins            = $actual_end_at->diffInMinutes($actual_start_at, true); 
                                                echo $mins*4/3;
                                                ?>px;
                                                 margin-top: <?php
                                                $starttime   = Carbon\Carbon::parse($item->session_start_time)->settime("09","00");
                                                $end         = Carbon\Carbon::parse($item->session_start_time);
                                                $top         = $end->diffInMinutes($starttime, true); 
                                                echo ceil($top*4/3);
                                                ?>px;
                                                width: calc(100% - 45px);
                                                margin-left: 45px
                                                 "
                                                class="p-1 items-center justify-center z-30 bg-gray-300 shadow rounded-sm absolute zoom-in flex border-l-4 
                                                @if($item->status == 1) border-green-400 @elseif($item->session_start_time > Carbon\Carbon::now('Asia/Tbilisi')) border-orange-400 @elseif($item->session_start_time < Carbon\Carbon::now('Asia/Tbilisi')) border-red-400 @endif ">
                                               <div class="mx-auto">
                                                <div class="flex items-center justify-center hover:shadow-none">
                                                    @if ($item->clinetserviceable->image)
                                                    <img src="{{asset('../storage/clientimg/'.$item->clinetserviceable->image->name)}}" class="h-10 w-10 object-cover rounded-md">
                                                    @else
                                                    <img src="{{asset('../storage/clientimg/user.jpg')}}" class="h-10 w-10 object-cover rounded-md">
                                                    @endif
                                                    <div class="ml-3">
                                                            <h6 class="font-bold text-xs">
                                                                {{$item->clinetserviceable->{"full_name_".app()->getLocale()} }}
                                                            </h6>
                                                        <span class="text-xs font-normal">
                                                            {{$item->clinetserviceable->number }}
                                                        </span>
                                                    </div>
                                                </div>
                                               </div>
                                            </a>
                                        
                                <div class="modal" id="modal{{$item->id}}">
                                    <div class="modal__content p-10 text-center">
                                        <div class="flex justify-between my-3">
                                            <div class="w-full md:w-1/3 text-left font-bold text-xs px-3 mb-6 md:mb-0">
                                                <small class="font-normal text-xs">სახელი</small> <br>
                                                <a href="/clients/edit/{{$item->clinetserviceable->id}}">
                                                     {{$item->service->{"title_".app()->getLocale()} }}
                                                </a>
                                            </div>
                                            <div class="w-full md:w-1/3 text-left font-bold text-xs px-3 mb-6 md:mb-0">
                                                <small class="font-normal text-xs">თანხა</small> <br>
                                                <span class="font-bold text-xs">{{$item->new_price/100}}
                                                    @if ($item->service->currency_type == "gel") ₾
                                                    @elseif ($item->service->currency_type == "usd") $
                                                    @elseif ($item->service->currency_type == "eur") €
                                                    
                                                    @endif
                                                </span> 
                                            </div>
                                            <div class="w-full md:w-1/3 text-left font-bold text-xs px-3 mb-6 md:mb-0">
                                                <small class="font-normal text-xs">ხანგრძლივობა</small> <br>
                                                {{Carbon\Carbon::parse($item->session_start_time)->isoFormat('h:m') .' - '. $item->getEndTime()}}
                                            </div>
                                        </div>
                                    @if ($item->status == 0)
                                    <form action="{{ route('turnonawqa') }}" method="post">
                                        @csrf
                                     <div class="flex">
                                         <div class="w-full px-3 mb-6 md:mb-0">
                                             <div class="relative">
                                             <input type="hidden" name="pay_id" value="{{$item->id}}">
                                               <select required onchange="setpaymethod({{$item->id}}, this.value)" name="pay_method" class="block font-normal text-xs appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                                                <option value="">გადახდის მეთოდი</option>
                                                <option value="consignation">კონსიგნაცია</option>
                                                 @foreach ($paymethods as $method)
                                               <option value="{{$method->id}}">{{$method->{"name_".app()->getLocale()} }}</option>
                                                 @endforeach
                                               </select>
                                               <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                                 <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                               </div>
                                             </div>
                                           </div>
                                            <div id="consignation{{$item->id}}" style="display: none" class="w-full px-3 mb-6 md:mb-0">
                                           <input class="text-xs cursor-pointer font-bold font-caps appearance-none block w-full bg-gray-200 text-gray-800 border rounded py-3 px-4" type="number" min="0" step="0.01" name="paid" max="{{number_format($item->new_price/100, 2)}}" value="დადასტურება">
                                           </div>
                                           <div class="w-full px-3 mb-6 md:mb-0">
                                             <input class="text-xs cursor-pointer font-bold font-caps appearance-none block w-full bg-indigo-500 text-white border rounded py-3 px-4" type="submit" value="დადასტურება">
                                           </div>
                                     </div>
                                    </form>
                                    @else 
                                    <div class="flex">
                                        <div class="w-full md:w-1/3 text-left font-bold text-xs px-3 mb-6 md:mb-0">
                                            <small class="font-normal text-xs">მეთოდი</small> <br>
                                            {{ $item->pay_method == "consignation" ? 'კონსიგნაცია' : $item->pay_method }}
                                        </div>
                                        <div class="w-full md:w-1/3 text-left font-bold text-xs px-3 mb-6 md:mb-0">
                                            <small class="font-normal text-xs">მოვიდა</small> <br>
                                            {{ Carbon\Carbon::parse($item->session_endtime)->isoFormat('Y-MM-DD') }}
                                        </div>
                                        <div class="w-full md:w-1/3 text-left font-bold text-xs px-3 mb-6 md:mb-0">
                                            <small class="font-normal text-xs">ჩაწერა</small> <br>
                                            {{ Carbon\Carbon::parse($item->created_at)->isoFormat('Y-MM-DD') }}
                                        </div>
                                    </div>
                                    @if ($item->pay_method == "consignation" && $item->new_price > $item->paid)
                                        <form action="{{ route('addconsignation', $item->id) }}" method="POST" class="mt-2 flex">
                                            @csrf
                                            <div class="w-full px-3 mb-6 md:mb-0">
                                                <input class="text-xs cursor-pointer font-bold font-caps appearance-none block w-full bg-gray-200 text-gray-800 border rounded py-3 px-4" type="number" min="0" step="0.01" name="paid" max="{{number_format($item->new_price/100, 2)}}" value="{{number_format($item->paid/100, 2)}}">
                                            </div>
                                            <div class="w-full px-3 mb-6 md:mb-0">
                                                <input class="text-xs cursor-pointer font-bold font-caps appearance-none block w-full bg-indigo-500 text-white border rounded py-3 px-4" type="submit" value="დადასტურება">
                                            </div>
                                        </form>
                                    @endif
                                    @endif
                                    </div>
                                </div>
                            </a>
                            @empty
                            @endforelse
                            <div class=" flex items-center" style="height: 40px">
                                <span>9:00</span>
                            </div>
                            <div class="border-t flex items-center" style="height: 40px">
                                <span>9:30</span>
                            </div>
                            <div class="border-t flex items-center" style="height: 40px">
                                <span>10:00</span>
                            </div>
                            <div class="border-t flex items-center" style="height: 40px">
                                <span>10:30</span>
                            </div>
                            <div class="border-t flex items-center" style="height: 40px">
                                <span>11:00</span>
                            </div>
                            <div class="border-t flex items-center" style="height: 40px">
                                <span>11:30</span>
                            </div>
                            <div class="border-t flex items-center" style="height: 40px">
                                <span>12:00</span>
                            </div>
                            <div class="border-t flex items-center" style="height: 40px">
                                <span>12:30</span>
                            </div>
                            <div class="border-t flex items-center" style="height: 40px">
                                <span>13:00</span>
                            </div>
                            <div class="border-t flex items-center" style="height: 40px">
                                <span>13:30</span>
                            </div>
                            <div class="border-t flex items-center" style="height: 40px">
                                <span>14:00</span>
                            </div>
                            <div class="border-t flex items-center" style="height: 40px">
                                <span>14:30</span>
                            </div>
                            <div class="border-t flex items-center" style="height: 40px">
                                <span>15:00</span>
                            </div>
                            <div class="border-t flex items-center" style="height: 40px">
                                <span>15:30</span>
                            </div>
                            <div class="border-t flex items-center" style="height: 40px">
                                <span>16:00</span>
                            </div>
                            <div class="border-t flex items-center" style="height: 40px">
                                <span>16:30</span>
                            </div>
                            <div class="border-t flex items-center" style="height: 40px">
                                <span>17:00</span>
                            </div>
                            <div class="border-t flex items-center" style="height: 40px">
                                <span>17:30</span>
                            </div>
                            <div class="border-t flex items-center" style="height: 40px">
                                <span>18:00</span>
                            </div>
                            <div class="border-t flex items-center" style="height: 40px">
                                <span>18:30</span>
                            </div>
                            <div class="border-t flex items-center" style="height: 40px">
                                <span>19:00</span>
                            </div>
                            <div class="border-t flex items-center" style="height: 40px">
                                <span>19:30</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    <div class="col-span-12 xxl:col-span-3 -mb-10 pb-10">
        <div class="mt-4 px-4">
            <h6 class="font-bold font-caps text-gray-700 text-xs">ფილტრი</h6>
            <div class="box mt-5 p-2">
                <form action="">
                    <div class="w-full mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                          თანამშრომლები
                        </label>
                        <div class="relative">
                          <select name="users" class="block font-normal text-xs appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                            <option value="">აირჩიეთ თანამშრომელი</option>
                            @foreach ($alluser as $user)
                                @if ($selecteduser == $user->id)
                                <option selected value="{{$user->id}}">{{$user->profile->first_name .' '. $user->profile->last_name}}</option>
                                @else
                                <option value="{{$user->id}}">{{$user->profile->first_name .' '. $user->profile->last_name}}</option>
                                @endif
                            @endforeach
                          </select>
                          <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                          </div>
                        </div>
                      </div>
                    <div class="mt-3">
                        <label class="block uppercase tracking-wide mb-2 text-gray-700 text-xs font-bold mb-2">
                            თარიღი
                          </label>
                          <input @if(isset($date)) value="{{$date}}" @endif  name="date" class=" font-normal text-xs datepicker input w-full appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"> 
                          
                    </div>
                        <div class="flex">
                            <button class="w-3/4 mt-2 block appearance-none font-bold font-caps bg-indigo-500 text-xs text-white bg-gray-200 border border-gray-200  py-3 px-4 rounded leading-tight">
                                ძებნა
                              </button>   
                              <a href="{{url()->current()}}" class="w-1/4 mt-2 block appearance-none flex items-center justify-center font-bold font-caps bg-red-500 text-xs text-white bg-gray-200 border border-gray-200  py-3 px-4  rounded leading-tight">
                                <svg width="1.3em" height="1.3em" viewBox="0 0 16 16" class="bi bi-x-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                  </svg>
                                </a>   
                        </div>
                </form>
            </div>
            
        </div>
    </div>
    </div>
@endsection
@section('custom_scripts')
    <script type="text/javascript">

        function addPayMethod(id) {
            $('#pay_id').val(id)
        }

        $(document).ready(function () {
            $('.select2').select2();
            
        });
        $('.addnewservice').click(function(){
            let getid = $(this).attr('data-userid');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('getUserServices') }}",
                method: 'POST',
                data: { 
                    userid: getid, },
                success: function(data){
                    if(data.status == true){
                        $id = Date.now();
                        $html = `
                            <div id="serv`+$id+`" class="mt-1 bg-gray-200 relative p-2 flex flex-wrap -mx-3 mb-2">
                            <span onclick="removeserv(`+$id+`)" class="cursor-pointer font-bold h-5 absolute top-0 right-0 w-5 bg-red-500 text-white">
                                x
                            </span>               
                            <div class="w-full md:w-1/3 px-3 flex items-center justify-center">
                                <div class="flex items-center justify-center relative">
                                <input type="hidden" name="personal" id="personal`+$id+`" value="`+getid+`">
                                    <select required name="service[]" id="getservice`+$id+`" class="block text-xs font-normal appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                    <option>აირჩიეთ</option>
                                    `+data.html+`
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                    </div>
                                </div>
                                </div>
                                
                                <div class="w-full md:w-1/3 px-3 flex items-center justify-center">
                                <div class="relative text-left">
                                <input required name="date[]" class="bg-gray-200" id="getdate`+$id+`" type="date" value="{{Carbon\Carbon::now()->isoFormat('Y-MM-DD')}}">
                                    <div class="font-medium flex items-center">
                                        <input required type="time" class="bg-gray-200" name="time[]"  id="getthistime`+$id+`" onchange="gettime(`+$id+`)" value="{{Carbon\Carbon::now('Asia/Tbilisi')->isoFormat('HH:MM')}}"> 
                                        - 
                                        <span id="settime`+$id+`"></span> </div>
                                    <div class="flex items-center font-normal text-xs justify-content-start">
                                    <h4 class="mr-3"><input required type="number" value="30" min="0" name="duration[]" class="bg-gray-200 w-10 focus:outline-none" readonly id="duration`+$id+`"> მინ</h4>
                                    <span onclick="minustime(`+$id+`)" class="bg-gray-300 h-5 w-5 flex items-center justify-center hover:bg-gray-400 cursor-pointer"> - </span>
                                    <span onclick="addtime(`+$id+`)" class="bg-gray-300 h-5 w-5  flex items-center justify-center hover:bg-gray-400 cursor-pointer"> + </span>
                                    </div>
                                </div>
                                </div>
                                <div class="w-full md:w-1/3 px-3 flex items-center justify-center">
                                <div class="flex items-center">
                                    <span class="font-normal text-xs">₾</span><input required name="price[]" id="price'`+$id+`'" type="number" min="0" step="0.01" class="bg-gray-200 w-16 text-sm ml-2 font-bolder" value="30">
                                </div>
                                </div>
                        </div>
                        
                        <p class="font-normal w-full text-xs text-red-500" id="text`+getid+`"> </p>
                        `;
                        $('#service'+getid+'add').append($html);
                    }
                } 
            });
            
        });

    function setpaymethod($id, $val){
        if($val == "consignation"){
            $('#consignation'+$id).css('display', 'block');
        }else{
            $('#consignation'+$id).css('display', 'none');
        }
    }
    function dragtime($id, e){
        var offset = $('#div'+$id).offset();
        var relativeY = Math.round(e.pageY - offset.top);
        var maxheight =  document.getElementById('div'+$id).offsetHeight;
        if(relativeY + 18 < maxheight && relativeY > 20 ){
            
            $('#mouse'+$id).css('margin-top', relativeY-20);
        }
    }
    function removeserv($id){
        $('#serv'+$id).remove();
    }
    function gettime($id){
        $val = $('#getthistime'+$id).val();
        $a = $val.split(':');
        $seconds = (+$a[0]) * 60 * 60 + (+$a[1]) * 60; 
        $duration = parseInt($('#duration'+$id).val()) * 60;
        $seconds = $seconds + $duration;
        $hours = Math.floor($seconds / 3600);
        $seconds %= 3600;
        $minutes = Math.floor($seconds / 60);
        $('#settime'+$id).html($hours+':'+$minutes);
        $start = $val;
        $end = $hours+':'+$minutes;
        $date = $('#getdate'+$id).val();
        $user_id = $('#personal'+$id).val();
        $serv_id = $('#getservice'+$id).val();
        checktime($serv_id, $user_id, $id, $date, $start, $end);

    }
    function minustime($id){
        if(parseInt($('#duration'+$id).val()) <= 15){
            
        }else{
            $('#duration'+$id).val(parseInt($('#duration'+$id).val())-5);
            $val = $('#getthistime'+$id).val();
            $a = $val.split(':');
            $seconds = (+$a[0]) * 60 * 60 + (+$a[1]) * 60; 
            $duration = parseInt($('#duration'+$id).val()) * 60;
            $seconds = $seconds + $duration;
            $hours = Math.floor($seconds / 3600);
            $seconds %= 3600;
            $minutes = Math.floor($seconds / 60);
            $('#settime'+$id).html($hours+':'+$minutes);
            $start = $val;
            $end = $hours+':'+$minutes;
            $date = $('#getdate'+$id).val();
            $user_id = $('#personal'+$id).val();
            $serv_id = $('#getservice'+$id).val();
            checktime($serv_id, $user_id, $id, $date, $start, $end);
        }
        }
    function addtime($id){
            $('#duration'+$id).val(parseInt($('#duration'+$id).val())+5);
            $val = $('#getthistime'+$id).val();
            console.log($id);
            $a = $val.split(':');
            $seconds = (+$a[0]) * 60 * 60 + (+$a[1]) * 60; 
            $duration = parseInt($('#duration'+$id).val()) * 60;
            $seconds = $seconds + $duration;
            $hours = Math.floor($seconds / 3600);
            $seconds %= 3600;
            $minutes = Math.floor($seconds / 60);
            $('#settime'+$id).html($hours+':'+$minutes);
            $start = $val;
            $end = $hours+':'+$minutes;
            $date = $('#getdate'+$id).val();
            $user_id = $('#personal'+$id).val();
            $serv_id = $('#getservice'+$id).val();
            checktime($serv_id, $user_id, $id, $date, $start, $end);
        }
        function selectservice($id){
            $val = $('#getthistime'+$id).val();
            console.log($id);
            $a = $val.split(':');
            $seconds = (+$a[0]) * 60 * 60 + (+$a[1]) * 60; 
            $duration = parseInt($('#duration'+$id).val()) * 60;
            $seconds = $seconds + $duration;
            $hours = Math.floor($seconds / 3600);
            $seconds %= 3600;
            $minutes = Math.floor($seconds / 60);
            $('#settime'+$id).html($hours+':'+$minutes);
            $start = $val;
            $end = $hours+':'+$minutes;
            $date = $('#getdate'+$id).val();
            $user_id = $('#personal'+$id).val();
            $serv_id = $('#getservice'+$id).val();
            checktime($serv_id, $user_id, $id, $date, $start, $end);
        }
        function checktime($serv_id, $user_id, $id, $date, $start, $end){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('checkTime') }}",
            method: 'POST',
            data: { 
                start: $start,
                end: $end, 
                date: $date,
                serv_id: parseInt($serv_id),
                user_id: parseInt($user_id), },
            success: function(data){
                console.log(data);
                if(data.status == true){
                    $('#text'+$id).html(data.message);
                }
            } 
        });
    }
    </script>
@endsection
            