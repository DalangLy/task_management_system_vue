<template>
    <div @click.prevent="windowClickEvent()">
        <!--start sidebar-->
        <div class="sidebar" @mouseover="maximizeSideBarOnMouseOver" @mouseout="minimizeSideBarOnMouseOver">
            <div class="sidebar-inner">

                <!-- start side bar logo -->
                <div @click.prevent="$router.push({name : 'dashboard'})" class="sidebar-logo">
                    <div class="peers">
                        <div class="sidebar-logo-image">
                            <img src="storage/logo/oxygen logo.png" alt="Company Logo">
                        </div>
                        <span class="sidebar-logo-title"><img src="storage/logo/oxygen logo.png" alt="Oxygen"></span>
                    </div>
                </div>
                <!-- end side bar logo -->

                <!-- start sidebar menu -->
                <ul class="sidebar-menu">
                    <li class="nav-item mT-30">
                        <span class="sidebar-link">
                            <span class="icon-holder"><i class="fas fa-address-card" style="color: red;"></i></span>
                            <span class="title" @click.prevent="$router.push({name: 'dashboard'})">Dashboard</span>
                        </span>
                    </li>
                    <li class="nav-item">
                        <span class="sidebar-link">
                            <span class="icon-holder"><i class="fas fa-users" style="color: purple;"></i></span>
                            <span @click.prevent="$router.push({name: 'users'})" class="title">Users</span>
                        </span>
                    </li>
                    <li class="nav-item">
                        <span class="sidebar-link">
                            <span class="icon-holder"><i class="fab fa-accusoft" style="color:blue"></i></span>
                            <span class="title">Clients</span>
                        </span>
                    </li>
                    <li class="nav-item">
                        <span class="sidebar-link">
                            <span class="icon-holder"><i class="fas fa-user-tag" style="color: pink"></i></span>
                            <span class="title">Roles</span>
                        </span>
                    </li>
                    <li class="nav-item">
                        <span class="sidebar-link">
                            <span class="icon-holder"><i class="fas fa-mug-hot" style="color: green"></i></span>
                            <span class="title">Client Accounts</span>
                        </span>
                    </li>
                    <li class="nav-item">
                        <span class="sidebar-link">
                            <span class="icon-holder"><i class="fas fa-project-diagram" style="color: cyan"></i></span>
                            <span class="title">Projects</span>
                        </span>
                    </li>
                    <li class="nav-item">
                        <span class="sidebar-link">
                            <span class="icon-holder"><i class="fas fa-briefcase" style="color: yellow"></i></span>
                            <span class="title">Time Sheet</span>
                        </span>
                    </li>
                    <li class="nav-item">
                        <span class="sidebar-link">
                            <span class="icon-holder"><i class="fas fa-crosshairs" style="color: gray"></i></span>
                            <span class="title">Positions</span>
                        </span>
                    </li>
                    <li class="nav-item">
                        <span class="sidebar-link">
                            <span class="icon-holder"><i class="fas fa-adjust" style="color: green"></i></span>
                            <span class="title">Leave Request</span>
                        </span>
                    </li>


                </ul>
                <!-- end sidebar menu -->

            </div>
        </div>
        <!--end sidebar-->

        <!--start page container-->
        <div class="page-container">

            <!--start header-->
            <div class="header">
                <div class="header-container">
                    <ul class="nav-left">

                        <!-- start sidebar toggle button -->
                        <li class="sidebar-toggle" @click.prevent="toggleSidebarOnClick"><i class="fas fa-bars"></i></li>
                        <!-- end sidebar toggle button -->

                    </ul>
                    <ul class="nav-right">

                        <!-- start left nav user avatar and name container-->
                        <li class="user-avatar-and-name-container" @click="showUpUserAccountDropDown">

                            <!-- start user avatar -->
                            <div class="user-avatar">
                                <img v-if="userData.avatar" :src="userData.avatar">
                                <img v-else src="https://c7.uihere.com/icons/216/669/123/user-management-1e8bf7cb3c23335e2af745696a1e3f91.png">
                            </div>
                            <!-- end user avatar -->

                            <!-- start user name -->

                            <span class="username">{{userData.name}}</span>

                            <!-- end user name -->

                            <!-- start account dropdown container -->
                            <div class="user-account-dropdown-container">
                                <div class="user-account-dropdown-container-inner">
                                    <span @click.prevent.stop="$router.push({name: 'profile'})" class="user-account-dropdown-item"><i class="fas fa-user-circle"></i> Account</span>
                                    <span @click.prevent.stop="$router.push({name : 'logout'});" class="user-account-dropdown-item"><i class="fas fa-sign-out-alt"></i> Logout</span>
                                </div>
                            </div>
                            <!-- end account dropdown container -->

                        </li>
                        <!-- end left nav user avatar and name container-->

                    </ul>
                </div>
            </div>
            <!--end header-->

            <!--start main-->
            <main class="main-content">
                <div>
                    <router-view></router-view>
                </div>
            </main>
            <!--end main-->

            <!--start footer-->
            <footer>
                <div class="footer-content">Copyright © 2017 Designed by Dalang. All rights reserved.</div>
            </footer>
            <!--end footer-->

        </div>
        <!--end page container-->
    </div>
