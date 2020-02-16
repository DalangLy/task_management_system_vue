<template>
    <div>

        <!--        &lt;!&ndash; start breadcrumb &ndash;&gt;-->
        <!--        <nav aria-label="breadcrumb">-->
        <!--            <ol class="breadcrumb">-->
        <!--                <li class="breadcrumb-item"><a href="#">Home</a></li>-->
        <!--                <li class="breadcrumb-item active" aria-current="page">Library</li>-->
        <!--            </ol>-->
        <!--        </nav>-->
        <!--        &lt;!&ndash; end breadcrumb &ndash;&gt;-->

        <div class="d-flex flex-row justify-content-end align-items-center my-3">
            <input @keyup="filterSearch" type="text" class="form-control w-25" placeholder="Search">
        </div>



        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th class="text-center align-middle" scope="col">#</th>
                <th class="text-center align-middle" scope="col">Task Name</th>
                <th class="text-center align-middle" scope="col">Account</th>
                <th class="text-center align-middle" scope="col">Fee</th>
                <th class="text-center align-middle" scope="col">Expense</th>
                <th class="text-center align-middle" scope="col">Profit/Loss</th>
                <th class="text-center align-middle" scope="col">Status</th>
                <th class="text-center align-middle" scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
                <tr v-for="(data, index) in allData">
                    <th class="align-middle" scope="row">{{index+1}}</th>
                    <td class="align-middle">{{data.task_name}}</td>
                    <td class="align-middle">{{data.client_account}}</td>
                    <td class="align-middle">{{data.fee}}$</td>
                    <td class="align-middle">{{getTotalExpense(data.project_detail_id)+getTotalPSupply(data.project_detail_id)}}$</td>
                    <td class="align-middle">{{calculateProfit(data.fee, getTotalExpense(data.project_detail_id)+getTotalPSupply(data.project_detail_id))}}$</td>
                    <td class="align-middle">{{data.finished?'Yes':'No'}}</td>
                    <td class="align-middle">
                        <button @click.prevent.stop="$router.push({name: 'dashboard.detail', params: { dashboardId: data.project_detail_id }})" class="btn btn-warning"><i class="fas fa-eye"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>


    </div>
</template>

<script>
    export default {
        name: "Dashboard",
        data(){
            return{
                works: [],
                searchResult: [],
            }
        },
        created(){
            this.gettingData();
        },
        methods:{
            async gettingData(){
                //get user token from auth module
                const userToken = JSON.parse(this.$store.getters.getUserToken);
                const accessToken = userToken[0].accessToken;
                axios.defaults.headers.common['Authorization'] = 'Bearer '+ accessToken;

                await axios.get('api/v1/dashboards').then(response => {
                    if(response.status === 200){
                        this.works = response.data;
                    }
                }).catch(err => {
                    console.log(err);
                });
            },
            filterSearch(e){
                let keyword = e.target.value;

                let found = this.works.filter(function(element) {
                    return (element.task_name+'').toString().toLowerCase().includes(keyword.toLowerCase());
                });
                if(keyword.length <= 0){
                    this.searchResult = [];
                }
                else{
                    this.searchResult = found;
                }
            },
            getTotalExpense(projectDetailId){
                const projectDetail = this.works.find(r => parseInt(r.project_detail_id) === parseInt(projectDetailId));
                let totalExpense = 0;
                let workingHours = projectDetail.working_hours;
                projectDetail.employees.forEach(employee => {
                    let minPerMonth = (60*workingHours)*30;
                    let salaryPerMin = employee.current_work_salary/minPerMonth;

                    let workingHour = this.diff(employee.start_time, employee.end_time);

                    let workingMinutes = this.getMinutes(workingHour);

                    let expenseSalary = salaryPerMin * workingMinutes;

                    totalExpense += expenseSalary;
                });
                return totalExpense;
            },
            getTotalPSupply(projectDetailId){
                const projectDetail = this.works.find(r => parseInt(r.project_detail_id) === parseInt(projectDetailId));
                let totalSupply = 0;
                projectDetail.purchases.forEach(purchase => {
                    totalSupply += purchase.paid;
                });
                return totalSupply;
            },
            calculateProfit(fee, expense){
                return parseFloat(fee) - parseFloat(expense);
            },
            getMinutes(time){
                let hour = parseInt(time.substr(0, 2));
                let minute = parseInt(time.substr(3, 5));
                let totalMinutes = 0;
                if(hour > 0){
                    totalMinutes = (hour * 60) + minute;
                }
                else{
                    totalMinutes = minute;
                }
                return totalMinutes;
            },
            diff(start, end) {
                start = start.split(":");
                end = end.split(":");
                var startDate = new Date(0, 0, 0, start[0], start[1], 0);
                var endDate = new Date(0, 0, 0, end[0], end[1], 0);
                var diff = endDate.getTime() - startDate.getTime();
                var hours = Math.floor(diff / 1000 / 60 / 60);
                diff -= hours * 1000 * 60 * 60;
                var minutes = Math.floor(diff / 1000 / 60);

                // If using time pickers with 24 hours format, add the below line get exact hours
                if (hours < 0)
                    hours = hours + 24;

                return (hours <= 9 ? "0" : "") + hours + ":" + (minutes <= 9 ? "0" : "") + minutes;
            }
        },
        computed:{
            allData(){
                if(this.searchResult.length <= 0)
                    return this.works;
                else
                    return this.searchResult;
            },
        }
    }
</script>

<style scoped>

</style>
