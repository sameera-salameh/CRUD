@extends('layout.app')
@section('title', 'Create Post')


@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-white bg-opacity-50">
                <div class="card-header">Create New Post</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image" hidden>
                                <label class="btn btn-light text-dark m-1" for="image">Choose Image</label>
                            </div>
                        </div>
                        <button type="submit" class="btn" style="background-color: #F5E1D2; color: #ffffff;">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
