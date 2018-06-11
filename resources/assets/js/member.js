
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
            error:false,
            loading:false,
            users:[],
            edit:{
                status:false,
                title:'',
                url:'',
                model:{
                    id:'',
                    email:'',
                    name:'',
                    password:'',
                    level:'',
                    tmpass:'',
                }
            }
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
    },
    created(){
        this.init()
    },
    methods:{
        init(){
            this.loading = true
            axios.get('/api/member/lists')
                .then(response => {
                    this.users = response.data
                })
                .catch(e => {
                    console.log(e)
                })
            this.loading = false
        },
        add(){
          this.edit.status = true
          this.edit.title = 'Add New User'
          this.edit.url = '/api/member/add'
        },
        update(id){
            this.edit.status = true
            this.edit.title = 'Edit User'
            this.edit.url = '/api/member/update'
            let update = this.users.find(f => f.id === id)
            this.edit.model.tmpass =  Math.random().toString(36).substr(2, 5);
            this.edit.model.id = update.id
            this.edit.model.name = update.name
            this.edit.model.email = update.email
            this.edit.model.password = this.edit.model.tmpass
            this.edit.model.level = update.level
        },
        delete_(id){
            let delete_ = this.users.find(f => f.id === id)
            this.$modal.confirm({
                title: 'Confirm',
                content: 'Are you Sure?',
                okText: 'OK',
                cancelText: 'Cancel',
                onOk: ()=>{
                    this.loading = true
                    axios.post('/api/member/delete', {
                        id: id,
                    })
                        .then(response => {
                            if(response.data){
                                this.$notify.success('Success!')
                                this.init()
                            }
                        })
                        .catch(function (error) {
                            console.log(error)
                        });
                    this.loading = false
                },
            })
        },
        handleOk () {
            if(this.edit.model.password == this.edit.model.tmpass){
                this.edit.model.password = null
            }
            // if(this.edit.model.name != null && this.edit.model.email != null && this.edit.model.password != null && this.edit.model.level != null){
            //     this.loading = true
            //     this.edit.status = false
            //     axios.post(this.edit.url,
            //         this.edit.model
            //     )
            //         .then(response => {
            //             if(response.data){
            //                 this.$notify.success('Success!')
            //                 this.init()
            //             }
            //         })
            //         .catch(function (error) {
            //             console.log(error)
            //         });
            //     this.loading = false
            //     this.error = false
            // }else{
            //     this.error = true
            // }

        },
        handleCancel(){
            this.edit.status = false
            this.edit.title = ''
            this.edit.model.id = ''
            this.edit.model.name = ''
            this.edit.model.email = ''
            this.edit.model.password = ''
            this.edit.model.level = ''
            this.edit.model.tmpass = ''
        },
    }
});


