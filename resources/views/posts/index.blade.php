@extends('layout.app')

@section('title', 'Posts')

@section('content')
<div class="container-fluid pt-5">
    <div class="row">
        <div class="col-3">
            <div class="list-group position-fixed  me-3" style="top: 5rem; left:1rem">
                <h3>Hi, {{Auth::user()->name}}!</h3>
                <a href="{{ route('posts.create') }}" class="list-group-item list-group-item-action bg-transparent">Create New Post</a>
            </div>
        </div>
        
<div class="content">
<div class="container col-md-9 ml-auto">
            @forelse ($posts as $post)
                <div class="card mb-4 shadow bg-white bg-opacity-50">
                    <div class="card-body">
                        <p>Posted by {{ $post->user->name }}</p>
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{{ $post->description }}</p>
                        @if($post->image)
                            <div class="text-center my-3">
                                <img src="/images/{{$post->image}}" class="w-50 rounded" alt="">
                            </div>
                        @endif
                    </div>
                    <div class="card-footer bg-transparent">
                        <a href="{{ route('comments.create', ['postId' => $post->id]) }}" class="btn" style="background-color: #f1e6cb; color: #ffffff;">Add Comment</a>
                        <a href="{{ route('posts.show', $post->id) }}" class="btn" style="background-color: #a0d2eb; color: #ffffff;">Show</a>
                    </div>
                </div>
            @empty
                <p class="text-center">No Info To Show</p>
            @endforelse
        </div>
    </div>
@endsection