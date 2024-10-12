<script setup>
import { Facebook, Instagram, Youtube } from "lucide-vue-next";
import { authStore } from "./Auth/AuthStore/authClient";
import Nav from "../components/nav.vue";
const user = authStore();
</script>

<template>
    <section class="bg-lpbgcolor min-h-screen">
        <Nav />
        <!-- Hero section -->
        <div class="bg-[#f7f2ef] py-2 pb-32">
            <div class="relative">
                <router-link
                    to="/services"
                    class="absolute left-80 top-6 text-4xl font-playfair text-[#5a5a3a]"
                >
                    send letters to <br />your loved ones
                </router-link>
            </div>
            <div class="flex justify-between items-center">
                <div class="h-[350px] w-[300px]">
                    <img
                        src="/public/img/hero1.png"
                        alt="stationery"
                        class="object-cover h-full w-full"
                    />
                </div>
                <div class="h-[500px] w-[400px] relative">
                    <img
                        src="/public/img/hero2.png"
                        alt="stationery"
                        class="object-cover h-full w-full rounded-t-full"
                    />
                    <div
                        class="absolute bottom-[-60px] left-1/2 transform -translate-x-1/2"
                    >
                        <router-link
                            to="/shop"
                            class="bg-[#3d3d2e] text-lpbgcolor text-2xl font-playfair py-3 px-8 rounded-full shadow-md transition-transform duration-300 ease-in-out hover:bg-secondary hover:shadow-lg hover:-translate-y-1"
                        >
                            Shop Now
                        </router-link>
                    </div>
                </div>
                <div class="h-[350px] w-[300px]">
                    <img
                        src="/public/img/hero3.png"
                        alt="stationery"
                        class="object-cover h-full w-full"
                    />
                </div>
            </div>
            <div class="relative">
                <router-link
                    to="/products"
                    class="absolute right-64 bottom-0 text-4xl font-playfair text-[#5a5a3a]"
                >
                    locally sourced <br />stationeries
                </router-link>
            </div>
        </div>

        <!-- Products Section -->
        <div class="bg-[#f0ece4] py-16">
            <h2 class="text-center text-4xl font-playfair text-[#5a5a3a] mb-8">
                Our Products
            </h2>
            <p class="text-center text-lg text-[#4a4838] px-36 mb-8">
                Our eco-friendly stationery collection blends sustainability
                with elegance. From premium notebooks to recycled paper, every
                item is designed to minimize environmental impact while
                maintaining quality and beauty.
            </p>
            <div class="flex justify-evenly gap-8">
                <div class="relative">
                    <img
                        src="/public/img/hero1.png"
                        alt="eco-friendly product"
                        class="w-[350px] h-[350px] object-cover rounded-full shadow-md"
                    />
                    <router-link
                        to="/products"
                        class="absolute bottom-4 left-4 text-lg font-medium text-white bg-[#3d3d2e] py-2 px-4 rounded-lg"
                    >
                        Premium Notebooks
                    </router-link>
                </div>
                <div class="relative">
                    <img
                        src="/public/img/hero2.png"
                        alt="eco-friendly product"
                        class="w-[350px] h-[350px] object-cover rounded-full shadow-md"
                    />
                    <router-link
                        to="/products"
                        class="absolute bottom-4 left-4 text-lg font-medium text-white bg-[#3d3d2e] py-2 px-4 rounded-lg"
                    >
                        Recycled Paper
                    </router-link>
                </div>
                <div class="relative">
                    <img
                        src="/public/img/hero3.png"
                        alt="eco-friendly product"
                        class="w-[350px] h-[350px] object-cover rounded-full shadow-md"
                    />
                    <router-link
                        to="/products"
                        class="absolute bottom-4 left-4 text-lg font-medium text-white bg-[#3d3d2e] py-2 px-4 rounded-lg"
                    >
                        Custom Stationery
                    </router-link>
                </div>
            </div>
        </div>

        <!-- Services Section -->
        <div class="bg-[#f9f5ee] py-16">
            <h2 class="text-center text-4xl font-playfair text-[#5a5a3a] mb-8">
                Our Services
            </h2>
            <p class="text-center text-lg text-[#4a4838] px-36 mb-8">
                We help you create personal and thoughtful connections with our
                customizable services.
            </p>
            <div class="flex justify-center items-start gap-12">
                <div class="relative group w-[300px]">
                    <div
                        class="h-[300px] bg-[#e2dfd4] rounded-lg shadow-lg flex items-center justify-center overflow-hidden"
                    >
                        <img
                            src="/public/img/hero1.png"
                            class="object-cover opacity-80 group-hover:opacity-20 transition-all duration-300 w-full h-full"
                        />
                        <router-link
                            to="/services"
                            class="absolute text-lg font-semibold text-[#f9f5ee] bg-[#3d3d2e]/90 py-2 px-4 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                        >
                            Letter Writing Service
                        </router-link>
                    </div>
                </div>
                <div class="relative group w-[300px]">
                    <div
                        class="h-[300px] bg-[#d8d3ca] rounded-lg shadow-lg flex items-center justify-center overflow-hidden"
                    >
                        <img
                            src="/public/img/hero2.png"
                            class="object-cover opacity-80 group-hover:opacity-20 transition-all duration-300 w-full h-full"
                        />
                        <router-link
                            to="/services"
                            class="absolute text-lg font-semibold text-[#f9f5ee] bg-[#3d3d2e]/90 py-2 px-4 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                        >
                            Custom Stationery Design
                        </router-link>
                    </div>
                </div>
                <div class="relative group w-[300px]">
                    <div
                        class="h-[300px] bg-[#d0ccc4] rounded-lg shadow-lg flex items-center justify-center overflow-hidden"
                    >
                        <img
                            src="/public/img/hero3.png"
                            class="object-cover opacity-80 group-hover:opacity-20 transition-all duration-300 w-full h-full"
                        />
                        <router-link
                            to="/services"
                            class="absolute text-lg font-semibold text-[#f9f5ee] bg-[#3d3d2e]/90 py-2 px-4 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                        >
                            Mail Sending Solutions
                        </router-link>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mission and Vision Section -->
        <div class="bg-[#f0ece4] py-16">
            <div class="grid grid-cols-2 gap-12 items-center">
                <div class="w-[full] h-[400px]">
                    <img
                        src="/public/img/mv.jpg"
                        alt="Mission & Vision"
                        class="object-cover h-full w-full rounded-lg shadow-lg"
                    />
                </div>
                <div>
                    <h2 class="text-4xl font-playfair text-[#5a5a3a] mb-4">
                        Our Mission & Vision
                    </h2>
                    <p class="text-lg text-[#4a4838] mb-8">
                        Our mission is to promote sustainability and creativity
                        by offering eco-friendly stationery and personalized
                        services that inspire deeper, more meaningful
                        connections. We envision a world where thoughtful
                        communication and sustainability go hand in hand,
                        encouraging a greener planet one letter at a time.
                    </p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-[#5a5a3a] py-8">
            <div class="text-center text-lpbgcolor">
                <p>Contact Us: artenotes@gmail.com</p>
                <p class="flex justify-center items-center gap-6 mt-4">
                    Follow Us:
                    <a href="https://www.facebook.com" target="_blank">
                        <Facebook
                            :size="28"
                            :stroke-width="1"
                            class="hover:text-[#f0ece4]"
                        />
                    </a>
                    <a href="https://www.instagram.com" target="_blank">
                        <Instagram
                            :size="28"
                            :stroke-width="1"
                            class="hover:text-[#f0ece4]"
                        />
                    </a>
                    <a href="https://www.youtube.com" target="_blank">
                        <Youtube
                            :size="28"
                            :stroke-width="1"
                            class="hover:text-[#f0ece4]"
                        />
                    </a>
                </p>
            </div>
        </footer>
    </section>
</template>
