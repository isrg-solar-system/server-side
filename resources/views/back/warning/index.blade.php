
@extends('layouts.backmaster')

@section('include-css')

@endsection


@section('content')
    <div id="app">
        <div class="col-8 col-md-8 ">
            <set-warning></set-warning>
        </div>
        <div class="col-4 col-md-4">
            <list-warning></list-warning>
        </div>
    </div>





@endsection

@section('include-javascript')
    {{--<script src='https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js'></script>--}}
    {{--<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js'></script>--}}
    {{--<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/locales/bootstrap-datepicker.zh-TW.min.js'></script>--}}
    {{--<script src='{{asset('js/front/log.js')}}'></script>--}}
@endsection