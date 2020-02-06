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
            <button @click.prevent="$router.push({name: 'users.create'})" class="btn btn-primary"><i class="fas fa-plus"></i></button>
            <input @keyup="filterSearch" type="text" class="form-control w-25" placeholder="Search">
        </div>



        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Handle</th>
            </tr>
            </thead>
            <tbody>
                <tr v-for="(user, index) in allUsers">
                    <th scope="row">{{index}}</th>
                    <td>{{user.name}}</td>
                    <td>{{user.username}}</td>
                    <td>{{user.email}}</td>
                </tr>
            </tbody>
        </table>


    </div>
</template>

<script>
    export default {
        name: "UserList",
        data(){
            return{
                users: [],
                searchResult: [],
            }
        },
        created(){
            this.gettingUsers();
        },
        methods:{
            async gettingUsers(){
                //get user token from auth module
                const userToken = JSON.parse(this.$store.getters.getUserToken);
                const accessToken = userToken[0].accessToken;
                axios.defaults.headers.common['Authorization'] = 'Bearer '+ accessToken;

                await axios.get('api/v1/users').then(response => {
                    if(response.status === 200){
                        this.users = response.data;
                    }
                }).catch(err => {
                    console.log(err);
                });
            },
            filterSearch(e){
                let keyword = e.target.value;

                let found = this.users.filter(function(element) {
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
            allUsers(){
                if(this.searchResult.length <= 0)
                    return this.users;
                else
                    return this.searchResult;
            }
        }
    }
</script>

<style scoped>

</style>
