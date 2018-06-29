
<template>
    <div class="server-word">
        DataBase Status:{{db_status}}<br>
        Server Cpu:{{cpu_used}}%<br>
        Server Memory:{{mem_used}}%<br>
        <!--Server Memory:{{mem_used}}/{{mem}}<br>-->
        Disk Used:{{disk_used}}G/{{disk}}G
    </div>
</template>

<script>

    export default {
        data() {
            return {
                db_status:0,
                cpu_used:0,
                mem_used:0,
                mem:0,
                disk_used:0,
                disk:0,
                timer: '',
            }
        },
        created() {
            this.fetchstatus()
            this.timer = setInterval(this.fetchstatus, 3000)
        },
//        mounted(){
//            this.$nextTick(() => {
//                this.fetchstatus()
//            },1)
//        },
        methods: {
            fetchstatus(){
                axios.get('/api/server/data')
                    .then(response => {
                        // JSON responses are automatically parsed.
                        this.db_status = response.data.db_status
                        this.cpu_used =  response.data.cpu_used
                        this.mem_used = response.data.mem_used
                        this.disk_used = response.data.disk_used
                        this.disk = response.data.disk
                    })
                    .catch(e => {
                        console.log(e)
                    })
            }
        },
        beforeDestroy() {
            clearInterval(this.timer)
        }
    }
    </script>
