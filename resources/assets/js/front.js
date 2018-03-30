
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


window.Vue = require('vue');

import videojs from 'video.js'
import VueVideoPlayer from 'vue-video-player'
import 'video.js/dist/video-js.css'
window.videojs = videojs
Vue.use(VueVideoPlayer);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('ex', require('./components/ExampleComponent.vue'));

Vue.component('frontindexfirst', require('./components/front/index/firstComponent.vue'));
Vue.component('frontindexchart', require('./components/front/index/chartComponent.vue'));
Vue.component('frontindexcam', require('./components/front/index/camComponent.vue'));

Vue.component('frontlog', require('./components/front/log/logComponent.vue'));

const app = new Vue({
    el: '#app'
});


