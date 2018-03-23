
@extends('layouts.backmaster')

@section('include-css')

@endsection


@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <div class="row ">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Level</label>
                            <select class="form-control form-control-lg  border-input">
                                <option>Level Select</option>
                            </select>
                        </div>

                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Date</label>
                            <input type="text" class="form-control border-input" placeholder="2017/1/1" value="">
                        </div>
                    </div>
                    <div class="col-md-1">
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
                            <th>Level</th>
                            <th>Description</th>
                            <th>Date time</th>
                            <th>User</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1</td>
                        <td>Dakota Rice</td>
                        <td>$36,738</td>
                        <td>Niger</td>
                        <td>Oud-Turnhout</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Minerva Hooper</td>
                        <td>$23,789</td>
                        <td>Curaçao</td>
                        <td>Sinaai-Waas</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Sage Rodriguez</td>
                        <td>$56,142</td>
                        <td>Netherlands</td>
                        <td>Baileux</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Philip Chaney</td>
                        <td>$38,735</td>
                        <td>Korea, South</td>
                        <td>Overland Park</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Doris Greene</td>
                        <td>$63,542</td>
                        <td>Malawi</td>
                        <td>Feldkirchen in Kärnten</td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Mason Porter</td>
                        <td>$78,615</td>
                        <td>Chile</td>
                        <td>Gloucester</td>
                    </tr>
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