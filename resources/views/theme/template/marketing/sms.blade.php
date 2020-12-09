@extends('theme.layout.layout')

@section('content')

<div class="mx-auto mt-3" style="max-width: 600px">
    <div class="bg-orange-700">

    </div>
    <div class="flex items-center justify-between bg-white p-3">
        <input type="text" class="w-full font-normal text-xs focus:outline-none" onkeyup="this.value = this.value.replace(/[^0-9\.]/g, '');" placeholder="@lang('smssend.search')">
        <div @if(count($errors) > 0)x-data="{modal: true}"@else x-data="{modal: false}" @endif class="w-56 ">
            <button @click="modal=true" class="bg-indigo-500 focus:outline-none text-xs p-2 text-white font-bold text-center font-caps w-full">
                @lang('smssend.sendnew')
            </button>
            <x-modal x-show="modal">
                <form action="{{ route('smsSendPost') }}" method="POST" class="bg-white mx-auto" autocomplete="off">
                    @csrf
                    <div class="w-full px-3 mb-2">
                    <label class=" block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="phone">
                        <h6 class="font-caps">
                            @lang('smssend.number')
                        </h6> 
                    </label>
                    <input name="phone" required class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" onkeyup="this.value = this.value.replace(/[^0-9\.]/g, '');" id="phone" type="text" minlength="9" maxlength="9" placeholder="555 11 22 33">
                    <small class="font-normal"> @lang('smssend.checknumber')</small> 
                    @error('phone')
                        <p class="font-normal text-xs text-red-500">
                            {{$message}}
                        </p>
                    @enderror
                </div>
                    <div class="w-full px-3">
                        <label class="font-caps block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="text">
                            @lang('smssend.text')
                        </label>
                        <textarea name="text" id="text" cols="30" rows="5" class="appearance-none resize-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"></textarea>
                        @error('text')
                            <p class="font-normal text-xs text-red-500">
                                {{$message}}
                            </p>
                        @enderror
                    </div>
                    <div class="px-3 mt-2">
                        <button type="submit" class="w-full bg-indigo-500 py-3 px-4 text-white font-bold font-caps text-xs">@lang('smssend.submit')</button>
                    </div>
                </form>
            </x-modal>   
        </div>
    </div>
    @if (count($smses) > 0)
        @foreach ($smses as $sms)
            <div class="mt-3 bg-white p-3">
                <h6 class="font-bold text-xs"> <small class="font-normal">@lang('smssend.number'):</small> +{{$sms->number}}</h6>
                <h6 class="font-bold text-xs"> <small class="font-normal">@lang('smssend.date'):</small> {{Carbon\Carbon::parse($sms->created_at)->isoFormat('Y-MM-DD')}}</h6>
                <h6 class="text-xs"><small class="font-normal">@lang('smssend.text'):</small></h6>
                <p class="font-normal text-xs">{{$sms->text}}</p>
            </div>
        @endforeach
    @else 
    <div class="mt-3 bg-white p-3">
        <p class="font-normal text-xs">@lang('smssend.nosms').</p>
    </div>
    @endif
</div>


@endsection
@section('custom_scripts')
<script type="text/javascript">
	$(document).ready(function() {
		$('.side-menu').removeClass('side-menu--active');
        $('.side-menu[data-menu="sms"]').addClass('side-menu--active');
        $('#menusms ul').addClass('side-menu__sub-open');
        $('#menusms ul').css('display', 'block');
	});

</script>
@endsection