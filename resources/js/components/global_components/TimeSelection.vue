<template>
    <div>
        <div class="time-selection-overlay"></div>
        <div class="time-selection-container">
            <input class="time-input" type="text" value="00">
        </div>
    </div>
</template>

<script>
    export default {
        name: "TimeSelection"
    }
</script>

<style scoped>
    .time-selection-container{
        width: 300px;
        background-color: #fff;
        position: fixed;
        height: 300px;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1000001;
    }
    .time-selection-overlay{
        background-color: rgba(0,0,0,0.5);
        width: 100vw;
        height: 100vh;
        position: fixed;
        left: 0;
        top: 0;
        z-index: 1000000;
    }
    .time-input{
        font-size: 200px;
        width: 250px;
    }
</style>
