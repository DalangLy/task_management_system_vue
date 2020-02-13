<template>
    <div>

        <auto-complete v-model="data.client_account" :data="allClientAccounts" selected-text="client_account" selected-value="client_account_id"></auto-complete>

        <div class="form-group">
            <label for="txtProjectName">Project Name</label>
            <input v-model="data.project_name" style="width: 300px" type="text" class="form-control" id="txtProjectName" aria-describedby="projectNameHelp" placeholder="Project Name">
            <small id="projectNameHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <div class="form-group">
            <button @click.prevent.stop="save" class="btn btn-primary">Save</button>
        </div>

    </div>
</template>

<script>
    import AutoComplete from "../Users/partials/AutoCompleteSelection";
    export default {
        name: "AddProject",
        components:{
            'auto-complete': AutoComplete,
        },
        data(){
            return{
                data: {
                    client_account: null,
                    project_name: null,
                },
                client_accounts: [],
            }
        },
        created(){
            this.gettingClientAccounts();
        },
        methods:{
            async save(){
                //get user token from auth module
                const userToken = JSON.parse(this.$store.getters.getUserToken);
                const accessToken = userToken[0].accessToken;
                axios.defaults.headers.common['Authorization'] = 'Bearer '+ accessToken;

                await axios.post('api/v1/projects/store', this.data).then(response => {
                    if(response.status === 200){
                        console.log(response);
                    }
                }).catch(err => {
                    console.log(err);
                });
            },
            async gettingClientAccounts(){
                //get user token from auth module
                const userToken = JSON.parse(this.$store.getters.getUserToken);
                const accessToken = userToken[0].accessToken;
                axios.defaults.headers.common['Authorization'] = 'Bearer '+ accessToken;

                await axios.get('api/v1/client_accounts').then(response => {
                    if(response.status === 200){
                        this.client_accounts = response.data;
                    }
                }).catch(err => {
                    console.log(err);
                });
            }
        },
        computed:{
            allClientAccounts(){
                return this.client_accounts;
            }
        }
    }
</script>

<style scoped>

</style>
