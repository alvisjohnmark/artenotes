<script setup>
import {
    House,
    Users,
    ShoppingBag,
    MailCheck,
    LogIn,
    User,
    LogOut,
    ShoppingCart,
} from "lucide-vue-next";
import { useRoute } from "vue-router";
import { authStore } from "../Pages/Auth/AuthStore/authClient";

const user = authStore();
const route = useRoute();
</script>

<template>
    <nav class="bg-[#f5f0f1]">
        <div
            class="container mx-auto flex justify-between items-center py-4 px-10"
        >
            <div class="flex items-center">
                <img src="/public/img/logo.png" class="h-20 w-auto" />
            </div>
            <router-link
                to="/"
                class="text-lptxcolor text-5xl font-playfair pl-10"
                >artenotes</router-link
            >

            <div class="flex items-center space-x-4">
                <router-link
                    v-if="!user.token"
                    to="/register"
                    class="text-lptxcolor flex items-center space-x-1"
                >
                    <span>
                        <LogIn :stroke-width="1" />
                    </span>
                    <span class="hover:text-[#5a5a3a] font-bebasneue"
                        >Sign In</span
                    >
                </router-link>
                <div v-else class="flex gap-2 relative">
                    <router-link
                        to="cart"
                        class="block px-4 py-2 text-gray-800 hover:bg-gray-200"
                    >
                        <ShoppingCart :size="32" :stroke-width="1" />
                    </router-link>
                    <div
                        class="flex items-center space-x-1 cursor-pointer"
                        @click="user.toggleDropDown"
                    >
                        <User :size="32" :stroke-width="1" />
                    </div>

                    <div
                        v-if="user.showDropdown"
                        class="absolute right-0 mt-12 py-2 w-48 mt-12 bg-white rounded-md shadow-lg"
                    >
                        <router-link
                            to="/profile"
                            class="block px-4 py-2 text-gray-800 hover:bg-gray-200"
                        >
                            <User
                                :size="24"
                                :stroke-width="1"
                                class="inline-block mr-2"
                            />Profile
                        </router-link>
                        <span
                            class="block px-4 py-2 text-gray-800 hover:bg-gray-200 cursor-pointer"
                            @click="user.logoutUser()"
                        >
                            <LogOut
                                :stroke-width="1"
                                class="inline-block mr-2"
                            />Logout
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <hr class="border-lptxcolor" />
    </nav>
</template>

<style scoped></style>
