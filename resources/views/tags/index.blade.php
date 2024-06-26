@extends('layout.app')

@section('title', 'Tags')

@section('content')
<div class="container-fluid pt-5">
    <div class="row">
        <div class="col-3">
            <div class="list-group position-fixed  me-3" style="top: 5rem; left:1rem">
                @can('create', App\Models\Tag::class)
                    <a href="{{ route('tags.create') }}" class="list-group-item list-group-item-action bg-transparent">Add New Tag</a>
                @endcan 
            </div>
        </div>
        <div class="content">
<div class="container col-md-9 ml-auto">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-white bg-opacity-50">
                <div class="card-header">Tags</div>
                <div class="card-body">
                    <div class="row">
                        @foreach ($tags as $tag)
                        <div class="col-md-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $tag->name }}</h5>
                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('tags.show', $tag->id) }}" class="btn btn-light text-dark m-1">Show</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
