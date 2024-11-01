<script setup>
import {
    User,
    Mail,
    Lock,
    Eye,
    EyeOff
} from "lucide-vue-next";
import { authStore } from "./AuthStore/authClient";
import Nav from "../../components/nav.vue";
const user = authStore();
</script>

<template>
    <section class="bg-lpbgcolor min-h-screen">
        <Nav />
        <main class="flex justify-center items-center min-h-full py-10">
            <div class="bg-white shadow-lg rounded-lg overflow-hidden flex w-[600px]">
                <div class="w-1/3 flex flex-col justify-center items-center bg-lptxcolorlight p-8 relative">
                    <img src="/public/img/logo.png" class="h-28 w-auto mb-6" alt="Logo" />
                    <p class="text-center text-white text-sm italic">Your journey starts here</p>
                    <div class="absolute bottom-0 left-0 w-full h-1 bg-white opacity-30"></div>
                </div>
                
                <div class="w-2/3 p-10">
                    <h2 class="text-3xl font-bold text-lptxcolor mb-6">Register Account</h2>
                    <form @submit.prevent="user.registerUser()" class="space-y-4">
                        <div class="flex items-center border-b-2 border-gray-300 pb-2">
                            <User class="text-gray-400" />
                            <input
                                v-model="user.name"
                                type="text"
                                placeholder="Full Name"
                                class="ml-3 flex-1 border-none focus:outline-none focus:ring-0 placeholder-gray-500"
                            />
                        </div>
                        <div class="flex items-center border-b-2 border-gray-300 pb-2">
                            <Mail class="text-gray-400" />
                            <input
                                v-model="user.email"
                                type="email"
                                placeholder="Email"
                                class="ml-3 flex-1 border-none focus:outline-none focus:ring-0 placeholder-gray-500"
                            />
                        </div>
                        <div class="flex items-center border-b-2 border-gray-300 pb-2">
                            <Lock class="text-gray-400" />
                            <input
                                v-model="user.password"
                                @input="user.onPasswordInput"
                                :type="user.showPassword ? 'text' : 'password'"
                                placeholder="Password"
                                class="ml-3 flex-1 bg-transparent border-none focus:outline-none py-2 placeholder-gray-500"
                            />
                            <button
                                v-if="user.showPasswordIcon"
                                type="button"
                                @click="user.togglePasswordVisibility()"
                                class="text-gray-400"
                            >
                                <Eye v-if="!user.showPassword" />
                                <EyeOff v-else />
                            </button>
                        </div>
                        <div class="flex items-center border-b-2 border-gray-300 pb-2">
                            <Lock class="text-gray-400" />
                            <input
                                v-model="user.confirmPassword"
                                @input="user.onConfirmPasswordInput"
                                :type="user.showConfirmPassword ? 'text' : 'password'"
                                placeholder="Confirm Password"
                                class="ml-3 flex-1 bg-transparent border-none focus:outline-none py-2 placeholder-gray-500"
                            />
                            <button
                                v-if="user.showConfirmPasswordIcon"
                                type="button"
                                @click="user.toggleConfirmPasswordVisibility()"
                                class="text-gray-400"
                            >
                                <Eye v-if="!user.showConfirmPassword" />
                                <EyeOff v-else />
                            </button>
                        </div>
                        <div class="mt-6">
                            <button
                                type="submit"
                                class="w-full bg-lptxcolor text-white py-2 rounded-sm transition duration-300"
                            >
                                Register
                            </button>
                        </div>
                    </form>
                    <p class="text-sm text-gray-500 mt-4">
                        Already have an account?
                        <router-link to="/login" class="text-lptxcolor hover:underline"
                            >Log in</router-link
                        >
                    </p>
                </div>
            </div>
        </main>
    </section>
</template>

<style scoped>
/* Custom styles for layout and design */
</style>
