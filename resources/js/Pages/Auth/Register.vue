<script setup>
import {
    House,
    Users,
    ShoppingBag,
    MailCheck,
    LogIn,
    User,
    Mail,
    Lock,
} from "lucide-vue-next";
import { authStore } from "./AuthStore/authClient";
const user = authStore();
</script>

<template>
    <section class="bg-lpbgcolor min-h-screen">
        <nav class="bg-[#f5f0f1]">
            <div
                class="container mx-auto flex justify-between items-center py-4 px-10"
            >
                <div class="flex items-center">
                    <img src="/public/img/logo.png" class="h-20 w-auto" />
                </div>
                <h1 class="text-lptxcolor text-5xl font-playfair">artenotes</h1>

                <div class="flex items-center space-x-4">
                    <router-link
                        v-if="!user.token"
                        to="/login"
                        class="text-lptxcolor flex items-center space-x-1"
                    >
                        <span>
                            <LogIn :stroke-width="1" />
                        </span>
                        <span class="hover:text-[#5a5a3a] font-bebasneue"
                            >Sign In</span
                        >
                    </router-link>
                    <div v-else>
                        <span
                            class="text-lptxcolor flex items-center space-x-1 cursor-pointer"
                            @click="user.logoutUser()"
                        >
                            <User :stroke-width="1" />
                            <span class="hover:text-[#5a5a3a] font-bebasneue"
                                >Logout</span
                            >
                        </span>
                    </div>
                </div>
            </div>
            <hr class="border-lptxcolor" />
            <div class="container mx-auto flex justify-center gap-8 py-2">
                <router-link
                    to="/"
                    class="text-lptxcolor flex items-center space-x-1 p-1 border-b-2 border-lptxcolor"
                >
                    <span>
                        <House :stroke-width="1" />
                    </span>
                    <span class="hover:text-[#5a5a3a] font-bebasneue"
                        >HOME</span
                    >
                </router-link>

                <router-link
                    to="/about"
                    class="text-lptxcolor flex items-center space-x-1 p-1"
                >
                    <span>
                        <Users :stroke-width="1" />
                    </span>
                    <span class="hover:text-[#5a5a3a] font-bebasneue"
                        >ABOUT US</span
                    >
                </router-link>

                <router-link
                    to="/products"
                    class="text-lptxcolor flex items-center space-x-1 p-1"
                >
                    <span>
                        <ShoppingBag :stroke-width="1" />
                    </span>
                    <span class="hover:text-[#5a5a3a] font-bebasneue"
                        >PRODUCTS</span
                    >
                </router-link>

                <router-link
                    to="/services"
                    class="text-lptxcolor flex items-center space-x-1 p-1"
                >
                    <span>
                        <MailCheck :stroke-width="1" />
                    </span>
                    <span class="hover:text-[#5a5a3a] font-bebasneue"
                        >SERVICES</span
                    >
                </router-link>
            </div>
        </nav>
        <main class="flex justify-center items-center min-h-full py-10">
            <div
                class="bg-white shadow-lg rounded-lg overflow-hidden flex w-[600px]"
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
                    <h2 class="text-3xl font-bold mb-6">Register</h2>
                    <form
                        @submit.prevent="user.registerUser()"
                        class="space-y-4"
                    >
                        <div class="flex items-center border-b-2 pb-2">
                            <User class="text-gray-400" />
                            <input
                                v-model="user.name"
                                type="text"
                                placeholder="Full Name"
                                class="ml-3 flex-1 border-none focus:outline-none"
                            />
                        </div>
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
                                type="password"
                                placeholder="Password"
                                class="ml-3 flex-1 border-none focus:outline-none"
                            />
                        </div>
                        <div class="flex items-center border-b-2 pb-2">
                            <Lock class="text-gray-400" />
                            <input
                                v-model="user.confirmPassword"
                                type="password"
                                placeholder="Confirm Password"
                                class="ml-3 flex-1 border-none focus:outline-none"
                            />
                        </div>
                        <div class="mt-6">
                            <button
                                type="submit"
                                class="w-full bg-lptxcolor text-white py-2 rounded-full hover:from-green-500 hover:to-green-700"
                            >
                                Register
                            </button>
                        </div>
                    </form>
                    <p class="text-sm text-gray-500 mt-4">
                        Already have an account?
                        <a href="/login" class="text-lptxcolor hover:underline"
                            >Log in</a
                        >
                    </p>
                </div>
            </div>
        </main>
    </section>
</template>

<style scoped></style>
