@extends('layout.app')
@section('title', 'Edit Tag')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-white bg-opacity-50">
                <div class="card-header">Edit The Tag</div>
                <div class="card-body">
                    <form action="{{ route('tags.update', $tag->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $tag->name }}" required>
                        </div>
                        <button type="submit" class="btn" style="background-color: #f1e6cb; color: #ffffff;">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
