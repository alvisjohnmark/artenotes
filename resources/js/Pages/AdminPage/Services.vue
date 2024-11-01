<script setup>
import {
    Home,
    Box,
    Settings,
    FileText,
    LogOut,
    Bolt,
    Trash2,
} from "lucide-vue-next";
import { adminFunctions } from "./AdminStore/adminStore";
import { onMounted } from "vue";
const admin = adminFunctions();
onMounted(() => {
    admin.getAdminName();
    admin.fetchServices();
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

        <main class="flex-1 p-6 bg-bglightcolor">
            <div class="mb-4 flex justify-between items-center">
                <h1 class="text-2xl font-semibold text-lptxcolor">Services</h1>
                <button
                    @click="admin.toggleAddServiceModal()"
                    class="bg-lpbgcolordark text-white py-2 px-4 rounded-lg shadow-md hover:bg-opacity-80 transition-all"
                >
                    Add service
                </button>
            </div>

            <table
                class="min-w-full bg-white rounded-lg shadow-md overflow-hidden"
            >
                <thead class="bg-lpbgcolordark text-white">
                    <tr>
                        <th class="p-4 text-center">Service Name</th>
                        <th class="p-4 text-center">Service Description</th>
                        <th class="p-4 text-center">Service Price</th>
                        <th class="p-4 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        class="border-b border-gray-200"
                        v-for="service in admin.service_list"
                        :key="service.id"
                    >
                        <td class="p-4 text-center">
                            {{ service.service_name }}
                        </td>
                        <td class="p-4 text-justify">
                            {{ service.service_description }}
                        </td>
                        <td class="p-4 text-center">
                            ₱{{ service.service_price }}
                        </td>
                        <td class="p-4 text-center">
                            <div class="flex justify-center space-x-2">
                                <button
                                    @click="admin.editService(service)"
                                    class="flex items-center px-3 py-2 bg-green-600 text-white rounded hover:bg-green-700 focus:outline-none"
                                >
                                    <Bolt
                                        :stroke-width="1.5"
                                        class="mr-1 text-white"
                                    />
                                    <span>Edit</span>
                                </button>
                                <button
                                    @click="admin.deleteService(service.id)"
                                    class="flex items-center px-3 py-2 bg-red-600 text-white rounded hover:bg-red-700 focus:outline-none"
                                >
                                    <Trash2
                                        :stroke-width="1.5"
                                        class="mr-1 text-white"
                                    />
                                    <span>Delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div
                v-if="admin.showAddServiceModal"
                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
            >
                <div class="bg-white w-full max-w-lg p-8 rounded-lg shadow-lg">
                    <h2 class="text-xl font-semibold mb-4">Add Service</h2>
                    <form @submit.prevent="admin.addService()">
                        <div class="mb-4">
                            <label
                                class="block text-sm font-medium text-gray-700"
                                >Service Name</label
                            >
                            <input
                                type="text"
                                v-model="admin.service_name"
                                class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
                            />
                        </div>
                        <div class="mb-4">
                            <label
                                class="block text-sm font-medium text-gray-700"
                                >Service description</label
                            >
                            <textarea
                                rows="10"
                                cols="10"
                                v-model="admin.service_description"
                                class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
                            >
                            </textarea>
                        </div>
                        <div class="mb-4">
                            <label
                                class="block text-sm font-medium text-gray-700"
                                >Service Price</label
                            >
                            <input
                                type="number"
                                v-model="admin.service_price"
                                class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
                            />
                        </div>
                        <div class="flex justify-end space-x-4 mt-6">
                            <button
                                type="button"
                                @click="admin.toggleAddServiceModal"
                                class="py-2 px-4 bg-gray-500 text-white rounded-md hover:bg-gray-600"
                            >
                                Cancel
                            </button>
                            <button
                                type="submit"
                                class="py-2 px-4 bg-blue-600 text-white rounded-md hover:bg-blue-700"
                            >
                                Add service
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div
                v-if="admin.showEditServiceModal"
                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
            >
                <div class="bg-white w-full max-w-xl p-8 rounded-lg shadow-lg">
                    <h2 class="text-xl font-semibold mb-4">Edit service</h2>
                    <form @submit.prevent="admin.updateService()">
                        <div class="mb-4">
                            <label
                                class="block text-sm font-medium text-gray-700"
                                >Service Name</label
                            >
                            <input
                                type="text"
                                v-model="admin.service_name"
                                class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
                            />
                        </div>
                        <div class="mb-4">
                            <label
                                class="block text-sm font-medium text-gray-700"
                                >Service description</label
                            >
                            <textarea
                                rows="10"
                                cols="10"
                                v-model="admin.service_description"
                                class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
                            >
                            </textarea>
                        </div>
                        <div class="mb-4">
                            <label
                                class="block text-sm font-medium text-gray-700"
                                >Service Price</label
                            >
                            <input
                                type="number"
                                v-model="admin.service_price"
                                class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
                            />
                        </div>
                        <div class="flex justify-end space-x-4 mt-6">
                            <button
                                type="button"
                                @click="admin.toggleEditServiceModal"
                                class="py-2 px-4 bg-gray-500 text-white rounded-md hover:bg-gray-600"
                            >
                                Cancel
                            </button>
                            <button
                                type="submit"
                                class="py-2 px-4 bg-blue-600 text-white rounded-md hover:bg-blue-700"
                            >
                                Edit service
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</template>

<style scoped></style>
