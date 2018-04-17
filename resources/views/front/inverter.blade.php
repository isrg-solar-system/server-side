
@extends('layouts.master')

@section('include-css')
    <link rel='stylesheet' href='{{asset('css/front/inverter.css')}}'>
@endsection


@section('content')
<div class=" col-12">
    <div class="cube freq-cube">  <!-- FREQUENCY -->
        <div class="head">
            <i class="fa fa-bolt" aria-hidden="true"></i> Battery
            <div class="dropdown">
                <div class="dropdown">
                    <button class="dropbtn">&#8801;</button>
                    <div class="dropdown-content">
                        <a href="#">Expand</a>
                        <a href="#">Clear history</a>
                        <a href="#"><i class="fa fa-cog" aria-hidden="true"></i> Properties</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="cubecontent freq-cube cube-frequency">
            <div class="row">
                <div class="col-md-3">
                    <a href="#" class="cubeblock battery-block" >
                        <div class="blocktitle">Battery voltage</div>
                        <div class="blocktitle">527</div>
                        <frontguage :max="100" :min="0" :value="value" :angle="-0.1" :linewidth="0.23" :width="200" :height="100"></frontguage>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="#" class="cubeblock battery-block">
                        <div class="blocktitle">Battery Charging Current</div>
                        <div class="blocktitle">527</div>
                        <frontguage :max="100" :min="0" :value="value" :angle="-0.1" :linewidth="0.23" :width="200" :height="100"></frontguage>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="#" class="cubeblock battery-block">
                        <div class="blocktitle">Battery Discharge Current</div>
                        <div class="blocktitle">527</div>
                        <frontguage :max="100" :min="0" :value="value" :angle="-0.1" :linewidth="0.23" :width="200" :height="100"></frontguage>

                    </a>
                </div>
                <div class="col-md-3">
                    <a href="#" class="cubeblock battery-block">
                        <div class="blocktitle">Battery Capacity</div>
                        <div class="blocktitle">527</div>
                        <frontguage :max="100" :min="0" :value="value" :angle="-0.1" :linewidth="0.23" :width="200" :height="100"></frontguage>
                    </a>
                </div>
            </div>
        </div>   <!-- Freq-Cubecontent -->
    </div>    <!-- Battery-CUBE -->
