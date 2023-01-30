<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link  :active="url('/products')">
                    <router-link :to="{ name: 'products.index' }" >
                        {{ __('Products') }}
                    </router-link>
                    </x-nav-link>
                    <x-nav-link  :active="url('/orders')">
                    <router-link :to="{ name: 'orders.index' }" >
                        {{ __('Orders') }}
                    </router-link>
                    </x-nav-link>
                
                </div>
            </div>



        </div>
    </div>


</nav>

