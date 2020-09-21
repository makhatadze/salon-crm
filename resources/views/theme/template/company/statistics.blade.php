@extends('theme.layout.layout')

@section('content')
<div class="p-4">
    <div class="grid grid-cols-4 ">
        @foreach ($users as $user)
        <div class="col-span-1 p-2">
            <div class="box p-2">
                da
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
@section('custom_scripts')
    <script type="text/javascript">
    </script>
@endsection
