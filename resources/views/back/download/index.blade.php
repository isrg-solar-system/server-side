
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

    .form-control[readonly]{
        background-color: #fffcf5;
        cursor: default;
        color: #000;
    }
@endsection


@section('content')
    <div id="app">
        <div class="col-md-12">

            <div class="col-md-3">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Select Data</h4>
                        <p class="category">Select which data you want to Download</p>
                    </div>
                    <div class="content ">
                        <ul>
                            <li v-for="data in datas">
                                <label class="fancy-checkbox">
                                    <input type="checkbox" v-model="userinput.selectdata" :value=data.name />
                                    <span>@{{data.name}}</span>
                                </label>
                            </li>
                        </ul>

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
                            <datePicker :format="customFormatter"  v-model="datePicker.datefrom" :input-class="datePicker.inputclass" name="datefrom" :required="true" :disabled="datePicker.disabled"></datePicker>
                        </div>
                        <div class="form-group">
                            <label>To</label>
                            <datePicker :format="customFormatter" v-model="datePicker.dateto" :input-class="datePicker.inputclass" name="dateto" :required="true" :disabled="datePicker.disabled"></datePicker>
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
                                    <input type="radio" name="icon" v-model="userinput.filetype" value="html"/>
                                    <div class="state p-success-o">
                                        <i class="icon mdi mdi-check"></i>
                                        <label>HTML</label>
                                    </div>
                                </div>
                            </li>
                            <!--<li>-->
                            <!--<div class="pretty p-icon p-round" style=" margin-bottom: 5px;">-->
                            <!--<input type="radio" name="icon"  v-model="userinput.filetype" value="json" />-->
                            <!--<div class="state p-success-o">-->
                            <!--<i class="icon mdi mdi-check"></i>-->
                            <!--<label>JSON</label>-->
                            <!--</div>-->
                            <!--</div>-->
                            <!--</li>-->
                            <li>
                                <div class="pretty p-icon p-round" style=" margin-bottom: 5px;">
                                    <input type="radio" name="icon"  v-model="userinput.filetype" value="csv" />
                                    <div class="state p-success-o">
                                        <i class="icon mdi mdi-check"></i>
                                        <label>CSV</label>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="pretty p-icon p-round" style=" margin-bottom: 5px;">
                                    <input type="radio" name="icon"  v-model="userinput.filetype" value="xlsx" />
                                    <div class="state p-success-o">
                                        <i class="icon mdi mdi-check"></i>
                                        <label>XLSX</label>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="pretty p-icon p-round" style=" margin-bottom: 5px;">
                                    <input type="radio" name="icon"  v-model="userinput.filetype" value="xlsm"/>
                                    <div class="state p-success-o">
                                        <i class="icon mdi mdi-check"></i>
                                        <label>XLSM</label>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="pretty p-icon p-round" style=" margin-bottom: 5px;">
                                    <input type="radio" name="icon"  v-model="userinput.filetype" value="XLS"/>
                                    <div class="state p-success-o">
                                        <i class="icon mdi mdi-check"></i>
                                        <label>XLS</label>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="pretty p-icon p-round" style=" margin-bottom: 5px;">
                                    <input type="radio" name="icon"  v-model="userinput.filetype" value="txt"/>
                                    <div class="state p-success-o">
                                        <i class="icon mdi mdi-check"></i>
                                        <label>TXT</label>
                                    </div>
                                </div>
                            </li>
                        </ul>


                    </div>
                </div>
            </div>
            <div class="col-md-3" >
                <div class="card">
                    <div class="header">
                        <h4 class="title">Start Download</h4>
                        <p class="category">click buttom to download data</p>
                    </div>
                    <div class="content" style="height:189px;">
                        <div class="form-group" style="margin-top:32px">
                            <button @click="postData" class="btn btn-primary btn-lg btn-block">Download</button>
                            <div class="progress" style="margin-top: 25px;" v-if="downloadstatus.status">
                                <div class="progress-bar bg-success" role="progressbar" v-bind:style="{ width: downloadstatus.progress+ '%' }":aria-valuenow=downloadstatus.progress aria-valuemin="0" aria-valuemax="100"></div>
                                <span class="text-success"><small>@{{downloadstatus.desc}}</small></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@section('js',asset('js/download.js'))
@section('include-javascript')
    var userid = '{{$user}}';
@endsection