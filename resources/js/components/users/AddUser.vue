<template>
    <div class="py-4 px-2">


        <!-- Start User Avatar-->
        <input type="file" id="inputFile" @change="previewImage">
        <div class="profile-avatar">
            <i @click.prevent="openFileDialog" class="edit-avatar-icon fas fa-pen"></i>
            <div class="profile-container">
                <img id="outPutImage" src="https://c7.uihere.com/icons/216/669/123/user-management-1e8bf7cb3c23335e2af745696a1e3f91.png" alt="">
            </div>
            <i @click="removePreviewImage" class="remove-avatar-icon fas fa-times"></i>
        </div>
        <!-- End User Avatar-->


        <div class="form-group">
            <label for="txtName">Name</label>
            <input v-model="data.name" style="width: 300px" type="text" class="form-control" id="txtName" aria-describedby="nameHelp" placeholder="Name">
            <small id="nameHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <div class="form-group">
            <label for="txtGender">Gender</label>
            <select v-model="data.gender" style="width: 300px" id="txtGender" class="form-control">
                <option value="1" selected>Male</option>
                <option value="2">Female</option>
            </select>
        </div>

        <div class="form-group">
            <label for="txtEmail">Email</label>
            <input v-model="data.email" style="width: 300px" type="email" class="form-control" id="txtEmail" aria-describedby="emailHelp" placeholder="Email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <div class="form-group">
            <label for="txtUsername">Username</label>
            <input v-model="data.username" style="width: 300px" type="text" class="form-control" id="txtUsername" aria-describedby="usernameHelp" placeholder="Username">
            <small id="usernameHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <div class="form-group">
            <label for="txtPassword">Password</label>
            <input v-model="data.password" style="width: 300px" type="password" class="form-control" id="txtPassword" aria-describedby="passwordHelp" placeholder="Password">
            <small id="passwordHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <div class="form-group">
            <label for="txtConfirmPassword">Confirm Password</label>
            <input v-model="data.password_confirmation" style="width: 300px" type="password" class="form-control" id="txtConfirmPassword" aria-describedby="confirmPasswordHelp" placeholder="Confirm Password">
            <small id="confirmPasswordHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <div class="form-group">
            <label for="txtName">Position</label>
            <auto-complete v-model="data.position" :data="positions" selected-text="position" selected-value="position_id"></auto-complete>
        </div>

        <div class="form-group">
            <label for="txtSalary">Salary</label>
            <input v-model="data.salary" style="width: 300px" type="number" class="form-control" id="txtSalary" aria-describedby="salaryHelp" placeholder="Salary">
            <small id="salaryHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <div class="form-group">
            <label for="txtName">Role</label>
            <auto-complete v-model="data.role" :data="roles" selected-text="role_display_name" selected-value="role_id"></auto-complete>
        </div>

        <div class="form-group">
            <label for="txtPhone">Phone</label>
            <input v-model="data.phone" style="width: 300px" type="text" class="form-control" id="txtPhone" aria-describedby="phoneHelp" placeholder="Phone">
            <small id="phoneHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <div class="form-group">
            <label for="txtStartDate">Start Date</label>
            <date-picker v-model="data.start_date" id="txtStartDate" aria-describedby="startDateHelp"></date-picker>
            <small id="startDateHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <div class="form-group">
            <label for="txtOfficialDate">Official Date</label>
            <date-picker v-model="data.official_date" id="txtOfficialDate" aria-describedby="officialDateHelp"></date-picker>
            <small id="officialDateHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <div class="form-group">
            <button @click.prevent.stop="save" class="btn btn-primary">Save</button>
        </div>

    </div>
</template>

<script>
    import AutoComplete from "../global_components/AutoCompleteSelection";
    import DatePicker from "../global_components/DatePicker";
    export default {
        name: "AddUser",
        components:{
            'auto-complete': AutoComplete,
            'date-picker': DatePicker,
        },
        data(){
            return{
                data:{
                    avatar: null,
                    name: null,
                    gender: 1,
                    email: null,
                    username:null,
                    password: null,
                    password_confirmation: null,
                    position: null,
                    salary: null,
                    role: 1,
                    phone: null,
                    start_date: null,
                    official_date: null,
                },
                positions: [],
                roles: [],
            }
        },
        created(){
            this.gettingPosition();
            this.gettingRoles();
        },
        methods:{
            async gettingRoles(){
                await axios.get('api/v1/getting_roles').then(response => {
                    if(response.status === 200){
                        this.roles = response.data;
                    }
                }).catch(err => {
                    console.log(err);
                })
            },
            async gettingPosition(){
                await axios.get('api/v1/getting_positions').then(response => {
                    if(response.status === 200){
                        this.positions = response.data;
                    }
                }).catch(err => {
                    console.log(err);
                })
            },
            async save(){
                //get user token from auth module
                const userToken = JSON.parse(this.$store.getters.getUserToken);
                const accessToken = userToken[0].accessToken;
                axios.defaults.headers.common['Authorization'] = 'Bearer '+ accessToken;

                await axios.post('api/v1/users/store', this.data).then(response => {
                    if(response.status === 200){
                        console.log(response);
                    }
                }).catch(err => {
                    console.log(err);
                });
            },
            // start user avatar script
            openFileDialog(){
                const input = document.getElementById('inputFile');
                input.click();
            },
            previewImage(event){
                const output = document.querySelector('#outPutImage');
                const thisKeyword = this;
                if(event.target.files.length > 0){
                    let reader = new FileReader();
                    reader.onload = function()
                    {
                        output.src = reader.result;
                        thisKeyword.data.avatar = reader.result;
                        thisKeyword.showRemoveProfileIcon(true)
                    };
                    reader.readAsDataURL(event.target.files[0]);
                }
            },
            removePreviewImage(){
                const fileInput = document.querySelector('#inputFile');
                fileInput.value = null;
                this.data.avatar = null;
                this.showRemoveProfileIcon(false);
                this.resetDefaultAvatar();
            },
            showRemoveProfileIcon(isShowing){
                const profileRemoveIcon = document.querySelector('.remove-avatar-icon');
                if(isShowing){
                    profileRemoveIcon.classList.add('show');
                }
                else{
                    profileRemoveIcon.classList.remove('show');
                }
            },
            resetDefaultAvatar(){
                const output = document.querySelector('#outPutImage');
                output.src = 'https://c7.uihere.com/icons/216/669/123/user-management-1e8bf7cb3c23335e2af745696a1e3f91.png';
            }
            // end user avatar script
        }
    }
</script>

<style scoped>
    /* start user avatar style*/
    .profile-avatar{
        display: inline-block;
        position: relative;
    }
    .edit-avatar-icon{
        padding: 10px;
        background-color: #fff;
        border-radius: 50%;
        -webkit-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.16);
        -moz-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.16);
        box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.16);
        position: absolute;
        top: -10px;
        right: -10px;
        cursor: pointer;
    }
    .remove-avatar-icon{
        padding: 6px 8px;
        background-color: #fff;
        border-radius: 50%;
        -webkit-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.16);
        -moz-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.16);
        box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.16);
        position: absolute;
        bottom: -6px;
        right: -8px;
        cursor: pointer;
        display: none;
    }
    .remove-avatar-icon.show{
        display: block;
    }
    .profile-container{
        width: 100px;
        height: 100px;
        border: 3px solid #fff;
        border-radius: 5px;
        overflow: hidden;
        -webkit-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.16);
        -moz-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.16);
        box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.16);
    }
    .profile-container img{
        vertical-align: middle;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    #inputFile{
        display: none;
    }
    /* end user avatar style */
</style>
