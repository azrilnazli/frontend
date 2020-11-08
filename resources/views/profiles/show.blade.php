@extends('layouts.app')

@section('content')
<div class="container">
    
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb  bg-dark text-white">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">My Profile</li>
        </ol>
    </nav>

    <div class="justify-content-center">
        <div class="col-md-12">
            <div class="card bg-dark text-white">
                <div class="card-header"><h2>{{ auth()->user()->name }}</h2></div>
                <div class="card-body">
                @include('profiles.partials.show_table')
                </div>
                <div class="card-footer">
                    <a class="btn btn-primary mt-2" href="{{ route('profile.edit',  auth()->user()->id  ) }}">Update</a>
                </div>
            </div>
        </div>
    </div>       
</div>   

@endsection    
