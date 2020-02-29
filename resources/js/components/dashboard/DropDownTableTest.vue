<template>
    <div>

<!--        <div class="parent-row" @click.prevent.stop="showChild($event)">-->
<!--            <div class="parent-row-content">Parent</div>-->
<!--        </div>-->
<!--        <div class="child-row">-->
<!--            <div class="child-row-content">-->

<!--                &lt;!&ndash; child rows &ndash;&gt;-->
<!--                <div class="child-one">hello</div>-->
<!--                <div class="child-one">hello</div>-->
<!--                <div class="child-one">hello</div>-->

<!--            </div>-->
<!--        </div>-->

        <template v-for="parent in allData">

            <div class="parent-row" @click.prevent.stop="parentClick($event, parent.projects.length)"> <!-- parent's row -->
                <div class="parent-row-content">{{parent.account_name}}</div> <!-- parent's content padding -->
            </div>



            <div class="child-row"> <!-- parent's child container -->
                <div class="child-row-content"> <!-- parent's child container's padding -->

                    <template v-for="child in parent.projects">
                        <div class="child-row-one" @click="childClick($event, child.works.length)"><!-- child's row -->
                            <div class="child-row-one-content">{{child.project_name}}</div><!-- child's row content padding -->
                        </div>

                        <template v-for="subChild in child.works">
                            <div class="row-one-sub-child"> <!-- child row -->
                                <div class="row-one-sub-child-content">{{subChild.work_name}}</div> <!-- child row content padding -->
                            </div>
                        </template>

                    </template>

                </div>
            </div>
        </template>



    </div>
</template>

<script>
    export default {
        name: "DropDownTableTest",
        data(){
            return{
                allData: [
                    {
                        account_name: 'Account 1',
                        projects: [
                            {
                                project_name: 'Project 1',
                                works: [
                                    {
                                        work_name: 'Work 1'
                                    },
                                    {
                                        work_name: 'Work 2'
                                    }
                                ]
                            },
                            {
                                project_name: 'Project 2',
                                works: [
                                    {
                                        work_name: 'Work 3'
                                    },
                                    {
                                        work_name: 'Work 4'
                                    }
                                ]
                            },
                            {
                                project_name: 'Project 3',
                                works: [
                                    {
                                        work_name: 'Work 5'
                                    },
                                    {
                                        work_name: 'Work 6'
                                    }
                                ]
                            }
                        ]
                    },
                    {
                        account_name: 'Account 2',
                        projects: [
                            {
                                project_name: 'Project 4',
                                works: [
                                    {
                                        work_name: 'Work 7'
                                    },
                                    {
                                        work_name: 'Work 8'
                                    }
                                ]
                            },
                            {
                                project_name: 'Project 5',
                                works: [
                                    {
                                        work_name: 'Work 9'
                                    },
                                    {
                                        work_name: 'Work 10'
                                    }
                                ]
                            }
                        ]
                    },
                    {
                        account_name: 'Account 3',
                        projects: [
                            {
                                project_name: 'Project 6',
                                works: [
                                    {
                                        work_name: 'Work 11'
                                    },
                                    {
                                        work_name: 'Work 12'
                                    }
                                ]
                            },
                            {
                                project_name: 'Project 7',
                                works: [
                                    {
                                        work_name: 'Work 13'
                                    },
                                    {
                                        work_name: 'Work 14'
                                    }
                                ]
                            }
                        ]
                    }
                ]
            }
        },
        methods:{
            parentClick(e, childLength){
                const child = e.target.parentNode.nextElementSibling;

                if(child.clientHeight <= 0){
                    child.style.height = 50 * childLength+'px';
                }
                else{
                    child.style.height = '0px';
                    //row-one-sub-child
                    console.log(child.parentNode);
                }
            },
            childClick(e,  childLength){
                const child = e.target.parentNode.nextElementSibling;
                const currentElement = e.target.parentElement;
                const childRowContent = currentElement.parentElement;
                const childRowHeight = childRowContent.parentElement.clientHeight;
                console.log(e.target);


                if(child.clientHeight <= 0){
                    child.style.height = 50 * childLength+'px';
                    childRowContent.parentElement.style.height = childRowHeight + (50 * childLength)+'px';
                }
                else{
                    child.style.height = '0px';
                    childRowContent.parentElement.style.height = childRowHeight - (50 * childLength)+'px';
                }
            }
        }
    }
</script>

<style scoped>
    .parent-row{
        width: 300px;
        height: 50px;
        user-select: none;
    }
    .parent-row-content{
        width: 100%;
        height: 100%;
        background-color: #95999c;
        display: flex;
        align-items: center;
        padding: 10px;
        cursor: pointer;
        margin: 1px 0;
        transition: 0.3s ease;
        color: white;
        will-change: background-colors;
    }
    .parent-row-content:hover{
        background-color: #4aa0e6;
    }

    /* child row style */
    .child-row{
        width: 300px;
        height: 0;
        user-select: none;
        overflow: hidden;
        transition: 0.3s ease;
    }
    .child-row-content{
        width: 100%;
        height: 100%;
        background-color: #95999c;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 10px;
        cursor: pointer;
        margin: 1px 0;
        color: white;
    }
    .child-row-one{
        width: 100%;
        height: 50px;
    }
    .child-row-one-content{
        width: 100%;
        height: 100%;
        background-color: #1d2124;
        padding: 10px;
        color: #fff;
    }
    .row-one-sub-child{
        width: 100%;
        height: 0;
        overflow: hidden;
        transition: 0.3s ease;
        will-change: height;
    }
    .row-one-sub-child-content{
        width: 100%;
        height: 100%;
        background-color: #f7c6c5;
        padding: 10px;
        display: flex;
        align-items: center;
    }
</style>
