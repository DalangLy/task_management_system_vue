<template>
    <div>



        <div class="w-25 shadow rounded bg-light p-3 mx-auto mt-3">
            <div class="form-group">
                <label for="txtUsername">Username</label>
                <input type="text" v-model.trim="$v.userCredentials.username.$model" class="form-control" :class="{ 'is-invalid': $v.userCredentials.username.$error }" id="txtUsername" placeholder="Username" required>
                <div class="invalid-feedback" v-if="!$v.userCredentials.username.required">Field is required.</div>
            </div>
            <div class="form-group">
                <label for="txtPassword">Password</label>
                <input type="password" v-model.trim="$v.userCredentials.password.$model" class="form-control" :class="{ 'is-invalid': $v.userCredentials.password.$error }" id="txtPassword" placeholder="Password" required>
                <div class="invalid-feedback" v-if="!$v.userCredentials.password.required">Field is required.</div>
                <div class="invalid-feedback" v-if="!$v.userCredentials.password.minLength">Password must have at least {{$v.userCredentials.password.$params.minLength.min}} characters.</div>
            </div>
            <button class="btn btn-primary form-control" @click.prevent="login">Login</button>
        </div>


    </div>
</template>

<script>
    import { required, minLength } from 'vuelidate/lib/validators'

    export default {
        name: "Login",
        data(){
            return{
                userCredentials: {
                    username: '',
                    password: '',
                },
            }
        },
        validations: {
            userCredentials: {
                username: {
                    required,
                },
                password: {
                    required,
                    minLength: minLength(8),
                },
            },
        },
        methods:{
            async login(){

                if(this.isValid()){
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
                else{
                    console.log('err');
                }
            },
            isValid(){
                const userName = this.$v.userCredentials.username;
                const password = this.$v.userCredentials.password;
                return !(userName.$invalid && password.$invalid);
            }
        }
    }
</script>

<style scoped>

</style>
