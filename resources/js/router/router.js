import Vue from 'vue'
import VueRouter from 'vue-router'
import store from '../vuex/store'

Vue.use(VueRouter);

import Login from '../components/Auth/Login'
import Logout from '../components/Auth/Logout'
import Dashboard from '../components/Dashboard/DashboardMaster'

//users
import UserMaster from '../components/Users/UserMaster'
import UserList from '../components/Users/UserList'
import AddUser from '../components/Users/AddUser'

const routes = [
    {
        path: '/login',
        name: 'login',
        component: Login,
        meta:{
            requireVisitor: true,
        }
    },
    {
        path: '/logout',
        name: 'logout',
        component: Logout,
        meta: {
            requireAuth: true,
        }
    },
    {
        path: '/',
        name: 'dashboard',
        component: Dashboard,
        meta: {
            requireAuth: true,
        },
        children: [
            {
                path: '/users',
                component: UserMaster,
                children: [
                    {
                        path: '/users',
                        name: 'users',
                        component: UserList,
                    },
                    {
                        path: '/users/create',
                        name: 'users.create',
                        component: AddUser,
                    }
                ]
            }
        ]
    }
];

// 3. Create the router instance and pass the `routes` option
// You can pass in additional options here, but let's
// keep it simple for now.
const router = new VueRouter({
    routes // short for `routes: routes`
});


/*
* Protect Route to prevent user typing manual url
* */
router.beforeEach((to, from, next) => {
    /******** User **********/
    if (to.matched.some(record => record.meta.requireVisitor)){
        if (!store.getters.isUserLoggedIn) {
            next();
        } else {
            next({
                name: 'dashboard',
            });
        }
    }
    else if (to.matched.some(record => record.meta.requireAuth)){
        if (!store.getters.isUserLoggedIn) {
            next({
                name: 'login',
            });
        } else {
            next();
        }
    }
    else {
        next() // make sure to always call next()!
    }
});

export default router;
