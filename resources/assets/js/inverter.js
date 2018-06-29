
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
Vue.component('frontguage', require('./components/front/inverter/GuagueComponent.vue'));


const app = new Vue({
    el: '#app',
    data:{
        realtime:{

        },
    },
    mounted(){
        window.Echo.channel('publicchannel')
            .listen('.realtime', (res) => {
                console.log(res)
                this.realtime =  (res[0])
            })
    },
    methods: {
        chan(){
          this.value = 50;
        },
    },
});


