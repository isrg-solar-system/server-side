<template>

    <div style="height: 500px; width: 100%; border: 1px solid red; position: relative;">
        <vue-draggable-resizable :w="300" :h="300" v-on:dragging="onDrag" v-on:resizing="onResize" :parent="true" :grid="[30,30]">
            <div class="card" style="width: 100%;height: 105%">
                <div class="header">
                    <h4 class="title">Team Members</h4>
                </div>
                <div class="content" v-bind:style="{ width: (width + 0) + 'px', height: (height-15) + 'px' }">
                    <canvas id="mix3" count="2" :width="width " :height="height"></canvas>
                    <chartjs-line target="mix3" :data="[70, 40, 55, 80, 55]" ></chartjs-line>
                    <chartjs-bar target="mix3" :data="[20, 30, 20, 10, 5]" :labels="['A', 'B', 'C', 'D', 'E']"></chartjs-bar>
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
                width: 0,
                height: 0,
                x: 0,
                y: 0
            }
        },
        methods: {
            onResize: function (x, y, width, height) {
                this.x = x
                this.y = y
                this.width = width
                this.height = height
            },
            onDrag: function (x, y) {
                this.x = x
                this.y = y
            }
        }
    }
</script>