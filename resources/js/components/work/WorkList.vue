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
            <button @click.prevent="$router.push({name: 'works.create'})" class="btn btn-primary"><i class="fas fa-plus"></i></button>
            <input @keyup="filterSearch" type="text" class="form-control w-25" placeholder="Search">
        </div>



        <table class="table table-bordered">
            <thead class="thead-dark">
            <tr>
                <th class="text-center align-middle" scope="col">#</th>
                <th class="text-center align-middle" scope="col">Task Name</th>
                <th class="text-center align-middle" scope="col">Project Name</th>
                <th class="text-center align-middle" scope="col">Task Type</th>
                <th class="text-center align-middle" scope="col">Fee</th>
                <th class="text-center align-middle" scope="col">Start Date</th>
                <th class="text-center align-middle" scope="col">End Date</th>
                <th class="text-center align-middle" scope="col">AE</th>
                <th class="text-center align-middle" scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(work, index) in allData">
                <th class="align-middle" scope="row">{{(index+1)}}</th>
                <td class="align-middle">{{work.task_name}}</td>
                <td class="align-middle">{{work.project_name}}</td>
                <td class="align-middle">{{work.task_type}}</td>
                <td class="align-middle">{{work.fee}}$</td>
                <td class="align-middle">{{work.start_date}}</td>
                <td class="align-middle">{{work.end_date}}</td>
                <td class="align-middle">{{work.name}}</td>
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
        name: "WorkList",
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

                await axios.get('api/v1/works').then(response => {
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
            }
        },
        computed:{
            allData(){
                if(this.searchResult.length <= 0)
                    return this.works;
                else
                    return this.searchResult;
            }
        }
    }
</script>

<style scoped>

</style>
