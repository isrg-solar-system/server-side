
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



const app = new Vue({
    el: '#app',
    data(){
        return {
            data_limit:"",
            line_api:"",
            line_format:"",
            loading:true,
        }

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
        this.line_api = $('#line_api').attr('value')
        this.data_limit = $('#data_limit').attr('value')
        this.line_format = $('textarea#line_format').attr('value')
        this.loading = false
    },
    created(){
    },
    methods:{
        save(key){
            this.loading = true
            let senddata
            switch(key) {
                case 'line':
                    senddata = {line_api:this.line_api,line_format:this.line_format}
                    break;
                case 'datalimit':
                    senddata = {data_limit:this.data_limit}
                    break;
            }
            axios.post('/back/setting/update',
                senddata
            )
                .then(response => {
                    if(response.data){
                        this.$notify("Updata Web Setting Success", 'success', {mode: 'html'})
                    }
                    this.loading = false
                })
                .catch(function (error) {
                    console.log(error)
                    this.loading = false
                });
        }
    }
});


