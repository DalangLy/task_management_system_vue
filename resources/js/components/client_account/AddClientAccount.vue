<template>
    <div>

        <auto-complete v-model="data.client" :data="allClient" selected-value="client_id" selected-text="client_name"></auto-complete>

        <div class="form-group">
            <label for="txtClientAccountName">Client Account Name</label>
            <input v-model="data.client_account_name" style="width: 300px" type="text" class="form-control" id="txtClientAccountName" aria-describedby="clientAccountNameHelp" placeholder="Client Account Name">
            <small id="clientAccountNameHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <div class="form-group">
            <button @click.prevent.stop="save" class="btn btn-primary">Save</button>
        </div>

    </div>
</template>

<script>
    import AutoComplete from "../Users/partials/AutoComplete";
    export default {
        name: "AddClientAccount",
        components:{
            'auto-complete': AutoComplete,
        },
        data(){
            return{
                data: {
                    client: null,
                    client_account_name: null,
                },
                clients: [],
            }
        },
        created(){
            this.gettingClients();
        },
        methods:{
            async save(){
                //get user token from auth module
                const userToken = JSON.parse(this.$store.getters.getUserToken);
                const accessToken = userToken[0].accessToken;
                axios.defaults.headers.common['Authorization'] = 'Bearer '+ accessToken;

                await axios.post('api/v1/client_accounts/store', this.data).then(response => {
                    if(response.status === 200){
                        console.log(response);
                    }
                }).catch(err => {
                    console.log(err);
                });
            },
            async gettingClients(){
                //get user token from auth module
                const userToken = JSON.parse(this.$store.getters.getUserToken);
                const accessToken = userToken[0].accessToken;
                axios.defaults.headers.common['Authorization'] = 'Bearer '+ accessToken;

                await axios.get('api/v1/clients').then(response => {
                    if(response.status === 200){
                        this.clients = response.data;
                    }
                }).catch(err => {
                    console.log(err);
                });
            }
        },
        computed:{
            allClient(){
                return this.clients;
            }
        }
    }
</script>

<style scoped>

</style>
