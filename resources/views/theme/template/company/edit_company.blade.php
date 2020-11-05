@extends('theme.layout.layout')

@section('content')
<div class="grid grid-cols-12 gap-6 mt-5 flex content-center ">
<div class="intro-y col-span-12 md:col-span-6 box p-4">
    <form action="{{route('EditCompany', $company->id)}}" method="post">
    @method('PUT')
        @csrf
        <div class="flex flex-wrap -mx-3 mb-2 p-3">
            <div class="w-full lg:w-1/2 px-3 mb-6 md:mb-0 ">
                <label class="font-bold font-caps text-xs">@lang('company.name') @lang('language.main') <span class="text-red-700">*</span></label>
                <input required type="text"  value="{{$company->title_ge}}"  class="font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="title-ge">
            </div>
            <div class="w-full lg:w-1/2 px-3 mb-6 md:mb-0">
                <label class="font-bold font-caps text-xs">@lang('company.code')</label>
                <input type="text" class="font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="code">
            </div>
        </div>
       
        <div class="mt-3 p-3">
            <label class="font-bold font-caps text-xs">@lang('company.desc') <span class="text-red-700">*</span></label>
            <div class="mt-2">
                <textarea required data-feature="basic" class="summernote font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="editor-ge">
                    {{$company->description_ge}} 
                </textarea>
            </div>
        </div>
    
        <div class="relative mt-2 px-3">
            <button type="submit" name="user_add_submit" class="button w-25 bg-theme-1 text-white font-bold font-caps text-xs">@lang('company.update')</button>
        </div>
    </form>
</div></div>


@endsection
@section('custom_scripts')
<script type="text/javascript">
	$(document).ready(function() {
        $('.side-menu').removeClass('side-menu--active');
        $('.side-menu[data-menu="companies"]').addClass('side-menu--active');
        $('#menucompanies ul').addClass('side-menu__sub-open');
        $('#menucompanies ul').css('display', 'block');
        
	});

</script>
@endsection