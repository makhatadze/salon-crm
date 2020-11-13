<div>
    <x-modal>
        <div class="flex justify-between my-3">
            <div class="w-full md:w-1/3 text-left font-bold text-xs px-3 mb-6 md:mb-0">
                <small class="font-normal font-caps" style="font-size: 0.7rem">@lang('homepage.name')</small> <br>
                <a href="/clients/edit/{{$item->clinetserviceable->id}}">
                     {{$item->service->title_ge }}
                </a>
            </div>
            <div class="w-full md:w-1/3 text-left font-bold text-xs px-3 mb-6 md:mb-0">
                <small class="font-normal text-xs">@lang('homepage.price')</small> <br>
                <span class="font-bold font-caps" style="font-size: 0.7rem">{{$item->new_price/100}}
                    @if ($item->service->currency_type == "gel") 
                    @lang('money.icon')
                    @endif
                </span> 
            </div>
            <div class="w-full md:w-1/3 text-left font-bold text-xs px-3 mb-6 md:mb-0">
                <small class="font-normal font-caps" style="font-size: 0.7rem">@lang('homepage.duration')</small> <br>
                {{Carbon\Carbon::parse($item->session_start_time)->isoFormat('h:m') .' - '. $item->getEndTime()}}
            </div>
        </div>
        <div class="grid grid-cols-2 gap-3" x-data="handler()">
            <div class="col-span-1">
                <button @click="addNewField()" type="button" class="bg-indigo-500 w-full text-xs p-3 text-white font-bold">
                    პროდუქტის დამატება
                </button>
            </div>
            <div class="col-span-1">
                <button class="bg-indigo-500 w-full text-xs p-3 text-white font-bold">
                    გადახდა
                </button>
            </div>
            <template x-for="(field, index) in fields" :key="index">
            <div class="col-span-2 relative grid grid-cols-3 bg-gray-200 p-3 mt-2">
                <span class="absolute top-0 right-0 -mt-2 rounded cursor-pointer -mr-2 bg-red-500 p-1">
                    <svg @click="removeField(index)" width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash2-fill" fill="#fff" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.037 3.225l1.684 10.104A2 2 0 0 0 5.694 15h4.612a2 2 0 0 0 1.973-1.671l1.684-10.104C13.627 4.224 11.085 5 8 5c-3.086 0-5.627-.776-5.963-1.775z"/>
                        <path fill-rule="evenodd" d="M12.9 3c-.18-.14-.497-.307-.974-.466C10.967 2.214 9.58 2 8 2s-2.968.215-3.926.534c-.477.16-.795.327-.975.466.18.14.498.307.975.466C5.032 3.786 6.42 4 8 4s2.967-.215 3.926-.534c.477-.16.795-.327.975-.466zM8 5c3.314 0 6-.895 6-2s-2.686-2-6-2-6 .895-6 2 2.686 2 6 2z"/>
                      </svg>
                </span>
                <div class="col-span-1">
                    <select name="" id="" class="select2 ">
                        <option value="">d</option>
                    </select>
                </div>
                <div class="col-span-1 flex items-center justify-center font-normal">
                    <span>გრამი</span>
                </div>
                <div class="col-span-1">
                    <input type="number" value="0" step="0.1" min="0" class="w-full p-2 rounded">
                </div>
            </div>
            </template>
        </div>
    </x-modal>
    <script>
        document.getElementsByClassName('select2').select2(); 
        function handler() {
    return {
      fields: [],
      addNewField() {
          this.fields.push({
              txt1: '',
              txt2: ''
           });
        },
        removeField(index) {
           this.fields.splice(index, 1);
         }
      }
 }
    </script>
</div>
