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
        <aside
            class="w-64 bg-lpbgcolordark text-lptxcolorlight flex flex-col p-4 text-center border-r border-gray-700 shadow-lg"
        >
            <h2 class="text-2xl font-bold mb-4 text-lptxcolorsemilight">
                Admin panel
            </h2>
            <nav class="space-y-4">
                <router-link
                    to="/admin/dashboard"
                    class="flex items-center p-2 rounded transition-all duration-200 transform hover:bg-opacity-10 hover:bg-white hover:text-white text-opacity-90"
                    active-class="bg-lptxcolorsemilight bg-opacity-20"
                >
                    <Home
                        :size="32"
                        :stroke-width="1.25"
                        class="text-lptxcolorlight transition-colors duration-200"
                    />
                    <span class="ml-4 text-lg">Dashboard</span>
                </router-link>
                <router-link
                    to="/admin/products"
                    class="flex items-center p-2 rounded transition-all duration-200 transform hover:bg-opacity-10 hover:bg-white hover:text-white text-opacity-90"
                    active-class="bg-lptxcolorsemilight bg-opacity-20"
                >
                    <Box
                        :size="32"
                        :stroke-width="1.25"
                        class="text-lptxcolorlight transition-colors duration-200"
                    />
                    <span class="ml-4 text-lg">Products</span>
                </router-link>
                <router-link
                    to="/admin/services"
                    class="flex items-center p-2 rounded transition-all duration-200 transform hover:bg-opacity-10 hover:bg-white hover:text-white text-opacity-90"
                    active-class="bg-lptxcolorsemilight bg-opacity-20"
                >
                    <Settings
                        :size="32"
                        :stroke-width="1.25"
                        class="text-lptxcolorlight transition-colors duration-200"
                    />
                    <span class="ml-4 text-lg">Services</span>
                </router-link>
                <router-link
                    to="/admin/orders"
                    class="flex items-center p-2 rounded transition-all duration-200 transform hover:bg-opacity-10 hover:bg-white hover:text-white text-opacity-90"
                    active-class="bg-lptxcolorsemilight bg-opacity-20"
                >
                    <FileText
                        :size="32"
                        :stroke-width="1.25"
                        class="text-lptxcolorlight transition-colors duration-200"
                    />
                    <span class="ml-4 text-lg">Orders</span>
                </router-link>
                <button
                    @click="admin.logoutAdmin()"
                    class="flex items-center w-full p-2 rounded transition-all duration-200 transform hover:bg-opacity-10 hover:bg-white hover:text-white text-opacity-90"
                >
                    <LogOut
                        :size="32"
                        :stroke-width="1.25"
                        class="text-lptxcolorlight transition-colors duration-200"
                    />
                    <span class="ml-4 text-lg">Logout</span>
                </button>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6 bg-bglightcolor">
            <div class="mb-4 flex justify-between items-center">
                <h1 class="text-2xl font-semibold text-lptxcolor">Orders</h1>
                <p class="text-lg text-lptxcolor">Welcome, [Name]</p>
            </div>
        </main>
    </div>
</template>
