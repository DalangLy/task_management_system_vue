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

        <div class="d-flex flex-row justify-content-between align-items-center my-3">
            <button @click.prevent="$router.push({name: 'leave_requests.create'})" class="btn btn-primary"><i class="fas fa-plus"></i></button>
            <input @keyup="filterSearch" type="text" class="form-control w-25" placeholder="Search">
        </div>



        <table class="table table-bordered">
            <thead class="thead-dark">
            <tr>
                <th class="text-center align-middle" scope="col">#</th>
                <th class="text-center align-middle" scope="col">Staff</th>
                <th class="text-center align-middle" scope="col">Reason</th>
                <th class="text-center align-middle" scope="col">From</th>
                <th class="text-center align-middle" scope="col">To</th>
                <th class="text-center align-middle" scope="col">Supervisor Approved</th>
                <th class="text-center align-middle" scope="col">Approved</th>
                <th class="text-center align-middle" scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(task_type, index) in allData">
                <th class="align-middle" scope="row">{{(index+1)}}</th>
                <td class="align-middle">{{task_type.name}}</td>
                <td class="align-middle">{{task_type.reason}}</td>
                <td class="align-middle">{{task_type.leave_from}}</td>
                <td class="align-middle">{{task_type.leave_to}}</td>
                <td class="align-middle">{{task_type.supervisor_approved?'YES':'NO'}}</td>
                <td class="align-middle">{{task_type.approved?'YES':'NO'}}</td>
                <td class="align-middle">
                    <button class="btn btn-warning"><i class="fas fa-edit"></i></button>
                </td>
            </tr>
            </tbody>
        </table>


    </div>
</template>

<script>
    export default {
        name: "LeaveRequestList",
        data(){
            return{
                leaveRequests: [],
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

                await axios.get('api/v1/leave_requests').then(response => {
                    if(response.status === 200){
                        this.leaveRequests = response.data;
                    }
                }).catch(err => {
                    console.log(err);
                });
            },
            filterSearch(e){
                let keyword = e.target.value;

                let found = this.leaveRequests.filter(function(element) {
                    return (element.name+'').toString().toLowerCase().includes(keyword.toLowerCase());
                });
                if(keyword.length <= 0){
                    this.searchResult = [];
                }
                else{
                    this.searchResult = found;
                }
            }
        },
        computed:{
            allData(){
                if(this.searchResult.length <= 0)
                    return this.leaveRequests;
                else
                    return this.searchResult;
            }
        }
    }
</script>

<style scoped>

</style>
