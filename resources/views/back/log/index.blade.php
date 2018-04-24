
@extends('layouts.backmaster')

@section('include-css')

@endsection


@section('content')
    <div class="col-md-8">
        <div class="card">
            <div class="header">
                <div class="row ">
                    {{--<div class="col-md-3">--}}
                        {{--<div class="form-group">--}}
                            {{--<label>Level</label>--}}
                            {{--<select class="form-control form-control-lg  border-input">--}}
                                {{--<option>Level Select</option>--}}
                            {{--</select>--}}
                        {{--</div>--}}

                    {{--</div>--}}
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Date</label>
                            <input type="text" class="form-control border-input" placeholder="2017/1/1" value="">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>　</label>
                            <button type="submit" class="btn btn-secondary form-control border-input ">Search</button>
                        </div>

                    </div>
                </div>

                {{--<h4 class="title"></h4>--}}
                {{--<p class="category">Here is a subtitle for this table</p>--}}
            </div>
            <div class="content table-responsive table-full-width">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Description</th>
                            <th>Date time</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

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