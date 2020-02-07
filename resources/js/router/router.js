import Vue from 'vue'
import VueRouter from 'vue-router'
import store from '../vuex/store'

Vue.use(VueRouter);

import Login from '../components/Auth/Login'
import Logout from '../components/Auth/Logout'
import DashboardMaster from '../components/Dashboard/DashboardMaster'
import Dashboard from "../components/Dashboard/Dashboard";

//users
import UserMaster from '../components/Users/UserMaster'
import UserList from '../components/Users/UserList'
import AddUser from '../components/Users/AddUser'
import ProfileMaster from "../components/profile/ProfileMaster";
import Profile from "../components/profile/Profile";

//clients
import ClientMaster from "../components/Client/ClientMaster";
import ClientList from "../components/Client/ClientList";
import AddClient from "../components/Client/AddClient";
import RoleMaster from "../components/role/RoleMaster";
import RoleList from "../components/role/RoleList";
import AddRole from "../components/role/AddRole";

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
        component: DashboardMaster,
        meta: {
            requireAuth: true,
        },
        children: [
            {
                path: '/',
                name: 'dashboard',
                component: Dashboard
            },
            {
                path: '/clients',
                component: ClientMaster,
                children: [
                    {
                        path: '/clients',
                        name: 'clients',
                        component: ClientList,
                    },
                    {
                        path: '/clients/create',
                        name: 'clients.create',
                        component: AddClient,
                    }
                ]
            },
            {
                path: '/roles',
                component: RoleMaster,
                children: [
                    {
                        path: '/roles',
                        name: 'roles',
                        component: RoleList,
                    },
                    {
                        path: '/roles/create',
                        name: 'roles.create',
                        component: AddRole,
                    }
                ]
            },
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
            },
            {
                path: '/profile',
                component: ProfileMaster,
                children: [
                    {
                        path: '/profile',
                        name: 'profile',
                        component: Profile,
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
