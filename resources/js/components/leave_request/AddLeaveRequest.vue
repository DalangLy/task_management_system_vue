<template>
    <div>

        <div class="form-group">
            <label for="txtReason">Reason</label>
            <input v-model="data.reason" style="width: 300px" type="text" class="form-control" id="txtReason" aria-describedby="reasonHelp" placeholder="Reason">
            <small id="reasonHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <div class="form-group">
            <label for="txtLeaveFrom">Leave From</label>
            <input v-model="data.leave_from" style="width: 300px" type="text" class="form-control" id="txtLeaveFrom" aria-describedby="leaveFromHelp" placeholder="Leave From">
            <small id="leaveFromHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <div class="form-group">
            <label for="txtLeaveTo">Leave To</label>
            <input v-model="data.leave_to" style="width: 300px" type="text" class="form-control" id="txtLeaveTo" aria-describedby="leaveToHelp" placeholder="Leave To">
            <small id="leaveToHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <div class="form-group">
            <button @click.prevent.stop="save" class="btn btn-primary">Save</button>
        </div>

    </div>
</template>

<script>
    export default {
        name: "AddLeaveRequest",
        data(){
            return{
                data: {
                    reason: null,
                    leave_from: '2019-10-10',
                    leave_to: '2020-01-10',
                }
            }
        },
        methods:{
            async save(){
                //get user token from auth module
                const userToken = JSON.parse(this.$store.getters.getUserToken);
                const accessToken = userToken[0].accessToken;
                axios.defaults.headers.common['Authorization'] = 'Bearer '+ accessToken;

                await axios.post('api/v1/leave_requests/store', this.data).then(response => {
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
