<script>
    //Importing Line class from the vue-chartjs wrapper
    import { Bar } from 'vue-chartjs'
    //Exporting this so it can be used in other components
    export default ({
        extends: Bar,
        data () {
            return {
                datacollection: {
                    //Data to be represented on x-axis
                    labels: [],
                    datasets: [
                        {
                            label: 'Power',
                            backgroundColor: '#2B91D5',
                            pointBackgroundColor: 'white',
                            borderWidth: 1,
                            pointBorderColor: '#ffff',
                            //Data to be represented on y-axis
                            data: []
                        }
                    ]
                },
                //Chart.js options that controls the appearance of the chart
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            },
                            gridLines: {
                                display: true
                            }
                        }],
                        xAxes: [ {
                            gridLines: {
                                display: false
                            }
                        }]
                    },
                    legend: {
                        display: true
                    },
                    responsive: true,
                    maintainAspectRatio: false
                }
            }
        },
        mounted () {

            axios.post('/api/get/data',
                {dataname:'pv_charging_power',group:'todayofhour'}
            )
                .then(response => {
                    response.data.map((value, key)=>{
//                        console.log(value.mean,"key:"+key);
                        this.datacollection.labels.push(key+1)
                        this.datacollection.datasets[0].data.push(value.mean)

                        if(response.data.length == key+1){
                            this.renderChart(this.datacollection, this.options)
                        }
                    });

                })
                .catch(function (error) {
                    console.log(error)
                });
            //renderChart function renders the chart with the datacollection and options object.


        }
    })
</script>