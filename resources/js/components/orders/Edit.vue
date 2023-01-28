 
 <template>
     <div>

     <h3 class="text-2xl mb-4">Edit product</h3>

    <form class="space-y-6" @submit.prevent="editProduct">
        <div class="space-y-4 rounded-md shadow-sm">
            <div>
                <label for="product_name" class="block text-sm font-medium text-gray-700">Name</label>
                <div class="mt-1">
                    <input type="text" name="product_name" id="product_name"
                           class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="product.product_name">
                </div>
                <div
                  class="font-medium ml-3 text-red-700"
                  v-if="errors && errors.product_name"
                >
                {{errors.product_name[0]}}
                </div>
            </div>

            <div>
                <label for="unit_price" class="block text-sm font-medium text-gray-700">Price</label>
                <div class="mt-1">
                    <input type="text" name="unit_price" id="unit_price"
                           class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="product.unit_price">
                </div>

                <div
                  class="font-medium ml-3 text-red-700"
                  v-if="errors && errors.unit_price"
                >
                {{errors.unit_price[0]}}
                </div>
            </div>

            <div>
                <label for="supplier_id" class="block text-sm font-medium text-gray-700">Supplier</label>
                <div class="mt-1">
                    <select name="supplier_id" id="supplier_id"
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="product.supplier_id" >
                        <option v-for="supplier in suppliers" :value="supplier.id">{{ supplier.company_name }}</option>
                    </select>
                </div>
                <div
                  class="font-medium ml-3 text-red-700"
                  v-if="errors && errors.supplier_id"
                >
                {{errors.supplier_id[0]}}
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
 import useProducts from '../../composables/products'
 import useSuppliers from '../../composables/suppliers'

 export default {

    props: {
        id: {
            required: true,
            type: String
        }
    },

     setup(props) {

        const { errors, getProduct, product, updateProduct } = useProducts()
        const { suppliers, getSuppliers } = useSuppliers()
        onMounted(() => getProduct(props.id))
        onMounted(getSuppliers);

        const editProduct = async () => {
               await updateProduct(props.id)
               await getSuppliers()
        }

        return {
            product,
            suppliers,
            errors,
            editProduct
        }
     }
 }
 </script>
