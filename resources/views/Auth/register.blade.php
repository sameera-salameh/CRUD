@extends('layout.app')
@section('title', 'Register')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card bg-white bg-opacity-50">
                <div class="card-header">Register</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        </div>
                        <div class="form-group">
                            <label for="image">Profile Image</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image" hidden>
                                <label class="btn btn-light text-dark m-1" for="image">Choose Image</label>
                            </div>
                        </div>
                        <button type="submit" class="btn" style="background-color: #F5E1D2; color: #ffffff;">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection