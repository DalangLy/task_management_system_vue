<template>
    <div>
        <h1>Company Name : {{data.company_name}}</h1>
        <h5>Working Hour : {{data.working_hours}}</h5>
        <h5>Start Hour : {{data.starting_hour}}</h5>
        <h5>End Hour : {{data.end_hour}}</h5>
        <h2>Relax Time</h2>
        <h5>Relax From : {{data.relax_from}}</h5>
        <h5>Relax To : {{data.relax_to}}</h5>
    </div>
</template>

<script>
    export default {
        name: "CompanyInfo",
        data(){
            return{
                data: [],
            }
        },
        created(){
            this.gettingCompanyInfo();
        },
        methods:{
            async gettingCompanyInfo(){
                await axios.get('api/company_structure').then(response => {
                    if(response.status === 200){
                        this.data = response.data;
                    }
                }).catch(err => {
                    console.log(err);
                })
            }
        }
    }
</script>

<style scoped>

</style>
