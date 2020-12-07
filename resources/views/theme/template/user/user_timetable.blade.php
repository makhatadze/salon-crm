@extends('theme.layout.layout')
@section('content')
    <div class="grid grid-cols-7">
        <div class="col-span-7 py-3 bg-white border-b px-4 flex items-center justify-between">
            <div class="flex items-center">
                <img src="{{asset('../storage/clientimg/user.jpg')}}" class="w-10 h-10 rounded">
                <div class="ml-3">
                    <h6 class="font-bolder text-gray-700">{{$user->profile->first_name.' '.$user->profile->last_name}}</h6>
                    <span class="font-normal text-xs">{{ $user->getRoleNames()->first() == "user" ? __('homepage.employee') : $user->getRoleNames()->first() }}</span>
                </div>
            </div>
            <div>
                <form action="">
                    <h6 class="font-bold text-xs text-gray-700 "><input type="date" name="date" class="focus:outline-none" value="{{Carbon\Carbon::parse($date)->isoFormat('Y-MM-DD')}}"></h6>
                    <button class="font-medium w-full font-caps bg-indigo-500 text-white p-1" type="submit" style="font-size: 0.7rem">@lang('homepage.choose')</button>
                </form>
            </div>
        </div>
        @for ($i = 0; $i < 7; $i++)
        <div class="col-span-1 bg-white font-normal text-xs text-gray-600 p-2">
            <h6 class="font-bolder py-3 text-xs font-caps uppercase text-gray-700">
                {{Carbon\Carbon::parse($date)->addDays($i)->format('d F')}}
            </h6>
        <div class="relative " id="div{{$user->id.''.$i}}" onmouseover="$('#mouse{{$user->id.''.$i}}').css('display', 'block');" onmouseout="$(`#mouse{{$user->id.''.$i}}`).css('display', 'none');"  onmousemove="dragtime({{$user->id.''.$i}}, event)">
        <a  href="javascript:;" data-toggle="modal" data-target="#checkmodal{{$user->id.''.$i}}" class="hidden absolute bg-red-500 z-10 cursor-pointer" id="mouse{{$user->id.''.$i}}" style="height: 40px; width:calc(100% - 45px); margin-left:45px; ">

        </a>
        <div class="modal" id="checkmodal{{$user->id.''.$i}}">
            <div class="modal__content modal__content--lg p-10 text-center">



                <form class="w-full relative" action=" {{route('AddClientService')}} " method="POST">
                    @csrf
                    <div class="flex flex-wrap -mx-3 mb-2">
                        <div class="w-full md:w-1/2 px-3 mb-2 md:mb-0">
                        <input onkeyup="thisclientname({{$user->id.''.$i}})" class="appearance-none block font-normal text-xs w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="full_name_ge{{$user->id.''.$i}}" type="text" placeholder="xxxxxxxxxxx" name="full_name_ge">
                    </div>
                    <div class="w-full md:w-1/2 px-3">
                    <input  minlength="9" pattern=".{9,9}" onkeyup="this.value = this.value.replace(/[^0-9\.]/g, '');" maxlength="9" class="font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="client_number{{$user->id.''.$i}}" type="text" placeholder="xxxxxxxxxxxxxxxx" name="client_number">
                    </div>
                  </div>
                  <p class="font-normal text-xs mb-2">@lang('homepage.register_or_choose_client')</p>
                  <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full  px-3 mb-6 md:mb-0">
                    <div class="relative">
                    <select name="client" required id="selectclient{{$user->id.''.$i}}" class="block appearance-none font-normal text-xs w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                        <option value="">@lang('homepage.choose')</option>
                        @if ($clients)
                        @foreach ($clients as $client)
                            <option value="{{$client->id}}" >{{$client->full_name_ge }}</option>
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
                            @lang('homepage.add_service')
                          </h6>
                        <button id="service{{$user->id.''.$i}}" data-divid="{{$user->id.''.$i}}" data-userid="{{$user->id}}" data-settime="{{Carbon\Carbon::parse($date)->addDays($i)->isoFormat('Y-MM-DD')}}" class="addnewservice bg-gray-200 font-bold p-2 rounded-md h-8 w-8 focus:outline-none flex items-center justify-center" type="button">+</button>
                      </div>
                    </div>
                  </div>
                  <div class="mt-1 bg-gray-200 relative p-2 flex flex-wrap -mx-3 mb-2">
                    <div class="w-full md:w-1/3 px-3 flex items-center justify-center">
                        <div class="flex items-center justify-center relative">
                        <input type="hidden" name="personal" id="personal{{$user->id.''.$i}}" value="{{$user->id}}">
                          <select required onchange="selectservice({{$user->id.''.$i}})" name="service[]" id="getservice{{$user->id.''.$i}}" class="bg-gray-200 block text-xs font-normal appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option value="">@lang('homepage.choose')</option>
                            @foreach($user->services($user->id) as $serv)
                            <option value="{{$serv->id}}">{{ $serv->title_ge}}</option>
                            @endforeach
                          </select>
                          <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                          </div>
                        </div>
                      </div>
                      
                      <div class="w-full md:w-1/3 px-3 flex items-center justify-center">
                        <div class="relative text-left">
                        <input required name="date[]" class="bg-gray-200" id="getdate{{$user->id.''.$i}}" type="date" value="{{Carbon\Carbon::parse($date)->addDays($i)->isoFormat('Y-MM-DD')}}">
                          <div class="font-medium flex items-center">
                              <input required type="time" class="bg-gray-200"  min="09:00" max="22:00" name="time[]"  id="getthistime{{$user->id.''.$i}}" onchange="gettime({{$user->id.''.$i}})" value="{{Carbon\Carbon::now('Asia/Tbilisi')->isoFormat('HH:MM')}}"> 
                              - 
                              <span id="settime{{$user->id.''.$i}}"></span> </div>
                          <div class="flex items-center font-normal text-xs justify-content-start">
                            <h4 class="mr-3"><input required type="number" value="30" min="0" name="duration[]" class="w-10 bg-gray-200 focus:outline-none" readonly id="duration{{$user->id.''.$i}}"> მინ</h4>
                            <span onclick="minustime({{$user->id.''.$i}})" class="bg-gray-300 h-5 w-5 flex items-center justify-center hover:bg-gray-400 cursor-pointer"> - </span>
                            <span onclick="addtime({{$user->id.''.$i}})" class="bg-gray-300 h-5 w-5  flex items-center justify-center hover:bg-gray-400 cursor-pointer"> + </span>
                          </div>
                        </div>
                      </div>
                      <div class="w-full md:w-1/3 px-3 flex items-center justify-center">
                        <div class="flex items-center">
                            <span class="font-normal text-xs">@lang('money.icon')</span><input required name="price[]" id="price{{$user->id.''.$i}}" type="number" min="0" step="0.01" class="bg-gray-200 w-16 text-sm ml-2 font-bolder" value="30">
                        </div>
                      </div>
                </div>
                <p class="font-normal w-full text-xs text-red-500" id="text{{$user->id.''.$i}}"> </p>
                  <div  id="service{{$user->id.''.$i}}add">

                  </div>
                  <div class="mt-3 w-full ">
                      <button class="w-full py-3  text-center bg-indigo-500 text-white font-bold">
                        @lang('homepage.submit')
                      </button>
                  </div>
                </form>


            </div>
        </div>
        @forelse ($user->clientServices()
    ->whereDate('session_start_time', Carbon\Carbon::parse($date)->addDays($i))
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
                                            {{$item->clinetserviceable->full_name_ge }}
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
                            <small class="font-normal text-xs">@lang('homepage.name')</small> <br>
                            <a href="/clients/edit/{{$item->clinetserviceable->id}}">
                                 {{$item->service->title_ge }}
                            </a>
                        </div>
                        <div class="w-full md:w-1/3 text-left font-bold text-xs px-3 mb-6 md:mb-0">
                            <small class="font-normal text-xs">@lang('homepage.price')</small> <br>
                            <span class="font-bold text-xs" id="serviceprice{{$item->id}}">
                                {{$item->new_price/100}}
                            </span>
                            @if ($item->service->currency_type == "gel")
                                @lang('money.icon')
                            @endif
                        </div>
                        <div class="w-full md:w-1/3 text-left font-bold text-xs px-3 mb-6 md:mb-0">
                            <small class="font-normal text-xs">@lang('homepage.duration')</small> <br>
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
                           <select required onchange="setpaymethod({{$item->id}}, this.value)" name="pay_method" class="block font-normal text-xs appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option value="">@lang('homepage.pay_method')</option>
                            <option value="consignation">@lang('homepage.consignation')</option>
                             @foreach ($paymethods as $method)
                           <option value="{{$method->id}}">{{$method->name_ge }}</option>
                             @endforeach
                           </select>
                           <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                             <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                           </div>
                         </div>
                       </div>
                        <div id="consignation{{$item->id}}" style="display: none" class="w-full px-3 mb-6 md:mb-0">
                       <input id="consignationmax{{$item->id}}" class="text-xs cursor-pointer font-bold font-caps appearance-none block w-full bg-gray-200 text-gray-800 border rounded py-3 px-4" type="number" min="0" step="0.01" name="paid" max="{{number_format($item->new_price/100, 2)}}" value="@lang('homepage.submit')">
                       </div>
                       <div class="w-full px-3 mb-6 md:mb-0">
                         <input class="text-xs cursor-pointer font-bold font-caps appearance-none block w-full bg-indigo-500 text-white border rounded py-3 px-4" type="submit" value="@lang('homepage.submit')">
                       </div>
                       
                       <input type="hidden" name="newserviceprice" id="newserviceprice{{$item->id}}" required>
                 </div>
                 
                 <div class="w-full px-3 mb-6  mt-1 md:mb-0">
                    <input name="voucher" class="block font-normal text-xs appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 text-xs font-normal pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text"  placeholder="@lang('voucher.voucher')">
                  </div>
                 <div class="grid grid-cols-2 px-3">
                    <span onclick="addNewField({{$item->id}}, {{$item->new_price/100}})" class="col-span-2 focus:outline-none my-2 text-xs bg-indigo-500 p-2 text-white font-medium">
                       @lang('homepage.addproduct')
                    </span>
                    <div id="addproducts{{$item->id}}" class="grid grid-cols-2 col-span-2 gap-3">
                   </div>
                </div>
                </form>
                @else 
                <div class="flex">
                    <div class="w-full md:w-1/3 text-left font-bold text-xs px-3 mb-6 md:mb-0">
                        <small class="font-normal text-xs">@lang('homepage.pay_method')</small> <br>
                        {{ $item->pay_method == "consignation" ? __('homepage.consignation') : $item->pay_method }}
                    </div>
                    <div class="w-full md:w-1/3 text-left font-bold text-xs px-3 mb-6 md:mb-0">
                        <small class="font-normal text-xs">@lang('homepage.come')</small> <br>
                        {{ Carbon\Carbon::parse($item->session_endtime)->isoFormat('Y-MM-DD') }}
                    </div>
                    <div class="w-full md:w-1/3 text-left font-bold text-xs px-3 mb-6 md:mb-0">
                        <small class="font-normal text-xs">@lang('homepage.created')</small> <br>
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
                            <input class="text-xs cursor-pointer font-bold font-caps appearance-none block w-full bg-indigo-500 text-white border rounded py-3 px-4" type="submit" value="@lang('homepage.submit')">
                        </div>
                    </form>
                @endif
                
                @endif
                <div class="w-full flex my-3 items-center">
                    <a href="javascript:;" data-toggle="modal" data-target="#sms{{$item->id}}">
                        <svg width="1em" @click="modal=true" height="1em" viewBox="0 0 16 16" class="bi bi-chat-left-dots" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M14 1H2a1 1 0 0 0-1 1v11.586l2-2A2 2 0 0 1 4.414 11H14a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                            <path d="M5 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                          </svg>
                        </a>
                        @if ($item->status == 0)
                        <a href="{{route('removeclientservice', $item->id)}}" class="ml-2">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash2-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2.037 3.225l1.684 10.104A2 2 0 0 0 5.694 15h4.612a2 2 0 0 0 1.973-1.671l1.684-10.104C13.627 4.224 11.085 5 8 5c-3.086 0-5.627-.776-5.963-1.775z"/>
                                <path fill-rule="evenodd" d="M12.9 3c-.18-.14-.497-.307-.974-.466C10.967 2.214 9.58 2 8 2s-2.968.215-3.926.534c-.477.16-.795.327-.975.466.18.14.498.307.975.466C5.032 3.786 6.42 4 8 4s2.967-.215 3.926-.534c.477-.16.795-.327.975-.466zM8 5c3.314 0 6-.895 6-2s-2.686-2-6-2-6 .895-6 2 2.686 2 6 2z"/>
                              </svg>
                        </a>
                        @endif
                        <div class="modal" id="sms{{$item->id}}">
                            <div class="modal__content modal__content--lg p-10"> 
                                <form action="{{ route('smsSendPost') }}" method="POST" class="bg-white mx-auto" autocomplete="off">
                                    @csrf
                                    <div class="w-full px-3 mb-2">
                                    <label class=" block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="phone">
                                        <h6 class="font-caps">
                                            @lang('homepage.phone')
                                        </h6> 
                                    </label>
                                    <input name="phone" value="{{$item->clinetserviceable->number}}" readonly required class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" onkeyup="this.value = this.value.replace(/[^0-9\.]/g, '');" id="phone" type="text" minlength="9" maxlength="9" placeholder="555 11 22 33">
                                    <small class="font-normal">@lang('homepage.check_before_send')</small> 
                                    @error('phone')
                                        <p class="font-normal text-xs text-red-500">
                                            {{$message}}
                                        </p>
                                    @enderror
                                </div>
                                    <div class="w-full px-3">
                                        <label class="font-caps block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="text">
                                            @lang('homepage.text')
                                        </label>
                                        <textarea name="text" id="text" cols="30" rows="5" class="appearance-none resize-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"></textarea>
                                        @error('text')
                                            <p class="font-normal text-xs text-red-500">
                                                {{$message}}
                                            </p>
                                        @enderror
                                    </div>
                                    <div class="px-3 mt-2">
                                        <button type="submit" class="w-full bg-indigo-500 py-3 px-4 text-white font-bold font-caps text-xs">
                                            @lang('homepage.send')</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                 </div>
                </div>
            </div>
        </a>
        @empty
        @endforelse
        <div class="border-t flex items-center" style="height: 40px">
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
        <div class="border-t flex items-center" style="height: 40px">
            <span>20:00</span>
        </div>
        <div class="border-t flex items-center" style="height: 40px">
            <span>20:30</span>
        </div>
        <div class="border-t flex items-center" style="height: 40px">
            <span>21:00</span>
        </div>
        <div class="border-t flex items-center" style="height: 40px">
            <span>21:30</span>
        </div>
        <div class="border-t flex items-center" style="height: 40px">
            <span>22:00</span>
        </div>
    </div>
</div> 
        @endfor
    </div>
@endsection
@section('custom_scripts')
<script>
     function addNewField($id, $servprice){
        $randomid= Date.now();
        $html = `<div class="col-span-2 relative grid grid-cols-2  gap-2 bg-gray-200 p-3 mt-2" id="newproduct`+$randomid+`">
                    <span class="absolute top-0 right-0 -mt-2 rounded cursor-pointer -mr-2 bg-red-500 p-1">
                        <svg onclick="removeNewField('newproduct`+$randomid+`')" width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash2-fill" fill="#fff" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2.037 3.225l1.684 10.104A2 2 0 0 0 5.694 15h4.612a2 2 0 0 0 1.973-1.671l1.684-10.104C13.627 4.224 11.085 5 8 5c-3.086 0-5.627-.776-5.963-1.775z"/>
                            <path fill-rule="evenodd" d="M12.9 3c-.18-.14-.497-.307-.974-.466C10.967 2.214 9.58 2 8 2s-2.968.215-3.926.534c-.477.16-.795.327-.975.466.18.14.498.307.975.466C5.032 3.786 6.42 4 8 4s2.967-.215 3.926-.534c.477-.16.795-.327.975-.466zM8 5c3.314 0 6-.895 6-2s-2.686-2-6-2-6 .895-6 2 2.686 2 6 2z"/>
                        </svg>
                    </span>
                    <div class="col-span-1">
                        <label for="select`+$randomid+`" class="text-xs font-normal float-left">@lang('homepage.product')</label>
                        <select name="productnames[]" required onchange="selectproduct(`+$randomid+`, `+$id+`, `+$servprice+`)" id="select`+$randomid+`" class="select2 productselect w-full">
                            <option value=""></option>
                            @foreach($products as $prod)
                                <option value="{{$prod->id}}">{{$prod->title_ge}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-1 ">
                        <label  class="text-xs font-normal float-left">@lang('homepage.unit')</label> <br>
                        <span id="unit`+$randomid+`" class="font-bold text-xs"></span>
                    </div>
                    <div class="col-span-1 mt-2">
                        <label for="quntity`+$randomid+`" class="text-xs font-normal float-left">@lang('homepage.amout')</label>
                        <input required type="number" name="productquntity[]" oninput="setnewprice(`+$id+`, `+$servprice+`)"  id="quntity`+$randomid+`" value="0" step="0.1" min="0" class="w-full p-2 rounded">
                    </div>
                    <div class="col-span-1 mt-2">
                        <label for="price`+$randomid+`" class="text-xs font-normal float-left">@lang('homepage.price')</label>
                        <input required type="number" name="newproductprice[]" oninput="setnewprice(`+$id+`, `+$servprice+`)" id="price`+$randomid+`" value="0" step="0.01" min="0" class="w-full p-2 rounded">
                    </div>
                </div>`;
        $('#addproducts'+$id).append($html);
        $('#select'+$randomid).select2();
    }
    function removeNewField($id){
        $('#'+$id).remove();
    }
    function selectproduct($id, $main, $servprice){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('getProductInfo') }}",
            method: 'POST',
            data: { 
                id: parseInt($('#select'+$id).val())
                },
            success: function(data){
                if(data.status == true){
                    if (data.product['unit'] == "gram") {
                        $('#unit'+$id).html('@lang("homepage.gram")');
                    }else if (data.product['unit'] == "unit") {
                        $('#unit'+$id).html('@lang("homepage.unit")');
                    }if (data.product['unit'] == "metre") {
                        $('#unit'+$id).html('@lang("homepage.centimeter")');
                    }
                    $('#price'+$id).val(data.product['price']/100);
                    if(data.product['unit'] == "gram"){

                        $('#price'+$id).attr('min', (data.product['buy_price']/data.product['gramunit'])/100);
                    }else{
                    $('#price'+$id).attr('min', data.product['buy_price']/100);
                    }
                    $('#quntity'+$id).attr('max', data.product['stock']);
                    
                     setnewprice($main, $servprice);
                }
            } 
        });
    }
    
    function setnewprice($id, $servprice){
        var price = $("input[name='newproductprice[]']")
              .map(function(){return $(this).val();}).get();
        var quantity = $("input[name='productquntity[]']")
              .map(function(){return $(this).val();}).get();
        var money = 0;
        jQuery.each( price, function( i, val ) {
            money += val * quantity[i];
        });
        $('#newserviceprice'+$id).val(money);
        money = money + $servprice;
        console.log(money);
        $('#serviceprice'+$id).html(money);
        $('#consignationmax'+$id).attr('max', money);
    }
