@extends('theme.layout.layout')

@section('content')
<div class="grid grid-cols-12 gap-6 mt-5 flex content-center ">
<div class="intro-y col-span-6 box p-4">
    <form action="" method="post">
    @method('PUT')
        @csrf
    
        <div class="relative mt-3">
            <button type="submit" name="user_add_submit" class="button w-25 bg-theme-1 text-white font-helvetica">განახლება</button>
        </div>
    </form>
</div></div>


@endsection
@section('custom_scripts')
<script type="text/javascript">
	$(document).ready(function() {
		$('.side-menu').removeClass('side-menu--active');
		$('.side-menu[data-menu="settings"]').addClass('side-menu--active');
        
	});

</script>
@endsection