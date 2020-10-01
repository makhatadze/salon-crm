<div>

    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2 justify-between">
            <span></span>
           
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="w-56 relative text-gray-700">
                    <input type="text" class="input w-56 box pr-10 placeholder-theme-13 font-normal" placeholder="ძებნა.." wire:model="search">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg> 
                </div>
            </div>
        </div>
                @foreach ($brands as $brand)
                <div class="col-span-12 shadow rounded-md w-full mt-3 py-4 px-4 bg-white">
                    <h4 class="font-bolder text-gray-900">
                        {{$brand->name}}
                    </h4>
                </div>
                @endforeach
                
    </div>
</div>
