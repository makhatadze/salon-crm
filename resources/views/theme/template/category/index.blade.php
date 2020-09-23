@extends('theme.layout.layout')

@section('content')

    <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2 user-header">
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
                                <a class="flex items-center mr-3" href="javascript:;"> <i data-feather="check-square"
                                                                                          class="w-4 h-4 mr-1"></i>
                                    რედაქტირება
                                </a>
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