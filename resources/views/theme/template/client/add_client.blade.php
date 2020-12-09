@extends('theme.layout.layout')

@section('content')
<div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto font-helvetica">
        @lang('createclient.title')
    </h2>
</div>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-8">
    <form  action="{{route('StoreClient')}}"  method="POST" enctype="multipart/form-data">
        @csrf
        <div class="intro-y box p-5">
            <div class="w-full p-2">
                <label class="font-bold font-caps text-xs text-gray-700">@lang('createclient.image')</label> <br>
            <input  type="file"name="client_image" class="font-normal text-sm input w-full border category mt-2">
            </div>
            <div class="flex">
                <div class="w-full p-2">
                    <label class="font-bold font-caps text-xs text-gray-700">@lang('createclient.name') @lang('language.main') <span class="text-red-500">*</span></label> <br>
                    <input required type="text" autocomplete="off" name="client_name_ge" id="client_name_ge"  class="font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="@lang('createclient.imia')">
                </div>
               </div>
               <div class="flex flex-wrap">
                <div class="w-full md:w-1/4 p-2">
                    <label class="font-bold font-caps text-xs text-gray-700">@lang('createclient.phone') <span class="text-red-500">*</span></label>
                    <input required type="text" minlength="9" maxlength="9" step="1" onkeyup="this.value = this.value.replace(/[^0-9\.]/g, '');" name="client_number" id="client_number" class="font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="@lang('createclient.c_phone')">
                </div>
                <div class="w-full md:w-1/4 p-2">
                    <label class="font-bold font-caps text-xs text-gray-700">@lang('createclient.address')</label>
                    <input type="text" name="client_address" id="client_address" class="font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="XXXXXXXXXXXXXX">
                </div>
                <div class="w-full md:w-1/4 p-2">
                    <label class="font-bold font-caps text-xs text-gray-700">@lang('createclient.mail')</label>
                    <input type="text" name="client_mail" id="client_mail" class="font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="XXXXXXXXXXXXXXXXXXXXX">
                </div>
                <div class="w-full md:w-1/4 p-2">
                    <label class="font-bold font-caps text-xs text-gray-700">@lang('createclient.sex') </label>
                        <div class="relative">
                          <select class="font-normal text-xs  block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="sex" name="sex">
                            <option value="male" selected>@lang('createclient.male')</option>
                            <option value="female">@lang('createclient.female')</option>
                            <option value="other">@lang('createclient.other')</option>
                          </select>
                          <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                          </div>
                        </div>
                      </div>
               </div>
               <div class="flex flex-wrap">
                <div class="w-full md:w-1/3 p-2">
                    <label class="font-bold font-caps text-xs text-gray-700">@lang('createclient.group') </label>
                        <div class="relative">
                          <select class="font-normal text-xs  block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="group" name="group">
                            <option value="">@lang('createclient.choose_group')</option>
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
                          <label class="font-bold font-caps text-xs text-gray-700">@lang('createclient.add_group')</label>
                          <input type="text"name="group_name" id="group_name" class="font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="xxxxxxxxxxxxxxxxxxx">
                      </div>
                <div class="w-full md:w-1/3 p-2  font-normal text-xs">
                    <label class="font-bold font-caps text-xs text-gray-700">@lang('createclient.attention') </label>
                    <p class="mt-1">
                        @lang('createclient.attention_text')
                    </p>
                </div>
               </div>
               <div class="flex flex-wrap">
                <div class="w-full md:w-1/2 p-2">
                    <label class="font-bold font-caps text-xs text-gray-700">@lang('createclient.p_number')</label>
                    <input type="text" name="personal_number" id="personal_number" class="font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="xxxxxxxxxxxxxxxxx">
                </div>
                <div class="w-full md:w-1/2 p-2">
                    <label class="font-bold font-caps text-xs text-gray-700">@lang('createclient.b_date')</label>
                    <input type="date" name="birthday_date" id="birthday_date" class="font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="xxxxxxxxxxxx">
                </div>
               </div>
             
              <br>
                <input type="submit" class=" button text-white bg-theme-1 shadow-md ml-2 font-bold font-caps text-xs" value="@lang('createclient.submit')">
            </form>
        </div>
    </div>
</div>
@endsection
@section('custom_scripts')
<script type="text/javascript">
	$(document).ready(function() {
            $('.side-menu').removeClass('side-menu--active');
            $('.side-menu[data-menu="user"]').addClass('side-menu--active');
            $('#menuuser ul').addClass('side-menu__sub-open');
            $('#menuuser ul').css('display', 'block');
    });
   
</script>
@endsection
