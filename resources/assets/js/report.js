
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */



// require('chart.js');
// require('hchs-vue-charts');
// Vue.use(VueCharts);
import VueChartkick from 'vue-chartkick'
import Chart from 'chart.js'
Vue.use(VueChartkick, {adapter: Chart})
Vue.component('showreport', require('./components/back/report/ShowReportComponent.vue'));


const app = new Vue({
    el: '#app',
    mounted(){
        window.Echo.channel('publicchannel')
            .listen('.warning', (data) => {
                if(data.status){
                    this.$notify("Data name ："+data.dataname + "<br>Data Value:" + data.value + "<br>is safe now ", 'info', {mode: 'html'})
                }else{
                    this.$notify("Data name ："+data.dataname + "<br>Data Value:" + data.value + "<br>is out of range ", 'warning', {mode: 'html'})

                }
            })
        // this.$layer.iframe({
        //     content: {
        //         content: VueWeatherWidget, //传递的组件对象
        //         parent: this,//当前的vue对象
        //         data:[]//props
        //     },
        //     area:['800px','600px'],
        //     title: 'title'
        // });
    },
});


