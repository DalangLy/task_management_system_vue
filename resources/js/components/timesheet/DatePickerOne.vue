<template>
    <div class="date-picker" @click.prevent.stop="showCalendar">

        <div ref="display" class="display" style="width: 300px">Select Date</div>

        <div ref="datePickerContainerRef" class="date-picker-container">
            <div class="d-flex flex-row align-items-center justify-content-between my-2">
                <button class="d-btn" @click.prevent.stop="changeMonth('backwards')">&#8592;</button>
                <h5 class="font-weight-bold p-0 m-0">{{changeDate.month.toString().length<2?'0'+changeDate.month:changeDate.month}}-{{changeDate.year}}</h5>
                <button class="d-btn" @click.prevent.stop="changeMonth('forwards')">&#8594;</button>
            </div>

            <div class="calendar-container">
                <div class="calendar-header">
                    <div class="header-item">Mon</div>
                    <div class="header-item">Tue</div>
                    <div class="header-item">Wed</div>
                    <div class="header-item">Thu</div>
                    <div class="header-item">Fri</div>
                    <div class="header-item">Sat</div>
                    <div class="header-item sunday">Sun</div>
                </div>
                <div class="calendar-body">
                    <template v-for="(day, index) in displayCalendar">

                        <!-- create blank day if start day is not monday-->
                        <!-- but if start day is monday so dont need to create black date-->
                        <template v-if="index === 0 && day.dayName !== 'Sunday'">
                            <div v-for="m in day.dayRange" class="blank-day-item"></div>
                        </template>

                        <div @click.prevent="dateSelect(day.dayNum)" class="day-item" :class="day.currentDay?'current-day-highlight':''">{{day.dayNum}}</div>
                    </template>

                </div>
            </div>
        </div>


    </div>
</template>

<script>
    export default {
        name: "DatePicker",
        data(){
            return{
                years: [],
                calendar: [],
                changeDate:{
                    day: new Date().getDate(), //day 1 - 31
                    month: (new Date().getMonth()+1), //because return value is month 0 - 11 so to get 1 - 12 we add 1
                    year: new Date().getFullYear(), // year 1 - 12
                },
                isCalendarVisible: false,
            }
        },
        mounted() {
            this.years = this.createYear(2000,2050);

            this.calendar = this.createCalendar(this.years, this.getTwentyNineFebruaryYears(this.years), 'Saturday');

            document.addEventListener('click', this.handleClickOutside);

            this.displaySelectedDate();
        },
        destroyed(){
            document.removeEventListener('click', this.handleClickOutside);
        },
        methods:{
            handleClickOutside(evt) {
                evt.stopPropagation();
                if (!this.$el.contains(evt.target)) {
                    this.isCalendarVisible = false;
                    this.$refs.datePickerContainerRef.classList.remove('visible');
                }
            },
            dateSelect(selectedDay){
                this.changeDate.day = selectedDay;

                this.displaySelectedDate();
            },
            displaySelectedDate(){
                //display day
                let month = this.changeDate.month.toString().length < 2?'0'+this.changeDate.month:this.changeDate.month;
                let day = this.changeDate.day.toString().length < 2?'0'+this.changeDate.day:this.changeDate.day;
                let value = this.changeDate.year +'-'+month+''+'-'+day;
                this.$refs.display.innerHTML = value;

                //emit value to component
                this.$emit('input', value);
            },
            showCalendar(){
                this.closeOtherOpeningDatePicker();

                this.isCalendarVisible = !this.isCalendarVisible;

                if(this.isCalendarVisible)
                    this.$refs.datePickerContainerRef.classList.add('visible');
                else
                    this.$refs.datePickerContainerRef.classList.remove('visible');
            },
            closeOtherOpeningDatePicker(){
                //close other opening auto complete
                //protect if you use this auto complete more than one in a page, so when you open other so so the last one wont close
                const otherDatePickers = document.querySelectorAll('.date-picker-container');
                otherDatePickers.forEach(datePicker => {
                    datePicker.classList.remove('visible');
                });
            },
            changeMonth(direction){
                if(direction === 'forwards'){
                    if(this.changeDate.year < 2050){
                        if(this.changeDate.month < 12)
                            this.changeDate.month++;
                        else{
                            this.changeDate.month = 1;
                            this.changeDate.year++;
                        }
                    }
                }
                else{
                    if(this.changeDate.year > 2000){
                        if(this.changeDate.month > 1)
                            this.changeDate.month--;
                        else{
                            this.changeDate.month = 12;
                            this.changeDate.year--;
                        }
                    }
                }
            },
            getTwentyNineFebruaryYears(arrayOfYears){
                if(Array.isArray(arrayOfYears)) {
                    //29 february happen only when year divided by 4 equal 0
                    //but year that divide by 100 === 0 but 400, february not 29
                    let noTwentyNineFebYear = [];
                    let twentyNineFebYears = [];
                    arrayOfYears.forEach(year => {
                        if ((year % 100) === 0 && (year % 400) > 0) {
                            noTwentyNineFebYear.push({year: year});
                        } else {
                            if ((year % 4) === 0) {
                                twentyNineFebYears.push({year: year});
                            }
                        }
                    });
                    return twentyNineFebYears;
                }
                console.log('input year must be array');
                return [];
            },
            createYear(from, to){
                let years = [];
                for(let i = from; i <= to; i++){
                    years.push(i);
                }
                return years;
            },
            createCalendar(arrayOfYears, arrayOfNotTwentyNineYears, startDayName){
                if(Array.isArray(arrayOfYears) && Array.isArray(arrayOfNotTwentyNineYears)){

                    let calendar = [];
                    let monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                    let dayName = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                    let startDayNameIndex = dayName.findIndex((dayName) => dayName.toLowerCase() === startDayName.toLowerCase());
                    let peakMonth = [1, 3, 5, 7, 8, 10, 12];

                    arrayOfYears.forEach(year => {
                        calendar.push(
                            {
                                year: year,
                                months: []
                            }
                        );

                        //check is it 29 feb?
                        let isTwentyNine = arrayOfNotTwentyNineYears.find(r => parseInt(r.year) === year)?true:false;

                        //inserting month
                        let insertedYear = calendar.findIndex(r => parseInt(r.year) === parseInt(year));
                        for(let month = 1; month <= 12; month++){
                            calendar[insertedYear].months.push(
                                {
                                    monthNum: month,
                                    monthName: monthNames[month-1],
                                    days: [],
                                }
                            );

                            //inserting day
                            let insertedMonthIndex = calendar[insertedYear].months.findIndex(r => parseInt(r.monthNum) === month);
                            let maxDay = 31;
                            if(month === 2){
                                if(isTwentyNine){
                                    maxDay = 29;
                                }
                                else{
                                    maxDay = 28;
                                }
                            }
                            else{
                                if(peakMonth.find((m) => m === month )){
                                    maxDay = 31;
                                }else{
                                    maxDay = 30;
                                }
                            }

                            for(let day = 1; day <= maxDay; day++){
                                calendar[insertedYear].months[insertedMonthIndex].days.push(
                                    {
                                        dayRange: (startDayNameIndex+1),//example monthday = 1, tuesday = 2, wednesday = 3... etc
                                        dayNum: day,
                                        dayName: dayName[startDayNameIndex],
                                        currentDay: day === new Date().getDate() && insertedMonthIndex === (new Date().getMonth()) && year === new Date().getFullYear(),
                                    }
                                );
                                startDayNameIndex++;
                                if(startDayNameIndex > 6){
                                    startDayNameIndex = 0;
                                }
                            }
                        }
                    });

                    return calendar;
                }
            },
        },
        computed:{
            displayCalendar(){
                if(this.calendar.length > 0){
                    if(this.calendar[0].months.length > 0){
                        if(this.calendar[0].months[0].days.length > 0){

                            let selectedYear = this.calendar.find(y => parseInt(y.year) === this.changeDate.year);
                            if(selectedYear){
                                let selectedMonth = selectedYear.months.find(m => parseInt(m.monthNum) === this.changeDate.month);
                                //let selectedDay = selectedMonth.days.find(d => parseInt(d.dayNum) === day);
                                return selectedMonth.days;
                            }
                        }
                    }
                }
            }
        }
    }
