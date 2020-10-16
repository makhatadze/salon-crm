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
            <div class="w-full p-2">
                <label class="font-bold font-caps text-xs text-gray-700">სურათის ატვირთვა</label> <br>
            <input required type="file"name="client_image" class="font-normal text-sm input w-full border category mt-2">
            </div>
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
                            <option value="">აირჩიეთ ჯგუფი</option>
                            @foreach ($groups as $group)
                          <option value="{{$group->id}}">{{$group->name}}</option>
                            @endforeach
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
               <div class="flex">
                <div class="w-full md:w-1/2 p-2">
                    <label class="font-bold font-caps text-xs text-gray-700">პირადი ნომერი</label>
                    <input type="text" name="personal_number" id="personal_number" class="font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="კლიენტის ნომერი">
                </div>
                <div class="w-full md:w-1/2 p-2">
                    <label class="font-bold font-caps text-xs text-gray-700">დაბადების თარიღი </label>
                    <input type="date" name="birthday_date" id="birthday_date" class="font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="კლიენტის ნომერი">
                </div>
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
   
</script>
@endsection
