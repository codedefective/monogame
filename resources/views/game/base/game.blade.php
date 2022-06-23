<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Anime Template">
    <meta name="keywords" content="Anime, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Anime | Template</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800;900&display=swap"
          rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{asset('web/css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('web/css/font-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('web/css/elegant-icons.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('web/css/plyr.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('web/css/nice-select.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('web/css/owl.carousel.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('web/css/slicknav.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('web/css/style.css')}}" type="text/css">
</head>

<body>
<!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>

<!-- Header Section Begin -->
<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-lg-2">
                <div class="header__logo">
                    <a href="{{route('home')}}">
                        <img src="{{asset('web/img/logo.svg')}}" alt="">
                    </a>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="header__nav">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li class="active"><a href="{{route('home')}}">Homepage</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="header__right">
                    <a  onclick="{{ auth()->check() ? 'return confirm("Are You Sure?")' : 'return true' }}" href="{{ auth()->check() ? route('logout') : route('login') }}">{{ auth()->check() ? auth()->user()->username ?? 'USERNAME_UNDEFINED' : '' }} <span class="icon_profile"></span></a>
                </div>
            </div>
        </div>
        <div id="mobile-menu-wrap"></div>
    </div>
</header>
<!-- Header End -->

@yield('content')


<!-- Footer Section Begin -->
<footer class="footer">
    <div class="page-up">
        <a href="#" id="scrollToTopButton"><span class="arrow_carrot-up"></span></a>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="footer__logo">
                    <a href="{{route('home')}}"><img src="{{asset('web/img/logo.svg')}}" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="footer__nav">
                    <ul>
                        <li class="active"><a href="{{route('home')}}">Homepage</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3">
                <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;<script>document.write(new Date().getFullYear());</script>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>

            </div>
        </div>
    </div>
</footer>
<!-- Footer Section End -->


<!-- Js Plugins -->
<script src="{{asset('web/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('web/js/bootstrap.min.js')}}"></script>
<script src="{{asset('web/js/player.js')}}"></script>
<script src="{{asset('web/js/jquery.nice-select.min.js')}}"></script>
<script src="{{asset('web/js/mixitup.min.js')}}"></script>
<script src="{{asset('web/js/jquery.slicknav.js')}}"></script>
<script src="{{asset('web/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('web/js/main.js')}}"></script>


</body>

</html>
