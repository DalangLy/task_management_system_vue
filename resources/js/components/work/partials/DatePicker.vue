<template>
    <div>

        <div class="date-picker">


            <div class="form-control" style="width: 300px">Select Date</div>
            <div class="date-picker-container">
                <div class="d-flex flex-row align-items-center justify-content-between my-2">
                    <button class="btn btn-primary" @click.prevent.stop="changeMonth('backwards')"><</button>
                    <h5 class="font-weight-bold p-0 m-0">{{changeDate.month}}-{{changeDate.year}}</h5>
                    <button class="btn btn-primary" @click.prevent.stop="changeMonth('forwards')">></button>
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

                            <div class="day-item" :class="day.currentDay?'current-day-highlight':''">{{day.dayNum}}</div>
                        </template>

                    </div>
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
                }
            }
        },
        mounted() {
            this.years = this.createYear(2000,2050);

            this.calendar = this.createCalendar(this.years, this.getTwentyNineFebruaryYears(this.years), 'Saturday');
        },
        methods:{
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
    .date-picker{
        position: relative;
    }
    .date-picker-container{
        border-radius: 5px;
        border: 1px solid black;
        width: 300px;
        min-height: 300px;
        background-color: white;
        padding: 10px;
        position: absolute;
        margin-top: 5px;
    }
    .calendar-container{

    }
    .calendar-header{
        display: flex;
        border-bottom: 1px solid gray;
        padding-bottom: 3px;
        margin-bottom: 5px;
    }
    .header-item{
        flex-grow: 1;
        min-width: 30px;
        background-color: cornflowerblue;
        border: 1px solid white;
        height: 50px;
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        user-select: none;
        border-radius: 5px;
    }
    .calendar-body{
        display: flex;
        flex-wrap: wrap;
    }
    .blank-day-item{
        width: 14.2857142857%;
        border: 1px solid white;
        height: 50px;
        display: flex;
        justify-content: center;
        align-items: center;
        user-select: none;
    }
    .day-item{
        width: 14.2857142857%;
        background-color: gray;
        border: 1px solid white;
        height: 50px;
        display: flex;
        justify-content: center;
        align-items: center;
        user-select: none;
        cursor: pointer;
        color: white;
        border-radius: 5px;
        transition: 0.3s ease;
    }
    .current-day-highlight{
        background-color: #f7c6c5;
    }
    .day-item:hover{
        background-color: #f7c6c5;
    }
    .sunday{
        background-color: red;
    }
</style>
