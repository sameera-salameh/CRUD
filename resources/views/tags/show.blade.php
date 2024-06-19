@extends('layout.app')
@section('title', 'Tag Details')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-white bg-opacity-50">
                <div class="card-header">Tag Details</div>
                <div class="card-body">
                    <div class="text-center">
                        <h2>{{ $tag->name }}</h2>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-light text-dark m-1">Edit</a>
                        <form action="{{ route('tags.destroy', $tag->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-light text-dark m-1">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
