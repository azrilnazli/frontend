@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('videos.update', $data->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row justify-content-center">
        <div class="col-md-12">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/videos">{{ __('Videos') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('videos.show' , $data->id )}}">{{ $data->title }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Metadata') }}</li>
                    <li class="breadcrumb-item"><a href="{{ route('videos.trailer' , $data->id )}}">Trailer</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('videos.video' , $data->id )}}">Video</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('videos.poster' , $data->id )}}">Poster</a></li>
                   
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
                <div class="card-header" style="background-color: #dee2e6"><h2>Metadata</h2></div>
                <div class="card-body" style="background-color: #eaeaea">

                    <dt class="col-sm-3">Title</dt>
                    <dd class="col-sm-9">
                        <div class="form-group row">
                            <div class="col-md-9">
                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $data->title }}" required autocomplete="title" >

                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                        </div>
                    </dd>

                    <dt class="col-sm-3">Description</dt>
                    <dd class="col-sm-9">
                        <div class="form-group row">

                                <div class="col-md-9">
                                    <!--<input id="description" type="description" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" required autocomplete="description"> -->
                                    <textarea class="form-control @error('description') is-invalid @enderror" rows="8" id="description" name="description" style="resize:none" required autocomplete="description">{{ $data->description }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                        </div>              
                    </dd>

                </dl>
                </div>

                <div class="card-footer text-center">
                    <a href="{{ route('videos.show', $data->id  )}}" class="float-left btn btn-primary">	&laquo; Show Assets</a>
                    <button type="submit" class="float-right btn btn-primary">
                        Trailer &raquo;
                    </button>
                </div>
            </div>


    
        </div>
    </div>
       
    </form>    
</div>
@endsection
