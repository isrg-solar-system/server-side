
@extends('layouts.backmaster')

@section('include-css')

@endsection


@section('content')
        <div class="col-lg-8 col-md-8 ">
            <div class="card">
                <div class="header row">
                    <h4 class="col-xs-9 title">Warning Setting List</h4>
                    <div class="col-xs-3 text-right">
                        <btn class="btn btn-sm btn-warning btn-icon" onclick="location.href='{{route('MemberAdd')}}'"><i class="fa ti-plus"></i></btn>
                    </div>
                </div>
                <div class="content">
                    <ul class="list-unstyled team-members">
                        <li>
                            <div class="row">
                                <div class="col-xs-2  text-center">
                                    <span class="text-danger"></span>
                                </div>
                                <div class="col-xs-2  text-center">
                                    <span class="text-success">Bettery Voltage</span>
                                </div>
                                <div class="col-xs-2  text-center">
                                    <span class="text-danger">></span>
                                </div>
                                <div class="col-xs-2  text-center">
                                    <span class="text-success">30</span>
                                </div>
                                <div class="col-xs-3 text-right">
                                    <btn class="btn btn-sm btn-success btn-icon"><i class="fa ti-pencil"></i></btn>
                                    <btn class="btn btn-sm btn-success btn-icon"><i class="fa ti-trash"></i></btn>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="row">
                                <div class="col-xs-2  text-center">
                                    <span class="text-danger"></span>
                                </div>
                                <div class="col-xs-2  text-center">
                                    <span class="text-success">Bettery Voltage</span>
                                </div>
                                <div class="col-xs-2  text-center">
                                    <span class="text-danger">></span>
                                </div>
                                <div class="col-xs-2  text-center">
                                    <span class="text-success">30</span>
                                </div>
                                <div class="col-xs-3 text-right">
                                    <btn class="btn btn-sm btn-success btn-icon"><i class="fa ti-pencil"></i></btn>
                                    <btn class="btn btn-sm btn-success btn-icon"><i class="fa ti-trash"></i></btn>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="row">
                                <div class="col-xs-2  text-center">
                                    <span class="text-danger"></span>
                                </div>
                                <div class="col-xs-2  text-center">
                                    <span class="text-success">Bettery Voltage</span>
                                </div>
                                <div class="col-xs-2  text-center">
                                    <span class="text-danger">></span>
                                </div>
                                <div class="col-xs-2  text-center">
                                    <span class="text-success">30</span>
                                </div>
                                <div class="col-xs-3 text-right">
                                    <btn class="btn btn-sm btn-success btn-icon"><i class="fa ti-pencil"></i></btn>
                                    <btn class="btn btn-sm btn-success btn-icon"><i class="fa ti-trash"></i></btn>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="row">
                                <div class="col-xs-2  text-center">
                                    <span class="text-danger"></span>
                                </div>
                                <div class="col-xs-2  text-center">
                                    <div class="form-group">
                                        <select class="form-control form-control-lg  border-input">
                                            <option>Battery Voltage</option>
                                            <option>Power</option>
                                            <option>Voltage</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-2  text-center">
                                    <div class="form-group">
                                        <select class="form-control form-control-lg  border-input">
                                            <option>></option>
                                            <option><</option>
                                            <option>=</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-2  text-center">
                                    <div class="form-group">
                                        <input type="email" class="form-control border-input" placeholder="Value">
                                    </div>
                                </div>
                                <div class="col-xs-3 text-right">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-sm btn-success btn-icon"><i class="fa ti-save-alt"></i></button>
                                        <button type="submit" class="btn btn-sm btn-success btn-icon"><i class="fa ti-back-left"></i></button>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
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