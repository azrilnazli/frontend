@extends('layouts.app')

@section('content')
<div class="container">
    <form method="POST" action="{{ route('videos.store_poster', $data->id) }}" enctype="multipart/form-data">
    @csrf
    <div class="row justify-content-center">
        <div class="col-md-12">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">{{ __('Home') }}</a></li>
                    <li class="breadcrumb-item"><a href="/videos">{{ __('Videos') }}</a></li>
                    <li class="breadcrumb-item"><a href="/videos/{{ $data->id }}">{{ $data->title }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Poster') }}</li>
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
                <div class="card-header" style="background-color: #dee2e6"><h2>{{ $data->title }}</h2></div>
                <div class="card-header" style="background-color: #eaeaea">
              
                <dl class="row col-md-6">
                    <dt class="col-sm-3">Poster 1</dt>
                    <dd class="col-sm-9">
                    
                    @if (file_exists(public_path('/uploads/' .$data->id. '/images/file-1.png')))


                    <table>
                        <tr>
                            <td><img style="width:400px;height:600px" src="/uploads/{{ $data->id }}/images/file-1.png" />file-1.png</td>
                            <td vAlign="top"><img style="width:200px;height:300px" src="/uploads/{{ $data->id }}/images/file-1-small.png" />file-2.png</td>
                    </table>
                        
                        
                    @else
                        <img src="/src/poster/400x600.png" />
                    @endif
                    
                    
                    <div class="input-group mt-1">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                        </div>
                        <div class="custom-file" >
                            <input onchange="form.submit()" type="file" class="form-control @error('file-1') is-invalid @enderror" name="file-1" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="inputGroupFile01"></label>
                        </div>
                    </div>

                    
                    </dd>

                    <dt class="col-sm-3">

                    </dt>
                    <dd class="col-sm-9"></dd>

                    <dt class="col-sm-3">Poster 2</dt>
                    <dd class="col-sm-9">

                        
                    @if (file_exists(public_path('/uploads/' .$data->id. '/images/file-2.png')))
                        <img style="width:640px;height:360px" src="/uploads/{{ $data->id }}/images/file-2-small.png" />
                        file-2-small.png
                    @else
                        <img src="/src/poster/640x360.png" />
                    @endif
                    
                        <div class="input-group mt-1">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                            </div>
                            <div class="custom-file">
                                <input onchange="form.submit()" type="file" class="form-control @error('file-2') is-invalid @enderror" name="file-2" class="custom-file-input" id="inputGroupFile02" aria-describedby="inputGroupFileAddon02">
                                <label class="custom-file-label" for="inputGroupFile02"></label>
                            </div>
                        </div>

                        
                    </dd>

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
