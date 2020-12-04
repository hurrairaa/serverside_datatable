<template>
    <div class="container">
            <br><br>
        <data-table
                :per-page="['10','25','50','100','200','400']"
                :columns="columns"
                url="http://127.0.0.1:8000/datatable"
                :filters="filters">
            <div slot="filters" slot-scope="{ tableFilters, perPage }">
                    <div class="row mb-2">
                        <div class="col-md-2">
                            <select class="form-control" v-model="tableFilters.length">
                                <option :key="page" v-for="page in perPage">{{ page }}</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select
                                v-model="tableFilters.filters.month"
                                class="form-control">
                                <option value>All</option>
                                <option value='1'>January</option>
                                <option value='2'>February</option>
                                <option value='3'>March</option>
                                <option value='4'>April</option>
                                <option value='5'>May</option>
                                <option value='6'>June</option>
                                <option value='7'>July</option>
                                <option value='8'>August</option>
                                <option value='9'>September</option>
                                <option value='10'>Octuber</option>
                                <option value='11'>November</option>
                                <option value='12'>December</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select
                                v-model="tableFilters.filters.year"
                                class="form-control">
                                <option value>All</option>
                                <option value='2000'>2000</option>
                                <option value='2001'>2001</option>
                                <option value='2002'>2002</option>
                                <option value='2003'>2003</option>
                                <option value='2004'>2004</option>
                                <option value='2005'>2005</option>
                                <option value='2006'>2006</option>
                                <option value='2007'>2007</option>
                                <option value='2008'>2008</option>
                                <option value='2009'>2009</option>
                                <option value='2010'>2010</option>
                                <option value='2011'>2011</option>
                                <option value='2012'>2012</option>
                                <option value='2013'>2013</option>
                                <option value='2014'>2014</option>
                                <option value='2015'>2015</option>
                                <option value='2016'>2016</option>
                                <option value='2017'>2017</option>
                                <option value='2018'>2018</option>
                                <option value='2019'>2019</option>
                                <option value='2020'>2020</option>
                                <option value='2021'>2021</option>
                                <option value='2022'>2022</option>
                                <option value='2023'>2023</option>
                                <option value='2024'>2024</option>
                                <option value='2025'>2025</option>
                                <option value='2026'>2026</option>
                                <option value='2027'>2027</option>
                                <option value='2028'>2028</option>
                                <option value='2029'>2029</option>
                                <option value='2030'>2030</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <input
                                name="name"
                                class="form-control"
                                v-model="tableFilters.search"
                                placeholder="Search Table">
                        </div>
                        <div class="col-md-4">
                            <date-range-picker               
                                    style="width:100%"
                                    :timePicker="false" 
                                    :timePicker24Hour="false"
                                    :showWeekNumbers="false"
                                    :showDropdowns="true"
                                    :linkedCalendars="true"
                                    :autoApply="true"
                                    :alwaysShowCalendars="false"
                                    v-model="dateRange"
                                    @update="updateValues"
                            >
                                <!-- <template v-slot:input="picker" style="min-width: 350px;">
                                    {{ picker.startDate | date }} - {{ picker.endDate | date }}
                                </template> -->
                            </date-range-picker>
                        </div>
                            <!-- <input type="hidden" v-model="filters.date"> -->
                    </div>
                </div>
            </data-table>
    </div>
</template>

<script>
import DateRangePicker from 'vue2-daterange-picker'
import 'vue2-daterange-picker/dist/vue2-daterange-picker.css'
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        components: { DateRangePicker },
        methods:{
            updateValues(){
                let startDate=new Date(this.dateRange.startDate);
                startDate=startDate.getFullYear()+'-'+this.formateDay(startDate.getMonth()+1)+'-'+this.formateDay(startDate.getDate());

                let endDate=new Date(this.dateRange.endDate);
                endDate=endDate.getFullYear()+'-'+this.formateDay(endDate.getMonth()+1)+'-'+this.formateDay(endDate.getDate());

                this.filters.date=startDate+'|'+endDate;
            },
            formateDay(day){
                return (day<10)?'0'+day:day;
            },
        },
        data() {
            return {
                dateRange:{},
                filters: {
                    month: '',
                    year:'',
                    date:''
                },
                columns: [
                    {
                        label: 'ID',
                        name: 'id',
                        orderable: true,
                    },
                    {
                        label: 'Name',
                        name: 'name',
                        orderable: true,
                    },
                    {
                        label: 'Email',
                        name: 'email',
                        orderable: true,
                    },
                    {
                        label: 'Address',
                        name: 'address',
                        orderable: true,
                    },
                    {
                        label: 'Phone No',
                        name: 'phone_no',
                        orderable: true,
                    },
                    {
                        label: 'Product',
                        name: 'title',
                        orderable: true,
                    },
                    {
                        label: 'Timestamp',
                        name: 'created_at',
                        orderable: true,
                    },
                ]
            }
        },
    }
</script>
