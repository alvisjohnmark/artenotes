<script setup>
import { Mail, Lock, Eye, EyeOff } from "lucide-vue-next";
import { adminStore } from "./AuthStore/authAdmin";
const admin = adminStore();
</script>

<template>
    <section
        class="bg-gradient-to-br from-gray-100 to-gray-300 min-h-screen flex items-center justify-center"
    >
        <main class="bg-white shadow-xl rounded-lg max-w-md w-full mx-4">
            <div class="p-8">
                <h2
                    class="text-4xl font-extrabold text-gray-800 mb-8 text-center"
                >
                    Admin
                </h2>
                <form @submit.prevent="admin.loginAdmin()" class="space-y-6">
                    <!-- Email input -->
                    <div
                        class="relative flex items-center border-b border-gray-300 focus-within:border-lptxcolor transition duration-300"
                    >
                        <Mail class="text-gray-400" />
                        <input
                            v-model="admin.email"
                            type="email"
                            placeholder="Email"
                            class="ml-3 flex-1 bg-transparent border-none focus:outline-none py-2 text-gray-700 placeholder-gray-400"
                        />
                    </div>
                    <!-- Password input -->
                    <div
                        class="relative flex items-center border-b border-gray-300 focus-within:border-lptxcolor transition duration-300"
                    >
                        <Lock class="text-gray-400" />
                        <input
                            v-model="admin.password"
                            @input="admin.onPasswordInput"
                            :type="admin.showPassword ? 'text' : 'password'"
                            placeholder="Password"
                            class="ml-3 flex-1 bg-transparent border-none focus:outline-none py-2 text-gray-700 placeholder-gray-400"
                        />
                        <!-- Toggle password visibility only if there's input -->
                        <button
                            v-if="admin.showPasswordIcon"
                            type="button"
                            @click="admin.togglePasswordVisibility()"
                            class="absolute right-0 mr-3 text-gray-400"
                        >
                            <Eye v-if="!admin.showPassword" />
                            <EyeOff v-else />
                        </button>
                    </div>

                    <!-- Submit button -->
                    <div class="mt-8">
                        <button
                            type="submit"
                            class="w-full bg-lptxcolor text-white py-3 rounded-sm font-semibold text-lg"
                        >
                            Login
                        </button>
                    </div>
                </form>
                <!-- Register link -->
                <p class="text-sm text-gray-500 mt-4">
                    New admin?
                    <router-link
                        to="/supersecretregisterpagehehe"
                        class="text-lptxcolor hover:underline"
                        >Register now</router-link
                    >
                </p>
            </div>
        </main>
    </section>
</template>

<style scoped></style>
