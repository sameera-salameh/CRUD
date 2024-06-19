@extends('layout.app')
@section('title', 'Edit Category')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-white bg-opacity-50">
                <div class="card-header">Edit The Category</div>
                <div class="card-body">
                    <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <div class="mb-3">
                                <img src="/images/{{ $category->image }}" class="img-fluid rounded w-25" alt="">
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image" hidden>
                                <label class="btn btn-light text-dark m-1" for="image">Choose Image</label>
                            </div>
                        </div>
                        <button type="submit" class="btn" style="background-color: #f1e6cb; color: #ffffff;">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection