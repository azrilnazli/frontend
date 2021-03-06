@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/videos">{{ __('Videos') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $data->title }}</li>
                    <li class="breadcrumb-item"><a href="{{ route('videos.edit' , $data->id )}}">Metadata</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('videos.trailer' , $data->id )}}">Trailer</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('videos.video' , $data->id )}}">Video</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('videos.poster' , $data->id )}}">Poster</a></li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-header" style="background-color: #dee2e6"><button type="button" class="btn btn-primary btn-lg">Video Assets</button></div>
                <div class="card-header" style="background-color: #eaeaea">
              
                <dl class="row col-md-12">
                    <dt class="col-sm-2">Title</dt>
                    <dd class="col-sm-9"> {{ $data->title }}</dd>
                    <dt class="col-sm-2">Category</dt>
                    <dd class="col-sm-9"> {{ $data->category->title }}</dd>
                    <dt class="col-sm-2">Description</dt>
                    <dd class="col-sm-9"> {{ $data->description }}</dd>
                    <dt class="col-sm-2">Time Taken</dt>
                    <dd class="col-sm-9">  {{ $data->time_taken }} seconds</dd>
                    

                    <dt class="col-sm-2">Created On</dt>
                    <dd class="col-sm-9">  {{ $data->created_at }}</dd>

                    <dt class="col-sm-2">Trailer</dt>
                    <dd class="col-sm-9"> 
                                <script type="text/javascript" src="//player.wowza.com/player/latest/wowzaplayer.min.js"></script>
                                <div id="playerElement-1" style="width:100%; height:0; padding:0 0 56.25% 0"></div>
                                <script type="text/javascript">
                                WowzaPlayer.create("playerElement-1",
                                        {
                                            "license":"PLAY1-hZeDc-CnBKQ-PM8MY-C9QkZ-cu899",
                                            "sources":[
                                                        {
                                                            "sourceURL":"http://localhost:8081/vod/{{ $data->id }}/trailer/smil:stream.smil/playlist.m3u8"
                                                        },
                                                    ],

                                            "title":"",
                                            "description":"",
                                            "autoPlay":false,
                                            "mute":false,
                                            "volume":75,
                                            @if (file_exists(public_path('/uploads/' .$data->id. '/images/trailer-poster.png')))
                                                "posterFrameURL":"/uploads/{{ $data->id }}/images/trailer-poster.png",
                                                "endPosterFrameURL":"/uploads/{{ $data->id }}/images/trailer-poster.png",
                                                "uiPosterFrameFillMode":"fit"
                                            @else 
                                                "posterFrameURL":"/src/poster/trailer-poster.png",
                                                "endPosterFrameURL":"/src/poster/trailer-poster.png",
                                                "uiPosterFrameFillMode":"fit"
                                            @endif   
                                        }
                                );
                            </script>                                
                    </dd>
                    <dt class="col-sm-2">Video</dt>
                    <dd class="col-sm-9"> 

                    <div id="playerElement-2" style="width:100%; height:0; padding:0 0 56.25% 0"></div>
                                <script type="text/javascript">
                                WowzaPlayer.create("playerElement-2",
                                        {
                                            "license":"PLAY1-hZeDc-CnBKQ-PM8MY-C9QkZ-cu899",
                                            "sources":[
                                                        {
                                                            "sourceURL":"http://localhost:8081/vod/{{ $data->id }}/videos/smil:stream.smil/playlist.m3u8"
                                                        },
                                                    ],

                                            "title":"",
                                            "description":"",
                                            "autoPlay":false,
                                            "mute":false,
                                            "volume":75,
                                            @if (file_exists(public_path('/uploads/' .$data->id. '/images/video-poster.png')))
                                                "posterFrameURL":"/uploads/{{ $data->id }}/images/video-poster.png",
                                                "endPosterFrameURL":"/uploads/{{ $data->id }}/images/video-poster.png",
                                                "uiPosterFrameFillMode":"fit"
                                            @else 
                                                "posterFrameURL":"/src/poster/video-poster.png",
                                                "endPosterFrameURL":"/src/poster/video-poster.png",
                                                "uiPosterFrameFillMode":"fit"
                                            @endif   
                                        }
                                );
                            </script>                                
                    </dd>                    

                    <dt class="col-sm-2">3:4 Poster</dt>
                    <dd class="col-sm-9">
                    @if (file_exists(public_path('/uploads/' .$data->id. '/images/file-1.png')))
                    <img class="img-thumbnail" src="/uploads/{{ $data->id }}/images/file-1.png" />
                    @else 
                    <img class="img-responsive" src="/src/poster/400x600.png" />
                    @endif   
                    </dd>

                    <dt class="col-sm-2">16:9 Poster</dt>
                    <dd class="col-sm-9">
                    @if (file_exists(public_path('/uploads/' .$data->id. '/images/file-2.png')))
                    <img class="img-thumbnail" src="/uploads/{{ $data->id }}/images/file-2-small.png" />
                    @else 
                    <img class="img-responsive" src="/src/poster/640x360.png" />
                    @endif   
                    </dd>

                </dl>
                </div>


                <div class="card-footer text-center">
                    <a href="{{ route('videos.index'  )}}" class="float-left btn btn-primary">	&laquo; Index</a>
                    <a href="{{ route('videos.edit', $data->id  )}}" class="float-right btn btn-primary">Metadata &raquo;</a>
                </div>

                
      
            </div>
        </div>
    </div>
</div>
@endsection
