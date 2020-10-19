@extends('theme.layout.layout')

@section('content')
<div class="grid grid-cols-12 gap-6 mt-5">
  <div class="col-span-3 p-3">
    @livewire('product.category')
  </div>
  <div class="col-span-9 p-3">
    @livewire('product.index')
  </div>
</div>
@endsection
@section('custom_scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.side-menu').removeClass('side-menu--active');
            $('.side-menu[data-menu="products"]').addClass('side-menu--active');

        });

    </script>
@endsection
