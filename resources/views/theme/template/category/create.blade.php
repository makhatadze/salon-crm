@extends('theme.layout.layout')
@section('content')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto font-helvetica">
            ახალი კატეგორიის დამატება
        </h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-8">
            <div class="intro-y box p-5">
                {!! Form::open(['action' => 'CategoryController@store','method' => 'POST']) !!}
                <div>
                    <label class="font-helvetica"><b>კატეგორია</b></label>
                    <div class="sm:grid grid-cols-2 gap-2 mb-4">
                        <div class="relative mt-2 {{ $errors->has('title_ge') ? ' has-error' : '' }}">
                            {{ Form::label('title_ge', 'სახელი ქართულად', ['class' => 'font-helvetica']) }}
                            {{ Form::text('title_ge', null, ['class' => 'input w-full border mt-2 col-span-2', 'no']) }}
                            @if ($errors->has('title_ge'))
                                <span class="help-block">
                                            {{ $errors->first('title_ge') }}
                                        </span>
                            @endif
                        </div>
                        <div class="relative mt-2 {{ $errors->has('title_en') ? ' has-error' : '' }}">
                            {{ Form::label('title_en', 'სახელი ინგლისურად', ['class' => 'font-helvetica']) }}
                            {{ Form::text('title_en', null, ['class' => 'input w-full border mt-2 col-span-2', 'no']) }}
                            @if ($errors->has('title_en'))
                                <span class="help-block">
                                            {{ $errors->first('title_en') }}
                                        </span>
                            @endif
                        </div>

                        <div class="relative mt-2 {{ $errors->has('title_ru') ? ' has-error' : '' }}">
                            {{ Form::label('title_ru', 'სახელი რუსულად', ['class' => 'font-helvetica']) }}
                            {{ Form::text('title_ru', null, ['class' => 'input w-full border mt-2 col-span-2', 'no']) }}
                            @if ($errors->has('title_ru'))
                                <span class="help-block">
                                            {{ $errors->first('title_ru') }}
                                        </span>
                            @endif
                        </div>
                    </div>
                    <div class="relative mt-3">
                        <button type="submit" name="user_add_submit"
                                class="button w-25 bg-theme-1 text-white font-helvetica">დამატება
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
    </script>
@endsection
