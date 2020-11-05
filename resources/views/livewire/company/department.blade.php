<div>
    
    @foreach ($departments as $dept)
        <div class="mt-3">
            <span>{{$dept->name_ge }}</span>
        </div>
    @endforeach
</div>
