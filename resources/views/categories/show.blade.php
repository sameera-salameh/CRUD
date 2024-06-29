@extends('layout.app')
@section('title', 'Category Details')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-white bg-opacity-50">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Category Details</h3>
                </div>     
                <div class="card-body">
                    <div class="text-center">
                        <img src="/images/{{ $category->image }}" alt="{{ $category->name }}" class="img-fluid mb-3">
                        <h2>{{ $category->name }}</h2>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection