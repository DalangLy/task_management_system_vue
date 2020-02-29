<template>
    <div>


        <drop-down-table :data="dashboards"></drop-down-table>





        <div class="my-5"></div>


        <div class="dashboard-container">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Task</th>
                        <th scope="col">Fee</th>
                        <th scope="col">Expense</th>
                        <th scope="col">Profit/Loss</th>
                        <th scope="col">Finished</th>
                    </tr>
                </thead>
                <tbody>
                    <tr @click.prevent.stop="showTaskDetail(d.employees, d.purchases)" v-for="(d, index) in dashboards" style="cursor:pointer;">
                        <th scope="row">{{(index+1)}}</th>
                        <td>{{d.task}}</td>
                        <td>{{d.fee}}$</td>
                        <td>{{d.expense}}$</td>
                        <td>{{d.profit}}$</td>
                        <td>{{d.finished}}</td>
                    </tr>

                </tbody>
            </table>

<!--            <div class="border p-2 mx-2" style="width: 200px">-->
<!--                <ul style="list-style-type: none" class="p-0 m-0">-->
<!--                    <h5>Employee :</h5>-->
<!--                    <li v-for="e in selectedEmployees">{{e.name}}</li>-->
<!--                </ul>-->
<!--            </div>-->

            <side-detail :employees_data="selectedEmployees" :purchases_data="selectedPurchasesData"></side-detail>
        </div>


    </div>
</template>

<script>
    import SideDashboardDetail from "./SideDashboardDetail";
    import DropDownTable from "./DropDownTable";
    export default {
        name: "DashboardTemp",
        components:{
            'side-detail': SideDashboardDetail,
            'drop-down-table': DropDownTable,
        },
        data(){
            return{
                dashboards: [
                    {
                        id: 1,
                        task: 'Task 1',
                        fee: 500,
                        expense: 200,
                        profit: 300,
                        finished: false,
                        employees: [
                            {
                                id: 1,
                                name: 'Dalang',
                            },
                            {
                                id: 2,
                                name: 'Narak',
                            }
                        ],
                        purchases: [
                            {
                                id: 1,
                                subject: 'Camera',
                                paid: 500,
                                description: 'buy for photoshoot'
                            },
                            {
                                id: 2,
                                subject: 'Camera Man',
                                paid: 250,
                                description: 'rent camera man for madam nom photoshoot',
                            }
                        ]
                    },
                    {
                        id: 2,
                        task: 'Task 2',
                        fee: 1200,
                        expense: 500,
                        profit: 700,
                        finished: false,
                        employees: [
                            {
                                id: 3,
                                name: 'Cheata',
                            },
                            {
                                id: 4,
                                name: 'Hun Hun',
                            }
                        ],
                        purchases: [
                            {
                                id: 1,
                                subject: 'Object 1',
                                paid: 500,
                                description: 'description 1'
                            },
                            {
                                id: 2,
                                subject: 'Object 2',
                                paid: 250,
                                description: 'description 2',
                            }
                        ]
                    },
                    {
                        id: 3,
                        task: 'Task 3',
                        fee: 700,
                        expense: 250,
                        profit: 450,
                        finished: false,
                        employees: [
                            {
                                id: 5,
                                name: 'Davy',
                            },
                            {
                                id: 6,
                                name: 'Tithya',
                            }
                        ],
                        purchases: [
                            {
                                id: 1,
                                subject: 'Object 3',
                                paid: 500,
                                description: 'description 3'
                            },
                            {
                                id: 2,
                                subject: 'Object 4',
                                paid: 250,
                                description: 'description 4',
                            }
                        ]
                    },
                    {
                        id: 4,
                        task: 'Task 4',
                        fee: 900,
                        expense:400,
                        profit: 500,
                        finished: false,
                        employees: [
                            {
                                id: 7,
                                name: 'Viputh',
                            },
                            {
                                id: 8,
                                name: 'Chin',
                            }
                        ],
                        purchases: [
                            {
                                id: 1,
                                subject: 'Object 5',
                                paid: 500,
                                description: 'description 5'
                            },
                            {
                                id: 2,
                                subject: 'Object 6',
                                paid: 250,
                                description: 'description 6',
                            }
                        ]
                    }
                ],
                selectedEmps: null,
                selectedPurchases: null,
            }
        },
        methods:{
            showTaskDetail(selectedEmployee, selectedPurchases){
                this.selectedEmps = selectedEmployee;
                this.selectedPurchases = selectedPurchases;
            }
        },
        computed:{
            selectedEmployees(){
                return this.selectedEmps;
            },
            selectedPurchasesData(){
                return this.selectedPurchases;
            }
        }
    }
</script>

<style scoped>
    .dashboard-container{
        display: grid;
        grid-template-columns: auto auto;
        grid-gap: 10px;
    }
</style>
