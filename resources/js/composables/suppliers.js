import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

export default function useSuppliers() {

    const supplier = ref([])
    const suppliers = ref([])
    const errors = ref('')

    const router = useRouter()

    const getSuppliers = async () => {

        const response = await axios.get('/api/suppliers');

        suppliers.value = response.data.data;
    }

    const getSupplier = async (id) => {

        const response = await axios.get(`/api/suppliers/${id}`);

        supplier.value = response.data.data
    }

    const storeSupplier = async (data) => {

        try {

            await axios.post('/api/suppliers', data)
            await router.push({ name: 'suppliers.index' })

        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors;
            }
        }
    }

    const updateSupplier = async (id) => {

        try {

            await axios.put(`/api/suppliers/${id}`, supplier.value)
            await router.push({ name: 'suppliers.index' })

        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors;
            }
        }
    }

    const destroySupplier = async (id) => {
        await axios.delete(`/api/suppliers/${id}`)
    }

    return {
        getSuppliers,
        getSupplier,
        suppliers,
        supplier,
        storeSupplier,
        updateSupplier,
        destroySupplier,
        errors
    }
}


