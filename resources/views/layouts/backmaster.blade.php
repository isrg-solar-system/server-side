
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('img/apple-icon.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('img/favicon.png')}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{$title}}</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="{{asset('css/back/bootstrap.min.css')}}" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="{{asset('css/back/animate.min.css')}}" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="{{asset('css/back/paper-dashboard.css')}}" rel="stylesheet"/>


    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href='https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css' rel='stylesheet' type='text/css'>
    <link href="{{asset('css/back/themify-icons.css')}}" rel="stylesheet">
    <style>
        .sidebar-wrapper {
            background: #505050;
            box-shadow: inset -1px 0px 0px 0px #25252A;
        }
        .sidebar .logo .simple-text, .sidebar[data-background-color="white"] .logo .simple-text, .off-canvas-sidebar .logo .simple-text, .off-canvas-sidebar[data-background-color="white"] .logo .simple-text{
            color: #fff;
        }
        @yield('include-css')
    </style>
</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-background-color="white" data-active-color="danger">

        <!--
            Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
            Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
        -->

        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="#" class="simple-text">
                    Solar System
                </a>
            </div>

            <ul class="nav">
                @foreach( $lists as $key => $list )
                    <li class="active">
                        <a href="{{ route($list['url'])}}">
                            <i class="{{$list['icon']}}"></i>
                            <p>{{$key}}</p>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">{{$title}}</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="{{route('FrontIndex')}}">
                                <p>首頁</p>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('UserLogout')}}">
                                <p>登出</p>
                            </a>
                        </li>
                    </ul>

                </div>

            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    @yield('content')
                </div>
            </div>
        </div>


        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>

                        {{--<li>--}}
                            {{--<a href="#">--}}
                                {{--Home--}}
                            {{--</a>--}}
                        {{--</li>--}}
                    </ul>
                </nav>
                <div class="copyright pull-right">
                    &copy; Powered By ISRG
                     <script>document.write(new Date().getFullYear())</script>, theme made by <a href="http://www.creative-tim.com">Creative Tim</a>
                </div>
            </div>
        </footer>

    </div>
</div>


</body>

<!--   Core JS Files   -->
<script src="{{ asset('js/back/jquery-1.10.2.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/back/bootstrap.min.js') }}" type="text/javascript"></script>

<!--  Checkbox, Radio & Switch Plugins -->
{{--<script src="{{ asset('js/back/bootstrap-checkbox-radio.js') }}"></script>--}}

<!--  Charts Plugin -->
<script src="{{ asset('js/back/chartist.min.js') }}"></script>

<!--  Notifications Plugin    -->
<script src="{{ asset('js/back/bootstrap-notify.js') }}"></script>

<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>

<!-- Paper Dashboard Core javascript and methods for Demo purpose -->
<script src="{{ asset('js/back/paper-dashboard.js') }}"></script>
<script>@yield('include-javascript')</script>
<script src="@yield('js',asset('js/back.js'))"></script>

</html>
