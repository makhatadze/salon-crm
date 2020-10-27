<div>
 <div class="box p-3">
    <div x-data="{modal: false}">
      <button @click="modal= true" class="py-2 w-full focus:outline-none bg-indigo-500 font-bolder text-center font-caps text-white" style="font-size: 0.65rem">
          დაამატეთ კატეგორია
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
    <ul class="mt-2">
      @foreach ($categories as $cat)
        <li x-data={dropdown:false} class="mt-1">
          <div class="flex items-center hover:bg-gray-200 p-2">
            <svg width="0.7em" x-show="!dropdown" height="0.7em" viewBox="0 0 16 16" class="bi bi-caret-right-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path d="M12.14 8.753l-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
            </svg>
            <svg width="0.7em" height="0.7em" x-show="dropdown" viewBox="0 0 16 16" class="bi bi-caret-down-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path d="M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
            </svg>
            <div class="flex w-full cursor-pointer items-center" @click="dropdown = !dropdown">
              <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi ml-3 bi-folder-fill" fill="#284fa7" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.826a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3zm-8.322.12C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139z"/>
              </svg>
              <h6 class="ml-3 font-medium text-xs">
                {{$cat->{"title_".app()->getLocale()} }}
              </h6>
            </div>
            <button x-data="{modal:false}">
              <svg width="1em" @click="modal=true" height="1em" viewBox="0 0 16 16" class="bi bi-plus-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
              </svg>
              <x-modal x-show="modal">
                    <div class="w-full">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="subcat_name{{$cat->id}}">
                        ქვე კატეგორია
                      </label>
                      <input id="subcat_name{{$cat->id}}" class="font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"  type="text" placeholder="ქვე კატეგორია">
                      <span @click="modal= false" wire:click="addSubCat({{$cat->id}}, $('#subcat_name{{$cat->id}}').val())" class="p-2 bg-indigo-500 text-white block text-center font-bold text-xs font-caps w-full">
                        დამატება
                      </span>
                    </div>
              </x-modal>
            </button>
          </div>
          <div class="">
            @foreach ($cat->subcategories as $subcat)
                <ul class="ml-4 mt-2" x-show="dropdown">
                <li class="mt-1" x-data={dropdown:false}>
                    <div class="hover:bg-gray-200 p-2 flex items-center">
                      <svg width="0.7em" x-show="!dropdown" height="0.7em" viewBox="0 0 16 16" class="bi bi-caret-right-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.14 8.753l-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
                      </svg>
                      <svg width="0.7em" height="0.7em" x-show="dropdown" viewBox="0 0 16 16" class="bi bi-caret-down-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                      </svg>
                      <div class="flex w-full cursor-pointer items-center" @click="dropdown = !dropdown">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi ml-3 bi-folder-fill" fill="#284fa7" xmlns="http://www.w3.org/2000/svg">
                          <path fill-rule="evenodd" d="M9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.826a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3zm-8.322.12C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139z"/>
                        </svg>
                        <h6 class="ml-3 font-medium text-xs">
                          {{$subcat->name}}
                        </h6>
                    </div>
                    <div x-data="{modal:false}">
                      <svg width="1em" @click="modal=true" height="1em" viewBox="0 0 16 16" class="bi bi-plus-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
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
                    </div>
                  </div>
                    <ul x-show="dropdown" class="w-full ml-8 mt-2">
                      @foreach ($subcat->brands as $brand)
                        <li class="flex items-center hover:bg-gray-200 p-2">
                          <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi ml-3 bi-folder-fill" fill="#284fa7" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.826a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3zm-8.322.12C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139z"/>
                          </svg>
                          <h6 class="ml-3 font-medium text-xs">{{$brand->name}}</h6>
                        </li>
                      @endforeach
                    </ul>
                  </li>
                </ul>
            @endforeach
          </div>
        </li>
      @endforeach
    </ul>
 </div>
                   
</div>
