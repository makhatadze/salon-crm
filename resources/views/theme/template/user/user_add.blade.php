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
                        <div class="relative mt-2 {{ $errors->has('first_name') ? ' has-error' : '' }}">
                            {{ Form::label('first_name', 'მომხმარებლის სახელი', ['class' => 'font-helvetica']) }}
                            {{ Form::text('first_name', null, ['class' => 'input w-full border mt-2 col-span-2', 'no']) }}
                            @if ($errors->has('first_name'))
                                <span class="help-block">
                                            {{ $errors->first('first_name') }}
                                        </span>
                            @endif
                        </div>
                        <div class="relative mt-2 {{ $errors->has('last_name') ? ' has-error' : '' }}">
                            {{ Form::label('last_name', 'მომხმარებლის გვარი', ['class' => 'font-helvetica']) }}
                            {{ Form::text('last_name', null, ['class' => 'input w-full border mt-2 col-span-2']) }}
                            @if ($errors->has('last_name'))
                                <span class="help-block">
                                            {{ $errors->first('last_name') }}
                                        </span>
                            @endif
                        </div>
                        <div class="relative mt-2 {{ $errors->has('pid') ? ' has-error' : '' }}">
                            {{ Form::label('pid', 'მომხმარებლის პირადი ნომერი', ['class' => 'font-helvetica']) }}
                            {{ Form::text('pid', null, ['class' => 'input w-full border mt-2 col-span-2']) }}
                            @if ($errors->has('pid'))
                                <span class="help-block">
                                            {{ $errors->first('pid') }}
                                        </span>
                            @endif
                        </div>
                        <div class="relative mt-2 {{ $errors->has('birthday') ? ' has-error' : '' }}">
                            {{ Form::label('birthday', 'დაბადების თარიღი', ['class' => 'font-helvetica']) }}
                            {{ Form::date('birthday', null, ['class' => 'input w-full border mt-2 col-span-2']) }}
                            @if ($errors->has('birthday'))
                                <span class="help-block">
                                            {{ $errors->first('birthday') }}
                                        </span>
                            @endif
                        </div>
                        <div class="relative mt-2 {{ $errors->has('phone') ? ' has-error' : '' }}">
                            {{ Form::label('phone', 'ტელეფონის ნომერი', ['class' => 'font-helvetica']) }}
                            {{ Form::text('phone', null, ['class' => 'input w-full border mt-2 col-span-2']) }}
                            @if ($errors->has('phone'))
                                <span class="help-block">
                                            {{ $errors->first('phone') }}
                                        </span>
                            @endif
                        </div>
                        <div class="relative mt-2 {{ $errors->has('email') ? ' has-error' : '' }}">
                            {{ Form::label('email', 'ელ-ფოსტა', ['class' => 'font-helvetica']) }}
                            {{ Form::email('email', null, ['class' => 'input w-full border mt-2 col-span-2']) }}
                            @if ($errors->has('email'))
                                <span class="help-block">
                                            {{ $errors->first('email') }}
                                        </span>
                            @endif
                        </div>
                    </div>
                    <label class="font-helvetica"><b>სამსახურეობრივი მონაცემები</b></label>
                    <div class="sm:grid grid-cols-2 gap-2 mb-4">
                    	<div class="relative mt-2 {{ $errors->has('position') ? ' has-error' : '' }}">
                            {{ Form::label('position', 'თანამდებობა', ['class' => 'font-helvetica']) }}
                            {{ Form::select('position', ['1' => 'სალონის ადმინისტრატორი', '2' => 'სტილისტი'], null, ['class' => 'input w-full border mt-2 col-span-12 font-helvetica']) }}
                            @if ($errors->has('position'))
                                <span class="help-block">
                                            {{ $errors->first('position') }}
                                        </span>
                            @endif
                        </div>
                        <div class="relative mt-2 {{ $errors->has('salary_type') ? ' has-error' : '' }}">
                            {{ Form::label('salary_type', 'თანამდებობა', ['class' => 'font-helvetica']) }}
                            {{ Form::select('salary_type', ['1' => 'ფიქსირებული', '2' => 'პროცენტი'], null, ['class' => 'input w-full border mt-2 col-span-12 font-helvetica']) }}
                            @if ($errors->has('salary_type'))
                                <span class="help-block">
                                            {{ $errors->first('position') }}
                                        </span>
                            @endif
                        </div>
                        <div class="relative mt-2 {{ $errors->has('salary') ? ' has-error' : '' }}">
                            {{ Form::label('salary', 'ხელფასი', ['class' => 'font-helvetica']) }}
                            {{ Form::text('salary', null, ['class' => 'input w-full border mt-2 col-span-2']) }}
                            @if ($errors->has('salary'))
                                <span class="help-block">
                                            {{ $errors->first('salary') }}
                                        </span>
                            @endif
                        </div>
                        <div class="relative mt-2 {{ $errors->has('percent') ? ' has-error' : '' }}">
                            {{ Form::label('percent', 'პროცენტი', ['class' => 'font-helvetica']) }}
                            {{ Form::text('percent', null, ['class' => 'input w-full border mt-2 col-span-2']) }}
                            @if ($errors->has('percent'))
                                <span class="help-block">
                                            {{ $errors->first('percent') }}
                                        </span>
                            @endif
                        </div>
                    </div>
                    <label class="font-helvetica"><b>პროფილის მონაცემები</b></label>
                    <div class="sm:grid grid-cols-2 gap-2">
                        <div class="relative mt-2 {{ $errors->has('password') ? ' has-error' : '' }}">
                            {{ Form::label('password', 'პაროლი', ['class' => 'font-helvetica']) }}
                            {{ Form::password('password', ['class' => 'input w-full border mt-2 col-span-2']) }}
                            @if ($errors->has('password'))
                                <span class="help-block">
                                            {{ $errors->first('password') }}
                                        </span>
                            @endif
                        </div>
                        <div class="relative mt-2 {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            {{ Form::label('password_confirmation', 'პაროლის გამეორება', ['class' => 'font-helvetica']) }}
                            {{ Form::password('password_confirmation', ['class' => 'input w-full border mt-2 col-span-2', 'type' => 'password']) }}
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                            {{ $errors->first('password_confirmation') }}
                                        </span>
                            @endif
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
