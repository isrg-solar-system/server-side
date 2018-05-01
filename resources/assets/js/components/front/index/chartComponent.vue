<template>
    <div>
        <vue-highcharts :options="options" ref="lineCharts"></vue-highcharts>
    </div>
</template>

<script>
    import VueHighcharts from 'vue2-highcharts'
    const asyncData = {
        name: 'data',
        marker: {
            symbol: 'square'
        },
        data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 23.3, 18.3, 13.9, 9.6]
    }
    export default{
        components: {
            VueHighcharts
        },
        data(){
            return{
                options: {
                    chart: {
                        height: 300,
                        type: 'line',
                    },
                    title: {
                        text: ''
                    },
                    xAxis: {
                        categories: []
                    },
                    yAxis: {
                        title: {
                            text: ''
                        },
                        labels: {
                            formatter: function () {
                                return this.value + '°';
                            }
                        }
                    },
                    tooltip: {
                        crosshairs: true,
                        shared: true
                    },
                    credits: {
                        enabled: false
                    },
                    plotOptions: {
                        spline: {
                            marker: {
                                radius: 4,
                                lineColor: '#666666',
                                lineWidth: 1
                            }
                        }
                    },
                    series: []
                }
            }
        },
        mounted(){
            let lineCharts = this.$refs.lineCharts;
            lineCharts.addSeries(asyncData);
        },
        methods: {
            load(){

            }
        }
    }
</script>