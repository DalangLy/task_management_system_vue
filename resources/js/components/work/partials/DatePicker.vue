<template>
    <div>

        <div class="form-control" style="width: 300px">Dalang</div>
        <div class="date-picker-container">
            <div class="d-flex flex-row align-items-center justify-content-between">
                <button class="btn btn-primary"><</button>
                <div>2019-10-10</div>
                <button class="btn btn-primary">></button>
            </div>

            <table>
<!--                <ul>-->
<!--                    <li v-for="day in displayCalendar">{{day.day}}</li>-->
<!--                </ul>-->
                <li v-text="displayCalendar"></li>
            </table>
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
            }
        },
        mounted() {
            this.years = this.createYear(2000,2050);

            this.calendar = this.createCalendar(this.years, this.getTwentyNineFebruaryYears(this.years), 'Saturday');
        },
        methods:{
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
                            let insertedMonth = calendar[insertedYear].months.findIndex(r => parseInt(r.monthNum) === month);
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
                                maxDay = 31;
                            }

                            for(let day = 1; day <= maxDay; day++){
                                calendar[insertedYear].months[insertedMonth].days.push(
                                    {
                                        dayNum: day,
                                        dayName: dayName[startDayNameIndex],
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
            }
        },
        computed:{
            displayCalendar(selectDay, selectMonth, selectYear){
                let date = new Date();
                let day = date.getDate(); //day 1 - 31
                let month = (date.getMonth()+1); //month 0 - 11
                let year = date.getFullYear(); // year 1 - 12

                if(selectDay && selectMonth && selectYear){
                    day = selectDay;
                    month = selectMonth;
                    year = selectYear;
                }

                let selectedYear = this.calendar.find(y => parseInt(y.year) === year);
                if(selectYear){
                    let selectedMonth = selectedYear.months.find(m => parseInt(m.monthNum) === 2);
                    // let selectedDay = selectedMonth.days.find(d => parseInt(d.dayNum) === day);
                    console.log(selectYear);
                    return selectedMonth;
                }
            }
        }
    }
</script>

<style scoped>
    .date-picker-container{
        border-radius: 5px;
        border: 1px solid black;
        width: 300px;
        height: 300px;
        background-color: white;
        padding: 10px;
    }
</style>
