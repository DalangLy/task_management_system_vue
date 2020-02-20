<template>
    <div>

        <div class="time-picker-overlay"></div>

        <div class="time-picker">

            <div class="clock" @mousemove.prevent.stop="moveTick">

                <div id="hour-tick" class="hour-tick"></div>
                <div class="center-dot"></div>
                <div class="clock-glass"></div>
            </div>


            <div class="x">0</div>
            <div class="y">0</div>
            <div class="degree">0</div>

        </div>

    </div>
</template>

<script>
    export default {
        name: "TimePicker",
        data(){
            return{

            }
        },
        mounted(){
            //test
            // const hourTick = document.getElementById('hour-tick');
            //
            // let second = 0;
            // setInterval(function(){
            //     second+=6;
            //     if(second > 359){
            //         second = 0;
            //     }
            //     hourTick.style.transform = "translateY(-100%) rotateZ("+second+"deg)";
            // }, 1000);

        },
        methods:{
            moveTick(e){
                e.stopPropagation();

                const x1 = e.offsetX;
                const y1 = e.offsetY;
                const xPos = (x1-100);
                const yPos = (100-y1);
                //console.log("X = "+xPos);
                //console.log("Y = "+yPos);

                const degree1 = Math.atan2(xPos, yPos) * 180 / Math.PI;
                let degreeNum = 0;
                if(degree1 < 0){
                    degreeNum = degree1+359;
                }
                else{
                    degreeNum = degree1;
                }

                const ceilDegree = Math.ceil(degreeNum);


                const degree = document.querySelector('.degree');
                const x = document.querySelector('.x');
                const y = document.querySelector('.y');
                //degree.innerText = "degree : "+ceilDegree;
                x.innerText = "X = : "+xPos;
                y.innerText = "Y = : "+yPos;

                const temp = ceilDegree%30===0?ceilDegree:(ceilDegree-(ceilDegree%30));
                degree.innerText = "degree : "+temp;

                const hourTick = document.getElementById('hour-tick');

                hourTick.style.transform = "translateY(-100%) rotateZ("+temp+"deg)";
            }
        }
    }
</script>

<style scoped>
    *{
        box-sizing: border-box;
    }
    .time-picker-overlay{
        background-color: rgba(0,0,0,0.5);
        width: 100vw;
        height: 100vh;
        position: fixed;
        left: 0;
        top: 0;
        z-index: 1000;
    }
    .time-picker{
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #fff;
        z-index: 1001;
        padding: 10px;
        border-radius: 5px;

        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        width: 500px;
        height: 400px;
    }
    .clock{
        position: relative;
        width: 200px;
        height: 200px;
        border: 5px solid #fff;
        border-radius: 50%;
        display: inline-block;
        -webkit-box-shadow: 3px 3px 15px -2px rgba(0,0,0,0.75);
        -moz-box-shadow: 3px 3px 15px -2px rgba(0,0,0,0.75);
        box-shadow: 3px 3px 15px -2px rgba(0,0,0,0.75);
    }
    .clock img{
        width: 100%;
        height: 100%;
        vertical-align: middle;
        object-fit: contain;
        pointer-events: none;
    }
    .clock-glass{
        position: absolute;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0, 0);
        border-radius: 50%;
    }
    .hour-tick{
        width: 1px;
        height: 40%;
        background-color: black;
        position: absolute;
        left: 50%;
        top: 50%;
        transform-origin: 0 100%;
        transform: translateY(-100%) rotateZ(0deg);
        will-change: transform;
        user-select: none;
    }
    .center-dot{
        width: 5px;
        height: 5px;
        background-color: black;
        border-radius: 50%;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
</style>
