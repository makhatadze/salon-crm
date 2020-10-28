@extends('theme.layout.layout')

@section('content')
<div class="grid grid-cols-12 mt-3">
    <div class="col-span-3 grid grid-cols-1">
        <div class="py-3 col-span-1 px-4 bg-white">
            <form action="{{route('updateGroup', $memberGroup->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="w-full px-3">
                    <input name="groupname" value="{{$memberGroup->name}}" class="font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="ჯგუფის სახელი">
                    <p class="text-gray-600 text-xs font-normal"> <strong class="text-gray-800">გაფრთხილება:</strong> სახელის განმეორებით არჩევა არ შეიძლება.</p>
                </div>
                <div class="w-full px-3">
                    <input class="appearance-none block w-full bg-indigo-500 text-white border border-gray-200 rounded py-2 font-bold text-xs mt-2 px-4 mb-3 cursor-pointer" value="რედაქტირება" type="submit">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('custom_scripts')
<script>
      $(document).ready(function () {
            $('.side-menu').removeClass('side-menu--active');
            $('.side-menu[data-menu="user"]').addClass('side-menu--active');
            $('#menuuser ul').addClass('side-menu__sub-open');
            $('#menuuser ul').css('display', 'block');
      });
      function addminutetag($user->id){
        if($('#'+$user->id).length == 2){
          $('#'+$user->id).val($('#'+$user->id).val()+":");
        }
      }
</script>
@endsection