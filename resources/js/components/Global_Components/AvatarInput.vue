<template>
    <div>
        <!-- Start User Avatar -->
        <input type="file" ref="inputFileRef" class="avatar-input" @change.prevent="previewImage">
        <div class="profile-avatar">
            <i @click.prevent="openFileDialog" class="edit-avatar-icon fas fa-pen"></i>
            <div class="profile-container">
                <img ref="outPutImage" :src="avatarValue?avatarValue:'https://c7.uihere.com/icons/216/669/123/user-management-1e8bf7cb3c23335e2af745696a1e3f91.png'" alt="">
            </div>
            <i @click.prevent="removePreviewImage" ref="btnRemoveAvatarRef" class="remove-avatar-icon fas fa-times"></i>
        </div>
        <!-- End User Avatar-->
    </div>
</template>

<script>
    export default {
        name: "AvatarInput",
        props: ['value'],
        methods: {
            // start user avatar script
            openFileDialog() {
                const input = this.$refs.inputFileRef;
                input.click();
            },
            previewImage(event) {
                const output = this.$refs.outPutImage;
                const thisKeyword = this;
                if (event.target.files.length > 0) {
                    let reader = new FileReader();
                    reader.onload = function () {
                        output.src = reader.result;
                        thisKeyword.$emit('input', reader.result);
                        thisKeyword.showRemoveProfileIcon(true)
                    };
                    reader.readAsDataURL(event.target.files[0]);
                }
            },
            removePreviewImage() {
                const fileInput = this.$refs.inputFileRef;
                fileInput.value = null;
                this.$emit('input', null);
                this.showRemoveProfileIcon(false);
                this.resetDefaultAvatar();
            },
            showRemoveProfileIcon(isShowing) {
                const profileRemoveIcon = this.$refs.btnRemoveAvatarRef;
                if (isShowing) {
                    profileRemoveIcon.classList.add('show');
                } else {
                    profileRemoveIcon.classList.remove('show');
                }
            },
            resetDefaultAvatar() {
                const output = this.$refs.outPutImage;
                output.src = 'https://c7.uihere.com/icons/216/669/123/user-management-1e8bf7cb3c23335e2af745696a1e3f91.png';
            }
            // end user avatar script
        },
        computed:{
            avatarValue(){
                return this.value;
            }
        },
    }
</script>

<style scoped>
    /* start user avatar style*/
    .profile-avatar{
        display: inline-block;
        position: relative;
        -webkit-user-select: none;
        user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
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
    .avatar-input{
        display: none;
    }
    /* end user avatar style */
</style>
