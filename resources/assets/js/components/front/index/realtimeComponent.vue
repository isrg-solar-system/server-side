<script>
    //Importing Line class from the vue-chartjs wrapper
    import { Line,mixins  } from 'vue-chartjs'
    let { reactiveData } = mixins

    export default {
        extends: Line,
        mixins: [reactiveData],
        data: () => ({
            chartData:'',
            labels:[],
            datas:[],
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        }),
        created () {
        },

        mounted () {
            this.renderChart(this.chartData, this.options)
//            setInterval(() => {
//                this.fillData()
//            }, 2000)
            window.Echo.channel('publicchannel')
                .listen('.realtime', (data) => {
                    let dt = new Date();
                    if(this.labels.length > 10){
                        this.labels.shift()
                        this.datas.shift()
                    }
                    this.labels.push(dt.getHours()+":"+dt.getMinutes()+":"+dt.getSeconds())
                    this.datas.push(data[0].pv_charging_power)
                    this.fillData()
                })
        },

        methods: {
            fillData () {
                this.chartData = {
                    labels: this.labels,
                    datasets: [
                        {
                            label: 'Data One',
                            backgroundColor: '#f87979',
                            data: this.datas
                        }
                    ]
                }
                console.log(this.chartData)
            },

            getRandomInt () {
                return Math.floor(Math.random() * (50 - 5 + 1)) + 5
            }
        }
    }
</script>