@extends('layout.app')

@section('title', 'Show The Post')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card bg-white bg-opacity-50">
                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text">{{ $post->description }}</p>
                    <img src="/images/{{$post->image}}" class="card-img-top img-fluid rounded mb-3 w-100" alt="" >
                    
                    <a href="{{ route('posts.edit', $post->id) }}" class="btn" style="background-color: #a0d2eb; color: #ffffff;">Edit</a>
                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn" style="background-color: #b2bec3; color: #ffffff;">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