function addPayMethod(id) {
    $('#pay_id').val(id)
}

    $(document).ready(function () {
        $('.side-menu').removeClass('side-menu--active');
        $('.side-menu[data-menu="user"]').addClass('side-menu--active');
        $('#menuuser ul').addClass('side-menu__sub-open');
        $('#menuuser ul').css('display', 'block');
        $('.select2').select2();
        
    });

$('.addnewservice').click(function(){
    let getid = $(this).attr('data-userid');
    let testid = $(this).attr('data-divid');
    let time = $(this).attr('data-settime');
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
                            <select required name="service[]" id="getservice`+$id+`" onchange="selectservice(`+$id+`)" class="block text-xs font-normal appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option>@lang('homepage.choose')</option>
                            `+data.html+`
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                        </div>
                        </div>
                        
                        <div class="w-full md:w-1/3 px-3 flex items-center justify-center">
                        <div class="relative text-left">
                        <input required name="date[]" class="bg-gray-200" id="getdate`+$id+`" type="date" value="`+time+`">
                            <div class="font-medium flex items-center">
                                <input required type="time" class="bg-gray-200" name="time[]"  id="getthistime`+$id+`" onchange="gettime(`+$id+`)" value="{{Carbon\Carbon::now('Asia/Tbilisi')->isoFormat('HH:MM')}}"> 
                                - 
                                <span id="settime`+$id+`"></span> </div>
                            <div class="flex items-center font-normal text-xs justify-content-start">
                            <h4 class="mr-3"><input required type="number" value="30" min="0" name="duration[]" class="bg-gray-200 w-10 focus:outline-none" readonly id="duration`+$id+`"> min</h4>
                            <span onclick="minustime(`+$id+`)" class="bg-gray-300 h-5 w-5 flex items-center justify-center hover:bg-gray-400 cursor-pointer"> - </span>
                            <span onclick="addtime(`+$id+`)" class="bg-gray-300 h-5 w-5  flex items-center justify-center hover:bg-gray-400 cursor-pointer"> + </span>
                            </div>
                        </div>
                        </div>
                        <div class="w-full md:w-1/3 px-3 flex items-center justify-center">
                        <div class="flex items-center">
                            <span class="font-normal text-xs">@lang('money.icon')</span><input required name="price[]" id="price'`+$id+`'" type="number" min="0" step="0.01" class="bg-gray-200 w-16 text-sm ml-2 font-bolder" value="30">
                        </div>
                        </div>
                </div>
                
                <p class="font-normal w-full text-xs text-red-500" id="text`+$id+`"> </p>
                `;
                $('#service'+testid+'add').append($html);
            }
        } 
    });
    
});
    function dragtime($id, e){
        var offset = $('#div'+$id).offset();
        var relativeY = Math.round(e.pageY - offset.top);
        var maxheight =  document.getElementById('div'+$id).offsetHeight;
        if(relativeY + 18 < maxheight && relativeY > 20 ){
            
            $('#mouse'+$id).css('margin-top', relativeY-20);
        }
    }
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
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('selectService') }}",
                method: 'POST',
                data: { 
                    id: parseInt($('#getservice'+$id).val()), },
                success: function(data){
                    if(data.status == true){
                        $('#duration'+$id).val(data.duration);
                        $('#price'+$id).val(data.price);
                    }
                } 
            });


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
                if(data.status == true){
                    $('#text'+$id).html(data.message);
                }
            } 
        });
    }
    
    function thisclientname($id){
        if($('#full_name_ge'+$id).val().length > 0){
            $('#selectclient'+$id).prop('required',false);
            $('#client_number'+$id).prop('required',true);
        }else{
            $('#client_number'+$id).prop('required',false);
            $('#selectclient'+$id).prop('required',true);
        }
    }
</script>
    
@endsection