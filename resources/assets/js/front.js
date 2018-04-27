
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


window.Vue = require('vue');


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
// Vue.component('ex', require('./components/ExampleComponent.vue'));


Vue.component('frontindexchart', require('./components/front/index/chartComponent.vue'));
Vue.component('frontindexcam', require('./components/front/index/camComponent.vue'));

// Vue.component('frontindexfirst', require('./components/front/index/firstComponent.vue'));

// Vue.component('frontlog', require('./components/front/log/logComponent.vue'));



const app = new Vue({
    el: '#app',
    data:{
        realtime:{
            pv_input_voltage:0,
            pv_input_current_for_battery:0,
            pv_charging_power:0,
        },
        lastupdatetime:0,
        today:0,
        week:0,
        month:0,
        year:0,
        sun:0,
        temp:0,
        wind:0,
        speed:0,
        windspeed:0,
    },
    mounted() {
        this.gettimenow();
        window.Echo.channel('publicchannel')
            .listen('.realtime', (data) => {
                console.log(data)
            })
    },
    computed: {

    },
    methods: {
        gettimenow(){
            let dt = new Date();
            this.lastupdatetime =  dt.getHours()+":"+dt.getMinutes()+":"+dt.getSeconds();
        },
    },
});


