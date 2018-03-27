
<template>

    <div class="col-md-12">

            <div class="col-md-3">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Select Data</h4>
                        <p class="category">Select which data you want to Download</p>
                    </div>
                    <div class="content ">
                        <ul>
                            <li v-for="data in datas">
                                <label class="fancy-checkbox">
                                    <input type="checkbox" v-model="userinput.selectdata" :value=data.name />
                                    <span>{{data.name}}</span>
                                </label>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Select Date</h4>
                        <p class="category">Select The Date</p>
                    </div>
                    <div class="content">
                        <div class="form-group">
                            <label>From</label>
                            <datePicker :format="customFormatter"  v-model="datePicker.datefrom" :input-class="datePicker.inputclass" name="datefrom" :required="true" :disabled="datePicker.disabled"></datePicker>
                        </div>
                        <div class="form-group">
                            <label>To</label>
                            <datePicker :format="customFormatter" v-model="datePicker.dateto" :input-class="datePicker.inputclass" name="dateto" :required="true" :disabled="datePicker.disabled"></datePicker>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Download As</h4>
                        <p class="category">Select Data Type</p>
                    </div>
                    <div class="content">
                        <ul>
                            <li>
                                <div class="pretty p-icon p-round" style=" margin-bottom: 5px;">
                                    <input type="radio" name="icon" v-model="userinput.filetype" value="pdf"/>
                                    <div class="state p-success-o">
                                        <i class="icon mdi mdi-check"></i>
                                        <label> PDF</label>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="pretty p-icon p-round" style=" margin-bottom: 5px;">
                                    <input type="radio" name="icon"  v-model="userinput.filetype" value="json" />
                                    <div class="state p-success-o">
                                        <i class="icon mdi mdi-check"></i>
                                        <label>JSON</label>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="pretty p-icon p-round" style=" margin-bottom: 5px;">
                                    <input type="radio" name="icon"  v-model="userinput.filetype" value="csv" />
                                    <div class="state p-success-o">
                                        <i class="icon mdi mdi-check"></i>
                                        <label>CSV</label>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="pretty p-icon p-round" style=" margin-bottom: 5px;">
                                    <input type="radio" name="icon"  v-model="userinput.filetype" value="xlsx" />
                                    <div class="state p-success-o">
                                        <i class="icon mdi mdi-check"></i>
                                        <label>XLSX</label>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="pretty p-icon p-round" style=" margin-bottom: 5px;">
                                    <input type="radio" name="icon"  v-model="userinput.filetype" value="osd"/>
                                    <div class="state p-success-o">
                                        <i class="icon mdi mdi-check"></i>
                                        <label>OSD</label>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="pretty p-icon p-round" style=" margin-bottom: 5px;">
                                    <input type="radio" name="icon"  v-model="userinput.filetype" value="xml"/>
                                    <div class="state p-success-o">
                                        <i class="icon mdi mdi-check"></i>
                                        <label>XML</label>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="pretty p-icon p-round" style=" margin-bottom: 5px;">
                                    <input type="radio" name="icon"  v-model="userinput.filetype" value="txt"/>
                                    <div class="state p-success-o">
                                        <i class="icon mdi mdi-check"></i>
                                        <label>TXT</label>
                                    </div>
                                </div>
                            </li>
                        </ul>


                    </div>
                </div>
            </div>
            <div class="col-md-3" >
                <div class="card">
                    <div class="header">
                        <h4 class="title">Start Download</h4>
                        <p class="category">click buttom to download data</p>
                    </div>
                    <div class="content" style="height:189px;">
                        <div class="form-group" style="margin-top:32px">
                            <button @click="postData" class="btn btn-primary btn-lg btn-block">Download</button>
                            <div class="progress" style="margin-top: 25px;" v-if="downloadstatus.tatus">
                                <div class="progress-bar bg-success" role="progressbar" v-bind:style="{ width: downloadstatus.progress+ '%' }":aria-valuenow=downloadstatus.progress aria-valuemin="0" aria-valuemax="100"></div>
                                <span class="text-success"><small>{{downloadstatus.desc}}</small></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </div>
</template>

<script>
    import datePicker from 'vuejs-datepicker';
    let moment = require('moment');
    export default {
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
                    progress:'',
                    desc:'',
                },

            }
        },
        created() {
            this.getMeasurement()
            this.getDataStatus()
        },
//        mounted(){
//            this.$nextTick(() => {
//                this.fetchstatus()
//            },1)
//        },
        methods: {
            customFormatter(date) {
                return moment(date).format().substr(0, 10);
            },
            getMeasurement(){
                axios.get('/api/db/measurement')
                    .then(response => {
                        // JSON responses are automatically parsed.
                        this.datas = response.data
                        console.log(this.datas)
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
                        console.log(this.datePicker)
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
                    })
                    .then(response => {
                        this.downloadstatus = true
                    })
                    .catch(function (error) {
                        console.log(error)
                    });
            },
            checkdownload(){
                axios.get('/api/download/status', {
                    datas: this.userinput.selectdata,
                    datefrom: this.datePicker.datefrom,
                    dateto: this.datePicker.dateto,
                })
            }
        },
        beforeDestroy() {
        },
        components: {
            datePicker
        }
    }
    </script>