</div>
<div class=" col-12" style="">
    <div class="row">
        <div class="col-md-8 col-12 " >
            <div class="row">
                <div class="col-6">
                    <div class="cube  freq-cube">  <!-- FANS -->
                        <div class="head">
                            <i class="fa fa-spinner" aria-hidden="true"></i> Fan
                            <div class="dropdown">
                                <button class="dropbtn">&#8801;</button>
                                <div class="dropdown-content">
                                    <a href="#">Expand</a>
                                    <a href="#">Properties</a>
                                </div>
                            </div>
                        </div>
                        <div class="cubecontent fan-cubecontent" style="    height: 192px;">

                            <a href="#" class="cubeblock fan-block">
                                <div class="cores-circle">
                                    <div class="cores-circle-inner">
                                        100%
                                    </div>
                                </div>
                                <div class="fan-blocktitle">Output Load</div>
                            </a>

                            <a href="#" class="cubeblock fan-block">
                                <div class="cores-circle">
                                    <div class="cores-circle-inner">
                                        10V
                                    </div>
                                </div>
                                <div class="fan-blocktitle">BUS voltage</div>

                            </a>

                            <a href="#" class="cubeblock fan-block">
                                <div class="cores-circle">
                                    <div class="cores-circle-inner">
                                        2
                                    </div>
                                </div>
                                <div class="fan-blocktitle">Device status</div>
                            </a>

                            <a href="#" class="cubeblock fan-block">
                                <div class="cores-fan-circle">
                                    <div class="cores-fan-circle-inner">
                                        OFF
                                    </div>
                                </div>
                                <div class="fan-blocktitle">Fan</div>
                            </a>
                        </div>  <!-- Fan-Cubecontent -->
                    </div>    <!-- Fan-CUBE -->
                </div>
                <div class="col-6">
                    <div class="cube  freq-cube">  <!-- USAGE -->
                        <div class="head">
                            <i class="fa fa-tachometer" aria-hidden="true"></i> Grid & Temperature
                            <div class="dropdown">
                                <button class="dropbtn">&#8801;</button>
                                <div class="dropdown-content">
                                    <a href="#">Expand</a>
                                    <a href="#">Properties</a>
                                </div>
                            </div>
                        </div>
                        <div class="cubecontent use-cubecontent">

                            <div class="use-overallleft">
                                <a href="#" class="cubeblock percent-block">

                                    <div class="tempGauge-demo">35&deg;C</div>

                                    <div class="blocktitle">Heat Sink Temperature</div>
                                </a>

                            </div>  <!-- use-overall -->

                            <div class="use-coresright">

                                <a href="#" class="cubeblock grid-block">
                                    <div class="cores-circle">
                                        <div class="cores-circle-inner">
                                            10V
                                        </div>
                                    </div>
                                    <div class="blocktitle">Grid Voltage</div>

                                </a>

                                <a href="#" class="cubeblock grid-block">
                                    <div class="cores-circle">
                                        <div class="cores-circle-inner">
                                            90&#37;
                                        </div>
                                    </div>
                                    <div class="blocktitle">Grid Frequency</div>

                                </a>

                            </div>  <!-- use-cores -->

                        </div>  <!-- USE-Cubecontent -->
                    </div>    <!-- USE-CUBE -->
                </div>
                <div class="col-12">
                    <div class="cube text-cube">  <!-- AC -->
                        <div class="head">
                            <i class="fa fa-thermometer-three-quarters" aria-hidden="true"></i> text</div>
                        <div class="cubecontent temp-cubecontent scrollbar scroll-temp" style="    height: 433px;">
                            <!--文字敘述-->
                        </div>  <!-- TEMP-Cubecontent -->
                    </div>    <!-- text-CUBE -->
                </div>
            </div>

        </div>
        <div class="col-md-4 col-12">
            <div class="cube AC-cube" STYLE="    height: 473px;
    width: 100%;">  <!-- AC -->
                <div class="head">
                    <i class="fa fa-thermometer-three-quarters" aria-hidden="true"></i> AC</div>
                <div class="cubecontent atemp-cubecontent ">
                    <div class="row">
                        <div class="col-md-6" style=" padding-left: 18px;">
                            <a href="#" class="cubeblock ACcubecontent-block-top">
                                <div class="blocktitle AC-blocktitle">AC output voltage</div>
                                <div class="AC-blocktitle">527</div>
                                <frontguage :max="100" :min="0" :value="value" :angle="0.25" :linewidth="0.10" :width="150" :height="100"></frontguage>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="#" class="cubeblock ACcubecontent-block-top">
                                <div class="blocktitle AC-blocktitle">AC output frequency</div>
                                <div class="AC-blocktitle">527</div>
                                <frontguage :max="100" :min="0" :value="value" :angle="0.25" :linewidth="0.10" :width="150" :height="100"></frontguage>

                            </a>
                        </div>
                        <div class="col-md-6" style=" padding-left: 18px;">
                            <a href="#" class="cubeblock ACcubecontent-block-top">
                                <div class="blocktitle AC-blocktitle">AC output apparent power</div>
                                <div class="AC-blocktitle">527</div>
                                <frontguage :max="100" :min="0" :value="value" :angle="0.25" :linewidth="0.10" :width="150" :height="100"></frontguage>

                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="#" class="cubeblock ACcubecontent-block-top">
                                <div class="blocktitle AC-blocktitle"> 　AC output active　　power</div>
                                <div class="AC-blocktitle">527</div>
                                <frontguage :max="100" :min="0" :value="value" :angle="0.25" :linewidth="0.10" :width="150" :height="100"></frontguage>

                            </a>
                        </div>
                    </div>
                </div>  <!-- TEMP-Cubecontent -->
            </div>    <!-- ac-CUBE -->
        </div>
    </div>



</div>




@endsection

@section('include-javascript')
@endsection

@section('js',asset('js/inverter.js'))
