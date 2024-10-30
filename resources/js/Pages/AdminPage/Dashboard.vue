<script setup>
import {
    Home,
    Box,
    Settings,
    FileText,
    Users,
    LogOut,
    Banknote,
    UserRoundPlus,
    BadgeDollarSign,
} from "lucide-vue-next";
import { adminFunctions } from "./AdminStore/adminStore";
import { onMounted } from "vue";
const admin = adminFunctions();
onMounted(() => {
    admin.getAdminName();
});

</script>

<template>
    <div class="min-h-screen flex bg-bglightcolor">
        <!-- Sidebar -->
        <aside class="w-64 bg-lpbgcolordark text-lptxcolorlight flex flex-col p-4 border-r border-gray-700 shadow-lg">
            <h2 class="text-2xl font-bold mb-4 text-lptxcolorsemilight">
                Admin panel
            </h2>
            <nav class="space-y-4">
                <router-link
                    to="/admin/dashboard"
                    class="flex items-center p-2 rounded transition-all duration-200 transform hover:bg-opacity-10 hover:bg-white hover:text-white text-opacity-90"
                    active-class="bg-lptxcolorsemilight bg-opacity-20"
                >
                    <Home :size="32" :stroke-width="1.25" class="text-lptxcolorlight transition-colors duration-200" />
                    <span class="ml-4 text-lg">Dashboard</span>
                </router-link>
                <router-link
                    to="/admin/products"
                    class="flex items-center p-2 rounded transition-all duration-200 transform hover:bg-opacity-10 hover:bg-white hover:text-white text-opacity-90"
                    active-class="bg-lptxcolorsemilight bg-opacity-20"
                >
                    <Box :size="32" :stroke-width="1.25" class="text-lptxcolorlight transition-colors duration-200" />
                    <span class="ml-4 text-lg">Products</span>
                </router-link>
                <router-link
                    to="/admin/services"
                    class="flex items-center p-2 rounded transition-all duration-200 transform hover:bg-opacity-10 hover:bg-white hover:text-white text-opacity-90"
                    active-class="bg-lptxcolorsemilight bg-opacity-20"
                >
                    <Settings :size="32" :stroke-width="1.25" class="text-lptxcolorlight transition-colors duration-200" />
                    <span class="ml-4 text-lg">Services</span>
                </router-link>
                <router-link
                    to="/admin/orders"
                    class="flex items-center p-2 rounded transition-all duration-200 transform hover:bg-opacity-10 hover:bg-white hover:text-white text-opacity-90"
                    active-class="bg-lptxcolorsemilight bg-opacity-20"
                >
                    <FileText :size="32" :stroke-width="1.25" class="text-lptxcolorlight transition-colors duration-200" />
                    <span class="ml-4 text-lg">Orders</span>
                </router-link>
                <button
                    class="flex items-center w-full p-2 rounded transition-all duration-200 transform hover:bg-opacity-10 hover:bg-white hover:text-white text-opacity-90"
                >
                    <LogOut :size="32" :stroke-width="1.25" class="text-lptxcolorlight transition-colors duration-200" />
                    <span class="ml-4 text-lg">Logout</span>
                </button>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6 bg-bglightcolor">
            <div class="mb-4 flex justify-between items-center">
                <h1 class="text-2xl font-semibold text-lptxcolor">Dashboard</h1>
                <p class="text-lg text-lptxcolor">Welcome, {{ admin.adminName }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <!-- Static Stats Cards -->
                <div class="bg-white p-4 rounded-lg shadow text-lptxcolor">
                    <div class="flex items-center justify-between">
                        <span>Today's Money</span>
                        <Banknote :size="32" :stroke-width="1.25" class="text-fmbtcolor" />
                    </div>
                    <h3 class="text-2xl font-bold">$53k</h3>
                    <p class="text-lptxcolorlight">+55% than last week</p>
                </div>

                <div class="bg-white p-4 rounded-lg shadow text-lptxcolor">
                    <div class="flex items-center justify-between">
                        <span>Today's Users</span>
                        <Users :size="32" :stroke-width="1.25" class="text-fmbtcolor" />
                    </div>
                    <h3 class="text-2xl font-bold">2,300</h3>
                    <p class="text-lptxcolorlight">+3% than last month</p>
                </div>

                <div class="bg-white p-4 rounded-lg shadow text-lptxcolor">
                    <div class="flex items-center justify-between">
                        <span>New Clients</span>
                        <UserRoundPlus :size="32" :stroke-width="1.25" class="text-fmbtcolor" />
                    </div>
                    <h3 class="text-2xl font-bold">3,462</h3>
                    <p class="text-red-500">-2% than yesterday</p>
                </div>

                <div class="bg-white p-4 rounded-lg shadow text-lptxcolor">
                    <div class="flex items-center justify-between">
                        <span>Sales</span>
                        <BadgeDollarSign :size="32" :stroke-width="1.25" class="text-fmbtcolor" />
                    </div>
                    <h3 class="text-2xl font-bold">$103,430</h3>
                    <p class="text-lptxcolorlight">+5% than yesterday</p>
                </div>
            </div>

            <!-- Chart Placeholders -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-white p-4 rounded-lg shadow">
                    <h2 class="text-lg font-semibold mb-2 text-lptxcolor">
                        Website View
                    </h2>
                    <p class="text-gray-500">Last Campaign Performance</p>
                    <div class="h-32 bg-gray-200 mt-4 rounded"></div>
                </div>

                <div class="bg-white p-4 rounded-lg shadow">
                    <h2 class="text-lg font-semibold mb-2 text-lptxcolor">
                        Daily Sales
                    </h2>
                    <p class="text-gray-500">15% increase in today sales</p>
                    <div class="h-32 bg-gray-200 mt-4 rounded"></div>
                </div>

                <div class="bg-white p-4 rounded-lg shadow">
                    <h2 class="text-lg font-semibold mb-2 text-lptxcolor">
                        Completed Tasks
                    </h2>
                    <p class="text-gray-500">Last Campaign Performance</p>
                    <div class="h-32 bg-gray-200 mt-4 rounded"></div>
                </div>
            </div>
        </main>
    </div>
</template>
