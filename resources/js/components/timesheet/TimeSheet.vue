<template>
    <div>

        <div class="form-group">
            <label for="txtProjectDetail">Work Name</label>
            <auto-complete v-model="data.project_detail_id" :data="allProjectDetails" selected-text="task_name" selected-value="project_detail_id" id="txtProjectDetail" aria-describedby="projectDetailHelp"></auto-complete>
            <small id="projectDetailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <div class="form-group">
            <button @click.prevent.stop="save" class="btn btn-primary">Save</button>
        </div>

    </div>
</template>

<script>
    import AutoComplete from "../Global_Components/AutoCompleteSelection";
    export default {
        name: "TimeSheet",
        components:{
            'auto-complete': AutoComplete,
        },
        data(){
            return{
                data: {
                    project_detail_id: null,
                },
                project_details: [],
            }
        },
        created(){
            this.gettingProjectDetails();
        },
        methods:{
            async save(){
                //get user token from auth module
                const userToken = JSON.parse(this.$store.getters.getUserToken);
                const accessToken = userToken[0].accessToken;
                axios.defaults.headers.common['Authorization'] = 'Bearer '+ accessToken;

                await axios.post('api/v1/timesheets/store', this.data).then(response => {
                    if(response.status === 200){
                        console.log(response);
                    }
                }).catch(err => {
                    console.log(err);
                });
            },
            async gettingProjectDetails(){
                //get user token from auth module
                const userToken = JSON.parse(this.$store.getters.getUserToken);
                const accessToken = userToken[0].accessToken;
                axios.defaults.headers.common['Authorization'] = 'Bearer '+ accessToken;

                await axios.get('api/v1/project_details').then(response => {
                    if(response.status === 200){
                        this.project_details = response.data;
                    }
                }).catch(err => {
                    console.log(err);
                });
            }
        },
        computed:{
            allProjectDetails(){
                return this.project_details;
            }
        }
    }
</script>

<style scoped>

</style>
