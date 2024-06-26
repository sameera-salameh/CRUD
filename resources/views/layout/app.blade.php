<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column vh-100"
    style="background-image: url('{{ asset('images/background/3.jpg') }}'); background-size: cover; background-attachment: fixed; margin: 0;">
    <nav class="navbar navbar-expand-lg navbar-light bg-transparent fixed-top">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="btn text-dark m-1" style="background-color: #fdf1e7" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn text-dark m-1" style="background-color: #fdf1e7" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn text-dark m-1" style="background-color: #fdf1e7" href="#">Contact</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    @auth
                    <li class="nav-item">
                        @can('viewAny', App\Models\Category::class)
                        <a class="btn text-dark m-1" href="{{ route('categories.index') }}"  style="background-color: #aee2f7" >Categories</a>
                        @endcan
                        @can('viewAny', App\Models\Tag::class)
                            <a  class="btn text-dark m-1" href="{{ route('tags.index') }}" style="background-color: #aee2f7" >Tags</a>
                        @endcan
                        <a class="btn text-dark m-1" href="{{route('posts.index')}}" style="background-color: #aee2f7">Posts</a>
                        <a class="btn text-dark m-1" href="{{route('logout')}}" style="background-color: #aee2f7">Logout</a>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-auto ps-5 pt-5">
        @yield('content')
    </div>
</body>
