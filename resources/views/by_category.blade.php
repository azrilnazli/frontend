@extends('layouts.app')

@section('content')


@php

$countVideos = count($data) ;
$videosPerRow = 9 ;

@endphp

@if($countVideos>0)
    <div class="carousel">
        <div class="carousel-row text-center">
        @for ($i = 0 ; $i < $countVideos; $i++)

            @if ($i % $videosPerRow == 0) 
            <hr class="border-0"> 
            @endif

            <div class="carousel-tile">
                <a href="{{ route('play',$data[$i]->id) }}"><img  style="width:200px;height:300px" src="{{ config('settings.asset_server') . $data->id }}/images/file-1-small.png" /></a>
            </div>
        @endfor

        </div>
    </div>
@endif
@endsection 