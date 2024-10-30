<script setup>
import { Mail, Lock, Eye, EyeOff } from "lucide-vue-next";
import { authStore } from "./AuthStore/authClient";
import Nav from "../../components/nav.vue";
const user = authStore();
</script>

<template>
    <section class="bg-lpbgcolor min-h-screen">
        <Nav />
        <main class="flex justify-center items-center min-h-full py-20">
            <div
                class="bg-white shadow-lg rounded-lg overflow-hidden flex w-[500px]"
            >
                <div
                    class="bg-gradient-to-t from-lptxcolorsemilight to-lptxcolorlight w-1/3 flex justify-center items-start p-10"
                >
                    <img
                        src="/public/img/logo.png"
                        class="h-28 w-auto"
                        alt="Logo"
                    />
                </div>

                <div class="w-2/3 p-10">
                    <h2 class="text-3xl font-bold mb-6">Login</h2>
                    <form @submit.prevent="user.loginUser()" class="space-y-4">
                        <div class="flex items-center border-b-2 pb-2">
                            <Mail class="text-gray-400" />
                            <input
                                v-model="user.email"
                                type="email"
                                placeholder="Email"
                                class="ml-3 flex-1 border-none focus:outline-none"
                            />
                        </div>
                        <div class="flex items-center border-b-2 pb-2">
                            <Lock class="text-gray-400" />
                            <input
                                v-model="user.password"
                                @input="user.onPasswordInput"
                                :type="user.showPassword ? 'text' : 'password'"
                                placeholder="Password"
                                class="ml-3 flex-1 bg-transparent border-none focus:outline-none py-2 text-gray-700 placeholder-gray-400"
                            />
                            <!-- Toggle password visibility only if there's input -->
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
                        <div class="mt-6">
                            <button
                                type="submit"
                                class="w-full bg-lptxcolor text-white py-2 rounded-sm hover:from-green-500 hover:to-green-700"
                            >
                                Login
                            </button>
                        </div>
                    </form>
                    <p class="text-sm text-gray-500 mt-4">
                        Dont't have an account?
                        <router-link
                            to="/register"
                            class="text-lptxcolor hover:underline"
                            >Register now</router-link
                        >
                    </p>
                </div>
            </div>
        </main>
    </section>
</template>

<style scoped></style>
