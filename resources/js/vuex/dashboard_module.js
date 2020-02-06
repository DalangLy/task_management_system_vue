const DashboardModule = {
    state:{
        userInfo: [],
    },
    mutations:{
        setUserInfo(state, value){
            state.userInfo = value;
        }
    },
    getters:{
        getUserInfo(state){
            return state.userInfo;
        }
    },
    actions:{

    }
};

export default DashboardModule;
