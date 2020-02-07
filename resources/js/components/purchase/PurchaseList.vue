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
            <button @click.prevent="$router.push({name: 'purchases.create'})" class="btn btn-primary"><i class="fas fa-plus"></i></button>
            <input @keyup="filterSearch" type="text" class="form-control w-25" placeholder="Search">
        </div>



        <table class="table table-bordered">
            <thead class="thead-dark">
            <tr>
                <th class="text-center align-middle" scope="col">#</th>
                <th class="text-center align-middle" scope="col">Working Code</th>
                <th class="text-center align-middle" scope="col">Task Name</th>
                <th class="text-center align-middle" scope="col">Project</th>
                <th class="text-center align-middle" scope="col">Subject</th>
                <th class="text-center align-middle" scope="col">Purchase Type</th>
                <th class="text-center align-middle" scope="col">Paid</th>
                <th class="text-center align-middle" scope="col">Description</th>
                <th class="text-center align-middle" scope="col">AE</th>
                <th class="text-center align-middle" scope="col">Approved</th>
                <th class="text-center align-middle" scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(purchase, index) in allData">
                <th class="align-middle" scope="row">{{(index+1)}}</th>
                <td class="align-middle">{{purchase.working_code}}</td>
                <td class="align-middle">{{purchase.task_name}}</td>
                <td class="align-middle">{{purchase.project_name}}</td>
                <td class="align-middle">{{purchase.subject}}</td>
                <td class="align-middle">{{purchase.purchase_type_name}}</td>
                <td class="align-middle">{{purchase.paid}}$</td>
                <td class="align-middle">{{purchase.description}}</td>
                <td class="align-middle">{{purchase.name}}</td>
                <td class="align-middle">{{purchase.approved}}</td>
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
        name: "PurchaseList",
        data(){
            return{
                purchases: [],
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

                await axios.get('api/v1/purchases').then(response => {
                    if(response.status === 200){
                        this.purchases = response.data;
                    }
                }).catch(err => {
                    console.log(err);
                });
            },
            filterSearch(e){
                let keyword = e.target.value;

                let found = this.purchases.filter(function(element) {
                    return (element.purchase_type_name+'').toString().toLowerCase().includes(keyword.toLowerCase());
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
                    return this.purchases;
                else
                    return this.searchResult;
            }
        }
    }
</script>

<style scoped>

</style>
