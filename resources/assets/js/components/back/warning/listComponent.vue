
<template>
    <div class="card">
        <div class="header row">
            <h4 class="col-xs-9 title">Warning List</h4>
            <div class="col-xs-3 text-right">
                <v-spin size="large" v-if="loading"></v-spin>
            </div>
        </div>
        <div class="content">
            <ul class="list-unstyled team-members">
                <li v-for="item in datas">
                    <div class="row">
                        <div class="col-xs-12 col-12  text-center">
                            <p class="text-success" v-if="item.status">{{item.name}}</p>
                            <p class="text-danger" v-if="!item.status">{{item.name}}</p>
                        </div>

                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>

    export default {
        data() {
            return {
                loading:true,
                datas:[],
            }
        },
        created() {
            this.loading = true
            this.init()


        },
        mounted(){
            window.Echo.channel('publicchannel')
                .listen('.warning', (data) => {
                    this.datas.find(f => f.name === data.dataname).status = data.status
                })
        },
        methods: {
            init(){
                axios.get('/api/db/measurement')
                    .then(response => {
                        // JSON responses are automatically parsed.
                        this.datas = response.data
                        this.getdatastatus()
                    })
                    .catch(e => {
                        console.log(e)
                    })
            },
            getdatastatus(){
                axios.get('/api/get/status')
                    .then(response => {
                        // JSON responses are automatically parsed.

                        $.each(response.data, (key, data) => {
                            let index =  this.datas.find(f => f.name == key)
                            Vue.set(index, "status",data);
                        })
                        this.loading = false
                    })
                    .catch(e => {
                        console.log(e)
                    })

            },

        },
        beforeDestroy() {

        }
    }
    </script>
