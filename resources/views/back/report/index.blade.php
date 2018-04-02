
@extends('layouts.backmaster')

@section('include-css')

@endsection


@section('content')
    <div id="app">

            <showreport></showreport>



    </div>

@endsection

@section('js')
{{asset('js/report.js')}}
@endsection