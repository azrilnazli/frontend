@extends('layouts.app')

@section('content')
<div class="container">
    
    <nav class="navbar " aria-label="breadcrumb">
        <ol class="breadcrumb  bg-dark text-white">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('profile.index') }}">My Profile</a></li>
            <li class="breadcrumb-item active" aria-current="page">Update</li>
        </ol>
    </nav>

    <div class="justify-content-center">
        <div class="col-md-12">
            <div class="card  bg-dark text-white">
                <div class="card-header">My Profile</div>
                <div class="card-body">
                @include('profiles.partials.edit_form')
                </div>
            </div>
        </div>
    </div>       
</div>   
@endsection    
