
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
                        <div class="col-xs-6 col-6  text-center">
                            {{item.name}}
                        </div>
                        <div class="col-xs-4  col-4  text-center " >
                            <p class="text-success" v-if="item.status">
                                Safe
                            </p>
                            <p class="text-danger" v-if="!item.status">
                                Data out of range
                            </p>
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
            this.loading = false

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
                $.each( this.datas, function( key, value ) {
                    axios.get('/api/get/'+value.name)
                        .then(response => {
                            // JSON responses are automatically parsed.
                            Vue.set(this, "status", response.data);
                        })
                        .catch(e => {
                            console.log(e)
                        })
                })
                console.log(this.datas)

            },

        },
        beforeDestroy() {

        }
    }
    </script>
