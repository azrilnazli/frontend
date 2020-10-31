@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">{{ __('Home') }}</a></li>
                    <li class="breadcrumb-item"><a href="/videos">{{ __('Videos') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Show') }}</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-header" style="background-color: #dee2e6"><h2>{{ $data->title }}</h2></div>
                <div class="card-header" style="background-color: #eaeaea">
              
                <dl class="row col-md-6">
                    <dt class="col-sm-3">Description</dt>
                    <dd class="col-sm-9"> {{ $data->description }}</dd>
                    <dt class="col-sm-3">Time Taken</dt>
                    <dd class="col-sm-9">  {{ $data->time_taken }} seconds</dd>

                    <dt class="col-sm-3">Created On</dt>
                    <dd class="col-sm-9">  {{ $data->created_at }}</dd>

                </dl>
                </div>

                <div class="card-body">
   
                <script type="text/javascript" src="//player.wowza.com/player/latest/wowzaplayer.min.js"></script>
                    <div id="playerElement" style="width:100%; height:0; padding:0 0 56.25% 0"></div>
                    <script type="text/javascript">
                    WowzaPlayer.create("playerElement",
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
                                "volume":75
                            }
                    );
                </script>


                    <div class="form-group row mb-0 mt-2">
                            
                            <a href="{{ route('users.index')}}" class="btn btn-dark ml-2">	&laquo; Back</a>
                
                    </div>
                  
                </div>

                
      
            </div>
        </div>
    </div>
</div>
@endsection
