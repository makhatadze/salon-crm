@extends('theme.layout.layout')

@section('content')
<div class="px-5 sm:px-16 py-10 sm:py-20">
    <div class="overflow-x-auto">
        <table class="table">
            <thead>
                <tr>
                    <th class="border-b-2 whitespace-no-wrap font-helvetica"> <b>კომპანია</b> </th>
                    <th class="border-b-2 text-right whitespace-no-wrap font-helvetica"> <b>მისამართი</b> </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($companies as $company)
                    @foreach ($company->offices()->whereNull('deleted_at')->get() as $office)
                    <tr>
                        <td class="border-b">
                            <div class="font-medium whitespace-no-wrap font-helvetica"><b> {{$company->{"title_".app()->getLocale()} }} </b></div>
                                <div class="text-gray-600 text-xs whitespace-no-wrap font-helvetica"> {{$office->{"name_".app()->getLocale()} }} </div>
                        </td>
                        <td class="text-right border-b w-140 font-helvetica"> 
                            
                        <div class="font-medium whitespace-no-wrap font-helvetica"><b> {{$office->{"address_".app()->getLocale()} }} </b></div>
                        <div class="text-gray-600 text-xs whitespace-no-wrap font-helvetica"> 
                            @if ($company->offices()->where('deleted_at', null)->count() > 1) 
                        <form action="{{route('RemoveOffice', $office->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500"><b>წაშლა</b></button>
                            </form>
                             @endif 
                        </div>
                            

                        </td>
                    </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
@section('custom_scripts')
<script type="text/javascript">
	$(document).ready(function() {
		$('.side-menu').removeClass('side-menu--active');
		$('.side-menu[data-menu="offices"]').addClass('side-menu--active');
        
	});

</script>
@endsection