<template>
    <div>

        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Working Date</th>
                <th scope="col">Start Time</th>
                <th scope="col">End Time</th>
            </tr>
            </thead>
            <tbody>
                <tr v-for="(item, row) in allData[0]">
                    <th scope="row">{{(row+1)}}</th>
                    <td style="width: 250px">
                        <auto-complete v-model="item.project_detail_id" :data="allProjectDetails" selected-text="task_name" selected-value="project_detail_id"></auto-complete>
                    </td>
                    <td style="width: 250px">
                        <date-picker v-model="item.working_date"></date-picker>
                    </td>
                    <td>
                        <div>{{item.start_time}}</div>
                    </td>
                    <td>
                        <div>{{item.end_time}}</div>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="d-flex justify-content-between align-middle">
            <button @click.prevent="addRow" class="btn btn-primary">Add</button>
            <button @click.prevent="save" class="btn btn-success">Save</button>
        </div>

    </div>
</template>

<script>
    import Dalang from "./AutoCompleteSelectionOne";
    import DatePicker from "./DatePickerOne";
    export default {
        name: "TimeSheetOne",
        components:{
            'auto-complete': Dalang,
            'date-picker': DatePicker,
        },
        data() {
            return {
                allData:[
                    [

                    ]
                ],
                project_details: [],
            }
        },
        mounted(){
            this.gettingProjectDetails();
        },
        methods:{
            addRow(){
                this.allData[0].push(
                    {
                        project_detail_id: 'IZE',
                        working_date: '',
                        start_time: '01:00',
                        end_time: '03:00',
                    }
                )
            },
            showHideWorkName(row, clickedItemName){
                const workName = document.querySelector('#workName'+row);
                const workNameEditable = document.querySelector('#workNameEditable'+row);
                if(clickedItemName === 'workName'){
                    workName.classList.remove('visible');
                    workNameEditable.classList.add('visible');
                }
                else{
                    workName.classList.add('visible');
                    workNameEditable.classList.remove('visible');
                }
            },
            async save(){
                //get user token from auth module
                const userToken = JSON.parse(this.$store.getters.getUserToken);
                const accessToken = userToken[0].accessToken;
                axios.defaults.headers.common['Authorization'] = 'Bearer '+ accessToken;


                await axios.post('api/v1/timesheets/store', this.allData).then(response => {
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
    .item{
        background-color: gray;
        width: 100%;
        height: 100%;
        display: none;
    }
    .item.visible{
        display: block;
    }
    .editable-item{
        background-color: #385d7a;
        width: 100%;
        height: 100%;
        display: none;
    }
    .editable-item.visible{
        display: block;
    }
    td{
        transition: 0.3s ease;
        will-change: background-color;
        cursor: pointer;
        text-align: center;
        vertical-align: middle;
    }
    td:hover{
        background-color: #95999c;
    }
</style>
