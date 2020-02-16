<template>
    <div>
        <router-view></router-view>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.gettingTrustClientToken();
        },
        methods:{
            async gettingTrustClientToken(){
                await this.$store.dispatch('getTrustClientToken').then(response => {
                    if(response.status === 200){
                        const trust_client_token = response.data.access_token;
                        this.$store.commit('storeTrustClientTokenValue', trust_client_token);
                    }
                }).catch(err => {
                    if(err.response.status === 401){
                        console.log("Unauthorized");
                    }
                    else{
                        console.log("Err Getting Trust client Token ", err.response);
                    }
                }).finally(() => {

                });
            }
        }
    }
</script>

<style>
    @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css');
</style>
