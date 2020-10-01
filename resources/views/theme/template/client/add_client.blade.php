@extends('theme.layout.layout')

@section('content')
<div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto font-helvetica">
        ახალი სერვისის რეგისტრაცია
    </h2>
</div>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-8">
    <form  action="{{route('StoreClient')}}"  method="POST" enctype="multipart/form-data">
        @csrf
        <div class="intro-y box p-5">
                
            <div class="flex">
                <div class="w-1/3 p-2">
                    <label class="font-bold font-caps text-xs text-gray-700">კლიენტის სრული სახელი GE <span class="text-red-500">*</span></label> <br>
                    <input required type="text" autocomplete="off" name="client_name_ge" id="client_name_ge"  class="font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="სრული სახელი">
                </div>
                <div class="w-1/3 p-2">
                    <label class="font-bold font-caps text-xs text-gray-700">კლიენტის სრული სახელი RU</label> <br>
                    <input type="text" autocomplete="off" name="client_name_ru" id="client_name_ru"  class="font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="სრული სახელი">
                </div>
                <div class="w-1/3 p-2">
                    <label class="font-bold font-caps text-xs text-gray-700">კლიენტის სრული სახელი EN</label> <br>
                    <input type="text" autocomplete="off" name="client_name_en" id="client_name_en"   class="font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="სრული სახელი">
                </div>
               </div>
               <div class="flex">
                <div class="w-full md:w-1/4 p-2">
                    <label class="font-bold font-caps text-xs text-gray-700">ნომერი <span class="text-red-500">*</span></label>
                    <input required type="text" min="0" step="1" name="client_number" id="client_number" class="font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="კლიენტის ნომერი">
                </div>
                <div class="w-full md:w-1/4 p-2">
                    <label class="font-bold font-caps text-xs text-gray-700">მისამართი</label>
                    <input type="text" name="client_address" id="client_address" class="font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="კლიენტის მისამართი">
                </div>
                <div class="w-full md:w-1/4 p-2">
                    <label class="font-bold font-caps text-xs text-gray-700">ელ-ფოსტა </label>
                    <input type="text" name="client_mail" id="client_mail" class="font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="კლიენტის ნომერი">
                </div>
                <div class="w-full md:w-1/4 p-2">
                    <label class="font-bold font-caps text-xs text-gray-700">სქესი </label>
                        <div class="relative">
                          <select class="font-normal text-xs  block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="sex" name="sex">
                            <option value="male" selected>მამრობითი</option>
                            <option value="female">მდედრობითი</option>
                            <option value="other">სხვა</option>
                          </select>
                          <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                          </div>
                        </div>
                      </div>
               </div>
               <div class="flex">
                <div class="w-full md:w-1/3 p-2">
                    <label class="font-bold font-caps text-xs text-gray-700">ჯგუფი </label>
                        <div class="relative">
                          <select class="font-normal text-xs  block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="group" name="group">
                            <option value="male">აირჩიეთ ჯგუფი</option>
                          </select>
                          <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                          </div>
                        </div>
                      </div>
                <div class="w-full md:w-1/3 p-2">
                    <label class="font-bold font-caps text-xs text-gray-700">დაამატეთ ჯგუფი </label>
                    <input type="text"name="group_name" id="group_name" class="font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="კლიენტის ნომერი">
                </div>
                <div class="w-full md:w-1/3 p-2  font-normal text-xs">
                    <label class="font-bold font-caps text-xs text-gray-700">გაფრთხილება </label>
                    <p class="mt-1">
                        იმ შემთხვევაში თუჯგუფის სახელს შეიყვანთ, ეს ჯგუფი ავტომატურად დაემატება კლიენტს.
                    </p>
                </div>
               </div>
               <div class="flex my-4 justify-between items-center p-2">
                   <h6 class="font-bold font-caps text-sm text-gray-700">სერვისის დამატება</h6>
                   <button type="button" id="addservice" class="dropdown-toggle bg-gray-300 button px-2 box text-gray-700 hover:bg-blue-900 hover:text-white">
                       <span class="w-5 h-5 flex items-center justify-center"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus w-4 h-4"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg> </span>
                   </button>
               </div>
               <!-- Choose Service -->
               <div id="services">
                
               </div>
              
              <br>
                <input type="submit" class=" button text-white bg-theme-1 shadow-md ml-2 font-bold font-caps text-xs" value="ატვირთვა">
            </form>
        </div>
    </div>
