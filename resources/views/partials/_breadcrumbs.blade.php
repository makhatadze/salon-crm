<div class="-intro-x breadcrumb mr-auto hidden sm:flex"><a href="/" class="">Application</a>
    @foreach(request()->breadcrumbs()->segments() as $key => $segment)
        @if($segment->name() != 'ru' && $segment->name() != 'en' && $segment->name() != 'showprofile')
            @if(!isset(request()->breadcrumbs()->segments()[$key+1]))
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                     class="feather feather-chevron-right breadcrumb__icon">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
                <a class="breadcrumb--active">{{ $segment->name() }}</a>
            @else
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                     class="feather feather-chevron-right breadcrumb__icon">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
                <a href="{{$segment->url()}}">{{ $segment->name() }}</a>
            @endif
        @endif
    @endforeach
</div>

