<!DOCTYPE html>
<html lang="en" >

<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>

    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css'>
    <link rel='stylesheet' href='{{asset('css/front/master.css')}}'>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('include-css')
</head>

<body>

<div id="container">
    <div id="topbar" class="col-md-12">
        <div id="topheader">
            <div id="top-pic">
                <img src="https://www.dropbox.com/s/xg2xy54v8nqdqjm/CPUM-Logo.png?raw=1" alt="cpumeter-logo">
            </div>
            <div id="topheading">
                <h1>Solar<span>Panel</span></h1>
                <h2>Monitor System</h2>
            </div>
        </div>
        <div id="date">
            <!--<a href="#">Help</a>-->
            <p id="pvm">下午9:15:43 | 2018/2/13</p>
        </div>
    </div>

    <div class="nav-box col-md-12">
        <nav class="navbar navbar-toggleable-md navbar-inverse">
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">主面<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">逆便器</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">趨勢圖</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">報表下載</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">警告訊息</a>
                    </li>
                </ul>
                <span class="navbar-text">
            <a href="#">登入</a>
          </span>
            </div>
        </nav>
    </div>


        @yield('content')


</div>
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>


<script src="{{ asset('js/app.js') }}"></script>
@yield('include-javascript')

</body>

</html>
