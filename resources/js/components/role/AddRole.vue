<template>
    <div>

        <div class="form-group">
            <label for="txtRoleName">Role Name</label>
            <input v-model="data.role" style="width: 300px" type="text" class="form-control" id="txtRoleName" aria-describedby="roleNameHelp" placeholder="Role Name">
            <small id="roleNameHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <div class="form-group">
            <label for="txtDisplayName">Display Name</label>
            <input v-model="data.display_name" style="width: 300px" type="text" class="form-control" id="txtDisplayName" aria-describedby="displayNameHelp" placeholder="Display Name">
            <small id="displayNameHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <div class="form-group">
            <button @click.prevent.stop="save" class="btn btn-primary">Save</button>
        </div>

    </div>
</template>

<script>
    export default {
        name: "AddRole",
        data(){
            return{
                data: {
                    role: null,
                    display_name: null,
                }
            }
        },
        methods:{
            async save(){
                //get user token from auth module
                const userToken = JSON.parse(this.$store.getters.getUserToken);
                const accessToken = userToken[0].accessToken;
                axios.defaults.headers.common['Authorization'] = 'Bearer '+ accessToken;

                await axios.post('api/v1/roles/store', this.data).then(response => {
                    if(response.status === 200){
                        console.log(response);
                    }
                }).catch(err => {
                    console.log(err);
                });
            },
        }
    }
</script>

<style scoped>

</style>
