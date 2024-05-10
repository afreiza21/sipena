<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <title>@yield('title')</title>
    <link href="{{ asset('assets/admin/css/style.css') }}" rel="stylesheet">
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
    <script defer="defer" src="{{ asset('assets/admin/js/main.js') }}"></script>    
</head>

<body class="app">
    <div id="loader">
        <div class="spinner"></div>
    </div>
    <script>window.addEventListener("load", (function () { const t = document.getElementById("loader"); setTimeout((function () { t.classList.add("fadeOut") }), 300) }))</script>
    <div class="peers ai-s fxw-nw h-100vh">
        <div class="d-n@sm- peer peer-greed h-100 pos-r bgr-n bgpX-c bgpY-c bgsz-cv" style='background-image:url("{{ asset('assets/images/header-bg.png')}}")'>
            <div class="pos-a centerXY">
                <div class="bgc-white bdrs-50p pos-r" style="width:120px;height:120px"><img class="pos-a centerXY" src="{{ asset('assets/images/logo.png')}}" alt=""></div>
            </div>
        </div>
        <div class="col-12 col-md-4 peer pX-40 pY-80 h-100 bgc-white scrollable pos-r" style="min-width:320px">
            @yield('content')            
        </div>
    </div>
</body>

</html>