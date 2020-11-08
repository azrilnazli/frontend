@extends('layouts.app')

@section('content')
<div class="container">
    
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-dark text-white">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Change Password</li>
        </ol>
    </nav>

    <div class="justify-content-center">
    
        <div class="col-md-12">
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
            <div class="card  bg-dark text-white">
                <div class="card-header ">Change Password</div>
                <div class="card-body col-md-8">
                @include('profiles.partials.change_password_form')
                </div>
            </div>
        </div>
    </div>       
</div>   
@endsection    
