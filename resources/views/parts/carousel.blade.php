
<div class="carousel">
    <div class="carousel-row text-center">
        @foreach($data as $video)
        <div class="carousel-tile">
            <a href="{{ route('play',$video->id) }}"><img  style="width:200px;height:300px" src="http://auth.test/uploads/{{ $video->id }}/images/file-1-small.png" /></a>
        </div>
        @endforeach
    </div>
</div>
