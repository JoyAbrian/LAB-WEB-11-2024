<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body{
            min-width: 400px;
            background-image: url('{{ URL('images/bg2.png') }}');
            background-size: cover; 
            background-repeat: no-repeat; 
        }

        html {
            scroll-behavior: smooth;
        }

        .content {
            flex: 1;
        }

        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: rgba(235, 196, 196, 0.642);
            padding: 5px 0;
        }

        .home {
            margin-top: 130px;
            color: rgba(255, 255, 255, 0.326);
        }

        .kiri, .kanan {
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .img {
            width: 350px;
            box-shadow: 0 20px 30px rgba(235, 196, 196, 0.642);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .collapse href {
            text-decoration: none;
        }

        .title {
            color: rgba(176, 224, 230, 0.582);
            text-shadow: 0 0 40px rgba(239, 240, 227, 0.459);
        }

        .highlight {
            color: rgba(184, 135, 11, 0.74);
        }

        .description {
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.443);
        }

        .choose-button {
            width: 200px;
            background-color: rgba(184, 135, 11, 0.74);
            border-radius: 20px;
            border: none;
            box-shadow: 0 2px 20px rgba(235, 196, 196, 0.642);
            color: rgba(255, 255, 255, 0.708);
            padding: 3px;
        }

        .choose-button a {
            color: black;
            text-decoration: none;
        }

        .about, .contact {
            margin-top: 100px;
        }

        .title {
            color: rgba(176, 224, 230, 0.582);
        }

        .about-content {
            display: flex;
            justify-content: center;
            color: rgba(255, 255, 255, 0.443);
            text-align: justify;
        }

        .about-column {
            width: 500px; /* Menetapkan lebar kolom */
        }

        .btn{
            background-color: rgba(184, 135, 11, 0.74);
        }

        .card-body{
            text-align: center;
        }
        .social-icons a{
            color: black;
        }
        .social-icons a:hover{
            color: brown;
        }

        .list-unstyled li {
            display: flex;
            gap: 5px;
        }

        .link a{
            text-decoration: none;
            color: black;
        }

        @media (max-width: 990px) {
            .home .row {
                flex-direction: column-reverse;
                display: flex;
                align-items: center;
            }
            .about-content {
                column-count: 1;
            }
            .kotak-card {
                flex-direction: column; /* Menyusun kartu menjadi satu kolom */
                align-items: center;
            }
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top bg-dark" data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">@yield('title', 'Simple Website')</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <x-button href="{{ route('home') }}" text="Home" />
                        </li>
                        <li class="nav-item">
                            <x-button href="{{ route('about') }}" text="About" />
                        </li>
                        <li class="nav-item">
                            <x-button href="{{ route('contact') }}" text="Contact" />
                        </li>
                    </ul>
    
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn text-white" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>
    </header>
    
    <div class="main">
        @yield('content')
    </div>

    <footer>
        <div class="container text-center">
            <p class="mb-0">&copy; 2024 Eky</p>
        </div>
    </footer>
</body>
</html>
