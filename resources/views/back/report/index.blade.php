
@extends('layouts.backmaster')

@section('include-css')
    .form-control[readonly]{
        background-color: #fffcf5;
        cursor: default;
        color: #000;
    }
@endsection


@section('content')
    <div id="app">
            <showreport></showreport>
    </div>

@endsection

@section('js')
{{asset('js/report.js')}}
@endsection