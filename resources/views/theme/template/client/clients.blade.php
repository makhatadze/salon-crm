@extends('theme.layout.layout')

@section('content')
<div class="grid grid-cols-12">
    <div class="scroll-horizontal col-span-12 lg:col-span-9 px-2">
        @if ($clients)
        @foreach ($clients as $client)
        <div class="min-w-scroll grid @if($client->hasConsignation()) border-l-4 border-orange-400 @endif grid-cols-5 bg-white p-3 col-span-12  mt-5">
            <div class="col-span-1 flex items-center">
                <div class="flex">
                    @if ($client->image)
                        <img src="{{asset('../storage/clientimg/'.$client->image->name)}}" class="h-10 w-10 object-cover rounded-md mr-3">
                    @else 
                        <img src="{{asset('../storage/clientimg/user.jpg')}}" class="h-10 w-10 object-cover rounded-md mr-3">
                    @endif
                <div>
                    <h6 class="font-bolder text-gray-800 uppercase text-xs">
                        <a href="{{route('EditClient', $client->id)}}">
                            {{$client->full_name_ge }}
                        </a>
                    </h6>
                    <span class="text-gray-600 text-xs">{{$client->number}}</span>
                </div>
                </div>
            </div>
            <div class="col-span-1">
                <small class="font-normal">@lang('clients.register'):</small> 
                <h6 class="font-bold text-xs">{{$client->created_at}}</h6>
            </div>
            <div class="col-span-1">
                <small class="font-normal">@lang('clients.paid'):</small> 
                <h6 class="font-bold text-xs">{{number_format(($client->clientservices()->where('status', 1)->sum('new_price')/100 + $client->sales()->sum('total')/100),2)}} <sup>₾</sup></h6>
            </div>
            <div class="col-span-1">
                <small class="font-normal">@lang('clients.services'): {{$client->clientservices()->count()}}</small> <br>
                <small class="font-normal">@lang('clients.sales'): {{$client->sales()->count()}}</small> 
            </div>
            <div class="col-span-1 flex items-center justify-center">
                <div>
                    <div class="flex justify-center items-center" x-data="{modal:false}">
                        <button @click="modal=true" class="p-2 bg-gray-300 rounded-lg">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="#444" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                            </svg>
                        </button>
                        <x-modal x-show="modal">
                            <div class="grid grid-cols-2">
                                <div class="col-span-1 px-2">
                                    <livewire:client.service :client="$client">
                                   
                                </div>
                                <div class="col-span-1 px-2">
                                    <livewire:client.sale :client="$client">
                                </div>
                            </div>
                        </x-modal>
                        
                        @if (auth()->user()->hasAnyPermission(['admin']))
                        <div x-data="{modal: false}">
                        <button @click="modal = true" class="ml-2 p-2 bg-gray-300 rounded-lg">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chat-left-dots" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M14 1H2a1 1 0 0 0-1 1v11.586l2-2A2 2 0 0 1 4.414 11H14a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                <path d="M5 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                            </svg>
                        </button>
                            <x-modal x-show="modal">
                                <form action="{{ route('smsSendPost') }}" method="POST" class="bg-white mx-auto" autocomplete="off">
                                    @csrf
                                    <div class="w-full px-3 mb-2">
                                    <label class=" block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="phone">
                                        <h6 class="font-caps">
                                            @lang('clients.phone')
                                        </h6> 
                                    </label>
                                    <input name="phone" value="{{$client->number}}" readonly required class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" onkeyup="this.value = this.value.replace(/[^0-9\.]/g, '');" id="phone" type="text" minlength="9" maxlength="9" placeholder="555 11 22 33">
                                    <small class="font-normal">@lang('clients.check_number')</small> 
                                    @error('phone')
                                        <p class="font-normal text-xs text-red-500">
                                            {{$message}}
                                        </p>
                                    @enderror
                                </div>
                                    <div class="w-full px-3">
                                        <label class="font-caps block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="text">
                                            @lang('clients.text')
                                        </label>
                                        <textarea name="text" id="text" cols="30" rows="5" class="appearance-none resize-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"></textarea>
                                        @error('text')
                                            <p class="font-normal text-xs text-red-500">
                                                {{$message}}
                                            </p>
                                        @enderror
                                    </div>
                                    <div class="px-3 mt-2">
                                        <button type="submit" class="w-full bg-indigo-500 py-3 px-4 text-white font-bold font-caps text-xs">@lang('clients.send')</button>
                                    </div>
                                </form>
                            </x-modal>
                        </div>
                        @endif
                        <a href="{{ route('OneClientExport', $client->id) }}" class="ml-2 p-2 bg-gray-300 rounded-lg">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-arrow-down-fill" fill="#444" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM8 5a.5.5 0 0 1 .5.5v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 1 1 .708-.708L7.5 9.293V5.5A.5.5 0 0 1 8 5z"/>
                            </svg>
                        </a>
                        <a href=" {{route('EditClient', $client->id)}} "  class="p-2 bg-gray-300 rounded-lg ml-2" href="javascript:;"> 
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-fill" fill="#444" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                            </svg>
                            </a>
                        {{-- 
                            DELETE
                            <form action="{{route('DeleteClient', $client->id)}}" method="get">
                            @csrf
                                <button type="submit"  class="p-2 bg-gray-300 rounded-lg ml-2" href="javascript:;" data-toggle="modal" data-target="#delete-confirmation-modal">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash2" fill="#444" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M3.18 4l1.528 9.164a1 1 0 0 0 .986.836h4.612a1 1 0 0 0 .986-.836L12.82 4H3.18zm.541 9.329A2 2 0 0 0 5.694 15h4.612a2 2 0 0 0 1.973-1.671L14 3H2l1.721 10.329z"/>
                                        <path d="M14 3c0 1.105-2.686 2-6 2s-6-.895-6-2 2.686-2 6-2 6 .895 6 2z"/>
                                        <path fill-rule="evenodd" d="M12.9 3c-.18-.14-.497-.307-.974-.466C10.967 2.214 9.58 2 8 2s-2.968.215-3.926.534c-.477.16-.795.327-.975.466.18.14.498.307.975.466C5.032 3.786 6.42 4 8 4s2.967-.215 3.926-.534c.477-.16.795-.327.975-.466zM8 5c3.314 0 6-.895 6-2s-2.686-2-6-2-6 .895-6 2 2.686 2 6 2z"/>
                                    </svg>
                                    </button>
                        </form> --}}
                        </div>
                </div>
        </div>
        </div>
        @endforeach
          {{$clients->links()}}
        @endif
    </div>
    <div class="col-span-12 lg:col-span-3 grid grid-cols-1">
        <form action="" class="col-span-1">
            <div class="bg-white p-2 mt-5">
                <div class="grid grid-cols-1 md:grid-cols-2 ">
                    <div class="p-2 col-span-1">
                        <label for="name" class="font-normal text-xs">
                            @lang('clients.client')
                        </label>
                        <input type="text" id="name" name="name" @if(isset($queries['name'])) value="{{$queries['name']}}" @endif  class="font-normal text-xs bg-gray-200 p-2 mt-2 text-gray-700 w-full focus:outline-none" placeholder="@lang('clients.name')">
                    </div>
                    <div class="p-2 col-span-1">
                        <label for="phone" class="font-normal text-xs">
                            @lang('clients.phone')
                        </label>
                        <input type="text" id="phone" @if(isset($queries['phone'])) value="{{$queries['phone']}}" @endif name="phone" class="font-normal text-xs bg-gray-200 p-2 mt-2 text-gray-700 w-full focus:outline-none" placeholder="xxxxxx">
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 ">
                    <div class="p-2 col-span-1 flex items-center mt-2">
                        <input type="checkbox" name="consignation" id="consignation" @if(isset($queries['consignation'])) checked @endif>
                        <label for="consignation" class="font-normal ml-3 text-xs">
                            @lang('clients.consignation')
                        </label>
                    </div>
                    <div class="p-2 col-span-1 flex items-center mt-2">
                            <div class="relative w-full">
                              <select name="group" class="font-normal text-xs block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                                <option value="">@lang('clients.choose_group')</option>
                                @foreach ($groups as $group)
                                    @if(isset($queries['group']) && $queries['group'] == $group->id)
                                    <option value="{{$group->id}}" selected>{{$group->name}}</option>
                                    @else
                                    <option value="{{$group->id}}">{{$group->name}}</option>
                                    @endif
                                @endforeach
                              </select>
                              <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                              </div>
                            </div>
                    </div>
                </div>
                
                <div class=" flex">
                    <input type="submit" class="font-normal text-xs bg-indigo-500 p-2 mt-2 text-white w-2/3 focus:outline-none" value="@lang('clients.search')">
                    <a href="{{url()->current()}}"class="font-normal flex items-center justify-center text-xs bg-red-500 p-2 mt-2 text-white w-1/3 focus:outline-none">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" stroke="white" class="bi bi-arrow-clockwise" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
                            <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
                          </svg>
                    </a>
                </div>
            </div>
        </form>
        <a href="{{route('CreateClient')}}" class="bg-indigo-500 py-3 text-center mt-2 col-span-1 text-white font-medium text-xs">@lang('clients.add_new_client')</a>
    </div>
</div>

@endsection
@section('custom_scripts')
<script type="text/javascript">
	$(document).ready(function() {
            $('.side-menu').removeClass('side-menu--active');
            $('.side-menu[data-menu="user"]').addClass('side-menu--active');
            $('#menuuser ul').addClass('side-menu__sub-open');
            $('#menuuser ul').css('display', 'block');
        
	});

</script>
@endsection