</script>

<style scoped>
    *{
        box-sizing: border-box;
    }
    .date-picker{
        position: relative;
        width: 300px;
    }
    .display{
        user-select: none;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        cursor: pointer;
    }
    .date-picker-container{
        border-radius: 5px;
        border: 1px solid #ced4da;
        width: 300px;
        min-height: 250px;
        background-color: white;
        padding: 10px;
        position: absolute;
        margin-top: 5px;
        display: none;
        z-index: 1000;
    }
    .d-btn{
        width: 40px;
        height: 40px;
        background-color: #95999c;
        color: white;
        outline: none;
        border-radius: 5px;
        border: none;
        user-select: none;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        cursor: pointer;
    }
    .date-picker-container.visible{
        display: block;
    }
    .calendar-container{

    }
    .calendar-header{
        display: grid;
        grid-template-columns: auto auto auto auto auto auto auto;
        background-color: #fff;
        grid-gap: 5px;
        border-bottom: 1px solid #ced4da;
        padding-bottom: 3px;
        margin-bottom: 5px;
    }
    .header-item{
        background-color: #fff;
        border: 1px solid #d1d1d1;
        min-height: 30px;
        color: black;
        display: flex;
        min-width: 35px;
        justify-content: center;
        align-items: center;
        user-select: none;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        border-radius: 5px;
    }
    .calendar-body{
        display: grid;
        grid-template-columns: auto auto auto auto auto auto auto;
        background-color: #fff;
        grid-gap: 5px;
    }
    .blank-day-item{
        background-color: transparent;
        border: 1px solid transparent;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 30px;
        user-select: none;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
    }
    .day-item{
        background-color: white;
        border: 1px solid #ced4da;
        display: flex;
        justify-content: center;
        align-items: center;
        user-select: none;
        cursor: pointer;
        color: black;
        border-radius: 5px;
        transition: 0.3s ease;
        min-height: 30px;
        will-change: transform, background-color, z-index, box-shadow;
    }
    .day-item:hover{
        background-color: #f7c6c5;
        transform: scale(1.2);
        z-index: 10;
        -webkit-box-shadow: 3px 3px 21px -6px rgba(0,0,0,0.3);
        -moz-box-shadow: 3px 3px 21px -6px rgba(0,0,0,0.3);
        box-shadow: 3px 3px 21px -6px rgba(0,0,0,0.3);
    }
    .sunday{
        color: red;
    }
    .current-day-highlight{
        background-color: #f7c6c5;
    }
</style>
