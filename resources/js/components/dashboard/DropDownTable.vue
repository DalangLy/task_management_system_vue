<template>
    <div>


        <!-- one row -->
        <div class="parent-row" @click.prevent.stop="showContent($event)">
            <div class="content">Client Account 1</div>
        </div>
        <div class="child-row" @click.prevent.stop="showContent($event)">
            <div class="content">
                Content
                <button class="btn btn-primary">hello</button>
            </div>
        </div>
        <div class="child-row">
            <div class="content">Content 1</div>
        </div>

        <!-- one row -->
        <div class="parent-row" @click.prevent.stop="showContent($event)">
            <div class="content">Parent</div>
        </div>
        <div class="child-row" @click.prevent.stop="showContent($event)">
            <div class="content">
                Content
                <button class="btn btn-primary">hello</button>
            </div>
        </div>
        <div class="child-row">
            <div class="content">Content 1</div>
        </div>

        <!-- one row -->
        <div class="parent-row" @click.prevent.stop="showContent($event)">
            <div class="content">Parent</div>
        </div>
        <div class="child-row" @click.prevent.stop="showContent($event)">
            <div class="content">
                Content
                <button class="btn btn-primary">hello</button>
            </div>
        </div>
        <div class="child-row">
            <div class="content">Content 1</div>
        </div>


    </div>
</template>

<script>
    export default {
        name: "DropDownTable",
        data(){
            return{

            }
        },
        methods:{
            showContent(event){
                const contentRef = event.target.parentNode.nextElementSibling;//this work if the clicked element has child

                if(contentRef){
                    if(contentRef.classList.contains('show')){
                        contentRef.classList.remove('show');
                        const child = contentRef.nextElementSibling;
                        if(child){
                            child.classList.remove('show');
                        }
                    }else{
                        contentRef.classList.add('show');
                    }
                }
            },
            async gettingData(){
                await axios.get('api/v1/positioins').then(response => {
                    if(response.status === 200){
                        console.log(response);
                    }
                })
            }
        }
    }
</script>

<style scoped>
    *{
        box-sizing: border-box;
    }
    .parent-row{
        width: 300px;
        height: 70px;
        background-color: #385d7a;
        cursor: pointer;
        user-select: none;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        transition: 0.3s ease;
        -webkit-transition: 0.3s ease;
        -o-transition: 0.3s ease;
        -moz-transition: 0.3s ease;
        color: white;
        will-change: background-color;
    }
    .parent-row:hover{
        background-color: #1b97cc;
    }
    .content{
        height: 100%;
        width: 100%;
        padding: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        border-bottom: 1px solid #c7c7c7;
        user-select: none;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
    }
    .child-row{
        width: 300px;
        background-color: #fff;
        height: 0;
        transition: 0.3s ease;
        -webkit-transition: 0.3s ease;
        -moz-transition: 0.3s ease;
        -o-transition: 0.3s ease;
        -ms-transition: 0.3s ease;
        will-change: height;
        overflow: hidden;
        cursor: pointer;
    }
    .child-row.show{
        height: 70px;
    }
</style>
