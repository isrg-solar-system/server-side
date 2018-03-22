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



    <div id="app">
        @yield('content')
    </div>

</div>
{{--<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>--}}
{{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>--}}



@yield('include-javascript')
<script src="{{ asset('js/back.js') }}"></script>
</body>

</html>
