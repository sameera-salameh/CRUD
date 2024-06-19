@extends('layout.app')
@section('title', 'Create Category')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-white bg-opacity-50">
                <div class="card-header">Create New Category</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('categories.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image" hidden>
                                <label class="btn btn-light text-dark m-1" for="image">Choose Image</label>
                            </div>
                        </div>
                        <button type="submit" class="btn" style="background-color: #F5E1D2; color: #ffffff;">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection