const AuthModule = {
    state:{
        userToken: localStorage.getItem('user_token') || null,
    },
    mutations:{
        setUserTokenValue(state, token){
            state.userToken = token;
        },
        replaceUserTokenValue(state, newToken){
            const newUserToken = [
                {accessToken: newToken.access_token},
                {refreshToken : newToken.refresh_token}
            ];
            state.userToken = JSON.stringify(newUserToken);//store token in vuex state
            localStorage.setItem('user_token', JSON.stringify(newUserToken));//store token to local storage
        },
        clearUserTokenIfRefreshTokenExpired(state){
            localStorage.removeItem('user_token');
            state.userToken = null;
        },
        removeUserToken(state){
            state.userToken = null;
        },
    },
    getters:{
        isUserLoggedIn(state){
            return state.userToken != null;
        },
        getUserToken(state){
            return state.userToken;
        }
    },
    actions:{
        login(context, userCredentials){
            return new Promise((resolve, reject) => {

                //get trust client token from trust client module
                const trustClientToken = context.getters.getTrustClientToken;
                axios.defaults.headers.common['Authorization'] = 'Bearer '+ trustClientToken;

                //send user login credential to server
                axios.post('api/v1/login', userCredentials).then(response => {
                    resolve(response);
                }).catch(err => {
                    reject(err);
                });
            })
        },
        issueNewAccessToken(context){
            return new Promise((resolve, reject) => {
                const userToken = JSON.parse(context.state.userToken);
                const refresh_token = userToken[1].refreshToken;
                axios.post('api/v1/issue_new_access_token', {refresh_token: refresh_token}).then(response => {
                    resolve(response);
                }).catch(err => {
                    reject(err);
                });
            })
        },
        logout(context){
            if(context.getters.isUserLoggedIn){
                return new Promise((resolve, reject) => {

                    //get auth token
                    const userToken = JSON.parse(context.state.userToken);
                    const access_token = userToken[0].accessToken;
                    axios.defaults.headers.common['Authorization'] = 'Bearer '+ access_token;

                    axios.post('api/v1/logout').then(response => {
                        localStorage.removeItem('user_token');
                        context.commit('removeUserToken');
                        resolve(response);
                    }).catch(err => {
                        localStorage.removeItem('user_token');
                        context.commit('removeUserToken');
                        reject(err);
                    })
                });
            }
        },
    }
};

export default AuthModule;
