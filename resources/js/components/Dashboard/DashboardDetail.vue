<template>
    <div>
        <h1>{{data.task_name}}</h1>
        <h1 v-for="employee in data.employees">{{employee.name}}</h1>
        <h1 v-for="purchase in data.purchases">{{purchase.subject}}</h1>
    </div>
</template>

<script>
    export default {
        name: "DashboardDetail",
        data(){
            return{
                data: [],
            }
        },
        created(){
            this.gettingDashboardDetail();
        },
        methods:{
            async gettingDashboardDetail(){
                await axios.get('api/v1/dashboard/detail/'+this.$route.params.dashboardId).then(response => {
                    if(response.status === 200){
                        this.data = response.data;
                    }
                }).catch(err => {
                    console.log(err);
                });
            }
        }
    }
</script>

<style scoped>

</style>
