<template>
    <div>

        <div class="form-group">
            <label for="txtProjectDetail">Select Work</label>
            <auto-complete v-model="data.project_detail_id" :data="allProjectDetails" id="txtProjectDetail" selected-value="project_detail_id" selected-text="task_name"></auto-complete>
        </div>

        <div class="form-group">
            <label for="txtPurchaseType">Select Purchase Type</label>
            <auto-complete v-model="data.purchase_type_id" :data="allPurchaseTypes" id="txtPurchaseType" selected-value="purchase_type_id" selected-text="purchase_type_name"></auto-complete>
        </div>


        <div class="form-group">
            <label for="txtPurchaseSubject">Subject</label>
            <input v-model="data.subject" style="width: 300px" type="text" class="form-control" id="txtPurchaseSubject" aria-describedby="purchaseSubjectHelp" placeholder="Purchase Subject">
            <small id="purchaseSubjectHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <div class="form-group">
            <label for="txtPaid">Paid</label>
            <input v-model="data.paid" style="width: 300px" type="text" class="form-control" id="txtPaid" aria-describedby="paidHelp" placeholder="Paid">
            <small id="paidHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <div class="form-group">
            <label for="txtPurchaseDescription">Description</label>
            <textarea v-model="data.description" style="width: 300px" class="form-control" id="txtPurchaseDescription" rows="3"></textarea>
        </div>

        <div class="form-group">
            <button @click.prevent.stop="save" class="btn btn-primary">Save</button>
        </div>

    </div>
</template>

<script>
    import AutoComplete from "../global_components/AutoCompleteSelection";
    export default {
        name: "AddPurchase",
        components:{
            'auto-complete': AutoComplete,
        },
        data(){
            return{
                data: {
                    project_detail_id: null,
                    purchase_type_id: null,
                    paid: null,
                    subject: null,
                    description: null,
                },
                projectDetails: [],
                purchaseTypes: [],
            }
        },
        created(){
            this.gettingProjectDetails();
            this.gettingPurchaseTypes();
        },
        methods:{
            async save(){
                //get user token from auth module
                const userToken = JSON.parse(this.$store.getters.getUserToken);
                const accessToken = userToken[0].accessToken;
                axios.defaults.headers.common['Authorization'] = 'Bearer '+ accessToken;

                await axios.post('api/v1/purchases/store', this.data).then(response => {
                    if(response.status === 200){
                        console.log(response);
                    }
                }).catch(err => {
                    console.log(err);
                });
            },
            async gettingProjectDetails(){
                //get user token from auth module
                const userToken = JSON.parse(this.$store.getters.getUserToken);
                const accessToken = userToken[0].accessToken;
                axios.defaults.headers.common['Authorization'] = 'Bearer '+ accessToken;

                await axios.get('api/v1/purchases/project_details').then(response => {
                    if(response.status === 200){
                        this.projectDetails = response.data;
                    }
                }).catch(err => {
                    console.log(err);
                });
            },
            async gettingPurchaseTypes(){
                //get user token from auth module
                const userToken = JSON.parse(this.$store.getters.getUserToken);
                const accessToken = userToken[0].accessToken;
                axios.defaults.headers.common['Authorization'] = 'Bearer '+ accessToken;

                await axios.get('api/v1/purchases/purchase_types').then(response => {
                    if(response.status === 200){
                        this.purchaseTypes = response.data;
                    }
                }).catch(err => {
                    console.log(err);
                });
            }
        },
        computed:{
            allProjectDetails(){
                return this.projectDetails;
            },
            allPurchaseTypes(){
                return this.purchaseTypes;
            }
        }
    }
</script>

<style scoped>

</style>
