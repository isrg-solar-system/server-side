<template>

        <canvas :id="guagename" :width="width" :height="height"></canvas>

</template>


<script>
    import  Guage from './guage.js'
    export default {
        data () {
            return {
                guagename: this.getRandomInt(999),
            }
        },
        props: {
            width:{
                type:Number,
            },
            height:{
                type:Number,
            },
            angle:{
                type:Number,
                defalut: 0.15,
            },
            linewidth:{
                type:Number,
                defalut: 0.44,
            },
            max:{
                type:Number,
                defalut: 100,
            },
            min:{
                type:Number,
                defalut: 0,
            },
            value:{
                type:Number,
            }
        },
        mounted() {
            let opts = {
                angle: this.angle, // The span of the gauge arc
                lineWidth: this.linewidth, // The line thickness
                radiusScale: 1, // Relative radius
                pointer: {
                    length: 0.54, // // Relative to gauge radius
                    strokeWidth: 0.024, // The thickness
                    color: '#000000' // Fill color
                },
                limitMax: false,     // If false, max value increases automatically if value > maxValue
                limitMin: false,     // If true, the min value of the gauge will be fixed
                colorStart: '#040305',   // Colors
                colorStop: '#FFFFFF',    // just experiment with them
                strokeColor: '#2E2E2E',  // to see which ones work best for you
                generateGradient: true,
                highDpiSupport: true,     // High resolution support

            };
            var target = document.getElementById(this.guagename); // your canvas element
            this.guage = new Gauge(target).setOptions(opts); // create sexy gauge!
            this.guage.maxValue = this.max; // set max gauge value
            this.guage.MinValue = this.min;  // set min value
            this.guage.set(this.value); // set actual value
        },
        computed: {

        },
        created(){
        },
        watch: {
            value: function(newVal, oldVal) { // watch it
                this.guage.set(newVal);
            }
        },
        methods: {
            getRandomInt(max) {
                return Math.floor(Math.random() * Math.floor(max)).toString();
            }
        },

    }
</script>