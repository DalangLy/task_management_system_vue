<template>
    <div style="width: 80%">

        <!-- start account list row -->
        <div class="parent-row" @click.prevent.stop="showProjects($event)"> <!--project row-->
            <div class="content bg-account">

                <!-- start row content-->
                Account
                <!-- end row content-->

            </div>
        </div>
        <div class="child-row-container">
            <div class="content bg-account-light">


                <!-- start project list row -->
                <div class="parent-row project-row" @click.prevent.stop="showWorks($event)">
                    <div class="content bg-project">
                        Project
                    </div>
                </div><!-- project-row class use with js-->
                <div class="child-row-container work-row-container"> <!-- work-row-container class use with js-->
                    <div class="content bg-project-light">


                        <!-- start work list row-->
                        <div class="parent-row work-row"><!-- work-row class use with js-->
                            <div class="content bg-work">
                                Work 1
                            </div>
                        </div>
                        <!-- end work list row -->

                        <!-- work list 2-->
                        <div class="parent-row work-row">
                            <div class="content bg-work">
                                Work 2
                            </div>
                        </div>


                    </div>
                </div>
                <!-- end project list row -->


            </div>
        </div>
        <!-- end account list row -->

    </div>
</template>

<script>
    export default {
        name: "DropDownTableTestOne",
        props: ['data'],
        methods:{
            showProjects(e){
                const projectRowContainer = e.target.parentNode.nextElementSibling;
                const projectCount = this.countChildRow(projectRowContainer,'project-row');
                const paddingSize = 5 * 2;// 2 = left and right, 5 = padding 5px

                if(projectRowContainer.clientHeight <= 0){
                    projectRowContainer.style.height = ((50 * projectCount)+paddingSize)+'px';
                }else{
                    //collapse project row container
                    projectRowContainer.style.height = '0';

                    //find all work-row-container (child) and collapse all sub children
                    const workRowContainers = projectRowContainer.querySelectorAll('.'+projectRowContainer.className+' .work-row-container');
                    workRowContainers.forEach(workRowContainer => {
                        workRowContainer.style.height = '0';
                    });
                }
            },
            showWorks(e){
                //current selected workRowContainer
                const selectedWorkRowContainer = e.target.parentNode.nextElementSibling;

                //find current selected parent-project-row-container
                const currentParentProjectRowContainer = selectedWorkRowContainer.parentElement.parentElement;

                //set variables
                const workCount = this.countChildRow(selectedWorkRowContainer, 'work-row');
                const paddingSize = 5 * 2;

                const currentParentProjectRowContainerHeight = this.getCurrentParentProjectRowContainerHeight(currentParentProjectRowContainer);

                if(selectedWorkRowContainer.clientHeight <= 0){
                    //resize parent (project row container)
                    currentParentProjectRowContainer.style.height = currentParentProjectRowContainerHeight + ((50*workCount)+paddingSize)+'px';

                    //resize child of selected item (work-row-container)
                    selectedWorkRowContainer.style.height = (50*workCount)+paddingSize+'px';
                }else{
                    selectedWorkRowContainer.style.height = '0';

                    //resize its parents
                    currentParentProjectRowContainer.style.height = currentParentProjectRowContainerHeight - ((50*workCount)+paddingSize)+'px';
                }
            },
            countChildRow(childRowContainer, childRowClassName){
                const childRows = childRowContainer.getElementsByClassName(childRowClassName);
                return childRows.length;
            },
            getCurrentParentProjectRowContainerHeight(selectedProjectRowContainer){
                return selectedProjectRowContainer.clientHeight;
            }
        },
        computed:{
            displayData(){
                if(this.data.length > 0){
                    return this.data;
                }
            }
        }
    }
</script>

<style scoped>
    /* start dropdown table style */
    .bg-account{
        background-color: #858585;
    }
    .bg-account-light{
        background-color: #fff;
    }
    .bg-project{
        background-color: #bfbfbf;
    }
    .bg-project-light{
        background-color: #fff;
    }
    .bg-work{
        background-color: #ededed;
    }
    .parent-row{
        width: 100%;
        height: 50px;
        user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
        -moz-user-select: none;
        -o-user-select: none;
        cursor: pointer;
        overflow: hidden;
        margin: 1px 0;
    }
    .content{
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        color: white;
        justify-content: center;
        padding: 5px;
        transition: 0.3s ease;
        -webkit-transition: 0.3s ease;
        -moz-transition: 0.3s ease;
        -o-transition: 0.3s ease;
        -ms-transition: 0.3s ease;
        will-change: background-color;
    }
    .child-row-container{
        width: 100%;
        overflow: hidden;
        height: 0;
        transition: 0.3s ease;
        -webkit-transition: 0.3s ease;
        -moz-transition: 0.3s ease;
        -o-transition: 0.3s ease;
        -ms-transition: 0.3s ease;
        will-change: height;
    }
    /* start dropdown table style */
</style>
