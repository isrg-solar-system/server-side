
@extends('layouts.backmaster')

@section('include-css')
    ul {
        list-style: none;
    }
    .fancy-checkbox input[type="checkbox"] {
        display: none;
    }

    .fancy-checkbox span:before {
        font-family: "FontAwesome";
        font-style: normal;
        width: 1em;
        height: 1em;
        content: '\f10c';
        margin-right: .3em;
    }

    .fancy-checkbox input[type="checkbox"]:checked ~ span:before {
        content: '\f05d';
    }
@endsection


@section('content')
    <div class="col-md-3">
        <div class="card">
            <div class="header">
                <h4 class="title">Select Data</h4>
                <p class="category">Select which data you want to Download</p>
            </div>
            <div class="content ">
                <ul><li>
                        <label class="fancy-checkbox">
                            <input type="checkbox" />
                            <span>Item One</span>
                        </label>
                    </li><li>
                        <label class="fancy-checkbox">
                            <input type="checkbox" />
                            <span>Item Two</span>
                        </label>
                    </li><li>
                        <label class="fancy-checkbox">
                            <input type="checkbox" />
                            <span>Item Three</span>
                        </label>
                    </li></ul>

            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="header">
                <h4 class="title">Select Date</h4>
                <p class="category">Select The Date</p>
            </div>
            <div class="content">
                <div class="form-group">
                    <label>From</label>
                    <input type="text" class="form-control border-input" placeholder="2017/1/1" value="">
                </div>
                <div class="form-group">
                    <label>To</label>
                    <input type="text" class="form-control border-input" placeholder="2017/9/1" value="">
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="header">
                <h4 class="title">Download As</h4>
                <p class="category">Select Data Type</p>
            </div>
            <div class="content">
                <ul>
                    <li>
                        <div class="pretty p-icon p-round" style=" margin-bottom: 5px;">
                            <input type="radio" name="icon" />
                            <div class="state p-success-o">
                                <i class="icon mdi mdi-check"></i>
                                <label> PDF</label>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="pretty p-icon p-round" style=" margin-bottom: 5px;">
                            <input type="radio" name="icon" />
                            <div class="state p-success-o">
                                <i class="icon mdi mdi-check"></i>
                                <label>JSON</label>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="pretty p-icon p-round" style=" margin-bottom: 5px;">
                            <input type="radio" name="icon" />
                            <div class="state p-success-o">
                                <i class="icon mdi mdi-check"></i>
                                <label>CSV</label>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="pretty p-icon p-round" style=" margin-bottom: 5px;">
                            <input type="radio" name="icon" />
                            <div class="state p-success-o">
                                <i class="icon mdi mdi-check"></i>
                                <label>XLSX</label>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="pretty p-icon p-round" style=" margin-bottom: 5px;">
                            <input type="radio" name="icon" />
                            <div class="state p-success-o">
                                <i class="icon mdi mdi-check"></i>
                                <label>ODS</label>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="pretty p-icon p-round" style=" margin-bottom: 5px;">
                            <input type="radio" name="icon" />
                            <div class="state p-success-o">
                                <i class="icon mdi mdi-check"></i>
                                <label>XML</label>
                            </div>
                        </div>
                    </li>
                </ul>


            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="header">
                <h4 class="title">Start Download</h4>
                <p class="category">click buttom to download data</p>
            </div>
            <div class="content">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Download</button>
                    {{--<input type="submit" class="form-control border-input" value="">--}}
                    <div class="progress" style="margin-top: 25px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        <span class="text-success"><small>Collecting data</small></span>
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