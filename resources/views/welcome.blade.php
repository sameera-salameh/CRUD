@extends('layout.app')

@section('title', 'Home')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <h1 class="display-4"><strong>POST</strong></h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa molestias expedita enim placeat laborum eos tempore iste, eligendi ullam atque, dicta non magni accusantium iure rem soluta unde labore ratione.</p>  
            <a href="{{route('login')}}" class="btn btn-light text-dark m-1" style="background-color: #F5E1D2">Login</a>
            <a href="{{route('register')}}" class="btn btn-light text-dark m-1" style="background-color: #F5E1D2">Register</a>
        </div>
    </div>
@endsection