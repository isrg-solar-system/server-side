
@extends('layouts.backmaster')

@section('include-css')
    ul {
        list-style: none;
    }
    .fancy-checkbox input[type="checkbox"] {
        display: none;
    }

    .fancy-checkbox span:before {
        font-family: "FontAwesome";
        font-style: normal;
        width: 1em;
        height: 1em;
        content: '\f10c';
        margin-right: .3em;
    }

    .fancy-checkbox input[type="checkbox"]:checked ~ span:before {
        content: '\f05d';
    }

    .form-control[readonly]{
        background-color: #fffcf5;
        cursor: default;
        color: #000;
    }
@endsection


@section('content')
    <div id="app">
        <downloads></downloads>
    </div>

@endsection

@section('include-javascript')
    {{--<script src='https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js'></script>--}}
    {{--<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js'></script>--}}
    {{--<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/locales/bootstrap-datepicker.zh-TW.min.js'></script>--}}
    {{--<script src='{{asset('js/front/log.js')}}'></script>--}}
@endsection