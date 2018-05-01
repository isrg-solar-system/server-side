<script>
    //Importing Line class from the vue-chartjs wrapper
    import { Line,mixins  } from 'vue-chartjs'
    let { reactiveData } = mixins

    export default {
        extends: Line,
        mixins: [reactiveData],
        data: () => ({
            chartData: '',
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        }),
        created () {
            this.fillData()
        },

        mounted () {
            this.renderChart(this.chartData, this.options)
            window.Echo.channel('publicchannel')
                .listen('.realtime', (data) => {

                })
        },

        methods: {
            fillData () {
                this.chartData = {
                    labels: ['January' + this.getRandomInt(), 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    datasets: [
                        {
                            label: 'Data One',
                            backgroundColor: '#f87979',
                            data: [this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt()]
                        }
                    ]
                }
            },
        }
    }
</script>