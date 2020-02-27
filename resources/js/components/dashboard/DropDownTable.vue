<template>
    <div>


        <div class="parent-row" @click.prevent.stop="showContent($event)">
            <div class="content">Parent</div>
        </div>
        <div class="child-row one" @click.prevent.stop="showContent($event)">
            <div class="content border">
                Content
                <button class="btn btn-primary">hello</button>
            </div>
        </div>
        <div class="child-row two">
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
                console.log(event.target);
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
        transition: 0.3s ease;
        color: white;
    }
    .parent-row:hover{
        background-color: #1b97cc;
    }
    .content{
        height: 100%;
        width: 100%;
        padding: 10px;
    }
    .child-row{
        width: 300px;
        background-color: #95999c;
        height: 0;
        transition: 0.3s ease;
        will-change: height;
        overflow: hidden;
        cursor: pointer;
    }
    .child-row.show{
        height: 70px;
    }
    .one{
        background-color: #546c8f;
    }
    .two{
        background-color: #548f7e;
    }
</style>
