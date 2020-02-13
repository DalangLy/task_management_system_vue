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
                <th class="text-center align-middle" scope="col">#</th>
                <th class="text-center align-middle" scope="col">Avatar</th>
                <th class="text-center align-middle" scope="col">Name</th>
                <th class="text-center align-middle" scope="col">Email</th>
                <th class="text-center align-middle" scope="col">Position</th>
                <th class="text-center align-middle" scope="col">Role</th>
                <th class="text-center align-middle" scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
                <tr v-for="(user, index) in allUsers">
                    <th class="align-middle" scope="row">{{(index+1)}}</th>
                    <td class="d-flex justify-content-center align-items-center">
                        <div class="avatar-container">
                            <img v-if="user.avatar" :src="user.avatar" alt="">
                            <img v-else src="https://c7.uihere.com/icons/216/669/123/user-management-1e8bf7cb3c23335e2af745696a1e3f91.png" alt="">
                        </div>
                    </td>
                    <td class="align-middle">{{user.name}}</td>
                    <td class="align-middle">{{user.email}}</td>
                    <td class="align-middle">{{user.position}}</td>
                    <td class="align-middle">{{user.role_display_name}}</td>
                    <td class="align-middle">
                        <button @click.prevent.stop="$router.push({name: 'users.edit', params: { userId: user.id }})" class="btn btn-warning"><i class="fas fa-edit"></i></button>
                    </td>
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
    .avatar-container{
        width: 30px;
        height: 30px;
        border-radius: 3px;
        background-color: #fff;
        overflow: hidden;
        border: 1px solid lightgray;
    }
    .avatar-container img{
        width: 100%;
        height: 100%;
        vertical-align: middle;
        object-fit: cover;
    }
</style>
