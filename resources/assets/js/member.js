
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
            users:[],
            edit:{
                status:false,
                title:'',
            }
        }

    },
    mounted(){

    },
    created(){
        this.init()
    },
    methods:{
        init(){
            axios.get('/api/member/lists')
                .then(response => {
                    this.users = response.data
                    console.log(this.users)
                })
                .catch(e => {
                    console.log(e)
                })

        },
        add(){
          this.edit.status = true
          this.edit.title = 'Add New User'
        },
        handleOk () {

        },
        handleCancel(){
            this.edit.status = false
            this.edit.title = ''
        },
    }
});


