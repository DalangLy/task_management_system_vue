<template>
    <!-- Show Loading On Logout Page -->
    <div class="d-flex justify-content-center align-items-center my-5">
        <div class="spinner-grow text-primary" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <div class="spinner-grow text-secondary" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <div class="spinner-grow text-success" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <div class="spinner-grow text-danger" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <div class="spinner-grow text-warning" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <div class="spinner-grow text-info" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <div class="spinner-grow text-light" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <div class="spinner-grow text-dark" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Logout",
        created() {
            if(this.isUserLoggedIn){
                this.logout();
            }
        },
        methods:{
            async logout(){
                await this.$store.dispatch('logout').then(response => {
                    if(response.status === 200){
                        this.$router.push({name : 'login'});
                    }
                }).catch(err => {

                }).finally(() => {

                });
            }
        },
        computed:{
            isUserLoggedIn(){
                return this.$store.getters.isUserLoggedIn;
            }
        }
    }
</script>

<style scoped>

</style>
