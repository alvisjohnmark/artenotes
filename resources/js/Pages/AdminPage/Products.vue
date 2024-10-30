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
import { adminStore } from "./AdminStore/adminStore";
const admin = adminStore();
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
                <h1 class="text-2xl font-semibold text-lptxcolor">Products</h1>
                <button
                    @click="admin.toggleAddModal"
                    class="bg-lpbgcolordark text-white py-2 px-4 rounded-lg shadow-md hover:bg-opacity-80 transition-all"
                >
                    Add Product
                </button>
            </div>

            <table
                class="min-w-full bg-white rounded-lg shadow-md overflow-hidden"
            >
                <thead class="bg-lpbgcolordark text-white">
                    <tr>
                        <th class="p-4 text-center">Name</th>
                        <th class="p-4 text-center">Stock</th>
                        <th class="p-4 text-center">Price</th>
                        <th class="p-4 text-center">Color</th>
                        <th class="p-4 text-center">Size</th>
                        <th class="p-4 text-center">Sheets per Paper</th>
                        <th class="p-4 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-gray-200">
                        <td class="p-4 text-center">Sample Product</td>
                        <td class="p-4 text-center">50</td>
                        <td class="p-4 text-center">$10.00</td>
                        <td class="p-4 text-center">Blue</td>
                        <td class="p-4 text-center">A4</td>
                        <td class="p-4 text-center">100</td>
                        <td class="p-4 text-center">
                            <div class="flex justify-center space-x-2">
                                <button
                                    @click="admin.toggleEditModal()"
                                    class="flex items-center px-3 py-2 bg-green-600 text-white rounded hover:bg-green-700 focus:outline-none"
                                >
                                    <Bolt
                                        :stroke-width="1.5"
                                        class="mr-1 text-white"
                                    />
                                    <span>Edit</span>
                                </button>
                                <button
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
                v-if="admin.showAddModal"
                class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50"
            >
                <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                    <h2 class="text-xl font-bold mb-4">Add Product</h2>
                    <form>
                        <div class="flex justify-end space-x-2">
                            <button
                                type="button"
                                @click="admin.toggleAddModal()"
                                class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600"
                            >
                                Cancel
                            </button>
                            <button
                                type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
                            >
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Edit Product Modal -->
            <div
                v-if="admin.showEditModal"
                class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50"
            >
                <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                    <h2 class="text-xl font-bold mb-4">Edit Product</h2>
                    <form>
                        <!-- Form Fields -->
                        <div class="flex justify-end space-x-2">
                            <button
                                type="button"
                                @click="admin.toggleEditModal()"
                                class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600"
                            >
                                Cancel
                            </button>
                            <button
                                type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
                            >
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</template>

<style scoped></style>
