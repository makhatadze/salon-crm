@extends('theme.layout.layout')

@section('content')
<div class="px-5 sm:px-16 py-10 sm:py-20">
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto font-medium text-xs m-0">
            ახალი დეპარტამენტი
        </h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
               <a href="{{route('CreateDepartment')}}" type="button" class="button button--lg block text-white bg-theme-1 font-bold font-caps text-xs mx-auto mt-8"> 
                   დამატება
               </a>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="table">
            <thead>
                <tr>
                    <th class="border-b-2 whitespace-no-wrap font-bold font-caps text-gray-800 text-sm"> <b>დეპარტამენტი</b> </th>
                    <th class="border-b-2 text-right whitespace-no-wrap font-bold font-caps text-gray-800 text-sm"> <b>მისამართი</b> </th>
                </tr>
            </thead>
            <tbody>
                @if ($departments)
                @foreach ($departments as $department)
                <tr>
                    <td class="border-b">
                        <div class="font-helvetica whitespace-no-wrap font-bold  text-black">{{$department->{'name_'.app()->getLocale()} }}</div>
                        <div class="text-gray-600 font-helvetica  text-xs whitespace-no-wrap font-normal">{{$department->departmentable()->first()->{"name_".app()->getLocale()} }} | <small>{{$department->departmentable()->first()->officeable()->first()->{"title_".app()->getLocale()} }}</small></div>
                    </td>
                 <td class="text-right border-b w-32 font-medium">
                    <div class="font-helvetica  whitespace-no-wrap font-normal">{{$department->{'address_'.app()->getLocale()} }}</div>
                    <div class="text-gray-600 text-xs whitespace-no-wrap">
                        <form action="{{ route('RemoveDepartment', $department->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                 <button type="submit" class="text-red-400 font-bold font-caps text-gray-800 text-sm"><b>წაშლა</b></button>
                        </form>
                    </div>
                
                 </td>
                 </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>

@endsection
@section('custom_scripts')
<script type="text/javascript">
	$(document).ready(function() {
		$('.side-menu').removeClass('side-menu--active');
		$('.side-menu[data-menu="departments"]').addClass('side-menu--active');
        
	});

</script>
@endsection