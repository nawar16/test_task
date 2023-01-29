 
 <template>
     <div>

     <h3 class="text-2xl mb-4">Edit order</h3>

    <form class="space-y-6" @submit.prevent="editOrder">
        <div class="space-y-4 rounded-md shadow-sm">
            <div>
                <label for="order_date" class="block text-sm font-medium text-gray-700">Order date</label>
                <div class="mt-1">
                    <input type="date" name="order_date" id="order_date"
                           class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="order.order_date">
                </div>
                <div
                  class="font-medium ml-3 text-red-700"
                  v-if="errors && errors.order_date"
                >
                {{errors.order_date[0]}}
                </div>
            </div>
            <div>
                <label for="customer_id" class="block text-sm font-medium text-gray-700">Customer</label>
                <div class="mt-1">
                    <select name="customer_id" id="customer_id"
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="order.customer_id" >
                        <option v-for="customer in customers" :value="customer.id">{{ customer.first_name }} {{ customer.last_name }}</option>
                    </select>
                </div>
                <div
                  class="font-medium ml-3 text-red-700"
                  v-if="errors && errors.customer_id"
                >
                {{errors.customer_id[0]}}
                </div>
            </div>
            <div>
                <label for="items" class="block text-sm font-medium text-gray-700" @click="addItem()"><i class="fa fa-add"></i> Add Order Item</label>
                <div class="mt-1">
                
                <ul ref="list" class="list" v-sortable="{animation: 250, onUpdate: work}">
                    <li v-for="(item, index) in order.order_items" :_id="item.id" :order="item.order" :key="item.id" >
                        <div class="grid grid-cols-3 gap-3">
                            <div ><input v-model="item.quantity" placeholder="Enter quantity" type="number" @change="setQ($event, item.id)"/></div>
                            <div >
                            <select
                            v-model="item.product_id"
                            @change="setP($event, item.id)"
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            >
                            <option value="">Choose Product</option>
                            <option v-for="product in products" :value="product.id">{{ product.product_name }}</option>
                            </select>
                            </div>
                         
                        </div>
                    </li>
                    <li v-for="(item, index) in orderedItems" :_id="item.id" :order="item.order" :key="item.id" >
                        <div class="grid grid-cols-3 gap-3">
                            <div ><input v-model="item.quantity" placeholder="Enter quantity" type="number" @change="setQ($event, item.id)"/></div>
                            <div >
                            <select
                            v-model="item.product_id"
                            @change="setP($event, item.id)"
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            >
                            <option value="">Choose Product</option>
                            <option v-for="product in products" :value="product.id">{{ product.product_name }}</option>
                            </select>
                            </div>
                            <div >
                                <button @click="deleteItem(index)"><i class="fa fa-trash">  </i></button>
                            </div>
                        </div>
                    </li>
                </ul>

                <div
                  class="font-medium ml-3 text-red-700"
                  v-if="errors && errors.orderedItems"
                >
                {{errors.orderedItems[0]}}
                </div>
            </div>
            </div>

      
         

        </div>

        <div class="flex place-content-end mb-4">
        <button type="submit"
                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase bg-blue-800 rounded-md border border-transparent ring-blue-300 transition duration-150 ease-in-out hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring disabled:opacity-25">
        UPDATE
        </button>
        </div>
    </form>
 </div>
 </template>
 <script>

 import { onMounted } from 'vue'
 import useOrders from '../../composables/orders'
 import useSuppliers from '../../composables/suppliers'
 import useCustomers from '../../composables/customers'
 import useProducts from '../../composables/products'

 export default {

    props: {
        id: {
            required: true,
            type: String
        }
    },
    data() {
        return {
            items: [],
            orderedItems: [{id: 0, product_id: '', quantity: ''  }],
        }
    },
    created: function()
    {
        this.orderedItems = _.orderBy(this.items, 'order')
    },
    methods: {
        work: function(event)
        {
            const { oldIndex, newIndex } = event
            const movedItem = this.orderedItems.splice(oldIndex, 1)
            this.orderedItems.splice(newIndex, 0, ...movedItem)
        },
        deleteItem(index) {
            this.orderedItems.splice(index, 1)
        },
        addItem(){
            let newI = this.orderedItems.length
            this.orderedItems.push({id: newI, product_id: '', quantity: ''})
        },
        setQ($event, item_id) {
            this.orderedItems[item_id].quantity = $event.target.value
            this.order.items = this.orderedItems
        },
        setP($event, item_id) {
            this.orderedItems[item_id].product_id = $event.target.value
            this.order.items = this.orderedItems
        }
    },
     setup(props) {

        const { errors, getOrder, order, updateOrder } = useOrders()
        const { suppliers, getSuppliers } = useSuppliers()
        const { customers, getCustomers } = useCustomers()
        const { products, getProducts } = useProducts()
        onMounted(() => getOrder(props.id))
        onMounted(getSuppliers);
        onMounted(getCustomers);
        onMounted(getProducts);


        const editOrder = async () => {
               await updateOrder(props.id)
               await getSuppliers()
        }

        return {
            order,
            customers,
            products,
            suppliers,
            errors,
            editOrder
        }
     }
 }
 </script>
