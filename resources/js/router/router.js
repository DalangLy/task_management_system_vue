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

//roles
import RoleMaster from "../components/role/RoleMaster";
import RoleList from "../components/role/RoleList";
import AddRole from "../components/role/AddRole";

//client account
import ClientAccountMaster from "../components/client_account/ClientAccountMaster";
import ClientAccountList from "../components/client_account/ClientAccountList";
import AddClientAccount from "../components/client_account/AddClientAccount";

//project
import ProjectMaster from "../components/project/ProjectMaster";
import ProjectList from "../components/project/ProjectList";
import AddProject from "../components/project/AddProject";

//position
import PositionMaster from "../components/position/PositionMaster";
import PositionList from "../components/position/PositionList";
import AddPosition from "../components/position/AddPosition";

//task type
import TaskTypeMaster from "../components/task_type/TaskTypeMaster";
import TaskTypeList from "../components/task_type/TaskTypeList";
import AddTaskType from "../components/task_type/AddTaskType";

//work
import WorkMaster from "../components/work/WorkMaster";
import WorkList from "../components/work/WorkList";
import AddWork from "../components/work/AddWork";

//purchase type
import PurchaseTypeMaster from "../components/purchase_type/PurchaseTypeMaster";
import PurchaseTypeList from "../components/purchase_type/PurchaseTypeList";
import AddPurchaseType from "../components/purchase_type/AddPurchaseType";

//purchase
import PurchaseMaster from "../components/purchase/PurchaseMaster";
import PurchaseList from "../components/purchase/PurchaseList";
import AddPurchase from "../components/purchase/AddPurchase";

//leave request
import LeaveRequestMaster from "../components/leave_request/LeaveRequestMaster";
import LeaveRequestList from "../components/leave_request/LeaveRequestList";
import AddLeaveRequest from "../components/leave_request/AddLeaveRequest";

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
                path: '/client_accounts',
                component: ClientAccountMaster,
                children: [
                    {
                        path: '/client_accounts',
                        name: 'client_accounts',
                        component: ClientAccountList
                    },
                    {
                        path: '/client_accounts/create',
                        name: 'client_accounts.create',
                        component: AddClientAccount
                    }
                ]
            },
            {
                path: '/projects',
                component: ProjectMaster,
                children: [
                    {
                        path: '/projects',
                        name: 'projects',
                        component: ProjectList,
                    },
                    {
                        path: '/projects/create',
                        name: 'projects.create',
                        component: AddProject,
                    }
                ]
            },
            {
                path: '/positions',
                component: PositionMaster,
                children: [
                    {
                        path: '/positions',
                        name: 'positions',
                        component: PositionList,
                    },
                    {
                        path: '/positions/create',
                        name: 'positions.create',
                        component: AddPosition,
                    }
                ]
            },
            {
                path: '/task_types',
                component: TaskTypeMaster,
                children: [
                    {
                        path: '/task_types',
                        name: 'task_types',
                        component: TaskTypeList,
                    },
                    {
                        path: '/task_types/create',
                        name: 'task_types.create',
                        component: AddTaskType,
                    }
                ]
            },
            {
                path: '/works',
                component: WorkMaster,
                children: [
                    {
                        path: '/works',
                        name: 'works',
                        component: WorkList,
                    },
                    {
                        path: '/works/create',
                        name: 'works.create',
                        component: AddWork,
                    }
                ]
            },
            {
                path: '/purchase_types',
                component: PurchaseTypeMaster,
                children: [
                    {
                        path: '/purchase_types',
                        name: 'purchase_types',
                        component: PurchaseTypeList,
                    },
                    {
                        path: '/purchase_types/create',
                        name: 'purchase_types.create',
                        component: AddPurchaseType,
                    }
                ]
            },
            {
                path: '/purchases',
                component: PurchaseMaster,
                children: [
                    {
                        path: '/purchases',
                        name: 'purchases',
                        component: PurchaseList,
                    },
                    {
                        path: '/purchases/create',
                        name: 'purchases.create',
                        component: AddPurchase,
                    }
                ]
            },
            {
                path: '/leave_requests',
                component: LeaveRequestMaster,
                children: [
                    {
                        path: '/leave_requests',
                        name: 'leave_requests',
                        component: LeaveRequestList,
                    },
                    {
                        path: '/leave_requests/create',
                        name: 'leave_requests.create',
                        component: AddLeaveRequest,
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
