import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex);

import TrustClientModule from "./trust_client_module";
import AuthModule from "./auth_module";

const store = new Vuex.Store({
    state: {

    },
    mutations: {

    },
    getters:{

    },
    actions:{

    },
    modules:{
        TrustClientModule,
        AuthModule,
    }
});

export default store;
