<template>
    <div>
        <h1>{{data.task_name}}</h1>

        <h5>Employees</h5>
        <ul>
            <li v-for="employee in data.employees">
                Employee Name : {{employee.name}}
                Salary: {{employee.salary}}$
            </li>
        </ul>


        <h5>Supply</h5>
        <ul>
            <li v-for="purchase in data.purchases">
                <div>Subject : {{purchase.subject}}</div>
                <div>Paid : {{purchase.paid}}</div>
            </li>
        </ul>
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
