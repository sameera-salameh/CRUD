@extends('layout.app')
@section('title', 'Add Comment')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-white bg-opacity-50">
                <div class="card-header">Add a Comment</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('comments.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <label for="content">content</label>
                            <input type="text" class="form-control" id="content" name="content" required>
                        </div>
                        <button type="submit" class="btn" style="background-color: #F5E1D2; color: #ffffff;">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
