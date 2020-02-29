<template>
    <div>

        <div class="account-row" @click.prevent.stop="showProjects($event)"> <!--project row-->
            <div class="content bg-account">
                Account
            </div>
        </div>
        <div class="project-row-container">
            <div class="content bg-account-light">


                <!-- start project list row -->
                <div class="project-row" @click.prevent.stop="showWorks($event)">
                    <div class="content bg-project">
                        Project
                    </div>
                </div>
                <div class="work-row-container">
                    <div class="content bg-project-light">


                        <!-- start work list row-->
                        <div class="work-row">
                            <div class="content bg-work">
                                Work 1
                            </div>
                        </div>
                        <!-- end work list row -->

                        <!-- work list 2-->
                        <div class="work-row">
                            <div class="content bg-work">
                                Work 2
                            </div>
                        </div>


                    </div>
                </div>
                <!-- end project list row -->


                <!-- start project list row -->
                <div class="project-row" @click.prevent.stop="showWorks($event)">
                    <div class="content bg-project">
                        Project
                    </div>
                </div>
                <div class="work-row-container">
                    <div class="content bg-project-light">


                        <!-- start work list row-->
                        <div class="work-row">
                            <div class="content bg-work">
                                Work 1
                            </div>
                        </div>
                        <!-- end work list row -->

                        <!-- work list 2-->
                        <div class="work-row">
                            <div class="content bg-work">
                                Work 2
                            </div>
                        </div>


                    </div>
                </div>
                <!-- end project list row -->


                <!-- start project list row -->
                <div class="project-row" @click.prevent.stop="showWorks($event)">
                    <div class="content bg-project">
                        Project
                    </div>
                </div>
                <div class="work-row-container">
                    <div class="content bg-project-light">


                        <!-- start work list row-->
                        <div class="work-row">
                            <div class="content bg-work">
                                Work 1
                            </div>
                        </div>
                        <!-- end work list row -->

                        <!-- work list 2-->
                        <div class="work-row">
                            <div class="content bg-work">
                                Work 2
                            </div>
                        </div>


                    </div>
                </div>
                <!-- end project list row -->







            </div>
        </div>


    </div>
</template>

<script>
    export default {
        name: "DropDownTableTestOne",
        methods:{
            showProjects(e){
                const projectRowContainer = e.target.parentNode.nextElementSibling;
                const projectCount = this.countChildRow(projectRowContainer,'project-row');
                const paddingSize = 10 * 2;

                if(projectRowContainer.clientHeight <= 0){
                    projectRowContainer.style.height = ((50 * projectCount)+paddingSize)+'px';
                }else{
                    //collapse project row container
                    projectRowContainer.style.height = '0';

                    //find all work-row-container (child) and collapse all sub children
                    const workRowContainers = document.querySelectorAll('.'+projectRowContainer.className+' .work-row-container');
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
                const paddingSize = 10 * 2;

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
        }
    }
</script>

<style scoped>
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
    .account-row{
        width: 300px;
        height: 50px;
        user-select: none;
        cursor: pointer;
        overflow: hidden;
        margin: 1px 0;
    }
    .content{
        width: 100%;
        height: 100%;
        padding: 10px;
        display: flex;
        flex-direction: column;
        align-items: center;
        color: white;
        justify-content: center;
    }
    .project-row-container{
        width: 300px;
        overflow: hidden;
        height: 0;
        transition: 0.3s ease;
        will-change: height;
    }
    .project-row{
        width: 100%;
        height: 50px;
        user-select: none;
        cursor: pointer;
        overflow: hidden;
        margin: 1px 0;
    }
    .work-row-container{
        width: 100%;
        overflow: hidden;
        height: 0;
        transition: 0.3s ease;
        will-change: height;
    }
    .work-row{
        width: 100%;
        height: 50px;
        user-select: none;
        cursor: pointer;
        overflow: hidden;
        margin: 1px 0;
    }
</style>
