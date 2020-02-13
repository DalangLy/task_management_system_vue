<template>
    <div>

        <div class="form-group">
            <label for="txtClient">Clients</label>
            <auto-complete v-model="clientId" :data="allClient" selected-value="client_id" selected-text="client_name" id="txtClient"></auto-complete>
        </div>

        <div class="form-group">
            <label for="txtClientAccount">Client Account</label>
            <auto-complete v-model="clientAccountId" :data="allClientAccounts" selected-value="client_account_id" selected-text="client_account" id="txtClientAccount"></auto-complete>
        </div>

        <div class="form-group">
            <label for="txtProject">Projects</label>
            <auto-complete v-model="data.project_id" :data="allProjects" selected-value="project_id" selected-text="project_name" id="txtProject"></auto-complete>
        </div>

        <div class="form-group">
            <label for="txtTaskType">Task Types</label>
            <auto-complete v-model="data.task_type_id" :data="allTaskTypes" selected-value="task_type_id" selected-text="task_type" id="txtTaskType"></auto-complete>
        </div>


        <div class="form-group">
            <label for="txtTaskName">Task Name</label>
            <input v-model="data.task_name" style="width: 300px" type="text" class="form-control" id="txtTaskName" aria-describedby="taskNameHelp" placeholder="Task Name">
            <small id="taskNameHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <div class="form-group">
            <label for="txtFee">Fee</label>
            <input v-model="data.fee" style="width: 300px" type="text" class="form-control" id="txtFee" aria-describedby="feeHelp" placeholder="Fee">
            <small id="feeHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <div class="form-group">
            <label for="txtStartDate">Start Date</label>
            <date-picker v-model="data.start_date" id="txtStartDate" aria-describedby="startDateHelp"></date-picker>
            <small id="startDateHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>



        <div class="form-group">
            <label for="txtEndDate">End Date</label>
            <date-picker v-model="data.end_date" id="txtEndDate" aria-describedby="endDateHelp"></date-picker>
            <small id="endDateHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <div class="form-group">
            <button @click.prevent.stop="save" class="btn btn-primary">Save</button>
        </div>



    </div>
</template>

<script>
    import AutoComplete from "../Global_Components/AutoCompleteSelection";
    import DatePicker from "../Global_Components/DatePicker";
    export default {
        name: "AddWork",
        components:{
            'auto-complete': AutoComplete,
            'date-picker': DatePicker,
        },
        data(){
            return{
                data: {
                    project_id: null,
                    task_type_id: null,
                    task_name: null,
                    fee: null,
                    start_date:  "2019-10-10",
                    end_date: "2020-10-10",
                },
                clients: [],
                clientAccounts: [],
                projects: [],
                taskTypes: [],
                clientId: null,
                clientAccountId: null,
                selectedDate: null,
            }
        },
        created(){
            this.gettingClients();
            this.gettingClientAccounts();
            this.gettingProjects();
            this.gettingTaskTypes();
        },
        methods:{
            async save(){
                //get user token from auth module
                const userToken = JSON.parse(this.$store.getters.getUserToken);
                const accessToken = userToken[0].accessToken;
                axios.defaults.headers.common['Authorization'] = 'Bearer '+ accessToken;

                await axios.post('api/v1/works/store', this.data).then(response => {
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
            },
            async gettingClientAccounts(){
                //get user token from auth module
                const userToken = JSON.parse(this.$store.getters.getUserToken);
                const accessToken = userToken[0].accessToken;
                axios.defaults.headers.common['Authorization'] = 'Bearer '+ accessToken;

                await axios.get('api/v1/client_accounts').then(response => {
                    if(response.status === 200){
                        this.clientAccounts = response.data;
                    }
                }).catch(err => {
                    console.log(err);
                });
            },
            async gettingProjects(){
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
            async gettingTaskTypes(){
                //get user token from auth module
                const userToken = JSON.parse(this.$store.getters.getUserToken);
                const accessToken = userToken[0].accessToken;
                axios.defaults.headers.common['Authorization'] = 'Bearer '+ accessToken;

                await axios.get('api/v1/task_types').then(response => {
                    if(response.status === 200){
                        this.taskTypes = response.data;
                    }
                }).catch(err => {
                    console.log(err);
                });
            }
        },
        computed:{
            allClient(){
                return this.clients;
            },
            allClientAccounts(){
                return this.clientAccounts.filter(r => parseInt(r.client_id) === this.clientId);
            },
            allProjects(){
                return this.projects.filter(r => parseInt(r.client_account_id) === this.clientAccountId);
            },
            allTaskTypes(){
                return this.taskTypes;
            }
        },
    }
</script>

<style scoped>

</style>
