<!DOCTYPE html>
<html lang="en" >

<head>

    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no'>
    <title>@yield('title')  - Solar Monitoring System</title>

    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css'>
    <link rel='stylesheet' href='{{asset('css/front/master.css')}}'>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('include-css')
</head>

<body>

<div class="container">

    <div id="topbar" class="col-md-12">
        <div id="topheader" onclick="location.href='{{route('FrontIndex')}}'">
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
            {{--<p id="pvm">下午9:15:43 | 2018/2/13</p>--}}
        </div>
    </div>

    <div class="nav-box col-md-12">
        <nav class="navbar navbar-toggleable-md navbar-inverse">
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item @if($place=='index') active @endif">
                        <a class="nav-link" href="{{route('FrontIndex')}}">Home @if($place=='index')<span class="sr-only">(current)</span>@endif</a>
                    </li>
                    <li class="nav-item @if($place=='inverter') active @endif">
                        <a class="nav-link" href="{{route('FrontInverter')}}">Inverter @if($place=='inverter')<span class="sr-only">(current)</span>@endif</a>
                    </li>
                    <li class="nav-item @if($place=='chart') active @endif">
                        <a class="nav-link" href="{{route('FrontChart','pv_input_voltage')}}">Chart</a>
                    </li>
                    <li class="nav-item @if($place=='ipcam') active @endif" >
                        <a class="nav-link" href="{{route('FrontIpcam')}}">IPCam @if($place=='ipcam')<span class="sr-only">(current)</span>@endif</a>
                    </li>
                </ul>
                <span class="navbar-text">
                    @if(!isset($user->id))
                        <a href="{{route('login')}}">登入</a>
                    @else
                        <a href="{{route('BackIndex')}}">後台</a>
                        <a href="{{route('UserLogout')}}">登出</a>
                    @endif
                </span>
            </div>
        </nav>
    </div>

    <div id="app">
        @yield('content')
    </div>
    @yield('contentout')
</div>
{{--<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>--}}
{{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>--}}



@yield('include-javascript')
<script src="@yield('js',asset('js/front.js'))"></script>
</body>

</html>
