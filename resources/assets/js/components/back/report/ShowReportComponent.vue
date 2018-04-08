<template>
    <div>
            <div class="row" style="width: 490px;margin-bottom:4px;">
                <div class="col-xs-1">
                    <v-spin size="large"  v-if="loading"></v-spin>
                </div>
                <div class="col-xs-1">
                    <button class="btn btn-sm btn-warning btn-icon" @click="add" ><i class="fa ti-plus"></i></button>
                </div>

                <div class="col-xs-1"  v-if="configable == false">
                    <button class="btn btn-sm btn-warning btn-icon" @click="setConfig"><i class="fa ti-pencil-alt"></i></button>
                </div>
                <div class="col-xs-1" v-if="configable == true">
                    <button class="btn btn-sm btn-warning btn-icon" @click="saveConfig"><i class="fa ti-save-alt"></i></button>
                </div>
                <div class="col-xs-1">
                    <button class="btn btn-sm btn-warning btn-icon" ><i class="fa ti-import"></i></button>
                </div>
                <div class="col-xs-1">
                    <button class="btn btn-sm btn-warning btn-icon" ><i class="fa ti-printer"></i></button>
                </div>
            </div>
        <div class="clearFix"></div>
        <div :style="styleObject">
            <vue-draggable-resizable v-for="(report,index) in reports" :key="report.id" :x="report.x" :y="report.y" :w="report.width" :h="report.height"  v-on:dragging="(x, y) => onDrag(report.id,x,y)" v-on:resizing="(x, y, width, height) => onResize(report.id,x, y, width, height)" :parent="true" :draggable="configable" :resizable="configable">
                <div class="card" style="width: 100%;height: 105%">
                    <div class="header row">
                        <h4 class="title col-xs-9">{{ report.title }}</h4>
                        <div class="col-xs-3 text-right" v-if="configable == true">
                            <button class="btn btn-sm btn-warning btn-icon" @click="dele(index)"><i class="fa ti-trash"></i></button>
                        </div>
                    </div>
                    <div class="content" v-bind:style="{ width: report.width + 'px', height: (report.height) + 'px' }">
                        <line-chart v-if="report.chart=='line'" :width='report.width-40+"px"' :height='(report.height-80)+"px"' :data="report.data" :colors="['#878787','#fffff']" :download="report.name+'.png'"></line-chart>
                        <column-chart v-if="report.chart=='bar'" :width='report.width-40+"px"' :height='(report.height-80)+"px"' :data="report.data" :colors="['#878787','#fffff']" :download="report.name+'.png'"></column-chart>
                        <area-chart v-if="report.chart=='area'" :width='report.width-40+"px"' :height='(report.height-80)+"px"' :data="report.data" :colors="['#878787','#fffff']" :download="report.name+'.png'"></area-chart>

                    </div>
                </div>
            </vue-draggable-resizable>



        </div>
        <v-modal title="Add Widget"
                 :visible="addclick"
                 ok-text="Submit"
                 cancel-text="Cancel">

            <div >
                <div style="width: 480px;padding-right: 15px;">
                    <div class="content " >
                        <form>
                            <div class="row" >
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="widgetname">Widget Name</label>
                                        <input type="text" name="widgetname" class="form-control border-input" placeholder="First Chart 1 ...">
                                    </div>
                                </div>
                                <div class="col-md-12 " style="margin-left: 10px;">
                                    <label for="widgetname">Data Select</label>
                                    <div class="clearfix"></div>
                                    <div class=" form-group  col-md-3  " v-for="data in measurement">
                                        <div class="pretty p-default p-curve">
                                            <input type="option" name="data" />
                                            <div class="state p-primary-o">
                                                <label>{{data.name}}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 " style="margin-left: 10px;">
                                    <label for="widgetname">Data Option</label>
                                    <div class="clearfix"></div>
                                    <div class="pretty p-default p-round">
                                        <input type="radio" name="radio1">
                                        <div class="state">
                                            <label>Real Time</label>
                                        </div>
                                    </div>

                                    <div class="pretty p-default p-round">
                                        <input type="radio" name="radio1">
                                        <div class="state">
                                            <label>Day</label>
                                        </div>
                                    </div>

                                    <div class="pretty p-default p-round">
                                        <input type="radio" name="radio1">
                                        <div class="state">
                                            <label>Month</label>
                                        </div>
                                    </div>

                                    <div class="pretty p-default p-round">
                                        <input type="radio" name="radio1">
                                        <div class="state">
                                            <label>Year</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12" style="margin-left: 10px;">
                                    <div class="form-group">
                                        <label>From</label>
                                        <input type="text" class="form-control border-input" placeholder="2017/1/1" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>To</label>
                                        <input type="text" class="form-control border-input" placeholder="2017/1/1" value="">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </v-modal>
    </div>



