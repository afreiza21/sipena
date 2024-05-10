<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shorcut icon" type="text/css" href="{{ asset('assets/images/favicon.png') }}">
    <title>@yield('title')</title>
    <style>
        #loader {
            transition: all .3s ease-in-out;
            opacity: 1;
            visibility: visible;
            position: fixed;
            height: 100vh;
            width: 100%;
            background: #fff;
            z-index: 90000
        }

        #loader.fadeOut {
            opacity: 0;
            visibility: hidden
        }

        .spinner {
            width: 40px;
            height: 60px;
            position: absolute;
            top: calc(50% - 20px);
            left: calc(50% - 20px);
            background-image: url("{{ asset('assets/images/favicon.png') }}");
            background-repeat: no-repeat;
            background-size: auto;
            border-radius: 100%;
            -webkit-animation: sk-scaleout 1s infinite ease-in-out;
            animation: sk-scaleout 1s infinite ease-in-out
        }

        @-webkit-keyframes sk-scaleout {
            0% {
                -webkit-transform: scale(0)
            }

            100% {
                -webkit-transform: scale(1);
                opacity: 0
            }
        }

        @keyframes sk-scaleout {
            0% {
                -webkit-transform: scale(0);
                transform: scale(0)
            }

            100% {
                -webkit-transform: scale(1);
                transform: scale(1);
                opacity: 0
            }
        }
    </style>
    <link rel="stylesheet" href="{{ asset('assets/plugin/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugin/fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugin/fontawesome/css/brands.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugin/fontawesome/css/solid.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>
    <div id="loader">
        <div class="spinner"></div>
    </div>
    <script>
        window.addEventListener("load", (function() {
            const t = document.getElementById("loader");
            setTimeout((function() {
                t.classList.add("fadeOut")
            }), 300)
        }))
    </script>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('index') }}">
                <img src="{{ asset('assets/images/elinas.png') }}" alt="" height="50">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteName() == 'index' ? 'active' : '' }}"
                            {{ Route::currentRouteName() == 'index' ? 'aria-current="page"' : '' }}
                            href="{{ route('index') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteName() == 'video' ? 'active' : '' }}"
                            {{ Route::currentRouteName() == 'video' ? 'aria-current="page"' : '' }}
                            href="{{ route('video') }}">Edukasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteName() == 'article' ? 'active' : '' }}"
                            {{ Route::currentRouteName() == 'article' ? 'aria-current="page"' : '' }}
                            href="{{ route('article') }}">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteName() == 'product' ? 'active' : '' }}"
                            {{ Route::currentRouteName() == 'product' ? 'aria-current="page"' : '' }}
                            href="{{ route('product') }}">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteName() == 'about' ? 'active' : '' }}"
                            {{ Route::currentRouteName() == 'about' ? 'aria-current="page"' : '' }}
                            href="{{ route('about') }}">Tentang</a>
                    </li>
                    <li class="nav-item dropdown">
                        @guest
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-user"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end me-auto" aria-labelledby="navbarDropdown">
                                @if (Route::has('login'))
                                    <li><a class="dropdown-item" href="{{ route('login') }}">Masuk</a></li>
                                @endif

                                @if (Route::has('register'))
                                    <li><a class="dropdown-item" href="{{ route('register') }}">Daftar</a></li>
                                @endif
                            </ul>
                        @else
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-user"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end me-auto" aria-labelledby="navbarDropdown">
                                @notCustomer
                                    <li><a class="dropdown-item" href="{{ route('admin') }}">Dashboard</a></li>                                    
                                @endnotCustomer
                                <li><a class="dropdown-item" href="{{ route('cart') }}">Keranjang <span class="badge text-bg-dark">{{ $cart }}</span></a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        @endguest
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @if ($message = Session::get('success'))
        <div class="container mt-3">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif
    @if ($message = Session::get('error'))
        <div class="container mt-3">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif
    @yield('content')

    <footer class="p-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="assets/images/elinas.png" alt="" height="50">
                    <p>Edukasi pengolahan limbah kulit nanas menjadi barang yang memiliki nilai jual.</p>
                </div>
                <div class="col-md-2 px-3 footer-links">
                    <h4>Produk</h4>
                    <ul>
                        <li><i class="fa-solid fa-chevron-right"></i> <a href="#">Produk Olahan</a></li>
                        <li><i class="fa-solid fa-chevron-right"></i> <a href="#">Produk Limbah</a></li>
                    </ul>
                </div>
                <div class="col-md-2 px-3 footer-links">
                    <h4>Navigasi</h4>
                    <ul>
                        <li><i class="fa-solid fa-chevron-right"></i> <a href="{{ route('video') }}">Edukasi</a></li>
                        <li><i class="fa-solid fa-chevron-right"></i> <a href="{{ route('article') }}">Blog</a></li>
                        <li><i class="fa-solid fa-chevron-right"></i> <a href="{{ route('product') }}">Produk</a>
                        </li>
                        <li><i class="fa-solid fa-chevron-right"></i> <a href="{{ route('about') }}">Tentang</a></li>
                    </ul>
                </div>
                <div class="col-md-2 px-3 footer-links">
                    <h4>Follow</h4>
                    <ul>
                        <li><i class="fa-brands fa-facebook-f"></i> <a href="#">Facebook</a></li>
                        <li><i class="fa-brands fa-twitter"></i> <a href="#">Twitter</a></li>
                        <li><i class="fa-brands fa-instagram"></i> <a href="#">Instagram</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <script src="{{ asset('assets/plugin/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
