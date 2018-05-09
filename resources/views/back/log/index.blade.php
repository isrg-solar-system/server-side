
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
                    <form method="get" action="{{route('LogSearch')}}">
                        {{ csrf_field() }}
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Dataname and Date</label>
                                <input type="text" name="key" class="form-control border-input" placeholder="battery_voltage , 2017/1/1" value="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>　</label>
                                <button type="submit" class="btn btn-secondary form-control border-input ">Search</button>
                            </div>

                        </div>
                    </form>
                </div>

                {{--<h4 class="title"></h4>--}}
                {{--<p class="category">Here is a subtitle for this table</p>--}}
            </div>
            <div class="content table-responsive table-full-width">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Data Name</th>
                            <th>Status</th>
                            <th>Date time</th>
                        </tr>

                    </thead>
                    @foreach($log as $l)
                        <tr>
                            <td>{{$l->id}}</td>
                            <td>{{$l->dataname}}</td>
                            <td>@if($l->status) 狀況回復穩定 @else 狀況超出安全範圍 @endif</td>
                            <td>{{$l->created_at}}</td>
                        </tr>
                    @endforeach
                    <tbody>

                    </tbody>
                </table>

            </div>
            @if($page)
                <center>{{ $log->links() }}</center>
            @endif

        </div>
    </div>
@endsection

@section('include-javascript')
    {{--<script src='https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js'></script>--}}
    {{--<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js'></script>--}}
    {{--<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/locales/bootstrap-datepicker.zh-TW.min.js'></script>--}}
    {{--<script src='{{asset('js/front/log.js')}}'></script>--}}
@endsection