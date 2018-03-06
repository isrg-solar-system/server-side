
@extends('layouts.master')

@section('include-css')
    <link rel='stylesheet' href='{{asset('css/front/index.css')}}'>
@endsection


@section('content')
    <div class="col-md-12 row first-line">
        <div class="col-md-3">
            <div class="cube">
                <div class="head">
                    <i class="fa fa-spinner" aria-hidden="true"></i> Voltage
                </div>
                <div class="cubecontent first-line-cubecontent">
                    <div class="cubeblock first-line-cubecontent-block row col-md-12 pb-3 pt-2 mr-0 mp-0">
                        <div class="voltage-image col-md-3 ml-3 mr-0"></div>
                        <div class="first-line-block-content col-md-9 row pt-1">
                            <div class="blockvalue col-md-12 mt-2">9999 <span>V</span></div>
                            <!--               <div class="blocktitle col-md-12"></div> -->
                        </div>
                    </div>
                    <div class="clearFix"></div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="cube">
                <div class="head">
                    <i class="fa fa-spinner" aria-hidden="true"></i> Current
                </div>
                <div class="cubecontent first-line-cubecontent">
                    <div class="cubeblock first-line-cubecontent-block row col-md-12 pb-3 pt-2 mr-0 mp-0">
                        <div class="current-image col-md-3 ml-3 mr-0"></div>
                        <div class="first-line-block-content col-md-9 row pt-1">
                            <div class="blockvalue col-md-12 mt-2">9999 <span>A</span></div>
                            <!--               <div class="blocktitle col-md-12"></div> -->
                        </div>
                    </div>
                    <div class="clearFix"></div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="cube">
                <div class="head">
                    <i class="fa fa-spinner" aria-hidden="true"></i> Power
                </div>
                <div class="cubecontent first-line-cubecontent">
                    <div class="cubeblock first-line-cubecontent-block row col-md-12 pb-3 pt-2 mr-0 mp-0">
                        <div class="power-image col-md-3 ml-3 mr-0"></div>
                        <div class="first-line-block-content col-md-9 row pt-1">
                            <div class="blockvalue col-md-12 mt-2">9999 <span>W</span></div>
                            <!--               <div class="blocktitle col-md-12"></div> -->
                        </div>
                    </div>
                    <div class="clearFix"></div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="cube">
                <div class="head">
                    <i class="fa fa-spinner" aria-hidden="true"></i> Last Update
                </div>
                <div class="cubecontent first-line-cubecontent">
                    <div class="cubeblock first-line-cubecontent-block row col-md-12 pb-3 pt-2 mr-0 mp-0">
                        <div class="time-image col-md-3 ml-3 mr-0"></div>
                        <div class="first-line-block-content col-md-9 row pt-1">
                            <div class="blockvalue col-md-12 mt-2">12:30:54 </div>
                            <div class="blocktitle col-md-12"></div>
                        </div>
                    </div>
                    <div class="clearFix"></div>
                </div>
            </div>
        </div>
        <div class="clearFix"></div>
    </div>
    <div class="clearFix"></div>

    <div class="col-md-12 second-line mt-4 pl-4 text-white ">
        <div class="inner-box row p-4">
            <div class="second-line-block power-day col-md-3 pl-3 pr-0 m-0">
                <span class="second-line-value ml-4">89W</span><br>
                <span class="second-line-words ml-4">本日發電量</span>
            </div>
            <div class="second-line-block power-week col-md-3 pl-3 pr-0 m-0">
                <span class="second-line-value ml-4">689W</span><br>
                <span class="second-line-words ml-4">本週發電量</span>
            </div>
            <div class="second-line-block power-month col-md-3 pl-3 m-0">
                <span class="second-line-value ml-4">8787W</span><br>
                <span class="second-line-words ml-4">本月發電量</span>
            </div>
            <div class="second-line-block power-year col-md-3 pl-3 m-0">
                <span class="second-line-value ml-4">52148W</span><br>
                <span class="second-line-words ml-4">本年發電量</span>
            </div>
            <div class="third-line-block sun-power col-md-3 pl-3 m-0 mt-3">
                <div class="third-line-block-content row">
                    <div class="col-md-4 sun-power-icon mt-3"></div>
                    <div class="col-md-8 third-line-words mt-3">
                        118 <span>W/m</span> <br>
                        <span>日照</span>
                    </div>
                </div>
            </div>
            <div class="third-line-block temperature col-md-3 pl-3 m-0 mt-3">
                <div class="third-line-block-content row">
                    <div class="col-md-4 temperature-icon mt-3"></div>
                    <div class="col-md-8 third-line-words mt-3">
                        19.5 <span>W/m</span> <br>
                        <span>溫度</span>
                    </div>
                </div>
            </div>
            <div class="third-line-block wind-power col-md-3 pl-3 m-0 mt-3">
                <div class="third-line-block-content row">
                    <div class="col-md-4 wind-power-icon mt-3"></div>
                    <div class="col-md-8 third-line-words mt-3">
                        9.8 <span>(5級)</span> <br>
                        <span>最大陣風</span>
                    </div>
                </div>
            </div>
            <div class="third-line-block wind-speed col-md-3 pl-3 m-0 mt-3">
                <div class="third-line-block-content row">
                    <div class="col-md-4 wind-speed-icon mt-3"></div>
                    <div class="col-md-8 third-line-words mt-3">
                        1.7 <span>(2級)</span> <br>
                        <span>目前風速</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearFix"></div>
    </div>
    <div class="clearFix"></div>

    <div class="col-md-12 four-line row mt-3">
        <div class="col-md-6">
            <div class="cube">
                <div class="head">
                    <i class="fa fa-spinner" aria-hidden="true"></i> 當日發電量
                </div>
                <div class="cubecontent four-line-cubecontent">
                    <canvas id="todaypower"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="cube">
                <div class="head">
                    <i class="fa fa-spinner" aria-hidden="true"></i> 監視
                </div>
                <div class="cubecontent four-line-cubecontent">
                    <img src="https://ibw.bwnet.com.tw/image/pool/2014/09/e1b828510e6730560502df0fa98005a7.jpg" class="col-md-12">
                </div>
            </div>
        </div>
    </div>
@endsection

@section('include-javascript')
    <script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js'></script>

    <script src='{{asset('js/front/index.js')}}'></script>
@endsection