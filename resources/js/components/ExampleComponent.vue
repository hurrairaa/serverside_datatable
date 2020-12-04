<template>
    <div class="container">
            <br><br>
            <data-table
                :per-page="['10','25','50','100','200','400']"
                :columns="columns"
                url="http://127.0.0.1:8002/datatable">
            </data-table>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data() {
            return {
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
                        orderable: false,
                    },
                    {
                        label: 'Phone No',
                        name: 'phone_no',
                        orderable: false,
                    },
                    {
                        label: 'Product',
                        name: 'title',
                        orderable: false,
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
