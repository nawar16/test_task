import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

export default function useOrders() {

    const order = ref([])
    const orders = ref([])
    const errors = ref('')

    const router = useRouter()

    const getOrders = async () => {

        const response = await axios.get('/api/orders');

        orders.value = response.data.data;
    }

    const getOrder = async (id) => {

        const response = await axios.get(`/api/orders/${id}`);

        order.value = response.data.data
    }

    const storeOrder = async (data) => {

        try {

            await axios.post('/api/orders', data)
            await router.push({ name: 'orders.index' })

        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors;
            }
        }
    }

    const updateOrder = async (id) => {

        try {

            await axios.put(`/api/orders/${id}`, order.value)
            await router.push({ name: 'orders.index' })

        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors;
            }
        }
    }

    const destroyOrder = async (id) => {
        await axios.delete(`/api/orders/${id}`)
    }

    return {
        getOrders,
        getOrder,
        orders,
        order,
        storeOrder,
        updateOrder,
        destroyOrder,
        errors
    }
}


