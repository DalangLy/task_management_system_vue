<template>
    <div style="width: 80%">

        <!-- start table header -->
        <div class="w-100 overflow-hidden mb-2" style="height: 50px; user-select: none">
            <div class="bg-primary w-100 h-100 d-flex flex-column align-items-center justify-content-center font-weight-bold text-white" style="padding: 5px">

                <!-- start row content-->
                <div class="d-flex flex-row justify-content-center align-items-center h-100 w-100">
                    <div class="flex-grow-1 d-flex justify-content-center align-items-center h-100" style="width: 40px">
                        <i class="fas fa-stream" style="pointer-events: none"></i>
                    </div>
                    <div class="flex-grow-1 d-flex justify-content-center align-items-center h-100" style="width: 50px">#</div>
                    <div class="flex-grow-1 d-flex justify-content-center align-items-center h-100" style="width: 100px">Name</div>
                    <div class="flex-grow-1 d-flex justify-content-center align-items-center h-100" style="width: 100px">Fee</div>
                    <div class="flex-grow-1 d-flex justify-content-center align-items-center h-100" style="width: 100px">Expense</div>
                    <div class="flex-grow-1 d-flex justify-content-center align-items-center h-100" style="width: 100px">Profit/Loss</div>
                    <div class="flex-grow-1 d-flex justify-content-center align-items-center h-100" style="width: 40px">Finished</div>
                    <div class="flex-grow-1 d-flex justify-content-center align-items-center h-100" style="width: 100px">Actions</div>
                </div>
                <!-- end row content-->

            </div>
        </div>
        <!-- end table header -->


        <template v-for="(item,index) in displayData">
        <!-- start account list row -->
        <div class="parent-row" @click.prevent.stop="getId(1)"> <!--project row-->
            <div class="content default-padding bg-account">

                <!-- start row content-->
                <div class="d-flex flex-row justify-content-center align-items-center h-100 w-100">
                    <div class="flex-grow-1 d-flex justify-content-center align-items-center h-100" style="width: 40px">
                        <button @click.prevent.stop="showProjects($event)" class="btn btn-outline-light rounded-circle">
                            <i class="fas fa-chevron-down" style="pointer-events: none"></i>
                        </button>
                    </div>
                    <div class="flex-grow-1 d-flex justify-content-center align-items-center h-100" style="width: 50px">{{index+1}}</div>
                    <div class="flex-grow-1 d-flex justify-content-center align-items-center h-100" style="width: 100px">{{item.task}}</div>
                    <div class="flex-grow-1 d-flex justify-content-center align-items-center h-100" style="width: 100px">{{item.fee}}$</div>
                    <div class="flex-grow-1 d-flex justify-content-center align-items-center h-100" style="width: 100px">{{item.expense}}$</div>
                    <div class="flex-grow-1 d-flex justify-content-center align-items-center h-100" :class="item.profit < 0?'bg-danger':''" style="width: 100px">{{item.profit}}$</div>
                    <div class="flex-grow-1 d-flex justify-content-center align-items-center h-100" style="width: 40px">{{item.finished?'Yes':'No'}}</div>
                    <div class="flex-grow-1 d-flex justify-content-center align-items-center h-100" style="width: 100px">
                        <button class="btn btn-light"><i class="fas fa-eye"></i></button>
                    </div>
                </div>
                <!-- end row content-->

            </div>
        </div>
        <div class="child-row-container">
            <div class="content child-padding bg-account-light">


                <template v-for="(project, index) in item.projects">
                <!-- start project list row -->
                <div class="parent-row project-row">
                    <div class="content default-padding bg-project">

                        <!-- start project content -->
                        <div class="d-flex flex-row justify-content-center align-items-center h-100 w-100">
                            <div class="flex-grow-1 d-flex justify-content-center align-items-center h-100" style="width: calc(40px - 20px)">
                                <button @click.prevent.stop="showWorks($event)" class="btn btn-outline-light rounded-circle">
                                    <i class="fas fa-chevron-down" style="pointer-events: none"></i>
                                </button>
                            </div>
                            <div class="flex-grow-1 d-flex justify-content-center align-items-center h-100" style="width: 50px">{{index+1}}</div>
                            <div class="flex-grow-1 d-flex justify-content-center align-items-center h-100" style="width: 100px">{{project.project_name}}</div>
                            <div class="flex-grow-1 d-flex justify-content-center align-items-center h-100" style="width: 100px">{{project.fee}}$</div>
                            <div class="flex-grow-1 d-flex justify-content-center align-items-center h-100" style="width: 100px">{{project.expense}}$</div>
                            <div class="flex-grow-1 d-flex justify-content-center align-items-center h-100" :class="project.profit < 0?'bg-danger':''" style="width: 100px">{{project.profit}}$</div>
                            <div class="flex-grow-1 d-flex justify-content-center align-items-center h-100" style="width: 40px">{{project.finished?'Yes':'No'}}</div>
                            <div class="flex-grow-1 d-flex justify-content-center align-items-center h-100" style="width: 100px">
                                <button class="btn btn-light"><i class="fas fa-eye"></i></button>
                            </div>
                        </div>
                        <!-- end project content -->

                    </div>
                </div><!-- project-row class use with js-->
                <div class="child-row-container work-row-container"> <!-- work-row-container class use with js-->
                    <div class="content child-padding bg-project-light">


                        <template v-for="(work, index) in project.works">
                        <!-- start work list row-->
                        <div class="parent-row work-row"><!-- work-row class use with js-->
                            <div class="content default-padding bg-work">

                                <!-- start work content -->
                                <div class="d-flex flex-row justify-content-center align-items-center h-100 w-100">
                                    <div class="flex-grow-1 d-flex justify-content-center align-items-center h-100" style="width: calc(40px - 40px);"></div>
                                    <div class="flex-grow-1 d-flex justify-content-center align-items-center h-100" style="width: 50px">{{index+1}}</div>
                                    <div class="flex-grow-1 d-flex justify-content-center align-items-center h-100" style="width: 100px">{{work.work_name}}</div>
                                    <div class="flex-grow-1 d-flex justify-content-center align-items-center h-100" style="width: 100px">{{work.fee}}$</div>
                                    <div class="flex-grow-1 d-flex justify-content-center align-items-center h-100" style="width: 100px">{{work.expense}}$</div>
                                    <div class="flex-grow-1 d-flex justify-content-center align-items-center h-100" :class="work.profit < 0?'bg-danger':''" style="width: 100px">{{work.profit}}$</div>
                                    <div class="flex-grow-1 d-flex justify-content-center align-items-center h-100" style="width: 40px">{{work.finished?'Yes':'No'}}</div>
                                    <div class="flex-grow-1 d-flex justify-content-center align-items-center h-100" style="width: 100px">
                                        <button class="btn btn-light"><i class="fas fa-eye"></i></button>
                                    </div>
                                </div>
                                <!-- end work content -->

                            </div>
                        </div>
                        <!-- end work list row -->
                        </template>


                    </div>
                </div>
                <!-- end project list row -->
                </template>


            </div>
        </div>
        <!-- end account list row -->
        </template>

    </div>