</template>

<script>
    export default {
        name: "DashboardMaster",
        data(){
            return {
                isSidebarOpen: true,
                isUserAccountDropdownOpen: false,
                userData: [],
            }
        },
        created(){
            this.getUserInfo();
        },
        methods:{
            async getUserInfo(){
                //get user token from auth module
                const userToken = JSON.parse(this.$store.getters.getUserToken);
                const accessToken = userToken[0].accessToken;
                axios.defaults.headers.common['Authorization'] = 'Bearer '+ accessToken;

                await axios.get('api/v1/user').then(response => {
                    if(response.status === 200){
                        this.userData = response.data;
                        this.$store.commit('setUserInfo', response.data);
                    }
                }).catch(err => {
                    if(err.response.status === 401){//check if unauthorized of access token expired
                        if(this.isStudentLoggedIn){//if student already logged in so it mean access token expired, thus issue new access token using refresh token
                            this.requestNewAccessToken();
                        }
                    }
                });
            },
            async requestNewAccessToken(){
                await this.$store.dispatch('issueNewUserAccessToken').then(response => {
                    if(response.status === 200) {//200 = success and return new access token and refresh token
                        this.$store.commit('replaceUserTokenValue', response.data);//store token in vuex state
                        this.getUserInfo();
                    }
                }).catch(err => {
                    if(err.response.status === 401){
                        this.$store.commit('clearUserTokenIfRefreshTokenExpired');
                        location.reload();//reload page to check login condition again
                    }
                })
            },
            toggleSidebarOnClick(){
                const header = document.querySelector('.header');
                const sidebar = document.querySelector('.sidebar');
                const pageContainer = document.querySelector('.page-container');

                if(this.isSidebarOpen){
                    //close
                    header.classList.add('collapsed');
                    sidebar.classList.add('collapsed');
                    pageContainer.classList.add('collapsed');
                    this.showSideBarLogoTitle(false);
                }
                else{
                    //open
                    header.classList.remove('collapsed');
                    sidebar.classList.remove('collapsed');
                    pageContainer.classList.remove('collapsed');
                    this.showSideBarLogoTitle(true);
                }
                this.isSidebarOpen = !this.isSidebarOpen;
            },
            maximizeSideBarOnMouseOver(e){
                const sidebar = document.querySelector('.sidebar');
                if(sidebar.classList.contains('collapsed') && !this.isSidebarOpen){ //accur only when sidebar is collapsed
                    //console.log('side bar is collapsed');
                    sidebar.classList.remove('collapsed');
                    this.showSideBarLogoTitle(true);
                }
            },
            minimizeSideBarOnMouseOver(e){
                const sidebar = document.querySelector('.sidebar');
                if(!sidebar.classList.contains('collapsed') && !this.isSidebarOpen){ //accur only when sidebar is collapsed
                    //console.log('side bar is not collapsed');
                    sidebar.classList.add('collapsed');
                    this.showSideBarLogoTitle(false);
                }
            },
            showSideBarLogoTitle(isShow){
                const sidebarLogoTitle = document.querySelector('.sidebar-logo-title');
                if(isShow){
                    sidebarLogoTitle.classList.remove('collapsed');
                }else{
                    sidebarLogoTitle.classList.add('collapsed');
                }
            },
            showUpUserAccountDropDown(e){
                e.stopPropagation();
                const userAccountDropDown = document.querySelector('.user-account-dropdown-container');
                if(this.isUserAccountDropdownOpen){
                    userAccountDropDown.classList.remove('open');
                }else{
                    userAccountDropDown.classList.add('open');
                }
                this.isUserAccountDropdownOpen = !this.isUserAccountDropdownOpen;
            },
            windowClickEvent(){
                const userAccountDropDown = document.querySelector('.user-account-dropdown-container');
                if(this.isUserAccountDropdownOpen){
                    userAccountDropDown.classList.remove('open');
                    this.isUserAccountDropdownOpen = !this.isUserAccountDropdownOpen;
                }
            }
        },
        computed:{
            isStudentLoggedIn(){
                return this.$store.getters.isUserLoggedIn;
            }
        }
    }
