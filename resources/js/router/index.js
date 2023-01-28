import { createRouter, createWebHistory } from 'vue-router'


import Index from '../views/Index.vue'
import ProductsIndex from '../components/products/Index.vue'
import ProductsCreate from '../components/products/Create.vue'
import ProductsEdit from '../components/products/Edit.vue'
import OrdersIndex from '../components/orders/Index.vue'
import OrdersCreate from '../components/orders/Create.vue'
import OrdersEdit from '../components/orders/Edit.vue'


const routes = [
    {
        path: '/dashboard',
        name: 'index',
        component: Index
    },
    {
        path: '/products',
        name: 'products.index',
        component: ProductsIndex

    },
    {
        path: '/products/create',
        name: 'products.create',
        component: ProductsCreate
    },
    {
        path: '/products/:id/edit',
        name: 'products.edit',
        component: ProductsEdit,
        props: true
    },
    {
        path: '/orders',
        name: 'orders.index',
        component: OrdersIndex

    },
    {
        path: '/orders/create',
        name: 'orders.create',
        component: OrdersCreate
    },
    {
        path: '/orders/:id/edit',
        name: 'orders.edit',
        component: OrdersEdit,
        props: true
    }
]

export default createRouter({
    history: createWebHistory(),
    routes
})


