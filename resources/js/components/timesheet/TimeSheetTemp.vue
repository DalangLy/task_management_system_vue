<template>
    <div>

        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Work Name</th>
                <th scope="col">Work Date</th>
                <th scope="col">Start Time</th>
                <th scope="col">End Time</th>
            </tr>
            </thead>
            <tbody>
<!--                <tr>-->
<!--                    <th scope="row">1</th>-->
<!--                    <td>-->
<!--                        <auto-complete :data="project_details" selected-value="project_detail_id" selected-text="task_name"></auto-complete>-->
<!--                    </td>-->
<!--                    <td>-->
<!--                        <date-picker></date-picker>-->
<!--                    </td>-->
<!--                    <td>@mdo</td>-->
<!--                    <td>@mdo</td>-->
<!--                </tr>-->

                <tr v-for="(item,index) in data">
                    <th scope="row">{{index+1}}</th>
                    <td>
                        <auto-complete :data="project_details" selected-value="project_detail_id" selected-text="task_name"></auto-complete>
                    </td>
                    <td>{{item.working_date}}</td>
                    <td>{{item.start_time}}</td>
                    <td>{{item.end_time}}</td>
                </tr>
            </tbody>
        </table>

        <analog-time-picker></analog-time-picker>

        <button @click="addRow" class="btn btn-primary">Add</button>

    </div>
</template>

<script>
    import AutoCompleteSelection from "../global_components/AutoCompleteSelection";
    import DatePicker from "../global_components/DatePicker";
    import TimePicker from "../global_components/AnalogTimePicker";
    export default {
        name: "TimeSheetTemp",
        components:{
            'auto-complete': AutoCompleteSelection,
            'date-picker': DatePicker,
            'analog-time-picker': TimePicker,
        },
        data(){
            return{
                project_details: [],
                data: [
                    {
                        working_name: 'Ize Cola',
                        working_date: '2010-10-10',
                        start_time: '09:00',
                        end_time: '18:00',
                    }
                ]
            }
        },
        mounted(){
            this.gettingProjectDetails();
        },
        methods:{
            addRow(){
                this.data.push(
                    {
                        working_name: 'Ize Cola 1',
                        working_date: '2010-10-10',
                        start_time: '09:00',
                        end_time: '18:00',
                    }
                )
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
        }
    }
</script>

<style scoped>

</style>