</template>

<script>
    export default {
        name: "DropDownTableTestOne",
        props: ['data'],
        methods:{
            //start dropdown table function
            showProjects(e){
                const parentRow = e.target.parentElement.parentElement.parentElement.parentElement;

                const projectRowContainer = parentRow.nextElementSibling;
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
                const childRow = e.target.parentElement.parentElement.parentElement.parentElement;

                //current selected workRowContainer
                const selectedWorkRowContainer = childRow.nextElementSibling;

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
            },
            //end dropdown table functions
            getId(id){
                console.log(id);
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
        background-color: #2B7B9B;
    }
    .bg-account:hover{
        background-color: #005B7F;
    }
    .bg-account-light{
        background-color: #fff;
    }
    .bg-project{
        background-color: #01BAAD;
    }
    .bg-project:hover{
        background-color: #008077;
    }
    .bg-project-light{
        background-color: #fff;
    }
    .bg-work{
        background-color: #58C785;
    }
    .bg-work:hover{
        background-color: #007F33;
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
        transition: 0.3s ease;
        -webkit-transition: 0.3s ease;
        -moz-transition: 0.3s ease;
        -o-transition: 0.3s ease;
        -ms-transition: 0.3s ease;
        will-change: background-color;
    }
    .default-padding{
        padding: 5px;
    }
    .child-padding{
        padding: 5px 0 5px 20px;
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
