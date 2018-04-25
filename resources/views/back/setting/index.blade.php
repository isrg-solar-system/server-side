
@extends('layouts.backmaster')

@section('include-css')

@endsection


@section('content')

        <div id="app">
            <div class="row">

                <div class="col-md-8">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Warning</h4>
                                <p class="category">Setting the detail of Warning</p>
                            </div>
                            <div class="content ">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email Api Key</label>
                                            <input type="text" class="form-control border-input" placeholder="You can get from https://app.mailgun.com/">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Line Api Key</label>
                                            <input type="text" class="form-control border-input" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Format</label>
                                            <textarea class="form-control  border-input" rows="5" placeholder="You can use the key word 'value','status','dataname','datetime' in the Format &#10; by adding '@' &#10; example: the value is @value"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-right">
                                        <button type="button" class="btn btn-secondary">Send test message</button>
                                        <button type="button" class="btn btn-success">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Data Limit</h4>
                                {{--<p class="category">Setting this system</p>--}}
                            </div>

                            <div class="content" style="height: 100%">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Store Data Limit(second)</label>
                                            <input type="text" class="form-control border-input" placeholder="5">
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-right">
                                        <button type="button" class="btn btn-success">Save</button>
                                    </div>
                                </div>

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