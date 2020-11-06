<div>
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 xxl:col-span-3 -mb-10 pb-10">
            
            <div class="col-span-12 md:col-span-6 xl:col-span-4 xxl:col-span-12 mt-3 xxl:mt-8">
                <div class="box h-48 p-2 items-center flex justify-center">
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
                            <label class="text-left block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                            @lang('paymethod.name') <sup class="font-bold text-red-500">*</sup>
                            </label>
                            <input required wire:model="name_ge" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="xxxxxxxxxxxxxx" type="text">
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
                                <div class="box px-5 py-3 mb-3 flex items-center zoom-in">
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
                                        <div class="block h-8 w-8 rounded-md bg-gray-200 p-2 ml-3" wire:click="setupdate({{$pay->id}})">
                                        <svg width="1.18em" height="1.18em" viewBox="0 0 16 16" class="bi  bi-pencil-fill" fill="#404040" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                          </svg>
                                        </div>
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
    </div>
</div>
