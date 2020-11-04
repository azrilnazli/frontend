@extends('layouts.app')

@section('content')



<div class="carousel">
    <div class="carousel-row text-center">
        @foreach($row[1] as $video)
        <div class="carousel-tile" style="background: #46B1C9;">
        <a href="{{ route('play',$video->id) }}"><img  style="width:250px;height:142px" src="http://auth.test/uploads/{{ $video->id }}/images/file-2-small.png" /></a>
        </div>
        @endforeach
    </div>
</div>

<div class="carousel">
    <div class="carousel-row text-center">
        @foreach($row[1] as $video)
        <div class="carousel-tile" style="background: #46B1C9;">
        <a href="{{ route('play',$video->id) }}"><img  style="width:250px;height:142px" src="http://auth.test/uploads/{{ $video->id }}/images/file-2-small.png" /></a>
        </div>
        @endforeach
    </div>
</div>


<div class="carousel">
    <div class="carousel-row text-center">
        @foreach($row[1] as $video)
        <div class="carousel-tile" style="background: #46B1C9;">
        <a href="{{ route('play',$video->id) }}"><img  style="width:250px;height:142px" src="http://auth.test/uploads/{{ $video->id }}/images/file-2-small.png" /></a>
        </div>
        @endforeach
    </div>
</div>


<div class="carousel">
    <div class="carousel-row text-center">
        @foreach($row[1] as $video)
        <div class="carousel-tile" style="background: #46B1C9;">
        <a href="{{ route('play',$video->id) }}"><img  style="width:250px;height:142px" src="http://auth.test/uploads/{{ $video->id }}/images/file-2-small.png" /></a>
        </div>
        @endforeach
    </div>
</div>





@endsection 