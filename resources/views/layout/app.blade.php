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
                    <li class="nav-item">
                        <a class="btn text-dark m-1" href="#" style="background-color: #aee2f7">Log in</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-auto ps-5">
        @yield('content')
    </div>
</body>