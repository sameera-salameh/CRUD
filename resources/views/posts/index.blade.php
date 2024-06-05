@extends('layout.app')

@section('title', 'Posts')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @forelse ($posts as $post)
                <div class="card mb-4 shadow bg-white bg-opacity-50">
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{{ $post->description }}</p>
                        @if($post->image)
                            <div class="text-center my-3">
                                <img src="/images/{{$post->image}}" class="w-50 rounded" alt="">
                            </div>
                        @endif
                    </div>
                    <div class="card-footer bg-transparent">
                        <a href="{{ route('posts.show', $post->id) }}" class="btn" style="background-color: #a0d2eb; color: #ffffff;">Show</a>
                        <a href="{{ route('posts.edit', $post->id) }}" class="btn" style="background-color: #f1e6cb; color: #ffffff;">Edit</a>
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn" style="background-color: #b2bec3; color: #ffffff;">Delete</button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-center">No Info To Show</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
