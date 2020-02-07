<template>
    <div>

        <div class="form-group">
            <label for="txtPosition">Position</label>
            <input v-model="data.position" style="width: 300px" type="text" class="form-control" id="txtPosition" aria-describedby="positionHelp" placeholder="Position">
            <small id="positionHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <div class="form-group">
            <button @click.prevent.stop="save" class="btn btn-primary">Save</button>
        </div>

    </div>
</template>

<script>
    export default {
        name: "AddPosition",
        data(){
            return{
                data: {
                    position: null,
                },
            }
        },
        methods:{
            async save(){
                //get user token from auth module
                const userToken = JSON.parse(this.$store.getters.getUserToken);
                const accessToken = userToken[0].accessToken;
                axios.defaults.headers.common['Authorization'] = 'Bearer '+ accessToken;

                await axios.post('api/v1/positions/store', this.data).then(response => {
                    if(response.status === 200){
                        console.log(response);
                    }
                }).catch(err => {
                    console.log(err);
                });
            },
        },
    }
</script>

<style scoped>

</style>
