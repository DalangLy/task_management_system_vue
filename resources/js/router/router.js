import Vue from 'vue'
import VueRouter from 'vue-router'
import store from '../vuex/store'

Vue.use(VueRouter);

//auth routes
import Login from '../components/auth/Login'
import Logout from '../components/auth/Logout'

//layout routes
import Layout from '../components/dashboard/Layout'

//dashboard
import DashboardMaster from "../components/dashboard/DashboardMaster";
import Dashboard from "../components/dashboard/Dashboard";
import DashboardDetail from "../components/dashboard/DashboardDetail";

//user routes
import UserMaster from '../components/users/UserMaster'
import UserList from '../components/users/UserList'
import AddUser from '../components/users/AddUser'
import EditUser from "../components/users/EditUser";

//profile routes
import ProfileMaster from "../components/profile/ProfileMaster";
import Profile from "../components/profile/Profile";

//client routes
import ClientMaster from "../components/client/ClientMaster";
import ClientList from "../components/client/ClientList";
import AddClient from "../components/client/AddClient";

//roles routes
import RoleMaster from "../components/role/RoleMaster";
import RoleList from "../components/role/RoleList";
import AddRole from "../components/role/AddRole";

//client account routes
import ClientAccountMaster from "../components/client_account/ClientAccountMaster";
import ClientAccountList from "../components/client_account/ClientAccountList";
import AddClientAccount from "../components/client_account/AddClientAccount";

//project routes
import ProjectMaster from "../components/project/ProjectMaster";
import ProjectList from "../components/project/ProjectList";
import AddProject from "../components/project/AddProject";

//position routes
import PositionMaster from "../components/position/PositionMaster";
import PositionList from "../components/position/PositionList";
import AddPosition from "../components/position/AddPosition";

//task type routes
import TaskTypeMaster from "../components/task_type/TaskTypeMaster";
import TaskTypeList from "../components/task_type/TaskTypeList";
import AddTaskType from "../components/task_type/AddTaskType";

//work routes
import WorkMaster from "../components/work/WorkMaster";
import WorkList from "../components/work/WorkList";
import AddWork from "../components/work/AddWork";

//purchase type routes
import PurchaseTypeMaster from "../components/purchase_type/PurchaseTypeMaster";
import PurchaseTypeList from "../components/purchase_type/PurchaseTypeList";
import AddPurchaseType from "../components/purchase_type/AddPurchaseType";

//purchase routes
import PurchaseMaster from "../components/purchase/PurchaseMaster";
import PurchaseList from "../components/purchase/PurchaseList";
import AddPurchase from "../components/purchase/AddPurchase";

//leave request routes
import LeaveRequestMaster from "../components/leave_request/LeaveRequestMaster";
import LeaveRequestList from "../components/leave_request/LeaveRequestList";
import AddLeaveRequest from "../components/leave_request/AddLeaveRequest";

//time sheet routes
import TimeSheetMaster from "../components/timesheet/TimeSheetMaster";
import TimeSheet from "../components/timesheet/TimeSheet";

//
import CompanyMaster from "../components/company/CompanyMaster";
import CompanyInfo from "../components/company/CompanyInfo";

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
        component: Layout,
        meta: {
            requireAuth: true,
        },
        children: [
            {
                path: '/',
                component: DashboardMaster,
                children:[
                    {
                        path: '/',
                        name: 'dashboard',
                        component: Dashboard,
                    },
                    {
                        path: '/detail/:dashboardId',
                        name: 'dashboard.detail',
                        component: DashboardDetail,
                    }
                ]
            },
            {
                path: '/company',
                component: CompanyMaster,
                children: [
                    {
                        path: '/company',
                        name: 'company',
                        component: CompanyInfo,
                    }
                ]
            },
            {
                path: '/timesheets',
                component: TimeSheetMaster,
                children: [
                    {
                        path: '/timesheets',
                        name: 'timesheets',
                        component: TimeSheet,
                    }
                ]
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
                    },
                    {
                        path: '/users/edit/:userId',
                        name: 'users.edit',
                        component: EditUser,
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
