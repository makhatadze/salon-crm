<div>
    <div class="box p-3">
        <h5 class="font-bolder text-center font-caps text-xs text-gray-800">კატეგორიები & ბრენდები</h5>
      </div>
      <div x-data="{modal: false}">
        <button @click="modal= true" class="py-2 w-full focus:outline-none bg-indigo-500 font-bolder text-center font-caps text-white" style="font-size: 0.65rem">
            დამატება
        </button>
        <x-modal x-show="modal">
            <form wire:submit.prevent="addCategory">
                <div class="flex flex-wrap -mx-3 mb-1">
                    <div class="w-full px-3">
                      <div class="flex items-center">
                        <div class="w-full p-2 md:w-1/3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="title_ge">
                              სახელი <small>[GE]</small>
                            </label>
                            <input wire:model="title_ge" id="title_ge" class="font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"  type="text" placeholder="ქართულად">
                        </div>
                        <div class="w-full p-2 md:w-1/3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="title_en">
                              სახელი <small>[EN]</small>
                            </label>
                            <input wire:model="title_en" id="title_en" class="font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"  type="text" placeholder="ინგლისურად">
                        </div>
                        <div class="w-full p-2 md:w-1/3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="title_ru">
                              სახელი <small>[RU]</small>
                            </label>
                            <input wire:model="title_ru" id="title_ru" class="font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"  type="text" placeholder="რუსულად">
                        </div>
                      </div>
                    </div>
                  </div>
                  <button type="submit" @click="modal= false" class="p-2 bg-indigo-500 text-white font-bold text-xs font-caps w-full">
                      დამატება
                  </button>
            </form>
        </x-modal>
      </div>
      <ul class="w-full  bg-white">
          @foreach ($categories as $cat)
          <li class="w-full" x-data="{dropdown: false}">
              <div  class=" flex p-3 font-medium text-xs items-center justify-between">
                <h6 @click="dropdown = !dropdown" class="cursor-pointer">
                    {{$cat->{'title_'.app()->getLocale()} }}
                </h6>
                <div class="flex items-center">
                    <span class="p-2" x-data="{modal: false}">
                        <svg width="1.18em" @click="modal=true" height="1.18em" viewBox="0 0 16 16" class="bi cursor-pointer bi-plus-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                          </svg>
                          <x-modal x-show="modal">
                            <form wire:submit.prevent="addBrand({{$cat->id}}, $('#brand_name{{$cat->id}}').val())">
                                <div class="w-full">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="brand_name">
                                      ბრენდის სახელი
                                    </label>
                                <input id="brand_name{{$cat->id}}" class="font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"  type="text" placeholder="Apple, Microsoft..">
                                </div>
                                  <button type="submit" @click="modal= false" class="p-2 bg-indigo-500 text-white font-bold text-xs font-caps w-full">
                                      დამატება
                                  </button>
                            </form>
                          </x-modal>
                    </span>
                    <span class="p-2">
                        <svg @click="dropdown = !dropdown" width="1.18em" height="1.18em" viewBox="0 0 16 16" class="bi cursor-pointer bi-caret-down-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                        </svg>
                    </span>
                </div>
              </div>
              <div class="p-2 w-full font-normal text-xs" x-show="dropdown">
                    @if (count($cat->brands) > 0)
                        <ul >
                            @foreach ($cat->brands as $brand)
                            <li class="p-2 hover:bg-gray-200 cursor-pointer">{{$brand->name}}</li>
                            @endforeach
                        </ul>
                    @else
                        კატეგორია ცარიელია
                    @endif
                  
              </div>
            </li>
          @endforeach
      </ul>
</div>
