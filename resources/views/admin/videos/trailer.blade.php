@extends('layouts.app')

@section('content')
<div class="container">
    <form method="POST" action="{{ route('videos.store_trailer', $data->id) }}" enctype="multipart/form-data">
    @csrf
    <div class="row justify-content-center">
        <div class="col-md-12">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">{{ __('Home') }}</a></li>
                    <li class="breadcrumb-item"><a href="/videos">{{ __('Videos') }}</a></li>
                    <li class="breadcrumb-item"><a href="/videos/{{ $data->id }}">{{ $data->title }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Trailer') }}</li>
                </ol>
            </nav>

            @if ($message = Session::get('success'))
                <div class="alert alert-success" role="alert">
                    {{ $message }}
                </div>
            @endif


            @if ($errors->any())
                
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <div class="card">
                <div class="card-header" style="background-color: #dee2e6"><h2>Trailer for {{ $data->title }}</h2></div>
                <div class="card-header" style="background-color: #eaeaea">
              
                <dl class="row col-md-12">
                 
                    <dd class="col-sm-12">
                    
                    @if (file_exists(public_path('/uploads/' .$data->id. '/trailer/original.mp4')))

                        <script type="text/javascript" src="//player.wowza.com/player/latest/wowzaplayer.min.js"></script>
                        <div id="playerElement" style="width:100%; height:0; padding:0 0 56.25% 0"></div>
                        <script type="text/javascript">
                        WowzaPlayer.create("playerElement",
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

                                    @if (file_exists(public_path('/uploads/' .$data->id. '/images/trailer.png')))
                                        "posterFrameURL":"/uploads/{{ $data->id }}/images/trailer.png",
                                        "endPosterFrameURL":"/uploads/{{ $data->id }}/images/trailer.png",
                                        "uiPosterFrameFillMode":"fit"
                                    @else 
                                        "posterFrameURL":"/src/poster/trailer.png",
                                        "endPosterFrameURL":"/src/poster/trailer.png",
                                        "uiPosterFrameFillMode":"fit"

                                    @endif    
                                }
                        );
                        </script>
                        
                        
                    @else
                        <img src="/src/poster/trailer.png" />
                    @endif
                    
                    
                    <div class="input-group mt-1 row col-md-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Upload Video</span>
                        </div>
                        <div class="custom-file" >
                            <input onchange="form.submit()" type="file" class="form-control @error('file-1') is-invalid @enderror" name="file-1" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="inputGroupFile01">.mov or .mp4 only</label>
                        </div>
                        
                    </div>

                    <div class="input-group mt-1 row col-md-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Upload Poster</span>
                        </div>
                        <div class="custom-file" >
                            <input onchange="form.submit()" type="file" class="form-control @error('file-2') is-invalid @enderror" name="file-2" class="custom-file-input" id="inputGroupFile02" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="inputGroupFile02">.jpg or .png only</label>
                        </div>
                        
                    </div>

                    
                    </dd>

                    <dt class="col-sm-3">

                    </dt>
                    <dd class="col-sm-9"></dd>

                </dl>
                </div>

                <div class="form-group  mt-2">
                    <a href="{{ route('videos.index')}}" class="btn btn-dark ml-2">	&laquo; Back</a>
                </div>
            </div>



    
        </div>
    </div>
       
    </form>    
</div>
@endsection