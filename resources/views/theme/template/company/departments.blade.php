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
                        <div class="text-gray-600 font-helvetica  text-xs whitespace-no-wrap font-normal">{{$department->departmentable()->first()->{"name_".app()->getLocale()} }} | <small>{{$department->departmentable()->first()->officeable()->first()->{"title_".app()->getLocale()} }} | {{$department->{'address_'.app()->getLocale()} }}</small></div>
                    </td>
                 <td class="text-right border-b w-32 font-medium">
                    <div class="text-gray-600 text-xs whitespace-no-wrap flex">
                        <a href="/companies/departments/{{$department->id}}" class="p-2 bg-gray-300 rounded-lg ml-2" >
                            <svg width="1.18em" height="1.18em" viewBox="0 0 16 16" class="bi bi-file-arrow-down-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM8 5a.5.5 0 0 1 .5.5v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 1 1 .708-.708L7.5 9.293V5.5A.5.5 0 0 1 8 5z"/>
                              </svg>
                            </a>
                        <form action="{{ route('RemoveDepartment', $department->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit"  class="p-2 bg-gray-300 rounded-lg ml-2" href="javascript:;" data-toggle="modal" data-target="#delete-confirmation-modal">
                                <svg width="1.18em" height="1.18em" viewBox="0 0 16 16" class="bi bi-trash2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M3.18 4l1.528 9.164a1 1 0 0 0 .986.836h4.612a1 1 0 0 0 .986-.836L12.82 4H3.18zm.541 9.329A2 2 0 0 0 5.694 15h4.612a2 2 0 0 0 1.973-1.671L14 3H2l1.721 10.329z"/>
                                    <path d="M14 3c0 1.105-2.686 2-6 2s-6-.895-6-2 2.686-2 6-2 6 .895 6 2z"/>
                                    <path fill-rule="evenodd" d="M12.9 3c-.18-.14-.497-.307-.974-.466C10.967 2.214 9.58 2 8 2s-2.968.215-3.926.534c-.477.16-.795.327-.975.466.18.14.498.307.975.466C5.032 3.786 6.42 4 8 4s2.967-.215 3.926-.534c.477-.16.795-.327.975-.466zM8 5c3.314 0 6-.895 6-2s-2.686-2-6-2-6 .895-6 2 2.686 2 6 2z"/>
                                  </svg>
                               </button>
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