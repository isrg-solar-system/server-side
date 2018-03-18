<template>
    <div>
        <div class="col-md-12 row first-line">
            <div class="col-md-3">
                <div class="cube">
                    <div class="head">
                        <i class="fa fa-spinner" aria-hidden="true"></i> Voltage
                    </div>
                    <div class="cubecontent first-line-cubecontent">
                        <div class="cubeblock first-line-cubecontent-block row col-md-12 pb-3 pt-2 mr-0 mp-0">
                            <div class="voltage-image col-md-3 ml-3 mr-0"></div>
                            <div class="first-line-block-content col-md-9 row pt-1">
                                <div class="blockvalue col-md-12 mt-2">{{voltage}} <span>V</span></div>
                                <!--               <div class="blocktitle col-md-12"></div> -->
                            </div>
                        </div>
                        <div class="clearFix"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="cube">
                    <div class="head">
                        <i class="fa fa-spinner" aria-hidden="true"></i> Current
                    </div>
                    <div class="cubecontent first-line-cubecontent">
                        <div class="cubeblock first-line-cubecontent-block row col-md-12 pb-3 pt-2 mr-0 mp-0">
                            <div class="current-image col-md-3 ml-3 mr-0"></div>
                            <div class="first-line-block-content col-md-9 row pt-1">
                                <div class="blockvalue col-md-12 mt-2">{{current}} <span>A</span></div>
                                <!--               <div class="blocktitle col-md-12"></div> -->
                            </div>
                        </div>
                        <div class="clearFix"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="cube">
                    <div class="head">
                        <i class="fa fa-spinner" aria-hidden="true"></i> Power
                    </div>
                    <div class="cubecontent first-line-cubecontent">
                        <div class="cubeblock first-line-cubecontent-block row col-md-12 pb-3 pt-2 mr-0 mp-0">
                            <div class="power-image col-md-3 ml-3 mr-0"></div>
                            <div class="first-line-block-content col-md-9 row pt-1">
                                <div class="blockvalue col-md-12 mt-2">{{power}} <span>W</span></div>
                                <!--               <div class="blocktitle col-md-12"></div> -->
                            </div>
                        </div>
                        <div class="clearFix"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="cube">
                    <div class="head">
                        <i class="fa fa-spinner" aria-hidden="true"></i> Last Update
                    </div>
                    <div class="cubecontent first-line-cubecontent">
                        <div class="cubeblock first-line-cubecontent-block row col-md-12 pb-3 pt-2 mr-0 mp-0">
                            <div class="time-image col-md-3 ml-3 mr-0"></div>
                            <div class="first-line-block-content col-md-9 row pt-1">
                                <div class="blockvalue col-md-12 mt-2">{{lastupdatetime}}</div>
                                <div class="blocktitle col-md-12"></div>
                            </div>
                        </div>
                        <div class="clearFix"></div>
                    </div>
                </div>
            </div>
            <div class="clearFix"></div>
        </div>
    </div>
</template>


<script>
    export default {
        data () {
            return {
                voltage:0,
                current:0,
                power:0,
                lastupdatetime:0,
            }
        },
        mounted() {
            this.gettimenow();
        },
        computed: {
            // 计算属性的 getter

        },
        methods: {
            gettimenow(){
                let dt = new Date();
                this.lastupdatetime =  dt.getHours()+":"+dt.getMinutes()+":"+dt.getSeconds();
                console.log(this.lastupdatetime)
            },
        }

    }
</script>