
@extends('layouts.backmaster')

@section('include-css')

@endsection


@section('content')
        <div class="col-lg-8 col-md-8 ">
            <div class="card">
                <div class="header row">
                    <h4 class="col-xs-9 title">Team Members</h4>
                    <div class="col-xs-3 text-right">
                        <btn class="btn btn-sm btn-warning btn-icon" onclick="location.href='{{route('MemberAdd')}}'"><i class="fa ti-plus"></i></btn>
                    </div>
                </div>
                <div class="content">
                    <ul class="list-unstyled team-members">
                        <li>
                            <div class="row">
                                <div class="col-xs-3">
                                    <div class="avatar">
                                        <img src="assets/img/faces/face-0.jpg" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    DJ Khaled
                                    <br>
                                    <span class="text-success"><small>Admin</small></span>
                                </div>
                                <div class="col-xs-3">
                                    img21326@gmail.com
                                </div>

                                <div class="col-xs-3 text-right">
                                    <btn class="btn btn-sm btn-success btn-icon"><i class="fa ti-pencil"></i></btn>
                                    <btn class="btn btn-sm btn-success btn-icon"><i class="fa ti-trash"></i></btn>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="row">
                                <div class="col-xs-3">
                                    <div class="avatar">
                                        <img src="assets/img/faces/face-1.jpg" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    Creative Tim
                                    <br>
                                    <span class="text-success"><small>Available</small></span>
                                </div>

                                <div class="col-xs-3 text-right">
                                    <btn class="btn btn-sm btn-success btn-icon"><i class="fa fa-envelope"></i></btn>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="row">
                                <div class="col-xs-3">
                                    <div class="avatar">
                                        <img src="assets/img/faces/face-3.jpg" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    Flume
                                    <br>
                                    <span class="text-danger"><small>Busy</small></span>
                                </div>

                                <div class="col-xs-3 text-right">
                                    <btn class="btn btn-sm btn-success btn-icon"><i class="fa fa-envelope"></i></btn>

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