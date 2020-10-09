<div>
    <form class="w-full">
        <div class="flex  -mx-3 mb-6">
          <div class="w-full flex items-center justify-center md:w-1/3 px-3 mb-6 md:mb-0">
            <label  class="block mr-2 text-left uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="full_name_ge">
              სრული სახელი
            </label>
            <input wire:model="client_name" name="full_name_ge" class="appearance-none block font-normal text-xs w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="full_name_ge" name="full_name_ge" type="text" placeholder="სახელი">
          </div>
          <div class="w-full flex items-center justify-center md:w-1/3 px-3">
            <label class="block  mr-2 text-left uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="number">
              ნომერი
            </label>
            <input name="number" wire:model="client_phone" class="appearance-none font-normal text-xs block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="number" name="number" type="text" placeholder="+995 555 11 22 33">
          </div>
          <div class="w-full flex items-center justify-center md:w-1/3 px-3">
            <label class="block  mr-2 text-left uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="sex">
              სქესი
            </label>
            <div class="relative">
                <select wire:model="client_sex" class="block font-normal text-xs appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="sex" name="sex">
                  <option value="male">მამრობითი</option>
                  <option value="female">მდედრობითი</option>
                  <option value="other">სხვა</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                  <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </div>
              </div>    
        </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full px-3">
            <div class="flex justify-between items-center">
                <h6 class="font-bold">
                    სერვისის დამატება
                </h6>
                <a href="javascript:;" data-toggle="modal" data-target="#getservice" class="bg-gray-200 font-bold p-2 rounded-md h-8 w-8 focus:outline-none flex items-center justify-center" type="button">+</a>
            </div>
          </div>
        </div>
        <div class="mt-3 box py-3 px-2 shadow flex" id="serv1">
            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label class="font-normal text-left block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                  სერვისი
                </label>
                <div class="flex items-center justify-center relative">
                  <select wire:model="service" class="block text-xs font-normal appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                    <option>New Mexico</option>
                    <option>Missouri</option>
                    <option>Texas</option>
                  </select>
                  <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                  </div>
                </div>
              </div>
              <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                  <label class="font-normal text-left block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                    პერსონალი
                  </label>
                  <div class="flex items-center justify-center relative">
                    <select wire:model="personal" class="block text-xs font-normal appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                      <option>New Mexico</option>
                      <option>Missouri</option>
                      <option>Texas</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                      <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                    </div>
                  </div>
                </div>
              
            <div class="w-full md:w-1/3 px-3  mb-6 md:mb-0">
                <label class="font-normal text-left block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                  დრო
                </label>
                <div class="relative text-left">
                <input wire:model="date[]" type="date" value="{{Carbon\Carbon::now()->isoFormat('Y-MM-DD')}}">
                  <div class="font-medium flex items-center">
                      <input type="time" wire:model="time" id="getthistime" onchange="gettime(this.value)" value="{{Carbon\Carbon::now('Asia/Tbilisi')->isoFormat('HH:MM')}}"> 
                      - 
                      <span id="settime"></span> </div>
                  <div class="flex items-center font-normal text-xs justify-content-start">
                    <h4 class="mr-3"><span id="serv1min" wire:model="duration">30</span> მინ</h4>
                    <span onclick="minustime('serv1')" class="bg-gray-300 h-5 w-5 flex items-center justify-center hover:bg-gray-400 cursor-pointer"> - </span>
                    <span onclick="addtime('serv1')" class="bg-gray-300 h-5 w-5  flex items-center justify-center hover:bg-gray-400 cursor-pointer"> + </span>
                  </div>
                </div>
              </div>
              <div class="w-full md:w-1/3 px-3 py-4 h-full">
                <label class="font-normal text-left block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                  ფასი
                </label>
                <div class="flex items-center">
                    <span class="font-normal text-xs">₾</span><input wire:model="price" type="number" min="0" class="w-12 text-base ml-2 font-bolder" value="30">
                </div>
              </div>
        </div>
      </form>
      <script>
          function gettime($val){
              
            var a = $val.split(':');
            $seconds = (+a[0]) * 60 * 60 + (+a[1]) * 60; 
            $duration = parseInt($('#serv1min').html()) * 60;
            $seconds = $seconds + $duration;
            $hours = Math.floor($seconds / 3600);
            $seconds %= 3600;
            $minutes = Math.floor($seconds / 60);
            $('#settime').html($hours+':'+$minutes);
            console.log($hours+':'+$minutes);
          }
          function minustime($id){
              if(parseInt($('#'+$id+'min').html()) <= 15){
                
              }else{
                $('#'+$id+'min').html(parseInt($('#'+$id+'min').html())-5);
                $val = $('#getthistime').val();
                var a = $val.split(':');
                $seconds = (+a[0]) * 60 * 60 + (+a[1]) * 60; 
                $duration = parseInt($('#'+$id+'min').html()) * 60;
                $seconds = $seconds + $duration;
                $hours = Math.floor($seconds / 3600);
                $seconds %= 3600;
                $minutes = Math.floor($seconds / 60);
                $('#settime').html($hours+':'+$minutes);
              }
            }
          function addtime($id){
                $('#'+$id+'min').html(parseInt($('#'+$id+'min').html())+5);
                $val = $('#getthistime').val();
                var a = $val.split(':');
                $seconds = (+a[0]) * 60 * 60 + (+a[1]) * 60; 
                $duration = parseInt($('#'+$id+'min').html()) * 60;
                $seconds = $seconds + $duration;
                $hours = Math.floor($seconds / 3600);
                $seconds %= 3600;
                $minutes = Math.floor($seconds / 60);
                $('#settime').html($hours+':'+$minutes);
            }
            
      </script>
</div>
