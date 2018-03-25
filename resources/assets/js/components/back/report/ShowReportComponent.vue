
<template>
    <div>
        <button @click="add()"></button>
        <div v-for="element in myArray">

        </div>
    </div>

</template>

<script>

    export default {
        data() {
            return {
                myArray:[]
            }
        },
        created() {

        },
        methods: {
            add(){
                this.myArray.push('s')
            }
        },
        beforeDestroy() {

        }
    }
    </script>
