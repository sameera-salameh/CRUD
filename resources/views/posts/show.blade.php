@extends('layout.app')

@section('title', 'Show The Post')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card bg-white bg-opacity-50">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        @if($post->user->image && file_exists(public_path('images/' . $post->user->image)))
                        <img src="/images/{{$post->user->image}}" alt="" class="user-image img-fluid rounded-circle mr-3" style="width: 45px; height: 45px;">
                        @endif
                        <div>
                            <p class="text-muted mb-0">Posted by {{ $post->user->name }} on {{ $post->created_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p>Category: {{ $post->category->name }}</p>
                    <p class="card-text">{{ $post->description }}</p>
                    <p>
                        @foreach($post->tags as $tag)
                            <span>{{ $tag->name }}</span>
                        @endforeach
                    </p>
                    <img src="/images/{{$post->image}}" class="card-img-top img-fluid rounded mb-3 w-100" alt="" >
                    @if(Auth::id() === $post->user_id)
                    <a href="{{ route('posts.edit', $post->id) }}" class="btn" style="background-color: #f1e6cb; color: #ffffff;">Edit</a>
                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn" style="background-color: #b2bec3; color: #ffffff;">Delete</button>
                    </form>
                    @endif
                </div>
                <div class="card bg-white bg-opacity-50 mt-3">
                    <div class="card-body">
                        <h5>Comments:</h5>
                        @foreach($post->comments as $comment)
                            <div class="comment mb-2">
                                <div class="d-flex align-items-center mb-3">
                                    @if($comment->user->image)
                                    <img src="/images/{{$comment->user->image}}" alt="" class="user-image img-fluid rounded-circle mr-3" style="width: 45px; height: 45px;">
                                    @endif
                                    <div>
                                        <p class="text-muted mb-0">Commented by {{ $comment->user->name }} on {{ $comment->created_at->format('M d, Y') }}</p>
                                    </div>
                                </div>
                                <p>{{ $comment->content }}</p>
                                @if(Auth::id() === $comment->user_id)
                                <a href="{{ route('comments.edit', $comment->id) }}" class="btn" style="background-color: #f1e6cb; color: #ffffff;">Edit</a>
                            @endif
                                @if(Auth::id() === $post->user_id || Auth::id() === $comment->user_id)
                                    <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"class="btn" style="background-color: #b2bec3; color: #ffffff;">Delete</button>
                                    </form>
                                @endif
                            </div>
                            <hr> 
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
