<template>
    <div>

        <div class="dashboard-detail-container">

            <div class="dashboard-detail-inner">
                <div class="item">
                    <!-- header -->
                    <div class="item-header">
                        <div>1</div>
                        <div>Employees</div>
                        <div>2</div>
                    </div>
                    <!-- body -->
                    <div class="item-body">
                        <ul style="list-style-type: none; padding: 0; margin: 0">
                            <li v-for="e in employees">{{e.name}}</li>
                        </ul>
                    </div>
                </div>
                <div class="item">
                    <!-- header -->
                    <div class="item-header">
                        <div>1</div>
                        <div>Purchase</div>
                        <div>2</div>
                    </div>
                    <!-- body -->
                    <div class="item-body">
                        <ul style="list-style-type: none; padding: 0; margin: 0">
                            <li v-for="e in purchases">{{e.subject}}</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- slide navigation -->
            <button class="dashboard-detail-nav left-nav" @click="prev()"> < </button>
            <button class="dashboard-detail-nav right-nav" @click="next()"> > </button>

        </div>

    </div>
</template>

<script>
    export default {
        name: "SideDashboardDetail",
        props: [
            'employees_data', 'purchases_data',
        ],
        data(){
            return{
                position: 0,
            }
        },
        methods:{
            next(){
                const dashboardInner = document.querySelector('.dashboard-detail-inner');
                if(this.position >= -100){
                    this.position -= 200;
                }
                else{
                    this.position = 0;
                }
                dashboardInner.style.left = this.position+"px";
            },
            prev(){
                const dashboardInner = document.querySelector('.dashboard-detail-inner');
                if(this.position <= -100){
                    this.position+=200;
                }
                else{
                    this.position = -200;
                }
                dashboardInner.style.left = this.position+"px";
            }
        },
        computed:{
            employees(){
                return this.employees_data;
            },
            purchases(){
                return this.purchases_data;
            }
        }
    }
</script>

<style scoped>
    *{
        box-sizing: border-box;
    }
    .dashboard-detail-container{
        width: 200px;
        height: 300px;
        background-color: cyan;
        position: relative;
        overflow: hidden;
        border: 1px solid #DEE2E6;
        -webkit-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.49);
        -moz-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.49);
        box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.49);
    }
    .dashboard-detail-inner{
        width: 400px;
        height: 100%;
        background-color: gray;
        position: absolute;
        left: 0;
        transition: 0.3s ease;
        display: grid;
        grid-template-columns: auto auto auto;
    }
    .item{
        width: 200px;
        display: flex;
        flex-direction: column;
    }
    .item-body{
        flex-grow: 3;
        height: 100%;
        background-color: #fff;
        padding: 10px;
        /*display: flex;*/
        /*justify-content: center;*/
        /*align-items: center;*/
    }
    .dashboard-detail-nav{
        padding: 5px;
        border-radius: 5px;
        cursor: pointer;
        border: none;
        outline: none;
        transition: 0.3s ease;
        background-color: rgb(255,255,255);
        will-change: background-color, opacity;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        opacity: 0.2;
    }
    .dashboard-detail-nav:hover{
        -webkit-box-shadow: 1px 1px 3px 1px rgba(0,0,0,0.48);
        -moz-box-shadow: 1px 1px 3px 1px rgba(0,0,0,0.48);
        box-shadow: 1px 1px 3px 1px rgba(0,0,0,0.48);
        background-color: rgb(255,255,255);
        opacity: 1;
    }
    .left-nav{
        left: 10px;
    }
    .right-nav{
        right: 10px;
    }
    .item-header{
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #1b97cc;
        padding: 10px;
        flex-grow: 1;
        color: #fff;
    }
</style>
