<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example component.
                    </div>
                </div>
            </div>
        </div>
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
                        console.log("Err Getting Trust Client Token ", err.response);
                    }
                }).finally(() => {

                });
            }
        }
    }
</script>
