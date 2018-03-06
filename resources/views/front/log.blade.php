
@extends('layouts.master')

@section('include-css')

    <link rel='stylesheet' href='{{asset('css/front/log.css')}}'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css'>
@endsection


@section('content')

    <div class="col-md-12">
        <div class="cube cube-content ">
            <!-- FANS -->
            <div class="head">
                <i class="fa fa-spinner" aria-hidden="true"></i> Log
                <div class="dropdown">
                    <button class="dropbtn">≡</button>
                    <div class="dropdown-content">
                        <a href="#">Expand</a>
                        <a href="#">Properties</a>
                    </div>
                </div>
            </div>
            <div class="cubecontent log-cubecontent ">
                <div class="row align-items-center justify-content-center  mb-4">
                    <div class="col-lg-4 ">
                        <div class="input-group">
                            <div class="input-group-btn ">
                                <button type="button" class="btn btn-secondary dropdown-toggle bg-inverse text-white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Level
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Console</a>
                                    <a class="dropdown-item" href="#">Error</a>
                                </div>
                            </div>
                            <div class="input-group date ml-1">
                                <input id="datepicker" class="bg-inverse text-white border-0 " width="270" />
                            </div>
                        </div>
                    </div>

                </div>
                <table class="table table-inverse">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Level</th>
                        <th>Time</th>
                        <th>Message</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Console</td>
                        <td>107/1/1 23:59:59</td>
                        <td>get the new Data</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Error</td>
                        <td>107/1/1 23:54:59</td>
                        <td>Bettery has no power</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Error</td>
                        <td>107/1/1 23:54:59</td>
                        <td>Bettery has no power</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Error</td>
                        <td>107/1/1 23:54:59</td>
                        <td>Bettery has no power</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Error</td>
                        <td>107/1/1 23:54:59</td>
                        <td>Bettery has no power</td>
                    </tr>

                    </tbody>
                </table>

                <div class="clearFix"></div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center ">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>
    </div>
@endsection

@section('include-javascript')
    <script src='https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/locales/bootstrap-datepicker.zh-TW.min.js'></script>
    <script src='{{asset('js/front/log.js')}}'></script>
@endsection