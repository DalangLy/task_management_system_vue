<template>
    <div>
        <div class="user-profile-layout">
            <div class="container">
                <div class="header">
                    <h4>Employee Information</h4>
                </div>
                <div>
                    <div class="avatar-container">
                        <div class="avatar-content">
                            <div class="left">

                                <div class="avatar">
                                    <img src="http://www.gstatic.com/tv/thumb/persons/733885/733885_v9_bb.jpg" alt="">
                                </div>

                            </div>
                            <div class="right">

                                <div class="profile-name">
                                    <h3>{{userInfo.name}}</h3>
                                    <p>{{userInfo.position}}</p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="content-body">
                        <div class="content-body-inner">
                            <div class="body-left">

                                <h4>Contact</h4>
                                <p>Email: {{userInfo.email}}</p>
                                <p>Phone: {{userInfo.phone}}</p>

                            </div>
                            <div class="body-right">

                                <h4>Info</h4>
                                <p>Department: IS</p>
                                <p>Salary: {{userInfo.salary}}$</p>

                            </div>
                        </div>
                        <div class="content-body-inner">
                            <div class="body-left">

                                <h4>Contract</h4>
                                <p>Start Date: {{userInfo.start_date}}</p>
                                <p>Official Date: {{userInfo.official_date}}</p>

                            </div>
                            <div class="body-right">

                                <h4>Role</h4>
                                <p>{{userInfo.role_display_name}}</p>

                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="action-section">
                        <div class="action-section-inner">
                            <div class="action-section-content">
                                <a href="" class="action-btn">Edit Info</a>
                                <a href="" class="action-btn">Edit Account</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Profile",
        computed:{
            userInfo(){
                return this.$store.getters.getUserInfo;
            }
        }
    }
</script>

<style scoped>
    .user-profile-layout{
        width: auto;
        min-height: 100vh;
        background-color: #fff;
        border-radius: 20px;
        margin: 34px;
        -webkit-box-shadow: 3px 0px 10px 0px rgba(0,0,0,0.25);
        -moz-box-shadow: 3px 0px 10px 0px rgba(0,0,0,0.25);
        box-shadow: 3px 0px 10px 0px rgba(0,0,0,0.25);
        overflow: hidden;
        padding: 0 80px;
    }
    .container{
        width: 100%;
        height: 100%;
    }
    .header{
        height: 80px;
        border-bottom: 1px solid rgba(112,112,112,0.27);
        display: flex;
        align-items: center;
    }
    .avatar-container{
        display: inline-block;
        border-bottom: 1px solid rgba(112,112,112,0.27);
        padding: 30px 0;
    }
    .avatar-content{
        width: 100%;
        display: flex;
        align-items: stretch;
    }
    .left{
        flex: 1;
        width: 200px;
    }
    .right{
        flex: 2;
        width: 200px;
        display: flex;
        align-items: center;
    }
    .avatar{
        width: 100px;
        height: 100px;
        overflow: hidden;
        border-radius: 50%;
    }
    .avatar img{
        object-fit: cover;
        vertical-align: middle;
        width: 100%;
        height: 100%;
    }
    .profile-name{
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
    }
    .content-body{
        display: inline-block;
        border-bottom: 1px solid rgba(112,112,112,0.27);
    }
    .content-body-inner{
        display: flex;
        align-items: stretch;
        margin: 20px 0;
    }
    .body-left{
        width: 200px;
        flex-grow: 1;
    }
    .body-right{
        width: 200px;
        flex-grow: 1;
    }
    .action-section{
        display: inline-block;
        margin: 20px 0;
    }
    .action-section-inner{
        display: flex;
        align-items: stretch;
    }
    .action-section-content{
        width: 100%;
        flex-grow: 1;
        display: flex;
        flex-direction: row;
        align-items: center;
    }
    .action-btn{
        padding: 10px 20px;
        border-radius: 20px;
        background-color: #fff;
        color: #FFC000;
        outline: none;
        border: 1px solid #FFC000;
        cursor: pointer;
        transition: 0.3s ease;
        -webkit-transition: 0.3s ease;
        -o-transition: 0.3s ease;
        margin-right: 20px;
        text-decoration: none;
        font-size: 12px;
    }
    .action-btn:hover{
        background-color: #FFC000;
        color: #fff;
    }
    h4, p , h3{
        padding: 0;
        margin: 0;
    }
    h4{
        margin-bottom: 8px;
    }
</style>