</template>

<script>
    import VueDraggableResizable from 'vue-draggable-resizable'

    Vue.component('vue-draggable-resizable', VueDraggableResizable)

    export default {
        data: function () {
            return {
                reports:[],
                measurement:[],
                width: 0,
                height: 0,
                loading:false,
                configable:false,
                styleObject: {
                    height: '840px',
                    width: '99%',
                    //border: '1px solid gray',
                    border: 'none',
                    position: 'relative',
                },
                addclick:false,
            }
        },
        created(){
//            this.tmp = this.reports

            this.getReports()
            this.getMeasurement()

        },
        methods: {
            onResize(id,x, y, width, height) {
                this.x = x
                this.y = y
                this.width = width
                this.height = height
//                console.log(this.reports.find(f => f.id === id))
                this.reports.find(f => f.id === id).width = width
                this.reports.find(f => f.id === id).height = height
            },
            onDrag(id,x, y){
//                let index = this.reports.map(function (img) { return img.id }).indexOf(id)
//                this.reports[index].postion =  {x: x, y: y}
                this.reports.find(f => f.id === id).x = x
                this.reports.find(f => f.id === id).y = y
//                console.log(this.reports)
            },
            randkey(){
                return Math.floor(Math.random() * (100 - 1 + 1)) + 1;
            },
            setConfig(){
                this.configable = true
                this.styleObject.border =  '1px solid gray'
//                this.tmp = this.reports
            },
            saveConfig(){
//                this.reports = this.tmp
                this.configable = false
                this.styleObject.border =  'none'
                this.loading = true;

                    axios.post('/api/report/update', {
                        reports : this.reports
                    }).then(response => {
                       if(response.data.status == 1){
                           this.$notification['success']({
                               message: 'Success',
                               description: 'Success to save the config in database'
                           });
                       }

                        this.loading = false;
                    });


            },
            add(){
                this.addclick = true
            },
            dele(id){
                this.reports.splice(id, 1)
            },
            getReports(){
                this.loading = true;
                const reportsurl = '/api/report/lists'
                axios.get(reportsurl).then(response => {
                    let reports = []
                    $.each(response.data,function(key, data) {
                        reports[key] =  data
                        reports[key].data = {}
                    })
                    this.reports = reports
                    console.log(this.reports)
                    this.getChartData()
                })
            },
            getChartData(){
                $.each(this.reports, function(reportkey, report) {
                    let group =  this.group
                    let dateto= this.dateto
                    let datefrom =  this.datefrom
                    let name = this.name
                    axios.post('/api/get/data', {
                        group: group,
                        dataname: name,
                        dateto: dateto,
                        datefrom:  datefrom,
                    })
                        .then(response => {
                            let dtmp = {}
                            $.each(response.data,function(key, data) {
                                dtmp[data.time] =  data.mean
                            })
                            this.data = dtmp
                        })
                        .catch(function (error) {
                            console.log(error)
                        });
                });
                this.loading = false;
            },
            getMeasurement(){
                axios.get('/api/db/measurement')
                    .then(response => {
                        // JSON responses are automatically parsed.
                        this.measurement = response.data
                    })
                    .catch(e => {
                        console.log(e)
                    })
            },
        }
    }
</script>