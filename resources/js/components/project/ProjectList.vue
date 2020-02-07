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
            <button @click.prevent="$router.push({name: 'projects.create'})" class="btn btn-primary"><i class="fas fa-plus"></i></button>
            <input @keyup="filterSearch" type="text" class="form-control w-25" placeholder="Search">
        </div>



        <table class="table table-bordered">
            <thead class="thead-dark">
            <tr>
                <th class="text-center align-middle" scope="col">#</th>
                <th class="text-center align-middle" scope="col">Project Code</th>
                <th class="text-center align-middle" scope="col">Project</th>
                <th class="text-center align-middle" scope="col">Client Account</th>
                <th class="text-center align-middle" scope="col">Client</th>
                <th class="text-center align-middle" scope="col">Creator</th>
                <th class="text-center align-middle" scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(project, index) in allData">
                <th class="align-middle" scope="row">{{(index+1)}}</th>
                <td class="align-middle">{{project.project_code}}</td>
                <td class="align-middle">{{project.project_name}}</td>
                <td class="align-middle">{{project.client_account}}</td>
                <td class="align-middle">{{project.client_name}}</td>
                <td class="align-middle">{{project.name}}</td>
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
        name: "ProjectList",
        data(){
            return{
                projects: [],
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

                await axios.get('api/v1/projects').then(response => {
                    if(response.status === 200){
                        this.projects = response.data;
                    }
                }).catch(err => {
                    console.log(err);
                });
            },
            filterSearch(e){
                let keyword = e.target.value;

                let found = this.projects.filter(function(element) {
                    return (element.project_code+'').toString().toLowerCase().includes(keyword.toLowerCase())
                        || (element.project_name+'').toString().toLowerCase().includes(keyword.toLowerCase())
                        || (element.client_account+'').toString().toLowerCase().includes(keyword.toLowerCase())
                        || (element.client_code+'').toString().toLowerCase().includes(keyword.toLowerCase())
                        || (element.client_name+'').toString().toLowerCase().includes(keyword.toLowerCase());
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
                    return this.projects;
                else
                    return this.searchResult;
            }
        }
    }
</script>

<style scoped>

</style>
