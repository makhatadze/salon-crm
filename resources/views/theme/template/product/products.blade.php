@extends('theme.layout.layout')

@section('content')
<div class="grid grid-cols-12 gap-2 mt-5">
  <div class="col-span-12 lg:col-span-4 p-3">
    @livewire('product.category')
  </div>
  <div class="col-span-12  p-3">
    @livewire('product.index')
  </div>
</div>
@endsection
@section('custom_scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.side-menu').removeClass('side-menu--active');
            $('.side-menu[data-menu="shop"]').addClass('side-menu--active');
            $('#menushop ul').addClass('side-menu__sub-open');
            $('#menushop ul').css('display', 'block');

        });

    </script>
@endsection
