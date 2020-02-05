import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter);

import Login from '../components/Login/Login'
import Dashboard from '../components/Dashboard/DashboardMaster'

const routes = [
    {
        path: '/login',
        component: Login,
    },
    {
        path: '/',
        component: Dashboard
    }
];

// 3. Create the router instance and pass the `routes` option
// You can pass in additional options here, but let's
// keep it simple for now.
const router = new VueRouter({
    routes // short for `routes: routes`
});

export default router;
