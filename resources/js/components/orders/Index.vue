
<template>
    <div>

    <div class="flex place-content-end mb-4">
        <div class="px-4 py-2 text-white bg-blue-700 hover:bg-indigo-800 rounded-lg cursor-pointer">
            <router-link :to="{ name: 'orders.create' }" class="text-sm font-medium"><i class="fa fa-add"></i> Add</router-link>
        </div>
    </div>

        <DataTable :value="orders" responsiveLayout="scroll"
            :paginator="true" :rows="10"
            paginatorTemplate="FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink CurrentPageReport RowsPerPageDropdown" 
            :rowsPerPageOptions="[10,25,50]"
            :filters="filters" 
            currentPageReportTemplate="Showing {first} to {last} of {totalRecords} entries"
    >

        <template #header>
            <div class="flex place-content-end">
                <input type="text" v-model="filters['global'].value" placeholder="Search..." class="rounded-md"/>
			</div>
        </template>
       <Column field="order_date" header="Date" :sortable="true">
       </Column>
       <Column field="order_number" header="Num" :sortable="true">
       </Column>
       <Column field="customer.first_name" header="Customer" :sortable="true"></Column>
       <Column field="total_amount" header="Total amount" :sortable="true"></Column>
       <Column header="actions">
            <template #body="slotProps">
                <router-link :to="{ name: 'orders.edit', params: { id: slotProps.data.id } }" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 mr-4"><i class="fa fa-edit"></i></router-link>
                <button @click="deleteOrder(slotProps.data.id)" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"><i class="fa fa-trash"></i></button>
            </template>
       </Column>
    </DataTable>
    </div>
</template>
<script>
import { onMounted, ref } from "vue";
import useOrders from "../../composables/orders";
import {FilterMatchMode} from 'primevue/api';

export default {
    setup() {
        const { orders, getOrders, destroyOrder } = useOrders();

        const deleteOrder = async (id) => {
            if (!window.confirm('Are you sure? This record will permanantly deleted')) {
                return
            }

            await destroyOrder(id)
            await getOrders()
        }
        onMounted(getOrders);

        const filters = ref({
            'global': {value: null, matchMode: FilterMatchMode.CONTAINS},
        });

        return {
            orders,
            filters,
            deleteOrder
        };
    },
};
</script>
