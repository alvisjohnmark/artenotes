<script setup>
import {
    User,
    Mail,
    Lock,
} from "lucide-vue-next";
import { authStore } from "./AuthStore/authClient";
import Nav from "../../components/nav.vue"
const user = authStore();
</script>

<template>
    <section class="bg-lpbgcolor min-h-screen">
        <Nav/>
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
