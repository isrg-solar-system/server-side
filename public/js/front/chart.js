$.post("http://60.249.6.104:8187/api/get/data",
    {
        dateto:"2017-01-10",
        datefrom:"2017-01-31",
        dataname:"HUMD",
        group:"year"
    },
    function(data, status) {
        dataS = JSON.parse(data);
        var dataSDict = [];
        for (b = 0; b < dataS.length; b++) {
            dataSDict.push({
                name: dataS[b]['time'].substr(0, 10),
                y: dataS[b]['mean'],
            })
        }
        Startrarr = []
        for (var w = 0; w < dataSDict.length; w++) {
            Startrarr.push(parseFloat(dataSDict[w]['y'].toFixed(1)))
        }
        Start_avg = parseFloat(SumData(Startrarr) / Startrarr.length).toFixed(1)
        Start_min = Math.min.apply(null, Startrarr)
        Start_max = Math.max.apply(null, Startrarr)
        $(document).ready(function(){
            $(".valn").text(''+Start_min);
            $(".vala").text(''+Start_avg);
            $(".valx").text(''+Start_max);
        });
    })


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


            $.post("http://60.249.6.104:8187/api/get/data",
            {
                dateto:"2017-12-31",
                datefrom:"2017-12-1",
                dataname:"HUMD",
                group:"day"
            },
            function(data, status){
                dataJ = JSON.parse(data);
                var dataDict = [];
                for(a=0;a<dataJ.length;a++){
                    dataDict.push({
                        name: dataJ[a]['time'].substr(0,10),
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
                            text: 'Test Title'
                        },
                        subtitle: {
                            text: 'Day'
                        },
                        xAxis: {
                            type: 'category'
                        },
                        yAxis: {
                            title: {
                                text: 'HUMD'
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
                            name: 'HUMD',
                            colorByPoint: true,
                            data: dataDict
                        }]
                    });
                });
            });
$.post("http://60.249.6.104:8187/api/get/data",
    {
        dateto:"2017-01-10",
        datefrom:"2017-01-31",
        dataname:"HUMD",
        group:"month"
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
                    text: 'Test Title'
                },
                subtitle: {
                    text: 'Month'
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: 'HUMD'
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
                    name: 'HUMD',
                    colorByPoint: true,
                    data: dataMDict
                }]
            });
        });
    });

$.post("http://60.249.6.104:8187/api/get/data",
    {
        dateto:"2017-01-10",
        datefrom:"2017-01-31",
        dataname:"HUMD",
        group:"year"
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
                    text: 'Test Title'
                },
                subtitle: {
                    text: 'Year'
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: 'HUMD'
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
                    name: 'HUMD',
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
                    contextButtonTitle: '�ץX',
                    decimalPoint: '.',
                    downloadJPEG: "�U��JPEG�榡",
                    downloadPDF: "�U��PDF�榡",
                    downloadPNG: "�U��PNG�榡",
                    downloadSVG: "�U��SVG�榡",
                    drillUpText: "��^",
                    invalidDate: '�L�Ī��ɶ�',
                    loading: 'loading...',
                    months: ['�@��', '�G��', '�T��', '�|��', '����', '����', '�C��', '�K��', '�E��', '�Q��', '�Q�@��', '�Q�G��'],
                    noData: "�S�����",
                    numericSymbols: null,
                    printChart: "�C�L�Ϫ�",
                    resetZoom: '���s�Y����',
                    resetZoomTitle: '���s����l�j�p',
                    shortMonths: ['�@��', '�G��', '�T��', '�|��', '����', '����', '�C��', '�K��', '�E��', '�Q��', '�Q�@��', '�Q�G��'],
                    thousandsSep: ',',
                    weekdays: ['�P����', '�P���@', '�P���G', '�P���T', '�P���|', '�P����', '�P����'],

                    // Highstock
                    rangeSelectorFrom: '�}�l�ɶ�',
                    rangeSelectorTo: '�����ɶ�',
                    rangeSelectorZoom: '�d��',

                    // Highmaps
                    zoomIn: '�Y�p',
                    zoomOut: '��j'
                },

                global: {
                    // ���ϥ� UTC??
                    // useUTC: false,
                    //timezoneOffset: -8 * 60,
                    canvasToolsURL: protocol + '//cdn.hcharts.cn/highcharts/modules/canvas-tools.js',
                    VMLRadialGradientURL: protocol + +'//cdn.hcharts.cn/highcharts/gfx/vml-radial-gradient.png'
                },

                title: {
                    text: '���D'
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
                        text: '��'
                    }, {
                        type: 'month',
                        count: 3,
                        text: '�u'
                    }, {
                        type: 'month',
                        count: 6,
                        text: '�b�~'
                    }, {
                        type: 'ytd',
                        text: 'YTD'
                    }, {
                        type: 'year',
                        count: 1,
                        text: '�~'
                    }, {
                        type: 'all',
                        text: '�Ҧ�'
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
                    ohlc: {
                        tooltip: {
                            split: false,
                            pointFormat: '<span style="color:{point.color}">\u25CF</span> <b> {series.name}</b><br/>' +
                            '�}�L�G{point.open}<br/>' +
                            '�̰��G{point.high}<br/>' +
                            '�̧C�G{point.low}<br/>' +
                            '���L�G{point.close}<br/>'
                        }
                    },
                    candlestick: {
                        tooltip: {
                            split: false,
                            pointFormat: '<span style="color:{point.color}">\u25CF</span> <b> {series.name}</b><br/>' +
                            '�}�L�G{point.open}<br/>' +
                            '�̰��G{point.high}<br/>' +
                            '�̧C�G{point.low}<br/>' +
                            '���L�G{point.close}<br/>'
                        }
                    }
                }
            };

            Highcharts.setOptions(defaultOptionsZhCn);
        });


        window.onload=function(){
            objLoad=document.getElementById('load')
            //objLoad.style.display='none';
        }