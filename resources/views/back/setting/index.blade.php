
@extends('layouts.backmaster')

@section('include-css')

@endsection


@section('content')

        <div id="app">
            <div class="row">

                <div class="col-md-8">
                    {{--<div class="col-md-12">--}}
                        {{--<div class="card">--}}
                            {{--<div class="header">--}}
                                {{--<h4 class="title">Email Warning</h4>--}}
                                {{--<p class="category">Setting the detail for Email Warning</p>--}}
                            {{--</div>--}}
                            {{--<div class="content ">--}}
                                {{--<div class="row">--}}
                                    {{--<div class="col-md-12">--}}
                                    {{--<div class="form-group">--}}
                                    {{--<label for="exampleInputEmail1">Email Api Key</label>--}}
                                    {{--<input type="text" class="form-control border-input" placeholder="You can get from https://app.mailgun.com/" value="{{$setting->where('key','email_api')->first()->value}}">--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-md-12">--}}
                                        {{--<div class="form-group">--}}
                                            {{--<label for="exampleInputEmail1">Email Api Key (This Api Just Used for MailGun)</label>--}}
                                            {{--<input type="text" class="form-control border-input" placeholder="" value="{{$setting->where('key','line_api')->first()->value}}">--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-md-12">--}}
                                        {{--<div class="form-group">--}}
                                            {{--<label for="exampleInputEmail1">Email Address</label>--}}
                                            {{--<input type="text" class="form-control border-input" placeholder="" value="{{$setting->where('key','email_address')->first()->value}}">--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-md-12">--}}
                                        {{--<div class="form-group">--}}
                                            {{--<label for="exampleInputEmail1">Title</label>--}}
                                            {{--<input type="text" class="form-control border-input" placeholder="" value="{{$setting->where('key','email_title')->first()->value}}">--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-md-12">--}}
                                        {{--<div class="form-group">--}}
                                            {{--<label for="exampleInputEmail1">Content</label>--}}
                                            {{--<textarea class="form-control  border-input" rows="3" placeholder="You can use the key word 'value','status','dataname','datetime' in the Format &#10; by adding '@' &#10; example: the value is @value">  {!! $setting->where('key','email_format')->first()->value !!}  </textarea>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-md-12 text-right">--}}
                                        {{--<button type="button" class="btn btn-secondary">Send test message</button>--}}
                                        {{--<button type="button" class="btn btn-success">Save</button>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Line Warning</h4>
                                <p class="category">Setting the detail for Line Warning</p>
                            </div>
                            <div class="content ">
                                <div class="row">
                                    {{--<div class="col-md-12">--}}
                                        {{--<div class="form-group">--}}
                                            {{--<label for="exampleInputEmail1">Email Api Key</label>--}}
                                            {{--<input type="text" class="form-control border-input" placeholder="You can get from https://app.mailgun.com/" value="{{$setting->where('key','email_api')->first()->value}}">--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Line Api Key</label>
                                            <input type="text" class="form-control border-input" placeholder="" value="{{$setting->where('key','line_api')->first()->value}}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Format</label>
                                            <textarea class="form-control  border-input" rows="3" placeholder="You can use the key word 'value','status','dataname','datetime' in the Format &#10; by adding '@' &#10; example: the value is @value">  {!! $setting->where('key','line_format')->first()->value !!}  </textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-right">
                                        {{--<button type="button" class="btn btn-secondary">Send test message</button>--}}
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
                                            <input type="text" class="form-control border-input" placeholder="5" value="{{$setting->where('key','data_limit')->first()->value}}">
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