@extends('layouts.app')
@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">    
        
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">{{ __('Home') }}</a></li>
                    <li class="breadcrumb-item"><a href="/videos">{{ __('Videos') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Index') }}</li>
                </ol>
            </nav>

            @if ($message = Session::get('success'))
            <div class="alert alert-success" role="alert">
                 {{ $message }}
            </div>
            @endif

            <nav class="navbar navbar-expand-sm " style="background-color: #dee2e6">
                <form class="form-inline" action="{{ route('videos.search') }}" method="POST">
                @csrf
                    <input name="query" class="form-control mr-sm-2" type="text" placeholder="Search by Title">
                    <button class="btn btn-success" type="submit">Search</button>
                </form>
                <a href="{{ route('videos.create')}}" class="btn btn-primary ml-2">Create</a>
            </nav>

            <!-- start -->
            <div class="table-responsive">
                <table class="table table-bordered table-condensed table-striped">
                    <thead>

                        <th width="1%">ID</th>
                        <th width="62.5%">TITLE</th>
                  
                        <th width="1%"><i class="fas fa-video"></i></th>

                        <th width="40%">ACTION</th>
                    </thead>

                    <tbody>
                        @foreach($data as $row)
                        <tr >

                            <td>{{$row->id }}</td>
                            <td>{{$row->title }}</td>
                    
                            <td>
                                @if( $row->is_ready == 1 ) 
                                    <i class="fas fa-check"></i>
                                @else
                                    <i class="fas fa-spinner fa-pulse"></i>
                                @endif
                            </td>

                            <td>
                                
                                <form action="{{ route('videos.destroy', $row->id)}}" method="post">
                                    @csrf @method('DELETE')
                                    <a href="{{ route('videos.show', $row->id)}}" class="btn btn-primary ">Asset</a>
                                    <a href="{{ route('videos.poster', $row->id)}}" class="btn btn-primary">Poster</a>
                                    <a href="{{ route('videos.trailer', $row->id)}}" class="btn btn-primary">Trailer</a>
                                    <a href="{{ route('videos.edit', $row->id)}}" class="btn btn-success">Edit</a>
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
                
            </div>
          
            {{ $data->links() }}
    
            <!-- end -->
        </div>
    </div>

</div>

@endsection
