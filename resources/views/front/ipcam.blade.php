
@extends('layouts.master')

@section('include-css')
    <link rel='stylesheet' href='{{asset('css/front/index.css')}}'>
@endsection


@section('contentout')
    <script src="https://cdn.bootcss.com/flv.js/1.4.0/flv.min.js"></script>
    <div class="col-12">
        <video id="videoElement" height="100%" width="100%"></video>

    </div>
    <script>
        if (flvjs.isSupported()) {
            var videoElement = document.getElementById('videoElement');
            var flvPlayer = flvjs.createPlayer({
                type: 'flv',
                url: 'http://60.249.6.104:8781/live/{{$token}}.flv',
            });
            flvPlayer.attachMediaElement(videoElement);
            flvPlayer.load();
            flvPlayer.play();
        }
    </script>

@endsection

@section('include-javascript')
    {{--<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js'></script>--}}

    {{--<script src='{{asset('js/front/index.js')}}'></script>--}}
@endsection