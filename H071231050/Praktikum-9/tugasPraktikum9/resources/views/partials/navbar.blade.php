<nav class="bg-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <a href="#"
                        class="text-2xl font-extrabold text-white tracking-widest hover:text-indigo-400 transition-colors duration-300 drop-shadow-md">
                        VINKER
                    </a>
                </div>
                <div class="ml-10 flex items-baseline space-x-4">
                    <!-- Products Link -->
                    <a href="{{ route('products.index') }}"
                        class="{{ request()->routeIs('products.index') ? 'bg-gray-800 text-indigo-500 border-b-4 border-indigo-500' : 'text-gray-300 hover:bg-gray-700 hover:text-indigo-400' }} px-3 py-2 rounded-t-md text-sm font-medium">
                        Products
                    </a>
                    <!-- Category Link -->
                    <a href="{{ route('category.index') }}"
                        class="{{ request()->routeIs('category.index') ? 'bg-gray-800 text-indigo-500 border-b-4 border-indigo-500' : 'text-gray-300 hover:bg-gray-700 hover:text-indigo-400' }} px-3 py-2 rounded-t-md text-sm font-medium">
                        Category
                    </a>
                    <!-- Inventory Link -->
                    <a href="{{ route('inventoryLog.index') }}"
                        class="{{ request()->routeIs('inventoryLog.index') ? 'bg-gray-800 text-indigo-500 border-b-4 border-indigo-500' : 'text-gray-300 hover:bg-gray-700 hover:text-indigo-400' }} px-3 py-2 rounded-t-md text-sm font-medium">
                        Inventory
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>

