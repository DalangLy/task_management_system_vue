<template>
    <div>

        <div class="form-group">
            <label for="txtName">Name</label>
            <input v-model="data.client_name" style="width: 300px" type="text" class="form-control" id="txtName" aria-describedby="nameHelp" placeholder="Name">
            <small id="nameHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <div class="form-group">
            <button @click.prevent.stop="save" class="btn btn-primary">Save</button>
        </div>

    </div>
</template>

<script>
    export default {
        name: "AddClient",
        data(){
            return{
                data: {
                    client_name: null,
                }
            }
        },
        methods:{
            async save(){
                //get user token from auth module
                const userToken = JSON.parse(this.$store.getters.getUserToken);
                const accessToken = userToken[0].accessToken;
                axios.defaults.headers.common['Authorization'] = 'Bearer '+ accessToken;

                await axios.post('api/v1/clients/store', this.data).then(response => {
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
