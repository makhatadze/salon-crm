@extends('theme.layout.layout')

@section('content')

    {!! Form::open(['method'=>'GET']) !!}
    <div class="col-span-12 xxl:col-span-3 -mb-10 pb-10">
        <h6 class="font-bold font-caps text-gray-700 text-xs">ფილტრი</h6>
        <div class="box mt-5 p-2">
            <div class="flex flex-wrap -mx-3  mt-3">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0 {{ $errors->has('date_from') ? ' has-error' : '' }}">
                    {{ Form::label('date_from', 'გადახდის დრო - დან', ['class' => 'font-helvetica']) }}
                    {{ Form::date('date_from', Request::get('date_from') ? Request::get('date_from') : null , ['class' => 'input w-full border mt-2 col-span-2']) }}
                    @if ($errors->has('date_from'))
                        <span class="help-block">
                                            {{ $errors->first('date_from') }}
                                        </span>
                    @endif
                </div>
                <div class="w-full md:w-1/2 px-3 {{ $errors->has('date_to') ? ' has-error' : '' }}">
                    {{ Form::label('date_to', 'გადახდის დრო - დან', ['class' => 'font-helvetica']) }}
                    {{ Form::date('date_to', Request::get('date_to') ? Request::get('date_to') : null, ['class' => 'input w-full border mt-2 col-span-2']) }}
                    @if ($errors->has('date_to'))
                        <span class="help-block">
                                            {{ $errors->first('date_to') }}
                                        </span>
                    @endif
                </div>
            </div>

            <div class="flex flex-wrap -mx-3  mt-3">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0 {{ $errors->has('title') ? ' has-error' : '' }}">
                    {{ Form::label('title', 'სათაური', ['class' => 'font-helvetica']) }}
                    {{ Form::text('title',Request::get('title') ? Request::get('title') : '', ['class' => 'input w-full border mt-2 col-span-2']) }}
                    @if ($errors->has('title'))
                        <span class="help-block">
                                            {{ $errors->first('title') }}
                                        </span>
                    @endif
                </div>
                <div class="w-full md:w-1/2 px-3">
                    <button type="submit"
                            class="mt-2 block appearance-none font-bold font-caps bg-indigo-500 text-xs text-white w-full bg-gray-200 border border-gray-200  py-3 px-4 pr-8 rounded leading-tight"
                            id="category-search">
                        ძებნა
                    </button>
                </div>
            </div>
        </div>
    </div>

    {!! Form::close() !!}
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2 user-header mt-5">
        <a href="/category/create" class="button text-white bg-theme-1 shadow-md mr-2 font-helvetica">ახალი
            კატეგორიის დამატება</a>
    </div>
    <h2 class="intro-y text-lg font-medium mt-10 font-helvetica">
        კატეგორიების ჩამონათვალი
    </h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <table class="table table-report -mt-2 col-span-12">
            <thead>
            <tr>
                <th class="whitespace-no-wrap font-helvetica">სათაური</th>
                <th class="whitespace-no-wrap font-helvetica">შექმნის დრო</th>
                <th class="text-center whitespace-no-wrap font-helvetica">მოქმედება</th>
            </tr>
            </thead>
            <tbody>

            @if ($categories)
                @foreach ($categories as $cat)

                    <tr class="intro-x">
                        <td class="w-40">
                            <div class="flex font-helvetica">
                                {{$cat->{"title_".app()->getLocale()} }}
                            </div>
                        </td>
                        <td>
                            <a href="" class="font-medium whitespace-no-wrap font-helvetica">
                                {{$cat->created_at}}
                            </a>
                        </td>
                        <td class="table-report__action w-56">
                            <div class="flex justify-center items-center">
                                <a class="flex items-center mr-3 cursor-pointer"
                                   data-catid={{$cat->id}} data-toggle="modal"
                                   data-target="#category-update-confirmation-modal-{{ $cat->id }}"><i
                                            data-feather="check-square"
                                            class="w-4 h-4 mr-1"></i> რედაქტირება
                                </a>
                                <div class="modal fade" id="category-update-confirmation-modal-{{ $cat->id }}"
                                     tabIndex="-1">
                                    <div class="modal__content">
                                        <div class="p-5 text-center">
                                            <div class="p-5 text-center">
                                                {!! Form::open(['url' => route('CategoryUpdate',$cat->id),'method' => 'PUT']) !!}
                                                <div>
                                                    <label class="font-helvetica"><b>კატეგორია</b></label>
                                                    <div class="sm:grid mb-4">
                                                        <div class="relative mt-2 {{ $errors->has('title_ge') ? ' has-error' : '' }}">
                                                            {{ Form::label('title_ge', 'სახელი ქართულად', ['class' => 'font-helvetica']) }}
                                                            {{ Form::text('title_ge', $cat->title_ge ? $cat->title_ge : '', ['class' => 'input w-full border mt-2 col-span-2', 'no', 'required']) }}
                                                            @if ($errors->has('title_ge'))
                                                                <span class="help-block">
                                                        {{ $errors->first('title_ge') }}
                                                         </span>
                                                            @endif
                                                        </div>
                                                        <div class="relative mt-2 {{ $errors->has('title_en') ? ' has-error' : '' }}">
                                                            {{ Form::label('title_en', 'სახელი ინგლისურად', ['class' => 'font-helvetica']) }}
                                                            {{ Form::text('title_en', $cat->title_en ? $cat->title_en : '', ['class' => 'input w-full border mt-2 col-span-2', 'no']) }}
                                                            @if ($errors->has('title_en'))
                                                                <span class="help-block">
                                            {{ $errors->first('title_en') }}
                                        </span>
                                                            @endif
                                                        </div>

                                                        <div class="relative mt-2 {{ $errors->has('title_ru') ? ' has-error' : '' }}">
                                                            {{ Form::label('title_ru', 'სახელი რუსულად', ['class' => 'font-helvetica']) }}
                                                            {{ Form::text('title_ru', $cat->title_ru ? $cat->title_ru : '', ['class' => 'input w-full border mt-2 col-span-2', 'no']) }}
                                                            @if ($errors->has('title_ru'))
                                                                <span class="help-block">
                                            {{ $errors->first('title_ru') }}
                                        </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="relative mt-3">
                                                        <button type="submit" name="user_add_submit"
                                                                class="button w-25 bg-theme-1 text-white font-helvetica">
                                                            დამატება
                                                        </button>
                                                    </div>

                                                </div>
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a class="flex items-center text-theme-6 cursor-pointer"
                                   data-catid={{$cat->id}} data-toggle="modal"
                                   data-target="#category-delete-confirmation-modal-{{ $cat->id }}"> <i
                                            data-feather="trash-2"
                                            class="w-4 h-4 mr-1"></i> წაშლა
                                </a>
                                <div class="modal fade" id="category-delete-confirmation-modal-{{ $cat->id }}"
                                     tabIndex="-1">
                                    <div class="modal__content">
                                        <div class="p-5 text-center">
                                            <div class="p-5 text-center">
                                                <form action="{{route('CategoryDelete',$cat->id)}}" method="post">
                                                    {{method_field('delete')}}
                                                    {{csrf_field()}}
                                                    <div class="p-5 text-center">
                                                        <i data-feather="x-circle"
                                                           class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
                                                        <div class="text-3xl mt-5">დარწმუნებული ხარ?</div>
                                                        <div class="text-gray-600 mt-2">ნამდვილად გსურთ ამ ჩანაწერების
                                                            წაშლა? ამ პროცესის გაუქმება შეუძლებელია.
                                                        </div>
                                                    </div>
                                                    <div class="px-5 pb-8 text-center">
                                                        <button type="button" data-dismiss="modal"
                                                                class="button w-24 border text-gray-700 mr-1">გაუქმება
                                                        </button>
                                                        <button type="submit" class="button w-24 bg-theme-6 text-white">
                                                            წაშლა
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                {{$categories->links()}}
            @endif
            </tbody>
        </table>
        @endsection
        @section('custom_scripts')
            <script type="text/javascript">
                $(document).ready(function () {
                    $('.side-menu').removeClass('side-menu--active');
                    $('.side-menu[data-menu="services"]').addClass('side-menu--active');

                });

            </script>
@endsection