@extends('theme.layout.layout')

@section('content')
<div class="grid grid-cols-12 mt-3">
    <div class="col-span-3 grid grid-cols-1">
        <div class="py-3 col-span-1 px-4 bg-white">
            <form action="{{route('addGroup')}}" method="POST">
                @csrf
                <div class="w-full px-3">
                    <input name="groupname" class="font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="@lang('group.groupname')">
                    <p class="text-gray-600 text-xs font-normal"> @lang('group.attention')</p>
                </div>
                <div class="w-full px-3">
                    <input class="appearance-none block w-full bg-indigo-500 text-white border border-gray-200 rounded py-2 font-bold text-xs mt-2 px-4 mb-3 cursor-pointer" value="@lang('group.add')" type="submit">
                </div>
            </form>
        </div>
    </div>
    <div class="col-span-3 grid grid-cols-1 px-4">
        @if ($groups)
                @foreach ($groups as $group)
                    <div class="py-3 flex items-center justify-between col-span-1 px-4 bg-white" style="height: max-content" x-data="{modal: false}">
                        <h6 class="cursor-pointer" @click="modal = true">{{$group->name}}</h6>
                        <x-modal x-show="modal">
                            @forelse ($group->clients as $client)
                                <a href="{{route('EditClient', $client->id)}}" class="w-full mt-2 bg-gray-200 p-2 flex items-center justify-between">
                                    <div>
                                        <h6 class="font-bold text-xs">{{$client->{"full_name_".app()->getLocale()} }}</h6>
                                        <small class="font-normal">{{$client->number }}</small>
                                    </div>
                                    <div>
                                        <small  class="font-normal">@lang('group.services'): {{$client->clientservices()->where('status', 1)->count()}}</small><br>
                                        <small  class="font-normal">@lang('group.sales'): {{$client->sales()->count()}}</small>
                                    </div>
                                </a>
                                
                            @empty
                            <p class="font-normal text-xs">
                                @lang('group.no_clients')
                            </p>
                            @endforelse
                        </x-modal>
                        <div class="flex items-center">
                            <a href="{{route('GroupExport', $group->id)}}">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-arrow-down-fill" fill="#444" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM8 5a.5.5 0 0 1 .5.5v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 1 1 .708-.708L7.5 9.293V5.5A.5.5 0 0 1 8 5z"/>
                                </svg>
                            </a>
                            <a href="{{ route('editGroup', $group->id) }}" class="ml-3">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-fill" fill="#444" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                </svg>
                            </a>
                            <a href="{{ route('removeGroup', $group->id) }}" class="ml-3">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash2-fill" fill="#444" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2.037 3.225l1.684 10.104A2 2 0 0 0 5.694 15h4.612a2 2 0 0 0 1.973-1.671l1.684-10.104C13.627 4.224 11.085 5 8 5c-3.086 0-5.627-.776-5.963-1.775z"/>
                                    <path fill-rule="evenodd" d="M12.9 3c-.18-.14-.497-.307-.974-.466C10.967 2.214 9.58 2 8 2s-2.968.215-3.926.534c-.477.16-.795.327-.975.466.18.14.498.307.975.466C5.032 3.786 6.42 4 8 4s2.967-.215 3.926-.534c.477-.16.795-.327.975-.466zM8 5c3.314 0 6-.895 6-2s-2.686-2-6-2-6 .895-6 2 2.686 2 6 2z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach   
                <div class="w-full">
                    
            {{$groups->links('vendor.pagination.custom')}}
                </div>
        @endif
    </div>
</div>
@endsection
@section('custom_scripts')
<script>
      $(document).ready(function () {
            $('.side-menu').removeClass('side-menu--active');
            $('.side-menu[data-menu="user"]').addClass('side-menu--active');
            $('#menuuser ul').addClass('side-menu__sub-open');
            $('#menuuser ul').css('display', 'block');
      });
</script>
@endsection