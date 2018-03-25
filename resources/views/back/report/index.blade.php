
@extends('layouts.backmaster')

@section('include-css')

@endsection


@section('content')
    <div class="header">
        <div class="row ">
            <div class="col-md-12">
                <div class="col-md-2">
                    <div class="form-group">
                        <label>　</label>
                        <button type="submit" class="btn btn-secondary form-control border-input ">Add Widget</button>
                    </div>

                </div>

            </div>
        </div>

        {{--<h4 class="title"></h4>--}}
        {{--<p class="category">Here is a subtitle for this table</p>--}}
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="content ">
                <form>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="widgetname">Widget Name</label>
                                <input type="text" name="widgetname" class="form-control border-input" placeholder="First Chart 1 ...">
                            </div>
                        </div>
                        <div class="col-md-12 " style="margin-left: 10px;">
                            <label for="widgetname">Data Select</label>
                            <div class="clearfix"></div>
                            <div class=" form-group  col-md-3">
                                <div class="pretty p-default p-curve">
                                    <input type="checkbox" name="data" />
                                    <div class="state p-primary-o">
                                        <label>Primary</label>
                                    </div>
                                </div>
                            </div>
                            <div class=" form-group  col-md-3">
                                <div class="pretty p-default p-curve">
                                    <input type="checkbox" name="data" />
                                    <div class="state p-primary-o">
                                        <label>Primary</label>
                                    </div>
                                </div>
                            </div>
                            <div class=" form-group  col-md-3">
                                <div class="pretty p-default p-curve">
                                    <input type="checkbox" name="data" />
                                    <div class="state p-primary-o">
                                        <label>Primary</label>
                                    </div>
                                </div>
                            </div>
                            <div class=" form-group  col-md-3">
                                <div class="pretty p-default p-curve">
                                    <input type="checkbox" name="data" />
                                    <div class="state p-primary-o">
                                        <label>Primary</label>
                                    </div>
                                </div>
                            </div>
                            <div class=" form-group  col-md-3">
                                <div class="pretty p-default p-curve">
                                    <input type="checkbox" name="data" />
                                    <div class="state p-primary-o">
                                        <label>Primary</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 " style="margin-left: 10px;">
                            <label for="widgetname">Data Option</label>
                            <div class="clearfix"></div>
                            <div class="pretty p-default p-round">
                                <input type="radio" name="radio1">
                                <div class="state">
                                    <label>Real Time</label>
                                </div>
                            </div>

                            <div class="pretty p-default p-round">
                                <input type="radio" name="radio1">
                                <div class="state">
                                    <label>Day</label>
                                </div>
                            </div>

                            <div class="pretty p-default p-round">
                                <input type="radio" name="radio1">
                                <div class="state">
                                    <label>Month</label>
                                </div>
                            </div>

                            <div class="pretty p-default p-round">
                                <input type="radio" name="radio1">
                                <div class="state">
                                    <label>Year</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 " style="margin-left: 10px;">
                            <div class="form-group">
                                <label>From</label>
                                <input type="text" class="form-control border-input" placeholder="2017/1/1" value="">
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-8 " style="margin-left: 10px;">
                            <div class="form-group">
                                <label>To</label>
                                <input type="text" class="form-control border-input" placeholder="2017/1/1" value="">
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-8 " style="margin-left: 10px;">
                            <div class="form-group">
                                <label>　</label>
                                <button type="submit" class="btn btn-secondary form-control border-input ">Submit</button>
                            </div>
                        </div>
                    </div>

                </form>

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