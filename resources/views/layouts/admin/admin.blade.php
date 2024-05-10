<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <title>@yield('title')</title>    
    {{-- <script defer="defer" src="main.js"></script> --}}
    @yield('css-tambahan')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/style.css') }}">    
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
            background-color: #fff;
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
</head>

<body class="app">
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
    <div>
        <!-- #Left Sidebar ==================== -->
        <div class="sidebar">
            <div class="sidebar-inner">
                <!-- ### $Sidebar Header ### -->
                <div class="sidebar-logo">
                    <div class="peers ai-c fxw-nw">
                        <div class="peer peer-greed"><a class="sidebar-link td-n" href="index.html">
                                <div class="peers ai-c fxw-nw">
                                    <div class="peer align-items-center">
                                        <div class="logo"><img src="{{ asset('assets/images/logo.png') }}"
                                                alt="">
                                        </div>
                                    </div>
                                    <div class="peer peer-greed">
                                        <h4 class="lh-1 mB-0 logo-text"><b>Elinas</b></h4>
                                    </div>
                                </div>
                            </a></div>
                        <div class="peer">
                            <div class="mobile-toggle sidebar-toggle"><a href="" class="td-n"><i
                                        class="ti-arrow-circle-left"></i></a></div>
                        </div>
                    </div>
                </div><!-- ### $Sidebar Menu ### -->
                @include('layouts.admin.menu')
            </div>
        </div><!-- #Main ============================ -->
        <div class="page-container">
            <!-- ### $Topbar ### -->
            <div class="header navbar">
                <div class="header-container">
                    <ul class="nav-left">
                        <li><a id="sidebar-toggle" class="sidebar-toggle" href="javascript:void(0);"><i
                                    class="ti-menu"></i></a></li>                        
                    </ul>
                    <ul class="nav-right">                        
                        <li class="dropdown"><a href=""
                                class="dropdown-toggle no-after peers fxw-nw ai-c lh-1" id="dropdownMenuLink"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="peer mR-10"><div class="fa fa-user-circle fa-2x"></div></div>
                                <div class="peer"><span class="fsz-sm c-grey-900">{{ Auth::user()->name }}</span>
                                </div>
                            </a>
                            <ul class="dropdown-menu fsz-sm" aria-labelledby="dropdownMenuLink">
                                {{-- <li role="separator" class="divider"></li> --}}
                                <li><a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();"
                                        class="d-b td-n pY-5 bgcH-grey-100 c-grey-700">
                                        <i class="ti-power-off mR-10"></i> <span>{{ __('Logout') }}</span></a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div><!-- ### $App Screen Content ### -->
            <main class="main-content bgc-grey-100">
                <div id="mainContent">
                    @yield('content')                    
                </div>
            </main><!-- ### $App Screen Footer ### -->
            <footer class="bdT ta-c p-30 lh-0 fsz-sm c-grey-600"><span>Copyright © 2022 <b class="c-blue-900">Elinas</b>. All rights
                    reserved.</span></footer>
        </div>
    </div>
    <script src="{{ asset('assets/admin/js/main.js') }}"></script>
    @yield('js-tambahan')
</body>

</html>
