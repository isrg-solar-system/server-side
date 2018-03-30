<template>
    <div style="min-height: 700px; width: 99%; border: 1px solid red; position: relative;">
        <vue-draggable-resizable v-for="report in reports" :key="report.id" :x="report.postion.x" :y="report.postion.y" :w="report.size.width" :h="report.size.height"  v-on:dragging="(x, y) => onDrag(report.id,x,y)" v-on:resizing="(x, y, width, height) => onResize(report.id,x, y, width, height)" :parent="true">
            <div class="card" style="width: 100%;height: 105%">
                <div class="header">
                    <h4 class="title">{{ report.title }}</h4>
                </div>
                <div class="content" v-bind:style="{ width: report.size.width + 'px', height: (report.size.height-(report.size.height/10)) + 'px' }">
                    <canvas :id="report.id" :count="report.data.length" width="0" height="0"></canvas>
                    <chartjs-line v-for="da in report.data"  :target="report.id.toString()" :data="da.data" :datalabel="da.datalabel" ></chartjs-line>
                </div>
            </div>
        </vue-draggable-resizable>
    </div>

</template>

<script>
    import VueDraggableResizable from 'vue-draggable-resizable'

    Vue.component('vue-draggable-resizable', VueDraggableResizable)

    export default {
        data: function () {
            return {
                reports:[
                    {id:1,title:'test title',postion:{x:15,y:16},size:{width: 600,height: 600}, data:[{chart:'bar',data:[20,10,15,20],datalabel:"TestDataLabelBar"},{chart:'line',data:[85,20,11,17],datalabel:"TestDataLabelLine"}]},
                    {id:2,title:'test title2',postion:{x:315,y:316},size:{width:500,height: 900}, data:[{chart:'bar',data:[20,29,27,22],datalabel:"TestDataLabelBar"},{chart:'line',data:[78,22,17,66],datalabel:"TestDataLabelLine"}]}
                ],
                width: 0,
                height: 0,
            }
        },
        created(){

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

                console.log(this.reports)
            }
        }
    }
</script>