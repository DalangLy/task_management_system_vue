import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex);

import TrustClientModule from "./trust_client_module";
import AuthModule from "./auth_module";
import DashboardModule from "./dashboard_module";

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
        DashboardModule,
    }
});

export default store;
