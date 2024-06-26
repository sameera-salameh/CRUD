@extends('layout.app')
@section('title', 'Categories')
<div class="container-fluid pt-5">
    <div class="row">
        <div class="col-3">
            <div class="list-group position-fixed  me-3" style="top: 5rem; left:1rem">
                @can('create', App\Models\Category::class)
                    <a href="{{ route('categories.create') }}" class="list-group-item list-group-item-action bg-transparent">Add New Category</a>
                @endcan
            </div>
        </div>

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-white bg-opacity-50">
                <div class="card-header">Categories</div>
                <div class="card-body">
                    <div class="row">
                        @foreach ($categories as $category)
                        <div class="col-md-6 mb-4">
                            <div class="card">
                                <img src="/images/{{ $category->image }}" class="card-img-top" alt="{{ $category->name }}" style="max-height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $category->name }}</h5>
                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('categories.show', $category->id) }}" class="btn btn-light text-dark m-1">Show</a>
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