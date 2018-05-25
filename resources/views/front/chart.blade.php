
@extends('layouts.master')

@section('include-css')
    <link rel='stylesheet' href='{{asset('css/front/chart.css')}}'>
    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
@endsection


@section('contentout')
    <div class="container123 " style="background: #28282E;width: 95%;margin-left: 12px;">
        <div class="side">
            <select id="select_name" name="select_name" style="width: 100%;">

            </select>

            <ul class="links">
                <li><a href="#" class="selected" data-metric="Year">Year</a></li>
                <li><a href="#" data-metric="Month">Month</a></li>
                <li><a href="#" data-metric="Day">Day</a></li>
            </ul>
            <div class="stats">
                <ul data-metric="Year">
                    <li>
                        <div class="key">Minimum</div>
                        <div class="valn" ></div>
                    </li>
                    <li>
                        <div class="key">Average</div>
                        <div class="vala"></div>
                    </li>
                    <li>
                        <div class="key">Maximum</div>
                        <div class="valx"></div>
                    </li>
                </ul>
                <ul data-metric="Month">
                    <li>
                        <div class="key">Minimum</div>
                        <div class="valmn"></div>
                    </li>
                    <li>
                        <div class="key">Average</div>
                        <div class="valma"></div>
                    </li>
                    <li>
                        <div class="key">Maximum</div>
                        <div class="valmx"></div>
                    </li>
                </ul>
                <ul data-metric="Day">
                    <li>
                        <div class="key">Minimum</div>
                        <div class="valdn"></div>
                    </li>
                    <li>
                        <div class="key">Average</div>
                        <div class="valda"></div>
                    </li>
                    <li>
                        <div class="key">Maximum</div>
                        <div class="valdx"></div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main">
            <ul>
                <li class="active">
                    <article tabindex="0" data-metric="Year">
                        <div id="year" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                        <h1>Year</h1>
                    </article>
                </li>
                <li>
                    <article tabindex="0" data-metric="Month">
                        <div id="month" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                        <h1>Month</h1>
                    </article>
                </li>
                <li>
                    <article tabindex="0" data-metric="Day">
                        <div id="day" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                        <h1>Day</h1>
                    </article>
                </li>
            </ul>
        </div>
    </div>


@endsection

