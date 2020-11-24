<div>
    <div class="mx-auto mt-4" style="width: 50%">
        <div class="flex w-full items-center bg-white py-3 px-4">
            <input wire:model="search" type="text" class="w-full focus:outline-none font-normal text-xs" placeholder="@lang('service.search')">
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
            </svg>
            <a href="{{route('ServiceCreate')}}" class="p-2 rounded ml-2" style="background-color:#007bff">
                <svg width="1.18em" height="1.18em" viewBox="0 0 16 16" class="bi bi-plus" fill="#fff" stroke="white" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                  </svg>
            </a>
        </div>
        @foreach ($services as $item)
        <div class="w-full flex mt-2 bg-white py-2 px-3">
            <div class="w-1/4 ">
                <h6 class="font-bold text-xs text-gray-700">{{$item->title_ge}}</h6>
                <span class="text-xs font-normal">{{$item->duration_count}} @lang('service.minute')</span>
            </div>
            <div class="w-1/4  flex items-center">
                @if ($item->image)
                    <img src="{{asset('../storage/serviceimg/'.$item->image->name)}}" class="w-10 h-10 object-cover rounded">
                @endif
            </div>
            <div class="w-1/4 flex items-center text-xs font-bold text-gray-700">
                <div>
                    <h6>{{$item->price/100}} <sup> @lang('money.icon')</sup></h6> 
                    <small class="font-normal">@lang('service.price')</small>
                </div>
            </div>
            <div class="w-1/4 flex items-center justify-end">
                <button wire:click="changeStatus({{$item->id}})" class="p-2 focus:outline-none mr-2 bg-gray-200 rounded flex items-center font-normal text-xs">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi mr-1 bi-circle-fill"  fill="@if ($item->published == 1) #54ab89 @else #e35f5f @endif"  xmlns="http://www.w3.org/2000/svg">
                        <circle cx="8" cy="8" r="8"/>
                      </svg>
                      @if ($item->published == 1)
                        @lang('service.on')
                      @else 
                        @lang('service.off')
                      @endif
                </button>
                <a href="{{route('oneserviceExport', $item->id)}}" class="p-2 mr-2 bg-gray-200 rounded">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-arrow-down-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM8 5a.5.5 0 0 1 .5.5v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 1 1 .708-.708L7.5 9.293V5.5A.5.5 0 0 1 8 5z"/>
                      </svg>
                </a>
                
                <a href="{{route('ServiceEdit', $item->id)}}" class="p-2 bg-gray-200 rounded">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                      </svg>
                </a>
                @if ($item->clientsOnService()->count() == 0)
                <div x-data="{modal: false}">
                    <span  @click="modal=true" class="ml-2 block cursor-pointer p-2 bg-gray-200 rounded">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash2-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2.037 3.225l1.684 10.104A2 2 0 0 0 5.694 15h4.612a2 2 0 0 0 1.973-1.671l1.684-10.104C13.627 4.224 11.085 5 8 5c-3.086 0-5.627-.776-5.963-1.775z"/>
                            <path fill-rule="evenodd" d="M12.9 3c-.18-.14-.497-.307-.974-.466C10.967 2.214 9.58 2 8 2s-2.968.215-3.926.534c-.477.16-.795.327-.975.466.18.14.498.307.975.466C5.032 3.786 6.42 4 8 4s2.967-.215 3.926-.534c.477-.16.795-.327.975-.466zM8 5c3.314 0 6-.895 6-2s-2.686-2-6-2-6 .895-6 2 2.686 2 6 2z"/>
                          </svg>
                    </span>
                    <x-modal x-show="modal">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                              <!-- Heroicon name: exclamation -->
                              <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                              </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                              <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
                                @lang('service.deleteservice')
                              </h3>
                              <div class="mt-2">
                                <p class="text-sm font-normal leading-5 text-gray-500">
                                    @lang('service.deleteserviceinfo')
                                </p>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                          <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                            <button type="button" wire:click="removeservice({{$item->id}})" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                @lang('service.delete')
                            </button>
                          </span>
                          <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                            <button type="button" @click="modal = false" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                @lang('service.cancel')
                            </button>
                          </span>
                        </div>
                    </x-modal>
                </div>
                @endif
                
            </div>
        @endforeach
      </div>
    </div>
</div>
