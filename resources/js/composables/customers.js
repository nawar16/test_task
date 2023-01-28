import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

export default function useCustomers() {

    const customer = ref([])
    const customers = ref([])
    const errors = ref('')

    const router = useRouter()

    const getCustomers = async () => {

        const response = await axios.get('/api/customers');

        customers.value = response.data.data;
    }

    const getCustomer = async (id) => {

        const response = await axios.get(`/api/customers/${id}`);

        customer.value = response.data.data
    }


    return {
        getCustomers,
        getCustomer,
        customers,
        customer,
        errors
    }
}


