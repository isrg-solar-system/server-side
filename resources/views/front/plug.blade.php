
@extends('layouts.master')

@section('include-css')
    <link rel='stylesheet' href='{{asset('css/front/plug.css')}}'>
@endsection


@section('content')
    <div class="col-md-4">
        <!-- FANS -->
        <div class="cube">
            <div class="head">
                <i class="fa fa-spinner" aria-hidden="true"></i> Plug List
                <div class="dropdown">
                    <button class="dropbtn">≡</button>
                    <div class="dropdown-content">
                        <a href="#">Expand</a>
                        <a href="#">Properties</a>
                    </div>
                </div>
            </div>
            <div class="cubecontent plug-cubecontent">
                <div class="cubeblock plug-list-cubecontent-block row col-md-12">
                    <div class="plug-image col-md-3"></div>
                    <div class="plug-block-content col-md-9 row">
                        <div class="blocktitle col-md-12">Home First Plug</div>
                        <div class="blockvalue col-md-12">2200 <span>W</span></div>
                    </div>
                </div>
                <div class="cubeblock plug-list-cubecontent-block row col-md-12">
                    <div class="plug-image col-md-3"></div>
                    <div class="plug-block-content col-md-9 row">
                        <div class="blocktitle col-md-12">Home First Plug</div>
                        <div class="blockvalue col-md-12">2200 <span>W</span></div>
                    </div>
                </div>

                <div class="clearFix"></div>
            </div>
        </div>
    </div>
    <div class="col-md-8 row">
        <div class="col-md-12">
            <div class="cube cube-content">
                <!-- FANS -->
                <div class="head">
                    <i class="fa fa-spinner" aria-hidden="true"></i> Chart
                    <div class="dropdown">
                        <button class="dropbtn">≡</button>
                        <div class="dropdown-content">
                            <a href="#">Expand</a>
                            <a href="#">Properties</a>
                        </div>
                    </div>
                </div>
                <div class="cubecontent plug-cubecontent">
                    <div class="cubeblock plug-chart-cubecontent-block row col-md-12">
                        <div id="main" style="width: 600px;height:400px;"></div>
                    </div>
                    <div class="clearFix"></div>
                </div>
            </div>
        </div>
        <div class="col-md-12" style="margin-top:12px;">
            <div class="cube cube-content">
                <!-- FANS -->
                <div class="head">
                    <i class="fa fa-spinner" aria-hidden="true"></i> Detail
                    <div class="dropdown">
                        <button class="dropbtn">≡</button>
                        <div class="dropdown-content">
                            <a href="#">Expand</a>
                            <a href="#">Properties</a>
                        </div>
                    </div>
                </div>
                <div class="cubecontent plug-cubecontent">
                    <div class="cubeblock plug-chart-cubecontent-block row col-md-12">
                        Plug name:xxxx<br>
                        Online time: five hour<br>
                        Pug using Power : 50W
                    </div>
                    <div class="clearFix"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('include-javascript')
    <script src='https://cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts.min.js'></script>
    <script src='{{asset('js/front/plug.js')}}'></script>
@endsection