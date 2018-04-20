
<template>
    <div class="card">
        <div class="header row">
            <h4 class="col-xs-9 title">Warning Setting List</h4>
            <div class="col-xs-3 text-right">
                <v-spin size="large" v-if="loading"></v-spin>
                <button class="btn btn-sm btn-warning btn-icon" @click="create"><i class="fa ti-plus"></i></button>
            </div>
        </div>
        <div class="content">
            <ul class="list-unstyled team-members">
                <li v-for="item in settinglist">
                    <div class="row">
                        <div class="col-xs-2  text-center">
                            <span class="text-danger"></span>
                        </div>
                        <div class="col-xs-2  text-center">
                            <span class="text-success">{{ item.name }}</span>
                        </div>
                        <div class="col-xs-2  text-center">
                            <div class="form-group" v-if="config == item.id">
                                <select class="form-control form-control-lg  border-input" v-model="userinput.operate" >
                                    <option :selected="item.operate == '>'">></option>
                                    <option :selected="item.operate == '<'"><</option>
                                </select>
                            </div>
                            <span class="text-danger" v-else="config == item.id">{{ item.operate }}</span>

                        </div>
                        <div class="col-xs-2  text-center">
                            <div class="form-group" v-if="config == item.id">
                                <input type="email" class="form-control border-input" placeholder="Value" v-model="userinput.value">
                            </div>
                            <span class="text-success" v-else="config == item.id">{{ item.value }}</span>
                        </div>
                        <div class="col-xs-3 text-right">
                            <div v-if="config == item.id">
                                <button type="submit" class="btn btn-sm btn-success btn-icon" @click="save"><i class="fa ti-save-alt"></i></button>
                                <button type="submit" class="btn btn-sm btn-success btn-icon" @click="cancel"><i class="fa ti-back-left"></i></button>
                            </div>
                            <div v-else="config == item.id">
                                <button class="btn btn-sm btn-success btn-icon" @click="modify(item.id,item.name,item.operate,item.value)"><i class="fa ti-pencil"></i></button>
                                <button class="btn btn-sm btn-success btn-icon" @click="dele(item.id)"><i class="fa ti-trash"></i></button>
                            </div>


                        </div>
                    </div>
                </li>
                <li v-if="config == 'create'">
                    <div class="row">
                        <div class="col-xs-2  text-center">
                            <span class="text-danger"></span>
                        </div>
                        <div class="col-xs-2  text-center">
                            <div class="form-group">
                                <select class="form-control form-control-lg  border-input" v-model="userinput.name">
                                    <option v-for="data in datas">{{ data.name }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-2  text-center">
                            <div class="form-group">
                                <select class="form-control form-control-lg  border-input" v-model="userinput.operate">
                                    <option>></option>
                                    <option><</option>
                                    <option>=</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-2  text-center">
                            <div class="form-group">
                                <input type="email" class="form-control border-input" placeholder="Value" v-model="userinput.value">
                            </div>
                        </div>
                        <div class="col-xs-3 text-right">
                            <div class="form-group">
                                <button type="submit" class="btn btn-sm btn-success btn-icon" @click="save"><i class="fa ti-save-alt"></i></button>
                                <button type="submit" class="btn btn-sm btn-success btn-icon" @click="cancel"><i class="fa ti-back-left"></i></button>
                            </div>
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
                settinglist:[
                ],
                userinput:{
                    id:'',name:'',operate:'',value:'',index:'',
                },
                datas:'',
                config:false,
                index:false,
                loading:true,
            }
        },
        created() {
            this.init()
            this.getmeasurement()
            this.loading = false
        },
//        mounted(){
//            this.$nextTick(() => {
//                this.fetchstatus()
//            },1)
//        },
        methods: {

            init(){
                axios.get('/api/warning/lists')
                    .then(response => {
                        this.settinglist = (response.data)
                    })
            },
            getmeasurement(){
                axios.get('/api/db/measurement')
                    .then(response => {
                        // JSON responses are automatically parsed.
                        this.datas = response.data
                    })
                    .catch(e => {
                        console.log(e)
                    })
            },
            modify(id,name,operate,value){
                this.config = id
                this.userinput.id = id
                this.userinput.name = name
                this.userinput.operate = operate
                this.userinput.value = value
                this.index = this.settinglist.map(function (img) { return img.id }).indexOf(id)
            },
            cancel(){
                this.config = false
            },
            create(){
                this.config = 'create'
                this.userinput.id = ''
                this.userinput.name = ''
                this.userinput.operate = ''
                this.userinput.value = ''
            },
            save(){

                this.loading = true
                let url = ''
                if(this.config != 'create'){
                    url  = '/api/warning/update'
                }else{
                    url = '/api/warning/create'
                }
                axios.post(url, {
                    id: this.userinput.id,
                    name: this.userinput.name,
                    value: this.userinput.value,
                    operate:  this.userinput.operate,
                })
                    .then(response => {
                        if(response.data.status){
                            this.$notify.success('Success!')
                            this.init()
                            this.index = false
                            this.config = false
                            this.loading = false
                        }
                    })
                    .catch(function (error) {
                        console.log(error)
                    });


            },
            dele(id){
                let url = '/api/warning/delete'
                this.$modal.confirm({
                    title: 'Confirm',
                    content: 'Are you Sure?',
                    okText: 'OK',
                    cancelText: 'Cancel',
                    onOk: ()=>{
                        this.loading = true
                        axios.post(url, {
                            id: id,
                        })
                            .then(response => {
                                if(response.data.status){
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

        },
        beforeDestroy() {

        }
    }
    </script>
