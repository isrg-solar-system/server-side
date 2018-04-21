
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


import Datepicker from 'vuejs-datepicker';

let moment = require('moment');

Vue.component('Datepicker',Datepicker)

const app = new Vue({
    el: '#app',
    data() {
        return {
            userinput:{
                selectdata:[],
                filetype:[],
            },
            datePicker:{
                dateto:'',
                datefrom: '',
                disabled: {
                    to: new Date(2016, 0, 5), // Disable all dates up to specific date
                    from: new Date(2016, 0, 26), // Disable all dates after specific date
                },
                inputclass:'form-control border-input',
                format: 'yyyy-MM-dd',
            },


            datas:'',
            downloadstatus: {
                status:false,
                progress:0,
                desc:'',
                timer:'',
            },

        }
    },
    created() {
        this.getMeasurement()
        this.getDataStatus()
    },
    mounted(){
        window.Echo.channel('publicchannel')
            .listen('.warning', (data) => {
                if(data.status){
                    this.$notify("Data name ："+data.dataname + "<br>Data Value:" + data.value + "<br>is safe now ", 'info', {mode: 'html'})
                }else{
                    this.$notify("Data name ："+data.dataname + "<br>Data Value:" + data.value + "<br>is out of range ", 'warning', {mode: 'html'})

                }
            })
        window.Echo.private('download.'+userid)
            .listen('.status', (data) => {
                // console.log(data.downloadstatus)
                this.downloadstatus.progress = data.downloadstatus.val
                this.downloadstatus.desc = data.downloadstatus.status
                if( this.downloadstatus.progress == 100){
                    console.log(data.downloadstatus)
                    this.downloadstatus.status = true
                    //this.downloadstatus.timer = setInterval(this.checkdownload,500)
                    this.downloadstatus.progress = 0
                    this.downloadstatus.desc = ''
                    // location.href = '/back/download/get/'+data.downloadstatus.filename;
                }
            })
    },
    methods: {
        customFormatter(date) {
            return moment(date).format().substr(0, 10);
        },
        getMeasurement(){
            axios.get('/api/db/measurement')
                .then(response => {
                    // JSON responses are automatically parsed.
                    this.datas = response.data
                })
                .catch(e => {
                    console.log(e)
                })
        },
        getDataStatus(){
            axios.get('/api/db/datatime')
                .then(response => {
                    // JSON responses are automatically parsed.
                    this.datePicker.datefrom = new Date(response.data.first)
                    this.datePicker.dateto = new Date(response.data.last)
                    this.datePicker.disabled.to = new Date(response.data.first)
                    this.datePicker.disabled.from = new Date(response.data.last)
                })
                .catch(e => {
                    console.log(e)
                })

        },
        postData() {
//                console.log(Date.parse(this.datePicker.datefrom))
            axios.post('/api/download/file', {
                datas: this.userinput.selectdata,
                datefrom: this.datePicker.datefrom,
                dateto: this.datePicker.dateto,
                filetype: this.userinput.filetype,
            })
                .then(response => {

                })
                .catch(function (error) {
                    console.log(error)
                });
            this.downloadstatus.status = true
            //this.downloadstatus.timer = setInterval(this.checkdownload,500)
            this.downloadstatus.progress = 0
            this.downloadstatus.desc = ''

        },
        checkdownload(){
            axios.get('/api/download/status')
                .then(response => {
                    this.downloadstatus.progress = response.data.val
                    this.downloadstatus.desc = response.data.status
                    if(response.data.vals = 100){
                        location.href = '/back/download/get';
                        //clearInterval(this.downloadstatus.timer)
                    }
                })
        }
    },
    beforeDestroy() {
    },
    components: {
    }

});