</script>

<style scoped>
    *{
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    }
    body{
        color: #757575;
    }

    ul{
        padding: 0;
        margin: 0;
        list-style: none;
    }

    /*start page container style*/
    .page-container{
        padding-left: 280px;
        width: 100%;
        transition: all 0.3s ease;
        -webkit-transition: all 0.3s ease;
        -o-transition: all 0.3s ease;
    }
    .page-container.collapsed{
        padding-left: 70px;
    }
    /*end page container style*/

    /*start header style*/
    .header{
        position: fixed;
        right: 0;
        top: 0;
        left: 0;
        height: 60px;
        border-bottom: 1px solid rgba(0,0,0,.0625);
        transition: all 0.3s ease;
        -webkit-transition: all 0.3s ease;
        -o-transition: all 0.3s ease;
        background-color: #fff;
        z-index: 100;
        padding-left: 280px; /* use padding over margin because it not affect width */
    }
    .header.collapsed{
        padding-left: 70px;
    }
    .header-container{
        height: 100%;
        clear: both;
        content: "";
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .nav-left{
        float: left;
        margin-left: 10px;
    }
    .nav-right{
        float: right;
        margin-right: 10px;
    }
    /*end header style*/

    /*start side bar style*/
    .sidebar{
        width: 280px;
        position: fixed;
        bottom: 0;
        left: 0;
        top: 0;
        background-color: #fff;
        z-index: 1000;
        border-right: 1px solid rgba(0,0,0,.0625);
        transition: all 0.3s ease;
        -webkit-transition: all 0.3s ease;
        -o-transition: all 0.3s ease;
        overflow: hidden;
    }
    .sidebar.collapsed{
        width: 70px;
    }
    .sidebar-inner{
        width: 280px;
        height: 100%;
    }
    /*end side bar style*/


    /*start main content style*/
    .main-content{
        background-color: #f9fafb;
        min-height: 100vh;
        padding: 10px;
        margin-top: 60px; /* to avoid hide content behind header */
    }
    /*end main content style*/

    /*start footer style*/
    footer{
        height: 70px;
        width: 100%;
        background-color: #fff;
        border-top: 1px solid rgba(0,0,0,.0625);
    }
    .footer-content{
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    /*end footer style*/

    /* start sidebar toggle button style */
    .sidebar-toggle{
        border: none;
        background: none;
        outline: none;
        cursor: pointer;
        font-size: 20px;
    }
    /* end sidebar toggle button style */

    /* start user avatar style*/
    .user-avatar{
        width: 40px;
        height: 40px;
        background-color: #fff;
        border-radius: 50%;
        border: 2px solid #FFC000;
        cursor: pointer;
        overflow: hidden;
    }
    .user-avatar img{
        width: 100%;
        height: 100%;
        object-fit: cover;
        vertical-align: middle;
    }
    /* start user avatar style*/

    /*start side bar logo style*/
    .sidebar-logo{
        width: 100%;
        height: 60px;
        padding: 10px 5%; /* use percentage to get better sidebar collapsed style */
        border-bottom: 1px solid rgba(0,0,0,.0625);
        display: flex;
        justify-content: flex-start;
        align-items: center;
        cursor: pointer;
        -webkit-user-select: none; /* Safari 3.1+ */
        -moz-user-select: none; /* Firefox 2+ */
        -ms-user-select: none; /* IE 10+ */
        user-select: none; /* Standard syntax */
        text-decoration: none;
        color: inherit;
    }
    .peers{
        display: flex;
        flex-direction: row;
        align-items: center;
        transition: all 0.3s ease;
        -webkit-transition: all 0.3s ease;
        -o-transition: all 0.3s ease;
    }
    .sidebar-logo-image{
        width: 40px;
        height: 40px;
        transition: all 0.3s ease;
        -webkit-transition: all 0.3s ease;
        -o-transition: all 0.3s ease;
    }
    .sidebar-logo-image img{
        width: 100%;
        height: 100%;
        object-fit: contain;
        vertical-align: middle;
        transition: all 0.3s ease;
        -webkit-transition: all 0.3s ease;
        -o-transition: all 0.3s ease;
    }
    .sidebar-logo-title{
        height: 20px;
        margin-left: 20px;
        display: block;
        transition: all 0.3s ease;
        -webkit-transition: all 0.3s ease;
        -o-transition: all 0.3s ease;
        opacity: 1;
    }
    .sidebar-logo-title img{
        height: 100%;
        vertical-align: middle;
    }
    .sidebar-logo-title.collapsed{
        opacity: 0;
    }
    /*end side bar logo style*/


    /* start right nav user avatar and name container style */
    .user-avatar-and-name-container{
        display: flex;
        flex-direction: row;
        align-items: center;
        cursor: pointer;
        -webkit-user-select: none; /* Safari 3.1+ */
        -moz-user-select: none; /* Firefox 2+ */
        -ms-user-select: none; /* IE 10+ */
        user-select: none; /* Standard syntax */
        border: 1px solid #E3E5ED;
        padding: 2px 4px;
        border-radius: 35px;
    }
    .user-avatar-and-name-container .username{
        margin-left: 5px;
    }
    /* end right nav user avatar and name container style */

    /* start user account dropdown container style */
    .user-account-dropdown-container{
        width: 150px;
        background-color: #fff;
        position: absolute;
        top: 65px;
        right: 5px;
        border: 1px solid rgba(0,0,0,.0625);
        z-index: 1001;
        border-radius: 5px;
        -webkit-box-shadow: 0px 0px 5px 0px rgba(168,168,168,1);
        -moz-box-shadow: 0px 0px 5px 0px rgba(168,168,168,1);
        box-shadow: 0px 0px 5px 0px rgba(168,168,168,1);
        transition: all 0.3s ease;
        -webkit-transition: all 0.3s ease;
        -o-transition: all 0.3s ease;
        transform: translateX(160px);
        -webkit-transform: translateX(160px);
        -o-transform: translateX(160px);
    }
    .user-account-dropdown-container.open{
        transform: translateX(0);
        -webkit-transform: translateX(0);
        -o-transform: translateX(0);
    }
    .user-account-dropdown-container-inner{
        padding: 10px;
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .user-account-dropdown-item{
        text-decoration: none;
        margin: 10px;
        color: inherit;
        transition: color 0.3s ease;
        -webkit-transition: color 0.3s ease;
        -o-transition: color 0.3s ease;
    }
    .user-account-dropdown-item:hover{
        color: black;
    }
    /* end user account dropdown container style */


    /* start sidebar menu style */
    .sidebar-menu{
        width: 100%;
        height: 100vh;
        overflow: auto;
    }
    .nav-item{
        text-decoration: none;
        cursor: pointer;
    }
    .nav-item:hover .title{
        color: black;
    }
    .mT-30{
        margin-top: 30px;
    }
    .sidebar-link{
        padding: 10px 19px;
        display: flex;
        flex-direction: row;
        align-items: center;
        text-decoration: none;
        color: inherit;
        text-decoration: none;
    }
    .icon-holder{
        font-size: 20px;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .sidebar-link .title{
        margin-left: 22px;
        transition: color 0.3s ease;
        -webkit-transition: color 0.3s ease;
        -o-transition: color 0.3s ease;
    }
    /* end sidebar menu style */
</style>
