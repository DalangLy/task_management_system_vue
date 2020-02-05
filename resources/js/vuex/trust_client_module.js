const TrustClientModule = {
    state:{
        trustClientToken: null,
    },
    mutations:{
        storeTrustClientTokenValue(state, token){
            state.trustClientToken = token;
        }
    },
    getters:{
        getTrustClientToken(state){
            return state.trustClientToken;
        }
    },
    actions:{
        getTrustClientToken(context){
            return new Promise((resolve, reject) => {
                axios.get('api/v1/trust_client_token').then(response => {
                    resolve(response);
                }).catch(err => {
                    reject(err);
                });
            });
        },
    }
};

export default TrustClientModule;
