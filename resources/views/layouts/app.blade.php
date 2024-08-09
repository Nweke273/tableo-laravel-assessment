<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="DexignZone">
    <meta name="robots" content="">
    <meta name="keywords" content="admin dashboard, admin template, administration, analytics, bootstrap, cafe admin, elegant, food, health, kitchen, modern, responsive admin dashboard, restaurant dashboard">
    <meta name="description" content="Discover Davur - the ultimate admin dashboard and Bootstrap 5 template. Specially designed for professionals, and for business. Davur provides advanced features and an easy-to-use interface for creating a top-quality website with frontend">
    <meta property="og:title" content="Davur : Restaurant Admin Dashboard + FrontEnd">
    <meta property="og:description" content="Discover Davur - the ultimate admin dashboard and Bootstrap 5 template. Specially designed for professionals, and for business. Davur provides advanced features and an easy-to-use interface for creating a top-quality website with frontend">
    <meta property="og:image" content="social-image.png">
    <meta name="format-detection" content="telephone=no">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tableo</title>

    <link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body>

    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <div class="header">
        <div class="header-content">
            <nav class="navbar navbar-expand">
                <div class="collapse navbar-collapse justify-content-between">
                    <ul class="navbar-nav header-right">
                        <li class="nav-item dropdown header-profile">
                            <a class="nav-link" href="javascript::void[0]" role="button" data-bs-toggle="dropdown">
                                <div class="header-info">
                                    <span>Hello, <strong>From Tableo</strong></span>
                                </div>
                                <img src="images/profile/pic1.jpg" width="20" alt="">
                            </a>
                        </li>
                        @if(Auth::check())
                        <li style="position: absolute; right:4px">
                            <form action="{{ route('logout') }}" method="POST" class="mt-3">
                                @csrf
                                @method('POST')
                                <button type="submit" class="btn btn-danger">Log out</button>
                            </form>
                        </li>
                        @elseif (url()->current() != url('/'))
                        <li style="position: absolute; right:4px">
                            <a href="/" class="btn btn-primary mt-2">Home</a>
                        </li>
                        @endif
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    @yield('content')

    <script src="vendor/global/global.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/app.js"></script>
</body>

</html>