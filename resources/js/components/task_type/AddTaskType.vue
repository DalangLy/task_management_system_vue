<template>
    <div>

        <div class="form-group">
            <label for="txtTaskType">Task Type</label>
            <input v-model="data.task_type" style="width: 300px" type="text" class="form-control" id="txtTaskType" aria-describedby="taskTypeHelp" placeholder="Task Type">
            <small id="taskTypeHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <div class="form-group">
            <button @click.prevent.stop="save" class="btn btn-primary">Save</button>
        </div>

    </div>
</template>

<script>
    export default {
        name: "AddTaskType",
        data(){
            return{
                data: {
                    task_type: null,
                }
            }
        },
        methods:{
            async save(){
                //get user token from auth module
                const userToken = JSON.parse(this.$store.getters.getUserToken);
                const accessToken = userToken[0].accessToken;
                axios.defaults.headers.common['Authorization'] = 'Bearer '+ accessToken;

                await axios.post('api/v1/task_types/store', this.data).then(response => {
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
