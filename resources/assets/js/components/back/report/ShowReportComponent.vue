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
            <vue-draggable-resizable v-for="(report,index) in reports" :key="report.id" :x="report.postion.x" :y="report.postion.y" :w="report.size.width" :h="report.size.height"  v-on:dragging="(x, y) => onDrag(report.id,x,y)" v-on:resizing="(x, y, width, height) => onResize(report.id,x, y, width, height)" :parent="true" :draggable="configable" :resizable="configable">
                <div class="card" style="width: 100%;height: 105%">
                    <div class="header row">
                        <h4 class="title col-xs-9">{{ report.title }}</h4>
                        <div class="col-xs-3 text-right" v-if="configable == true">
                            <button class="btn btn-sm btn-warning btn-icon" @click="dele(index)"><i class="fa ti-trash"></i></button>
                        </div>
                    </div>
                    <div class="content" v-bind:style="{ width: report.size.width + 'px', height: (report.size.height-(report.size.height/10)) + 'px' }">
                        <canvas :id="report.id" :count="report.data.length" width="0" height="0"></canvas>
                        <chartjs-line v-for="da,index in report.data" :target="report.id.toString()" :data="da.data" :datalabel="da.datalabel" :key="index"></chartjs-line>
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
                                    <div class=" form-group  col-md-3">
                                        <div class="pretty p-default p-curve">
                                            <input type="checkbox" name="data" />
                                            <div class="state p-primary-o">
                                                <label>Primary</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" form-group  col-md-3">
                                        <div class="pretty p-default p-curve">
                                            <input type="checkbox" name="data" />
                                            <div class="state p-primary-o">
                                                <label>Primary</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" form-group  col-md-3">
                                        <div class="pretty p-default p-curve">
                                            <input type="checkbox" name="data" />
                                            <div class="state p-primary-o">
                                                <label>Primary</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" form-group  col-md-3">
                                        <div class="pretty p-default p-curve">
                                            <input type="checkbox" name="data" />
                                            <div class="state p-primary-o">
                                                <label>Primary</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" form-group  col-md-3">
                                        <div class="pretty p-default p-curve">
                                            <input type="checkbox" name="data" />
                                            <div class="state p-primary-o">
                                                <label>Primary</label>
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
                reports:[
                    {id:1,title:'test title',postion:{x:15,y:16},size:{width: 600,height: 600}, data:[{data:[20,10,15,20],datalabel:"TestDataLabelBar"},{data:[85,20,11,17],datalabel:"TestDataLabelLine"}]},
                    {id:2,title:'test title2',postion:{x:315,y:316},size:{width:900,height: 300}, data:[{data:[20,29,27,22],datalabel:"TestDataLabelBar"},{data:[78,22,17,66],datalabel:"TestDataLabelLine"}]}
                ],
                tmp:[],
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
            this.tmp = this.reports
        },
        methods: {
            onResize(id,x, y, width, height) {
                this.x = x
                this.y = y
                this.width = width
                this.height = height
//                console.log(this.reports.find(f => f.id === id))
                this.reports.find(f => f.id === id).size = {width: width, height: height}
            },
            onDrag(id,x, y){
//                let index = this.reports.map(function (img) { return img.id }).indexOf(id)
//                this.reports[index].postion =  {x: x, y: y}
                this.reports.find(f => f.id === id).postion = {x: x, y: y}

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
//                console.log(this.reports)
                this.configable = false
                this.styleObject.border =  'none'
//                this.tmp = false
            },
            add(){
                this.addclick = true
            },
            dele(id){
                this.reports.splice(id, 1);
            }
        }
    }
</script>