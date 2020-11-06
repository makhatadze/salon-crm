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
            </div>
        </div>
        @endforeach
    </div>
</div>
