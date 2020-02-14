<template>
    <div>

        <div class="form-group">
            <label for="txtProjectDetail">Work Name</label>
            <auto-complete v-model="data.project_detail_id" :data="allProjectDetails" selected-text="task_name" selected-value="project_detail_id" id="txtProjectDetail" aria-describedby="projectDetailHelp"></auto-complete>
            <small id="projectDetailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <div class="form-group">
            <label for="txtWorkingDate">Working Date</label>
            <date-picker v-model="data.working_date" id="txtWorkingDate"></date-picker>
        </div>

        <div class="form-group">
            <div class="d-inline-block">
                <label for="txtStartTime">Start</label>
                <select v-model="startHour" class="form-control" style="width: 150px;" id="txtStartTime">
                    <option v-for="(n, index) in 23" :value="index.toString().length < 2?'0'+index:index">{{index.toString().length < 2?'0'+index:index}}</option>
                </select>
            </div>
            <div class="d-inline-block">
                <label></label>
                <select v-model="startMin" class="form-control" style="width: 150px;">
                    <option v-for="(n, index) in 60" :value="index.toString().length < 2?'0'+index:index">{{index.toString().length < 2?'0'+index:index}}</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="d-inline-block">
                <label for="txtEndTime">End Date</label>
                <select v-model="endHour" class="form-control" style="width: 150px;" id="txtEndTime">
                    <option v-for="(n, index) in 23" :value="index.toString().length < 2?'0'+index:index">{{index.toString().length < 2?'0'+index:index}}</option>
                </select>
            </div>
            <div class="d-inline-block">
                <label></label>
                <select v-model="endMin" class="form-control" style="width: 150px;">
                    <option v-for="(n, index) in 60" :value="index.toString().length < 2?'0'+index:index">{{index.toString().length < 2?'0'+index:index}}</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <button @click.prevent.stop="save" class="btn btn-primary">Save</button>
        </div>

    </div>
</template>

<script>
    import AutoComplete from "../Global_Components/AutoCompleteSelection";
    import DatePicker from "../Global_Components/DatePicker";
    import TimeSelection from "../Global_Components/TimeSelection";
    export default {
        name: "TimeSheet",
        components:{
            'auto-complete': AutoComplete,
            'date-picker': DatePicker,
            'time-selection': TimeSelection,
        },
        data(){
            return{
                data: {
                    project_detail_id: null,
                    working_date: null,
                },
                startHour: '00',
                startMin: '00',
                endHour: '00',
                endMin: '00',
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

                let newData = {
                    project_detail_id: this.data.project_detail_id,
                    working_date: this.data.working_date,
                    startTime: this.startHour + ':' + this.startMin,
                    endTime: this.endHour + ':' + this.endMin,
                };

                await axios.post('api/v1/timesheets/store', newData).then(response => {
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
            },
        },
    }
</script>

<style scoped>

</style>
