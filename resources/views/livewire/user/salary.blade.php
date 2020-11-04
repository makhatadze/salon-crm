<div>
    <div class="w-full">
        <form action="{{ route('giveSalary', $user->id) }}" method="POST">
            @csrf
            <div class="flex flex-wrap -mx-3 mb-2">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                  <label class="text-left font-caps text-xs block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" >
                    ხელფასის ტიპი
                  </label>
                  <div class="relative">
                    <select required onchange="salarytype(this.value, {{$user->id}})" name="salary_type" class="block appearance-none w-full bg-gray-200 font-normal text-xs border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" > 
                     <option value="earn">გამომუშავებული</option>
                     <option value="salary">სტანდარტული ხელფასი</option>
                      <option value="avansi">ავანსი</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                      <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                    </div>
                  </div>
                </div>
                <div class="w-full md:w-1/4 px-3 hidden" id="raodenoba{{$user->id}}">
                    <label class="block uppercase tracking-wide text-left font-caps text-xs text-gray-700 text-xs font-bold mb-2">
                      რაოდენობა
                    </label>
                    <input required name="amout" min="0" value="0" step="0.1" class="font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="number" min="0" step="1">
                </div>
                <div class="w-full md:w-1/4 px-3 hidden" id="bonus{{$user->id}}">
                    <label class="block uppercase tracking-wide text-left font-caps text-xs text-gray-700 text-xs font-bold mb-2">
                    ბონუსი
                    </label>
                    <input required  min="0" value="0" step="0.1"  name="bonus" class="font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="number" min="0" step="0.01">
                </div>

                <div class="w-full md:w-1/2 px-3 " id="earn{{$user->id}}">
                    <label class="block uppercase tracking-wide text-left font-caps text-xs text-gray-700 text-xs font-bold mb-2">
                    გამოიმუშავა
                    <small class="font-normal text-x">[
                        <select wire:model="salaryperiod" class="w-auto focus:outline-none">
                            <option value="today">დღეს</option>
                            <option value="week">ბოლო 7 დღე</option>
                            <option value="month">ამ თვეს</option>
                            <option value="all">სულ</option>
                        </select> 
                    ]</small>
                    </label>
                    <input value="{{number_format($userearn/100, 2)}}" name="earn" class="font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="number" min="0" step="0.01">
                </div>
              </div>
              <div class="flex">
                  
                <div class="w-full md:w-1/2 p-2" id="salaryreason">
                    <label class="block uppercase tracking-wide text-left font-caps text-xs text-gray-700 text-xs font-bold mb-2">
                    მიზეზი
                    </label>
                    <input name="reason" class="font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" >
                </div>
                <div class="w-full md:w-1/2 p-2" id="salaryreason">
                    <label class="block uppercase tracking-wide text-left font-caps text-xs text-gray-700 text-xs font-bold mb-2">
                    <small style="font-size: 0.1px">.</small>
                    </label>
                    <input class="font-normal text-xs appearance-none cursor-pointer block w-full bg-indigo-500 text-white rounded py-3 px-4" type="submit" value="განახლება">
                </div>
              </div>
        </form>  
        <div class="bg-gray-200 p-2 my-2 grid grid-cols-2 gap-4 items-center justify-center">
            <div class="col-span-1">
                <div class="relative">
                    <select wire:model="salarytype" class="block appearance-none w-full font-normal text-xs bg-gray-200 border border-gray-200 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                        <option value="all">ყველა</option>
                        <option value="earn">გამომუშავებული</option>
                        <option value="salary">სტანდარტული ხელფასი</option>
                        <option value="avansi">ავანსი</option>
                        <option value="uncomplatedavansi">დაუფარავი ავანსი</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                      <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                    </div>
                  </div>
            </div>
            <div class="col-span-1">
                <input type="date" wire:model="date" class="w-auto font-normal text-xs bg-gray-200 focus:outline-none">
            </div>
        </div>
        @if($salaries)
        @foreach ($salaries as $salary)
            <div class="w-full bg-gray-200 p-2 mt-2 ">
                @if ($salary->type == "salary")
                <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <img src="{{asset('../img/cheked.svg')}}" class="w-5 h-5 object-contain">
                            <div class="text-left ml-2">
                                <h6 class="font-bold text-xs text-gray-700">
                                    სტანდარტული ხელფასი
                                </h6>
                                <small class="font-normal text-xs">{{$salary->created_at}}</small>
                            </div>
                        </div>
                        <div class="font-normal text-xs text-right">
                            <span>რაოდენობა: {{number_format($salary->salary/100, 2)}}</span> <br>
                            <span>ბონუსი: {{number_format($salary->bonus/100, 2)}}</span>
                        </div>
                    </div>
                    @elseif ($salary->type == "avansi")
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <img src="{{asset('../img/danger.svg')}}" class="w-5 h-5 object-contain">
                            <div class="text-left ml-2">
                                <h6 class="font-bold text-xs text-gray-700">
                                    ავანსი
                                </h6>
                                <small class="font-normal text-xs">{{$salary->created_at}}</small>
                            </div>
                        </div>
                        <div class="font-normal text-xs text-right">
                            <span>რაოდენობა: {{number_format($salary->salary/100, 2)}}</span>
                            @if ($salary->salary != $salary->avansi_complate)
                            <br>
                            <div class="flex">
                                <form wire:submit.prevent="addAvans({{$salary->id}}, $('#avansi'+{{$salary->id}}).val())">
                                    <input type="number" id="avansi{{$salary->id}}" class="w-16 font-normal text-xs focus:outline-none p-1" required placeholder="xx.xx" min="0" step="0.01" max="{{round($salary->salary/100, 2)}}" value="{{round($salary->avansi_complate/100, 2)}}">
                                    <button type="submit" class="w-8 text-white cursor-pointer bg-indigo-500 p-1">+</button>
                                </form>
                            </div>
                            @endif
                        </div>
                    </div>
                    @elseif ($salary->type == "earn")
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <img src="{{asset('../img/warning.svg')}}" class="w-5 h-5 object-contain">
                            <div class="text-left ml-2">
                                <h6 class="font-bold text-xs text-gray-700">
                                    გამომუშავებული
                                </h6>
                                <small class="font-normal text-xs">{{$salary->created_at}}</small>
                            </div>
                        </div>
                        <div class="font-normal text-xs text-right">
                            <span>რაოდენობა: {{number_format($salary->made_salary/100, 2)}}</span>
                        </div>
                    </div>
                    @endif
                    <p class="font-normal text-left text-gray-700" style="font-size: 0.7rem">
                        {{$salary->description}}
                    </p>
            </div>
        @endforeach
        <div class="w-full mt-2">
            {{$salaries->links()}}
        </div>
        @endif
    </div>
</div>