</div>
@endsection
@section('custom_scripts')
<script type="text/javascript">
	$(document).ready(function() {
		$('.side-menu').removeClass('side-menu--active');
        $('.side-menu[data-menu="services"]').addClass('side-menu--active');
    });
    $('#addservice').click(function(){
            let randomid= Date.now();
        $('#services').append(`
                   
        <div class=" shadow bg-gray-100 mb-3 relative" id="removeservice`+randomid+`">
            <span class="absolute right-0 top-3 bg-red-400 text-white px-2 rounded cursor-pointer" onclick="removeserv('removeservice`+randomid+`')">x</span>

            <div class="flex">

                    <div class="w-full md:w-1/3 p-2 mb-3 md:mb-0">
                        <label class="block font-caps uppercase tracking-wide text-white-700 text-xs font-bold mb-2" for="">
                        სერვისის სახელი
                        </label>
                        <div class="relative">
                            <select required  name="servicepicker[]" class="block appearance-none font-normal w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="">
                                @foreach ($services as $service)
                            <option value="{{$service->id}}">{{$service->{"title_".app()->getLocale()} }}</option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                            </div>
                    </div>


                    <div class="w-full md:w-1/3 p-2 mb-3 md:mb-0">
                            <div class="flex justify-between align-items-center">
                                <label class="font-bold font-caps text-xs text-gray-700 font-caps" >ჩაწერის თარიღი </label>
                            </div>
                        <div class="w-full p-2 mb-6 md:mb-0">
                                <input  name="datepicker[]" required required value="{{Carbon\Carbon::now()->format('Y-m-d')}}"  type="date" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 font-normal text-xs"> 
                        </div>  
                        </div>


                        <div class="w-full md:w-1/3 p-2 mb-3 md:mb-0">
                            <div class="flex justify-between align-items-center">
                                <label class="font-bold font-caps text-xs text-gray-700">ჩაწერის დრო </label>
                            </div>
                            <div class="w-full mt-2">
                                <input required type="time" required name="timepicker[]"  @if($serv->status) disabled @endif  value="{{Carbon\Carbon::now()->isoformat('hh:mm')}}"  class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 font-normal text-xs"> 
                            </div>
                        </div>

                    </div>








                    <div class="flex">
                        <div class="w-full md:w-1/2 p-2 mb-3 md:mb-0">
                            <div class="flex justify-between align-items-center">
                                <label class="font-bold font-caps text-xs text-gray-700">აირჩიეთ სტილისტი </label>
                            </div>
                            <div class="mt-2">
                                
                                <div class="relative">
                                    <select name="userpicker[]" required class="block text-xs appearance-none font-normal w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="">
                                        <option value=""></option>
                                        @foreach ($workers as $per)
                                        <option value="{{$per->id}}">{{$per->profile()->first()->first_name}} {{$per->profile()->first()->last_name}}</option>
                                        @endforeach
                                </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                    </div>
                                    </div>
                            </div>
                          
                        </div>
                        <div class="w-full md:w-1/2 p-2 mb-3 md:mb-0">
                            <label class="block font-caps uppercase tracking-wide text-white-700 text-xs font-bold mb-2" for="">
                                დეპარტამენტი
                            </label>
                            <div class="relative">
                                <select name="departments[]" required class="block appearance-none font-normal text-xs w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="">
                                    <option value="">აირჩიეთ დეპარტამენტი</option>
                                    @foreach ($departments as $department)
                                    @if ($serv->department_id == $department->id)
                                    <option value="{{$department->id}}" selected>{{$department->{"name_".app()->getLocale()} }}</option>
                                    @else 
                                    <option value="{{$department->id}}">{{$department->{"name_".app()->getLocale()} }}</option>
                                    @endif
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                </div>
                                </div>
                        </div>
                      </div>
                    
                    
                  </div>







                        
                  </div>
                
        `);
        $('.select2').select2();
        $('.datepicker').datepicker();
    });
    function removeserv($id){
        $('#'+$id).remove();
    }
</script>
@endsection
