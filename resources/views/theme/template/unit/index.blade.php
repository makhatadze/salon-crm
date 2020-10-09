@extends('theme.layout.layout')
@section('content')
<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12 xxl:col-span-4 xxl:border-l p-3 -mb-10 pb-10">
    <form class="w-full box max-w-lg p-2" action="{{ route('AddUnitReq') }}" method="post">
        @csrf
                <div class="w-full px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                        სახელი
                    </label>
                    <input name="name" class="font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"  type="text" placeholder="ერთეული">
                </div>
               
            <div class="mt-3">
                <button class="bg-indigo-500 py-3 px-4 w-full font-bold font-caps text-center text-white text-xs">დამატება</button>
            </div>
          </form>
    </div>
    <div class="col-span-12 xxl:col-span-3 xxl:border-l border-theme-5 -mb-10 pb-10">
        <div class="w-full p-2">
            @foreach ($units as $unit)
            <div class="mt-3 box p-2">
                {{ $unit->name }}
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection