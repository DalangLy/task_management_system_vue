<template>
    <div>



        <div class="w-25 shadow rounded bg-light p-3 mx-auto mt-3">
            <div class="form-group">
                <label for="txtUsername">Username</label>
                <input type="text" v-model="userCredentials.username" class="form-control is-invalid" id="txtUsername" placeholder="Username" required>
                <div class="invalid-feedback">
                    Please provide a valid username.
                </div>
            </div>
            <div class="form-group">
                <label for="txtPassword">Password</label>
                <input type="password" v-model="userCredentials.password" class="form-control is-invalid" id="txtPassword" placeholder="Password" required>
                <div class="invalid-feedback">
                    Please provide a valid password.
                </div>
            </div>
            <button class="btn btn-primary form-control" @click.prevent="login">Login</button>
        </div>



    </div>
</template>

<script>
    export default {
        name: "Login",
        data(){
            return{
                userCredentials: {
                    username: '',
                    password: '',
                }
            }
        },
        methods:{
            async login(){
                await this.$store.dispatch('login', this.userCredentials).then(response => {
                    if(response.status === 200){
                        const userToken = [
                            {accessToken: response.data.access_token},
                            {refreshToken : response.data.refresh_token}
                        ];
                        this.$store.commit('setUserTokenValue', JSON.stringify(userToken));//store token in vuex state
                        localStorage.setItem('user_token', JSON.stringify(userToken));//store token to local storage
                        this.$router.push({name : 'dashboard'});
                    }
                }).catch(err => {
                    console.log('err');
                }).finally(f => {
                    //console.log(f);
                });
            }
        }
    }
</script>

<style scoped>

</style>
