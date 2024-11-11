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
    Menu,
} from "lucide-vue-next";
import { ref } from "vue";
import { useRoute } from "vue-router";
import { authStore } from "../Pages/Auth/AuthStore/authClient";

const user = authStore();
const route = useRoute();
const isMenuOpen = ref(false); 

function toggleMenu() {
    isMenuOpen.value = !isMenuOpen.value;
}
</script>

<template>
    <nav class="bg-[#f5f0f1]">
        <div class="container mx-auto flex justify-between items-center py-4 px-10">
            <div class="flex items-center">
                <img src="/public/img/logo.png" class="h-20 w-auto" />
            </div>
            <router-link to="/" class="text-lptxcolor text-5xl font-playfair pl-10">artenotes</router-link>

            <div class="hidden md:flex items-center space-x-4">
                <router-link
                    v-if="!user.token"
                    to="/register"
                    class="text-lptxcolor flex items-center space-x-1"
                >
                    <span><LogIn :stroke-width="1" /></span>
                    <span class="hover:text-[#5a5a3a] font-bebasneue">Sign In</span>
                </router-link>
                <div v-else class="flex gap-2 relative">
                    <router-link to="/cart" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">
                        <ShoppingCart :size="32" :stroke-width="1" />
                    </router-link>
                    <div class="flex items-center space-x-1 cursor-pointer" @click="user.toggleDropDown">
                        <User :size="32" :stroke-width="1" />
                    </div>

                    <div
                        v-if="user.showDropdown"
                        class="absolute right-0 mt-12 py-2 w-48 bg-white rounded-md shadow-lg"
                    >
                        <router-link to="/profile" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">
                            <User :size="24" :stroke-width="1" class="inline-block mr-2" />Profile
                        </router-link>
                        <span class="block px-4 py-2 text-gray-800 hover:bg-gray-200 cursor-pointer" @click="user.logoutUser()">
                            <LogOut :stroke-width="1" class="inline-block mr-2" />Logout
                        </span>
                    </div>
                </div>
            </div>

            <!-- Mobile Menu Button -->
            <button @click="toggleMenu" class="md:hidden focus:outline-none">
                <Menu :size="28" :stroke-width="1" class="text-lptxcolor" />
            </button>
        </div>

        <hr class="border-lptxcolor" />

        <!-- Main Navigation Links -->
        <div class="container mx-auto flex flex-col md:flex-row justify-center gap-8 py-2">
            <!-- Desktop Navigation Links -->
            <div class="hidden md:flex justify-center gap-8">
                <router-link
                    to="/"
                    :class="{
                        'border-b-2 border-lptxcolor': route.path === '/',
                        'p-1': true,
                    }"
                    class="text-lptxcolor flex items-center space-x-1"
                >
                    <span><House :stroke-width="1" /></span>
                    <span class="hover:text-[#5a5a3a] font-bebasneue">HOME</span>
                </router-link>

                <router-link
                    to="/about"
                    :class="{
                        'border-b-2 border-lptxcolor': route.path === '/about',
                        'p-1': true,
                    }"
                    class="text-lptxcolor flex items-center space-x-1"
                >
                    <span><Users :stroke-width="1" /></span>
                    <span class="hover:text-[#5a5a3a] font-bebasneue">ABOUT US</span>
                </router-link>

                <router-link
                    to="/products"
                    :class="{
                        'border-b-2 border-lptxcolor': route.path === '/products',
                        'p-1': true,
                    }"
                    class="text-lptxcolor flex items-center space-x-1"
                >
                    <span><ShoppingBag :stroke-width="1" /></span>
                    <span class="hover:text-[#5a5a3a] font-bebasneue">PRODUCTS</span>
                </router-link>

                <router-link
                    to="/services"
                    :class="{
                        'border-b-2 border-lptxcolor': route.path === '/services',
                        'p-1': true,
                    }"
                    class="text-lptxcolor flex items-center space-x-1"
                >
                    <span><MailCheck :stroke-width="1" /></span>
                    <span class="hover:text-[#5a5a3a] font-bebasneue">SERVICES</span>
                </router-link>
            </div>

            <!-- Mobile Navigation Links -->
            <div
                v-if="isMenuOpen"
                class="md:hidden flex flex-col items-center py-4 space-y-2"
            >
                <router-link
                    to="/"
                    class="text-lptxcolor flex items-center space-x-1"
                    @click="toggleMenu"
                >
                    <span><House :stroke-width="1" /></span>
                    <span class="hover:text-[#5a5a3a] font-bebasneue">HOME</span>
                </router-link>
                <router-link
                    to="/about"
                    class="text-lptxcolor flex items-center space-x-1"
                    @click="toggleMenu"
                >
                    <span><Users :stroke-width="1" /></span>
                    <span class="hover:text-[#5a5a3a] font-bebasneue">ABOUT US</span>
                </router-link>
                <router-link
                    to="/products"
                    class="text-lptxcolor flex items-center space-x-1"
                    @click="toggleMenu"
                >
                    <span><ShoppingBag :stroke-width="1" /></span>
                    <span class="hover:text-[#5a5a3a] font-bebasneue">PRODUCTS</span>
                </router-link>
                <router-link
                    to="/services"
                    class="text-lptxcolor flex items-center space-x-1"
                    @click="toggleMenu"
                >
                    <span><MailCheck :stroke-width="1" /></span>
                    <span class="hover:text-[#5a5a3a] font-bebasneue">SERVICES</span>
                </router-link>

                <!-- Add Sign In/Cart/Profile in mobile view -->
                <router-link
                    v-if="!user.token"
                    to="/login"
                    class="text-lptxcolor flex items-center space-x-1"
                    @click="toggleMenu"
                >
                    <span><LogIn :stroke-width="1" /></span>
                    <span class="hover:text-[#5a5a3a] font-bebasneue">Sign In</span>
                </router-link>

                <div v-else>
                    <router-link
                        to="/cart"
                        class="text-lptxcolor flex items-center space-x-1"
                        @click="toggleMenu"
                    >
                        <span><ShoppingCart :stroke-width="1" /></span>
                        <span class="hover:text-[#5a5a3a] font-bebasneue">Cart</span>
                    </router-link>
                    <router-link
                        to="/profile"
                        class="text-lptxcolor flex items-center space-x-1"
                        @click="toggleMenu"
                    >
                        <span><User :stroke-width="1" /></span>
                        <span class="hover:text-[#5a5a3a] font-bebasneue">Profile</span>
                    </router-link>
                    <span
                        class="text-lptxcolor flex items-center space-x-1 cursor-pointer"
                        @click="user.logoutUser(); toggleMenu()"
                    >
                        <span><LogOut :stroke-width="1" /></span>
                        <span class="hover:text-[#5a5a3a] font-bebasneue">Logout</span>
                    </span>
                </div>
            </div>
        </div>
    </nav>
</template>

<style scoped>
/* Add any additional styles here */
</style>
