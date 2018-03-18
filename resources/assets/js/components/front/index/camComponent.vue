<template>

</template>


<script>
    import { chart } from 'vue-chartjs';
    export default {
        extends: chart,
        data () {
            return {
                voltage:0,
            }
        },
        props:[],
        mounted() {
            window.Echo.channel('receive')
                .listen('.xdxd', (e) => {
                    console.log('Got event...');
                    console.log(e);
                });

        },
    }
</script>