
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
                <div class="col-md-3" onclick="location.href = '{{route('FrontChart','battery_voltage')}}'">
                    <a href="#" class="cubeblock battery-block" >
                        <div class="blocktitle">Battery voltage</div>
                        <div class="blocktitle">@{{realtime.battery_voltage}}</div>
                        <frontguage :max="100" :min="0" :value="realtime.battery_voltage" :angle="-0.1" :linewidth="0.23" :width="200" :height="100"></frontguage>
                    </a>
                </div>
                <div class="col-md-3" onclick="location.href = '{{route('FrontChart','battery_charging_current')}}'">
                    <a href="#" class="cubeblock battery-block">
                        <div class="blocktitle">Battery Charging Current</div>
                        <div class="blocktitle">@{{realtime.battery_charging_current}}</div>
                        <frontguage :max="100" :min="0" :value="realtime.battery_charging_current" :angle="-0.1" :linewidth="0.23" :width="200" :height="100"></frontguage>
                    </a>
                </div>
                <div class="col-md-3" onclick="location.href = '{{route('FrontChart','battery_discharge_current')}}'">
                    <a href="#" class="cubeblock battery-block">
                        <div class="blocktitle">Battery Discharge Current</div>
                        <div class="blocktitle">@{{realtime.battery_discharge_current}}</div>
                        <frontguage :max="100" :min="0" :value="realtime.battery_discharge_current" :angle="-0.1" :linewidth="0.23" :width="200" :height="100"></frontguage>

                    </a>
                </div>
                <div class="col-md-3" onclick="location.href = '{{route('FrontChart','battery_capacity')}}'">
                    <a href="#" class="cubeblock battery-block">
                        <div class="blocktitle">Battery Capacity</div>
                        <div class="blocktitle">@{{realtime.battery_capacity}}</div>
                        <frontguage :max="100" :min="0" :value="realtime.battery_capacity" :angle="-0.1" :linewidth="0.23" :width="200" :height="100"></frontguage>
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
                                        @{{realtime.output_load_percent}} %
                                    </div>
                                </div>
                                <div class="fan-blocktitle">Output Load</div>
                            </a>

                            <a href="#" class="cubeblock fan-block">
                                <div class="cores-circle">
                                    <div class="cores-circle-inner">
                                        @{{realtime.bus_voltage}}
                                    </div>
                                </div>
                                <div class="fan-blocktitle">BUS voltage</div>

                            </a>

                            <a href="#" class="cubeblock fan-block">
                                <div class="cores-circle">
                                    <div class="cores-circle-inner">
                                        @{{realtime.device_status}}
                                    </div>
                                </div>
                                <div class="fan-blocktitle">Device status</div>
                            </a>

                            <a href="#" class="cubeblock fan-block">
                                <div class="cores-fan-circle">
                                    <div class="cores-fan-circle-inner">
                                        @{{realtime.battery_voltage_offset_for_fans_on}}
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

                            <div class="use-overallleft" onclick="location.href = '{{route('FrontChart','inverter_heat_sink_temperature')}}'">
                                <a href="#" class="cubeblock percent-block">

                                    <div class="tempGauge-demo">@{{realtime.inverter_heat_sink_temperature}}</div>

                                    <div class="blocktitle">Heat Sink Temperature</div>
                                </a>

                            </div>  <!-- use-overall -->

                            <div class="use-coresright" onclick="location.href = '{{route('FrontChart','grid_voltage')}}'">

                                <a href="#" class="cubeblock grid-block">
                                    <div class="cores-circle">
                                        <div class="cores-circle-inner">
                                            @{{realtime.grid_voltage}}
                                        </div>
                                    </div>
                                    <div class="blocktitle">Grid Voltage</div>

                                </a>

                                <a href="#" class="cubeblock grid-block" onclick="location.href = '{{route('FrontChart','grid_frequency')}}'">
                                    <div class="cores-circle">
                                        <div class="cores-circle-inner">
                                            @{{realtime.grid_frequency}}
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
                            <i class="fa fa-thermometer-three-quarters" aria-hidden="true"></i> Log</div>
                        <div class="cubecontent temp-cubecontent scrollbar scroll-temp" style=" height: 433px; padding-left:18px;">
                            <!--文字敘述-->
                            @foreach($warnings as $warning)
                                <a style="color:gray;">[ {{$warning->created_at}} ]</a>   {{$warning->dataname}} is @if($warning->status) safe now @else out of the range @endif <br>
                            @endforeach
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
                <div class="cubecontent atemp-cubecontent " style="padding-top: 40px">
                    <div class="row">
                        <div class="col-md-6" style=" padding-left: 18px;" onclick="location.href = '{{route('FrontChart','ac_output_voltage')}}'">
                            <a href="#" class="cubeblock ACcubecontent-block-top">
                                <div class="blocktitle AC-blocktitle">AC output voltage</div>
                                <div class="AC-blocktitle">@{{realtime.ac_output_voltage}}</div>
                                <frontguage :max="100" :min="0" :value="realtime.ac_output_voltage" :angle="0.25" :linewidth="0.10" :width="150" :height="100"></frontguage>
                            </a>
                        </div>
                        <div class="col-md-6" onclick="location.href = '{{route('FrontChart','ac_output_frequency')}}'">
                            <a href="#" class="cubeblock ACcubecontent-block-top">
                                <div class="blocktitle AC-blocktitle">AC output frequency</div>
                                <div class="AC-blocktitle">@{{realtime.ac_output_frequency}}</div>
                                <frontguage :max="100" :min="0" :value="realtime.ac_output_frequency" :angle="0.25" :linewidth="0.10" :width="150" :height="100"></frontguage>

                            </a>
                        </div>
                        <div class="col-md-6" style=" padding-left: 18px;" onclick="location.href = '{{route('FrontChart','ac_output_frequency')}}'">
                            <a href="#" class="cubeblock ACcubecontent-block-top">
                                <div class="blocktitle AC-blocktitle">AC output apparent power</div>
                                <div class="AC-blocktitle">@{{realtime.ac_output_frequency}}</div>
                                <frontguage :max="100" :min="0" :value="realtime.ac_output_frequency" :angle="0.25" :linewidth="0.10" :width="150" :height="100"></frontguage>

                            </a>
                        </div>
                        <div class="col-md-6" onclick="location.href = '{{route('FrontChart','ac_output_active_power')}}'">
                            <a href="#" class="cubeblock ACcubecontent-block-top">
                                <div class="blocktitle AC-blocktitle"> 　AC output active power</div>
                                <div class="AC-blocktitle">@{{realtime.ac_output_active_power}}</div>
                                <frontguage :max="100" :min="0" :value="realtime.ac_output_active_power" :angle="0.25" :linewidth="0.10" :width="150" :height="100"></frontguage>

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
