@extends('layout.app')
@section('title', 'Edit Comment')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-white bg-opacity-50">
                <div class="card-header">Edit The Comment</div>
                <div class="card-body">
                    <form action="{{ route('comments.update', $comment->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="content">content</label>
                            <input type="text" class="form-control" id="content" name="content" value="{{ $comment->content }}" required>
                        </div>
                        <button type="submit" class="btn" style="background-color: #f1e6cb; color: #ffffff;">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
