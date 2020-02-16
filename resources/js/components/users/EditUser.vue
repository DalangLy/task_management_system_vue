<template>
    <div class="py-4 px-2">


        <!-- Start User Avatar-->
        <avatar-input></avatar-input>
        <!-- End User Avatar-->


        <div class="form-group">
            <label for="txtName">Name</label>
            <input v-model="data.name" style="width: 300px" type="text" class="form-control" id="txtName" aria-describedby="nameHelp" placeholder="Name">
            <small id="nameHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <div class="form-group">
            <label for="txtEmail">Email</label>
            <input v-model="data.email" style="width: 300px" type="email" class="form-control" id="txtEmail" aria-describedby="emailHelp" placeholder="Email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <div class="form-group">
            <label for="txtName">Position</label>
            <auto-complete v-model="data.position" :selected-item-id="selectedPositionId" :data="positions" selected-text="position" selected-value="position_id"></auto-complete>
        </div>


        <div class="form-group">
            <button @click.prevent.stop="save" class="btn btn-primary">Save</button>
        </div>

    </div>
</template>

<script>
    import AutoCompleteSelection from "../global_components/AutoCompleteSelection";
    import AvatarInput from "../global_components/AvatarInput";
    export default {
        name: "EditUser",
        components:{
            'auto-complete': AutoCompleteSelection,
            'avatar-input': AvatarInput,
        },
        data(){
            return{
                data:{
                    avatar: null,
                    name: null,
                    email: null,
                    position: null,
                },
                selectedPositionId: null,
                positions: [],
            }
        },
        mounted(){
            this.gettingUserInfo();
            this.gettingPositions();
        },
        methods:{
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
            async gettingUserInfo(){
                //get user token from auth module
                const userToken = JSON.parse(this.$store.getters.getUserToken);
                const accessToken = userToken[0].accessToken;
                axios.defaults.headers.common['Authorization'] = 'Bearer '+ accessToken;

                await axios.get('api/v1/users/edit/'+this.$route.params.userId).then(response => {
                    if(response.status === 200){
                        this.data.avatar = response.data.avatar;
                        this.data.name = response.data.name;
                        this.data.email = response.data.email;
                        this.selectedPositionId = response.data.position_id;
                    }
                }).catch(err => {
                    console.error(err);
                });
            },
            async gettingPositions(){
                await axios.get('api/v1/positions').then(response => {
                    if(response.status === 200){
                        this.positions = response.data;
                    }
                }).catch(err => {
                    console.err(err);
                })
            },
            // start user avatar script
            openFileDialog(){
                console.log('hello')
                const input = this.$refs.inputFileRef;
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
