// 基于准备好的dom，初始化echarts实例
var myChart = echarts.init(document.getElementById('main'),'dark');

// 指定图表的配置项和数据
var option = {
    title: {
        text: 'ECharts 入门示例'
    },
    tooltip: {},
    legend: {
        data:['销量']
    },
    xAxis: {
        data: ["衬衫","羊毛衫","雪纺衫","裤子","高跟鞋","袜子"]
    },
    yAxis: {},
    series: [{
        name: '销量',
        type: 'line',
        data: [5, 20, 36, 10, 10, 20]
    }]
};

// 使用刚指定的配置项和数据显示图表。
myChart.setOption(option);
myChart.on('click', function (params) {
    window.open('https://www.baidu.com/s?wd=' + encodeURIComponent(params.name));
});

var percentChart = echarts.init(document.getElementById('percent'),'dark');

// 指定图表的配置项和数据
option = {
    tooltip: {
        trigger: 'item',
        formatter: "{a} <br/>{b}: {c} ({d}%)"
    },
    legend: {
        orient: 'vertical',
        x: 'left',
        data:['直接访问','邮件营销','联盟广告','视频广告','搜索引擎']
    },
    series: [
        {
            name:'访问来源',
            type:'pie',
            radius: ['50%', '70%'],
            avoidLabelOverlap: false,
            label: {
                normal: {
                    show: false,
                    position: 'center'
                },
                emphasis: {
                    show: true,
                    textStyle: {
                        fontSize: '30',
                        fontWeight: 'bold'
                    }
                }
            },
            labelLine: {
                normal: {
                    show: true
                }
            },
            data:[
                {value:335, name:'Plug 1'},
                {value:310, name:'Plug 2'},
                {value:234, name:'剩餘電量'}
            ]
        }
    ]
};

// 使用刚指定的配置项和数据显示图表。
percentChart.setOption(option);
percentChart.on('click', function (params) {
    window.open('https://www.baidu.com/s?wd=' + encodeURIComponent(params.name));
});