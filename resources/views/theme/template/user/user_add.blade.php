@extends('theme.layout.layout')

@section('content')
<div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto font-helvetica">
        ახალი მომხმარებლის რეგისტრაცია
    </h2>
</div>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-8">
        <div class="intro-y box p-5">
            {!! Form::open() !!}
                <div>
        			<label class="font-helvetica"><b>პირადი ინფორმაცია</b></label>
                    <div class="sm:grid grid-cols-2 gap-2 mb-4">
                        <div class="relative mt-2">
                            {{ Form::label('user_name', 'მომხმარებლის სახელი', ['class' => 'font-helvetica']) }}
                            {{ Form::text('user_name', null, ['class' => 'input w-full border mt-2 col-span-2']) }} 
                        </div>
                        <div class="relative mt-2">
                            {{ Form::label('user_last_name', 'მომხმარებლის გვარი', ['class' => 'font-helvetica']) }}
                            {{ Form::text('user_last_name', null, ['class' => 'input w-full border mt-2 col-span-2']) }} 
                        </div>
                        <div class="relative mt-2">
                            {{ Form::label('user_pid', 'მომხმარებლის პირადი ნომერი', ['class' => 'font-helvetica']) }}
                            {{ Form::text('user_pid', null, ['class' => 'input w-full border mt-2 col-span-2']) }} 
                        </div>
                        <div class="relative mt-2">
                            {{ Form::label('user_bday', 'დაბადების თარიღი', ['class' => 'font-helvetica']) }}
                            {{ Form::date('user_bday', null, ['class' => 'input w-full border mt-2 col-span-2']) }} 
                        </div>
                        <div class="relative mt-2">
                            {{ Form::label('user_phone', 'ტელეფონის ნომერი', ['class' => 'font-helvetica']) }}
                            {{ Form::text('user_phone', null, ['class' => 'input w-full border mt-2 col-span-2']) }} 
                        </div>
                        <div class="relative mt-2">
                            {{ Form::label('user_phone', 'ელ-ფოსტა', ['class' => 'font-helvetica']) }}
                            {{ Form::text('user_phone', null, ['class' => 'input w-full border mt-2 col-span-2']) }} 
                        </div>
                    </div>
                    <label class="font-helvetica"><b>სამსახურეობრივი მონაცემები</b></label>
                    <div class="sm:grid grid-cols-2 gap-2 mb-4">
                    	<div class="relative mt-2">
                            {{ Form::label('user_work_position', 'თანამდებობა', ['class' => 'font-helvetica']) }}
                            {{ Form::select('user_work_position', ['1' => 'სალონის ადმინისტრატორი', '2' => 'სტილისტი'], null, ['class' => 'input w-full border mt-2 col-span-12 font-helvetica']) }}
                        </div>
                        <div class="relative mt-2">
                            {{ Form::label('user_salary_type', 'ანაზღაურების ტიპი', ['class' => 'font-helvetica']) }}
                            {{ Form::select('user_salary_type', ['1' => 'ფიქსირებული', '2' => 'პროცენტი'], null, ['class' => 'input w-full border mt-2 col-span-12 font-helvetica']) }}
                        </div>
                        <div class="relative mt-2">
                            {{ Form::label('user_salary_cash', 'ხელფასი', ['class' => 'font-helvetica']) }}
                            {{ Form::text('user_salary_cash', null, ['class' => 'input w-full border mt-2 col-span-2']) }} 
                        </div>
                        <div class="relative mt-2">
                            {{ Form::label('user_salary_percent', 'პროცენტი', ['class' => 'font-helvetica']) }}
                            {{ Form::text('user_salary_percent', null, ['class' => 'input w-full border mt-2 col-span-2']) }} 
                        </div>
                    </div>
                    <label class="font-helvetica"><b>პროფილის მონაცემები</b></label>
                    <div class="sm:grid grid-cols-2 gap-2">
                        <div class="relative mt-2">
                            {{ Form::label('user_password', 'პაროლი', ['class' => 'font-helvetica']) }}
                            {{ Form::text('user_password', null, ['class' => 'input w-full border mt-2 col-span-2']) }} 
                        </div>
                        <div class="relative mt-2">
                            {{ Form::label('user_confirm_password', 'პაროლის გამეორება', ['class' => 'font-helvetica']) }}
                            {{ Form::text('user_confirm_password', null, ['class' => 'input w-full border mt-2 col-span-2']) }} 
                        </div>
                    </div>
                    <div class="relative mt-3">
                        <button type="submit" name="user_add_submit" class="button w-25 bg-theme-1 text-white font-helvetica">რეგისტრაცია</button>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
@section('custom_scripts')
<script type="text/javascript">
	$(document).ready(function() {
		$('.side-menu').removeClass('side-menu--active');
		$('.side-menu[data-menu="user"]').addClass('side-menu--active');
	});
</script>
@endsection