@section('include-javascript')
    <script src='https://code.jquery.com/jquery-3.1.1.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js'></script>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js'></script>
    <script src='https://img.hcharts.cn/highcharts/highcharts.js'></script>
    <script src='https://img.hcharts.cn/highcharts/modules/exporting.js'></script>
    <script src='https://img.hcharts.cn/highcharts/modules/data.js'></script>
    <script src='https://img.hcharts.cn/highcharts/modules/drilldown.js'></script>
    <script src='https://img.hcharts.cn/highcharts-plugins/highcharts-zh_CN.js'></script>
    <script src='http://img.hcharts.cn/highcharts/themes/dark-unica.js'></script>
    <script>
        var dataname_ = '{{ $dataname }}';


        function SumData(arr){ //arr total
            var sum=0;
            for (var i = 0; i < arr.length; i++) {
                sum += arr[i];
            };
            return parseFloat(sum);
        }

        function selectMetric(e) {
            e.preventDefault();
            var metric = $(e.currentTarget).attr('data-metric');
            var metricSelector = '[data-metric="' + metric + '"]';

            // set selected link
            $('.side .selected').removeClass('selected');
            $('.side .links a' + metricSelector).addClass('selected');

            // show proper stats
            $('.side .stats ul').hide();
            $('.side .stats ul' + metricSelector).show();

            // activate proper graph
            var year_avg = parseFloat(SumData(monarr) / monarr.length).toFixed(1),
                year_min = Math.min.apply(null, yeararr),
                year_max = Math.max.apply(null, yeararr),
                mon_avg = parseFloat(SumData(monarr) / monarr.length).toFixed(1),
                mon_min = Math.min.apply(null, monarr),
                mon_max = Math.max.apply(null, monarr),
                day_avg = parseFloat(SumData(dayarr) / dayarr.length).toFixed(1),
                day_min = Math.min.apply(null, dayarr),
                day_max = Math.max.apply(null, dayarr);
            $(".valn").text(''+year_avg);
            $(".vala").text(''+year_min);
            $(".valx").text(''+year_max);
            $(".valmn").text(''+mon_min);
            $(".valma").text(''+mon_avg);
            $(".valmx").text(''+mon_max);
            $(".valdn").text(''+day_min);
            $(".valda").text(''+day_avg);
            $(".valdx").text(''+day_max);

            var $wrapper = $('.main article' + metricSelector).parent();
            var isActive = $wrapper.hasClass('active');
            if (!isActive) {
                $wrapper
                    .addClass('active')
                    .siblings().removeClass('active');
            }
        }

        function checkKey(e) {
            if (e.keyCode === 13) {
                // hit enter
                selectMetric(e);
            }
        }

        $('.side .links a').on('click', selectMetric);
        $('.main article').on({
            'click': selectMetric,
            'keyup': checkKey
        });


        $.post("/api/get/data",
            {
                dateto:"2017-12-31",
                datefrom:new Date().toJSON().slice(0,10).replace(/-/g,'-'),
                dataname:dataname_,
                group:"dayofhour"
            },
            function(data, status){
                dataJ = JSON.parse(data);
                var dataDict = [];
                for(a=0;a<dataJ.length;a++){
                    dataDict.push({
                        name: dataJ[a]['time'].substr(11,18),
                        y:dataJ[a]['mean'],
                    })
                }
                dayarr = []
                for(var w=0;w<dataDict.length;w++){
                    dayarr.push(parseFloat(dataDict[w]['y'].toFixed(1)))
                }
                $(function () {
                    // Create the chart
                    Highcharts.chart('day', {
                        chart: {
                            type: 'column'
                        },
                        colors: [
                            '#fff'
                        ],
                        title: {
                            text: dataname_
                        },
                        subtitle: {
                            text: 'Day'
                        },
                        xAxis: {
                            type: 'category'
                        },
                        yAxis: {
                            title: {
                                text: dataname_
                            }
                        },
                        legend: {
                            enabled: false
                        },
                        plotOptions: {
                            series: {
                                borderWidth: 0,
                                dataLabels: {
                                    enabled: true,
                                    format: '{point.y:.1f}'
                                }
                            }
                        },
                        tooltip: {
                            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}</b> of total<br/>'
                        },
                        series: [{
                            name: dataname_,
                            colorByPoint: true,
                            data: dataDict
                        }]
                    });
                });
            });

        $.post("/api/get/data",
            {
                datefrom:"{{$now->startOfMonth()->toDateString()}}",
                dateto:"{{$now->endOfMonth()->toDateString()}}",
                dataname:dataname_,
                group:"allofday"
            },
            function(data, status) {

                dataM = JSON.parse(data);
                var dataMDict = [];
                for (b = 0; b < dataM.length; b++) {
                    dataMDict.push({
                        name: dataM[b]['time'].substr(0, 10),
                        y: dataM[b]['mean'],
                    })
                }
                monarr = []
                for(var w=0;w<dataMDict.length;w++){
                    monarr.push(parseFloat(dataMDict[w]['y'].toFixed(1)))
                }
                $(function () {
                    // Create the chart
                    Highcharts.chart('month', {
                        chart: {
                            type: 'column'
                        },
                        colors: [
                            '#fff'
                        ],
                        title: {
                            text: dataname_
                        },
                        subtitle: {
                            text: 'Month'
                        },
                        xAxis: {
                            type: 'category'
                        },
                        yAxis: {
                            title: {
                                text: dataname_
                            }
                        },
                        legend: {
                            enabled: false
                        },
                        plotOptions: {
                            series: {
                                borderWidth: 0,
                                dataLabels: {
                                    enabled: true,
                                    format: '{point.y:.1f}'
                                }
                            }
                        },
                        tooltip: {
                            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}</b> of total<br/>'
                        },
                        series: [{
                            name: dataname_,
                            colorByPoint: true,
                            data: dataMDict
                        }]
                    });
                });
            });

        $.post("/api/get/data",
            {
                datefrom:"{{$now->startOfYear()->toDateString()}}",
                dateto:"{{$now->endOfYear()->toDateString()}}",
                dataname:dataname_,
                group:"allofmonth"
            },
            function(data, status) {
                dataY = JSON.parse(data);
                var dataYDict = [];
                for (b = 0; b < dataY.length; b++) {
                    dataYDict.push({
                        name: dataY[b]['time'].substr(0, 10),
                        y: dataY[b]['mean'],
                    })
                }
                yeararr = []
                for(var w=0;w<dataYDict.length;w++){
                    yeararr.push(parseFloat(dataYDict[w]['y'].toFixed(1)))
                }
                $(function () {
                    // Create the chart
                    Highcharts.chart('year', {
                        chart: {
                            type: 'column'
                        },
                        colors: [
                            '#fff'
                        ],
                        title: {
                            text: dataname_
                        },
                        subtitle: {
                            text: 'Year'
                        },
                        xAxis: {
                            type: 'category'
                        },
                        yAxis: {
                            title: {
                                text: dataname_,
                            }
                        },
                        legend: {
                            enabled: false
                        },
                        plotOptions: {
                            series: {
                                borderWidth: 0,
                                dataLabels: {
                                    enabled: true,
                                    format: '{point.y:.1f}'
                                }
                            }
                        },
                        tooltip: {
                            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}</b> of total<br/>'
                        },
                        series: [{
                            name: dataname_,
                            colorByPoint: true,
                            data:dataYDict
                        }]
                    });
                });
            });
        // zh_TW

        /**
         * Highcharts-zh_CN plugins v1.0.3 (2017-04-05)
         *
         * (c) 2017 Jianshu Technology Co.,LTD (https://jianshukeji.com)
         *
         * Author : john@jianshukeji.com, Blue Monkey
         *
         * License: Creative Commons Attribution (CC)
         */

        (function (factory) {
            if (typeof module === 'object' && module.exports) {
                module.exports = factory;
            } else {
                factory(Highcharts);
            }
        })(function (Highcharts) {

            var protocol = window.location.protocol;

            var defaultOptionsZhCn = {
                lang: {
                    // Highcharts
                    contextButtonTitle: 'Export',
                    decimalPoint: '.',
                    downloadJPEG: "Download JPEG",
                    downloadPDF: "Download PDF",
                    downloadPNG: "Download PNG",
                    downloadSVG: "Download SVG",
                    drillUpText: "Back",
                    invalidDate: 'Invalid Date',
                    loading: 'loading...',
                    months: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    noData: "No Data",
                    numericSymbols: null,
                    printChart: "Print",
                    resetZoom: 'Reset Zoom',
                    resetZoomTitle: 'Reset Zoom Title',
                    shortMonths: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    thousandsSep: ',',
                    weekdays: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],

                    // Highstock
                    rangeSelectorFrom: 'Starting time',
                    rangeSelectorTo: 'End Time',
                    rangeSelectorZoom: 'Range',

                    // Highmaps
                    zoomIn: 'Zoom In',
                    zoomOut: 'Zoom Out'
                },

                global: {
                    // useUTC: false,
                    //timezoneOffset: -8 * 60,
                    canvasToolsURL: protocol + '//cdn.hcharts.cn/highcharts/modules/canvas-tools.js',
                    VMLRadialGradientURL: protocol + +'//cdn.hcharts.cn/highcharts/gfx/vml-radial-gradient.png'
                },

                title: {
                    text: 'Title'
                },

                tooltip: {
                    dateTimeLabelFormats: {
                        millisecond: '%H:%M:%S.%L',
                        second: '%H:%M:%S',
                        minute: '%H:%M',
                        hour: '%H:%M',
                        day: '%Y-%m-%d',
                        week: '%Y-%m-%d',
                        month: '%Y-%m',
                        year: '%Y'
                    },
                    split: false
                },

                exporting: {
                    url: protocol + '//export.highcharts.com.cn'
                },

                credits: {
                    text: 'Highcharts.com.cn',
                    href: 'https://www.highcharts.com.cn'
                },

                xAxis: {
                    dateTimeLabelFormats: {
                        millisecond: '%H:%M:%S.%L',
                        second: '%H:%M:%S',
                        minute: '%H:%M',
                        hour: '%H:%M',
                        day: '%Y-%m-%d',
                        week: '%Y-%m',
                        month: '%Y-%m',
                        year: '%Y'
                    }
                },

                /**
                 * Highstock
                 */


                rangeSelector: {
                    inputDateFormat: '%Y-%m-%d',
                    buttonTheme: {
                        width: 'auto',
                        style: {
                            fontSize: '12px',
                            padding: '4px'
                        }
                    },
                    buttons: [{
                        type: 'month',
                        count: 1,
                        text: 'Month'
                    }, {
                        type: 'month',
                        count: 3,
                        text: 'Season'
                    }, {
                        type: 'month',
                        count: 6,
                        text: 'Six months'
                    }, {
                        type: 'ytd',
                        text: 'YTD'
                    }, {
                        type: 'year',
                        count: 1,
                        text: 'Year'
                    }, {
                        type: 'all',
                        text: 'All'
                    }]
                },

                plotOptions: {
                    series: {
                        dataGrouping: {
                            dateTimeLabelFormats: {
                                millisecond: ['%Y-%m-%d %H:%M:%S.%L', '%Y-%m-%d %H:%M:%S.%L', ' ~ %H:%M:%S.%L'],
                                second: ['%Y-%m-%d %H:%M:%S', '%Y-%m-%d %H:%M:%S', ' ~ %H:%M:%S'],
                                minute: ['%Y-%m-%d %H:%M', '%Y-%m-%d %H:%M', ' ~ %H:%M'],
                                hour: ['%Y-%m-%d %H:%M', '%Y-%m-%d %H:%M', ' ~ %H:%M'],
                                day: ['%Y-%m-%d', '%Y-%m-%d', ' ~ %Y-%m-%d'],
                                week: ['%Y-%m-%d', '%Y-%m-%d', ' ~ %Y-%m-%d'],
                                month: ['%Y-%m', '%Y-%m', ' ~ %Y-%m'],
                                year: ['%Y', '%Y', ' ~ %Y']
                            }
                        }
                    },
                }
            };

            Highcharts.setOptions(defaultOptionsZhCn);
        });


        window.onload=function(){
            objLoad=document.getElementById('load')
            //objLoad.style.display='none';
            $.ajax({
                url: '/api/db/measurement',
                type: 'GET',
                dataType: 'json',
                error: function(xhr) {
                    alert('Ajax request 發生錯誤');
                },
                success: function(response) {
                    $('#select_name').append("<option value=\""+"{{$dataname}}"+"\">"+"{{$dataname}}"+"</option>");
                    $.each(response, function(i, name){
                        $('#select_name').append("<option value=\""+name+"\">"+name.name+"</option>");
                    });
                }
            });
            $( "#select_name" ).change(function() {
                $( "#select_name option:selected" ).each(function() {
                    location.href='/chart/'+$(this).text();
                });
            });
        }
    </script>
@endsection
@section('js','')