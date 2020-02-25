<template>
    <div>

        <div ref="overlayRef" @click.prevent.stop="hideTimeInput" class="overlay"></div>

        <div ref="timePickerRef" class="time-picker">

            <div class="time-container">
                <div class="time-input-container">
                    <input @input="checkHourValidate" ref="hourInputRef" @focus="focusInput" type="text" value="00">
                </div>
                <div class="time-separator-container">
                    <div class="dot"></div>
                    <div class="dot"></div>
                </div>
                <div class="time-input-container">
                    <input @input="checkMinuteValidation" ref="minuteInputRef" @focus="focusInput" type="text" value="00">
                </div>
            </div>


            <div class="time-picker-footer-action-container">
                <button @click="OKButtonClick" class="btn btn-primary">OK</button>
            </div>

        </div>

    </div>
</template>

<script>
    export default {
        name: "DigitalTimePicker",
        props: ['opened'],
        data(){
            return{
                temp: "",
                time: "500",
                isShowing: false,
                currentTime:{
                    hour: '',
                    minute: '',
                }
            }
        },
        mounted(){
            const date = new Date();
            const hourInput = this.$refs.hourInputRef;
            const minuteInput = this.$refs.minuteInputRef;
            hourInput.value = date.getHours().toString().length < 1?'0'+date.getHours():date.getHours();
            minuteInput.value = date.getMinutes().toString().length < 1?'0'+date.getMinutes():date.getMinutes();
            this.$emit('input', this.currentTime.hour +':'+ this.currentTime.minute);
        },
        methods:{
            checkHourValidate(event){
                const value = event.target.value;

                //const length = /^.{1,2}$/.test(value);
                //const numberOnly = /^\d*\.?\d*$/.test(value);
                //const numberWithLength = /^.{0,1}\d$/.test(value);
                const isMatched = /^(1[0-2]|[1-9])$/.test(value);

                if(isMatched){
                    event.target.value = value;
                    this.temp = value;
                }
                else{
                    if(value.length < this.temp.length){
                        this.temp = "";
                    }
                    event.target.value = this.temp;
                }
            },
            checkMinuteValidation(event){
                const value = event.target.value;

                const isMatched = /^[1-5]?[0-9]$/.test(value);

                if(isMatched){
                    event.target.value = value;
                    this.temp = value;
                }
                else{
                    if(value.length < this.temp.length){
                        this.temp = "";
                    }
                    event.target.value = this.temp;
                }
            },
            focusInput(event){
                event.target.select();
            },
            OKButtonClick(){
                const hourInput = this.$refs.hourInputRef;
                const minuteInput = this.$refs.minuteInputRef;
                const hour = hourInput.value.toString().length < 2?'0'+hourInput.value:hourInput.value;
                const minute = minuteInput.value.toString().length < 2?'0'+minuteInput.value:minuteInput.value;

                this.$emit('input', hour + ':'+ minute);

                this.hideTimeInput();
            },
            showTimeInput(){
                const timeInputOverlay = this.$refs.overlayRef;
                const timeInput = this.$refs.timePickerRef;
                timeInputOverlay.classList.add('visible');
                timeInput.classList.add('visible');
            },
            hideTimeInput(){
                const timeInputOverlay = this.$refs.overlayRef;
                const timeInput = this.$refs.timePickerRef;
                timeInputOverlay.classList.remove('visible');
                timeInput.classList.remove('visible');
            }
        },
    }
</script>

<style scoped>
    .overlay{
        width: 100vw;
        height: 100vh;
        background-color: rgba(0,0,0,0.5);
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1000;
        display: none;
    }
    .overlay.visible{
        display: block;
    }
    .time-picker{
        width: 400px;
        height: 300px;
        border-radius: 5px;
        background-color: #fff;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) scale(0);
        z-index: 1001;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        transition: 0.3s ease;
        will-change: transform;
    }
    .time-picker.visible{
        transform: translate(-50%, -50%) scale(1);
    }
    .time-container{
        display: grid;
        grid-template-columns: auto auto auto;
        grid-gap: 10px;
        align-items: center;
    }
    .time-input-container{
        width: 150px;
        border: 1px solid gray;
        overflow: hidden;
        border-radius: 5px;
        -webkit-box-shadow: 4px 4px 10px 2px rgba(0,0,0,0.5);
        -moz-box-shadow: 4px 4px 10px 2px rgba(0,0,0,0.5);
        box-shadow: 4px 4px 10px 2px rgba(0,0,0,0.5);
        padding: 5px;
    }
    .time-input-container input{
        border: none;
        outline: none;
        font-size: 100px;
        text-align: center;
        width: 100%;
        height: 100%;
    }
    .time-separator-container{
        display: flex;
        flex-direction: column;
        align-items: center;
        height: 60px;
        justify-content: space-between;
    }
    .dot{
        background-color: black;
        border-radius: 50%;
        width: 10px;
        height: 10px;
    }
    .time-picker-footer-action-container{
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        margin: 20px 0 10px;
    }
</style>
