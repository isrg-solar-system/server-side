
@extends('layouts.backmaster')

@section('include-css')

@endsection


@section('content')

        1.提醒格式
        2.提醒方式(@,line)
        5.LOG處存筆數
        6.網站名稱
        8.line api key
        <div id="app">
            <div class="row">

                <div class="col-md-12">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Web Title</h4>
                                <p class="category">Congi this Application title</p>
                            </div>
                            <div class="content ">


                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Web Title</h4>
                                <p class="category">Congi this Application title</p>
                            </div>
                            <div class="content ">


                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
@endsection

@section('include-javascript')
    {{--<script src='https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js'></script>--}}
    {{--<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js'></script>--}}
    {{--<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/locales/bootstrap-datepicker.zh-TW.min.js'></script>--}}
    {{--<script src='{{asset('js/front/log.js')}}'></script>--}}
@endsection