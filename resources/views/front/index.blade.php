
@extends('layouts.master')

@section('include-css')
    <link rel='stylesheet' href='{{asset('css/front/index.css')}}'>
@endsection


@section('content')
       <frontindexfirst></frontindexfirst>
       <ex></ex>
@endsection

@section('include-javascript')
    {{--<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js'></script>--}}

    {{--<script src='{{asset('js/front/index.js')}}'></script>--}}
@endsection