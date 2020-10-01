@extends('theme.layout.layout')
@section('content')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto font-helvetica">
            ახალი თანამშრომლის რეგისტრაცია
        </h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-8">
            <div class="intro-y box p-5">
                {!! Form::open(['files' => 'true']) !!}
                <div>
                    <label class="font-helvetica"><b>პირადი ინფორმაცია</b></label>
                    <div class="sm:grid grid-cols-3 gap-2 mb-4">
                        <div class="relative mt-2 {{ $errors->has('first_name') ? ' has-error' : '' }}">
                            {{ Form::label('first_name', 'მომხმარებლის სახელი', ['class' => 'font-bold font-caps text-xs text-gray-800']) }}
                            {{ Form::text('first_name', null, ['class' => 'appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500', 'no']) }}
                            @if ($errors->has('first_name'))
                                <span class="help-block">
                                            {{ $errors->first('first_name') }}
                                        </span>
                            @endif
                        </div>
                        <div class="relative mt-2 {{ $errors->has('last_name') ? ' has-error' : '' }}">
                            {{ Form::label('last_name', 'მომხმარებლის გვარი', ['class' => 'font-bold font-caps text-xs text-gray-800']) }}
                            {{ Form::text('last_name', null, ['class' => 'appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500']) }}
                            @if ($errors->has('last_name'))
                                <span class="help-block">
                                            {{ $errors->first('last_name') }}
                                        </span>
                            @endif
                        </div>
                        <div class="relative mt-2 {{ $errors->has('pid') ? ' has-error' : '' }}">
                            {{ Form::label('pid', 'მომხმარებლის პირადი ნომერი', ['class' => 'font-bold font-caps text-xs text-gray-800']) }}
                            {{ Form::text('pid', null, ['class' => 'appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500']) }}
                            @if ($errors->has('pid'))
                                <span class="help-block">
                                            {{ $errors->first('pid') }}
                                        </span>
                            @endif
                        </div>
                        <div class="relative mt-2 {{ $errors->has('birthday') ? ' has-error' : '' }}">
                            {{ Form::label('birthday', 'დაბადების თარიღი', ['class' => 'font-bold font-caps text-xs text-gray-800']) }}
                            {{ Form::date('birthday', null, ['class' => 'appearance-none text-xs block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500']) }}
                            @if ($errors->has('birthday'))
                                <span class="help-block">
                                            {{ $errors->first('birthday') }}
                                        </span>
                            @endif
                        </div>
                        <div class="relative mt-2 {{ $errors->has('phone') ? ' has-error' : '' }}">
                            {{ Form::label('phone', 'ტელეფონის ნომერი', ['class' => 'font-bold font-caps text-xs text-gray-800']) }}
                            {{ Form::text('phone', null, ['class' => 'appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500']) }}
                            @if ($errors->has('phone'))
                                <span class="help-block">
                                            {{ $errors->first('phone') }}
                                        </span>
                            @endif
                        </div>
                        <div class="relative mt-2 {{ $errors->has('email') ? ' has-error' : '' }}">
                            {{ Form::label('email', 'ელ-ფოსტა', ['class' => 'font-bold font-caps text-xs text-gray-800']) }}
                            {{ Form::email('email', null, ['class' => 'appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500']) }}
                            @if ($errors->has('email'))
                                <span class="help-block">
                                            {{ $errors->first('email') }}
                                        </span>
                            @endif
                        </div>
                    </div>
                    <div class="sm:grid grid-cols-2 gap-2 mb-4">
                        <div class="relative mt-2 {{ $errors->has('position') ? ' has-error' : '' }}">
                            {{ Form::label('position', 'თანამდებობა', ['class' => 'font-bold font-caps text-xs text-gray-800']) }}
                            {{ Form::select('position', ['2' => 'სალონის ადმინისტრატორი', '4' => 'სტილისტი'], null, ['class' => 'font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500']) }}
                            @if ($errors->has('position'))
                                <span class="help-block">
                                            {{ $errors->first('position') }}
                                        </span>
                            @endif
                        </div>
                        <div class="relative mt-2 {{ $errors->has('salary_type') ? ' has-error' : '' }}">
                            {{ Form::label('salary_type', 'თანამდებობა', ['class' => 'font-bold font-caps text-xs text-gray-800']) }}
                            {{ Form::select('salary_type', ['1' => 'ორივე', '2' => 'პროცენტი', '3' => 'ფიქსირებული'], null, ['class' => 'font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500']) }}
                            @if ($errors->has('salary_type'))
                                <span class="help-block">
                                            {{ $errors->first('position') }}
                                        </span>
                            @endif
                        </div>
                        <div class="relative mt-2 {{ $errors->has('salary') ? ' has-error' : '' }}" id="salary-container">
                            {{ Form::label('salary', 'ხელფასი', ['class' => 'font-bold font-caps text-xs text-gray-800']) }}
                            {{ Form::text('salary', null, ['class' => 'font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500']) }}
                            @if ($errors->has('salary'))
                                <span class="help-block">
                                            {{ $errors->first('salary') }}
                                        </span>
                            @endif
                        </div>
                        <div class="relative mt-2 {{ $errors->has('percent') ? ' has-error' : '' }} percent-container">
                            {{ Form::label('percent', 'პროცენტი', ['class' => 'font-bold font-caps text-xs text-gray-800']) }}
                            {{ Form::text('percent', null, ['class' => 'appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500']) }}
                            @if ($errors->has('percent'))
                                <span class="help-block">
                                            {{ $errors->first('percent') }}
                                        </span>
                            @endif
                        </div>

                    </div>
                    <div class="sm:grid grid-cols-2 gap-2">
                        <div class="w-1/2 p-2 {{ $errors->has('files') ? ' has-error' : '' }}">
                            {{ Form::label('image', 'სურათი', ['class' => 'font-helvetica']) }}
                            <div class="border-2 border-dashed rounded-md mt-2 pt-1">
                                <div class="relative mt-1">
                                    <div class="px-4 pb-2 flex items-center cursor-pointer relative">
                                        <span class="text-theme-1 mr-1">ატვირთეთ ფაილი</span>
                                        {!! Form::file('image',['class' => 'appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500', 'id' => 'files', 'name' =>'files']) !!}
                                    </div>
                                </div>
                            </div>
                            @if ($errors->has('files'))
                                <span class="help-block">
                                                {{ $errors->first('files') }}
                                            </span>
                            @endif
                        </div>
                    </div>
                    @if($companies)
                        <div class="jobs">
                            <div class="sm:grid grid-cols-3 gap-3 mb-5">

                                <div class="relative mt-2">
                                    <label class="font-bold font-caps text-xs text-gray-800">company</label>
                                    <div class="mt-2">
                                        <select data-placeholder="Select a company" name="company[]" id="company"
                                                class="font-helvetica select2 w-full">
                                            <option value=""></option>
                                            @foreach ($companies as $company)
                                                <option value="{{$company->id}}"> {{$company->{"title_".app()->getLocale()} }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="relative mt-2 office-1" id="office-1" style="display: none">
                                    <label class="font-bold font-caps text-xs text-gray-800">office</label>
                                    <div class="mt-2">
                                        <select data-placeholder="Select a office" name="office[]" id="select-office-1"
                                                class="font-helvetica select2 w-full">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="relative mt-2 department-1" id="department-1" style="display: none">
                                    <label class="font-bold font-caps text-xs text-gray-800">department</label>
                                    <div class="mt-2">
                                        <select data-placeholder="Select a company" name="department[]"
                                                id="select-department-1"
                                                class="font-helvetica select2 w-full">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <label class="font-helvetica"><b>პროფილის მონაცემები</b></label>
                        <div class="sm:grid grid-cols-2 gap-2">
                            <div class="relative mt-2 {{ $errors->has('password') ? ' has-error' : '' }}">
                                {{ Form::label('password', 'პაროლი', ['class' => 'font-bold font-caps text-xs text-gray-800']) }}
                                {{ Form::password('password', ['class' => 'appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500']) }}
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                            {{ $errors->first('password') }}
                                        </span>
                                @endif
                            </div>
                            <div class="relative mt-2 {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                {{ Form::label('password_confirmation', 'პაროლის გამეორება', ['class' => 'font-bold font-caps text-xs text-gray-800']) }}
                                {{ Form::password('password_confirmation', ['class' => 'appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500', 'type' => 'password']) }}
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                            {{ $errors->first('password_confirmation') }}
                                        </span>
                                @endif
                            </div>
                        </div>
                </div>
                @endif
                <div class="relative mt-3">
                    <button type="submit" name="user_add_submit"
                            class="button w-25 bg-theme-1 text-white font-helvetica">რეგისტრაცია
                    </button>
                </div>

            </div>
            {!! Form::close() !!}
        </div>
    </div>
    </div>
@endsection
@section('custom_scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.side-menu').removeClass('side-menu--active');
            $('.side-menu[data-menu="user"]').addClass('side-menu--active');


            $('select[name ="company[]"]').change(function () {
                getDropdownList($(this), $(this).val());
            })

            $('select[name ="office[]"').change(function () {
                getDropdownList($(this), '', $(this).val());
            })

            function getDropdownList(el, company = '', office = '', department = '') {
                $.ajax({
                    url: "{{route('ActionUserData')}}",
                    data: {
                        'company': company,
                        'office': office,
                        'department': department
                    }
                }).done(function (data) {
                    if (company) {
                        if (data) {
                            let option = '<option value=""></option>';
                            data.forEach(el => {
                                option = `${option}
                                <option value="${el.id}">${el['name_{{app()->getLocale()}}']}</option>
`
                            })
                            let id = $('.jobs').children();
                            id = id.length;
                            let office = `.office-${id}`;
                            let selectOffice = `#select-office-${id}`
                            let department = `.department-${id}`;
                            let selectDepartment = `#select-department-${id}`
                            $(department).css('display', 'none');
                            $(selectDepartment).html('')
                            $(office).css('display', 'block')
                            $(selectOffice).html(option)
                            $('.select2').select2();

                        }
                    }
                    if (office) {
                        if (data) {
                            let option = '<option value=""></option>';
                            data.forEach(el => {
                                option = `${option}
                                <option value="${el.id}">${el['name_{{app()->getLocale()}}']}</option>
`
                            })
                            let id = $('.jobs').children();
                            id = id.length;
                            let department = `.department-${id}`;
                            let selectDepartment = `#select-department-${id}`
                            $(department).css('display', 'block')
                            $(selectDepartment).html(option)
                            $('.select2').select2();
                        }
                    }
                });
            }
        });
    </script>
@endsection
