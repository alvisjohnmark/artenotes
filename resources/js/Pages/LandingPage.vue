<script setup>
import { Facebook, Instagram, Youtube } from "lucide-vue-next";
import { authStore } from "./Auth/AuthStore/authClient";
import { onMounted } from "vue";
import Nav from "../components/nav.vue";
import Footer from "../components/footer.vue";
const user = authStore();

onMounted(() => {
    user.checkTokenAndProceed(async () => {
        console.log("running...");
    });
});
</script>

<template>
    <section class="bg-lpbgcolor min-h-screen">
        <Nav />
        <div class="bg-[#f7f2ef] py-2 pb-32">
            <div class="relative">
                <router-link
                    to="/services"
                    class="absolute left-64 text-4xl font-playfair text-[#5a5a3a]"
                >
                    send letters to <br />your loved ones
                </router-link>
            </div>
            <div class="flex justify-between items-center">
                <div class="h-[350px] w-[300px]">
                    <img
                        src="/public/img/hero1.png"
                        alt="stationery"
                        class="object-cover h-full w-full mt-2"
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
        <div
            class="py-16 bg-cover bg-center min-h-[800px]"
            style="background-image: url('/img/lpbg1.jpg')"
        >
            <div class="py-16">
                <h2
                    class="text-center text-4xl font-playfair text-[#5a5a3a] mb-8"
                >
                    Our Products
                </h2>
                <p class="text-center text-lg text-[#4a4838] px-36 mb-8">
                    Our eco-friendly stationery collection blends sustainability
                    with elegance. From premium notebooks to recycled paper,
                    every item is designed to minimize environmental impact
                    while maintaining quality and beauty.
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
        </div>

        <!-- Services Section -->
        <div
            class="py-16 bg-cover bg-center min-h-[750px]"
            style="background-image: url('/img/lpbg2.jpg')"
        >
            <div class="py-16">
                <h2
                    class="text-center text-4xl font-playfair text-[#5a5a3a] mb-8"
                >
                    Our Services
                </h2>
                <p class="text-center text-lg text-[#4a4838] px-36 mb-8">
                    We help you create personal and thoughtful connections with
                    our customizable services.
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
        </div>

        <div
            class="py-16 bg-cover bg-center min-h-[750px]"
            style="background-image: url('/img/lpbg1.jpg')"
        >
            <div class="py-16 max-w-7xl mx-auto">
                <h2
                    class="text-center text-5xl font-playfair text-[#3f3f29] mb-8 tracking-wide"
                >
                    Our Specialties
                </h2>
                <p
                    class="text-center text-lg text-[#4a4838] max-w-3xl mx-auto mb-12 px-4"
                >
                    At Artenotes, we are dedicated to crafting eco-friendly
                    products and services that inspire meaningful, sustainable
                    connections.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 px-4">
                    <!-- Card 1: Premium Recycled Paper -->
                    <div
                        class="group overflow-hidden rounded-2xl shadow-lg transition-transform transform hover:scale-105 bg-gradient-to-b from-[#e2dfd4] to-[#e2dfd4]"
                    >
                        <div class="relative">
                            <img
                                src="/public/img/hero1.png"
                                alt="Premium Recycled Paper"
                                class="object-cover w-full h-64 transition-all duration-300 group-hover:scale-110"
                            />
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black opacity-40"
                            ></div>
                            <div
                                class="absolute bottom-4 left-1/2 transform -translate-x-1/2 text-center"
                            >
                       
                            </div>
                        </div>
                        <div class="px-6 py-4 text-center text-[#4a4838]">
                            High-quality recycled paper crafted with
                            eco-consciousness in mind, perfect for sustainable
                            stationery.
                        </div>
                    </div>

                    <!-- Card 2: Custom Eco-Stationery -->
                    <div
                        class="group overflow-hidden rounded-2xl shadow-lg transition-transform transform hover:scale-105 bg-gradient-to-b from-[#d8d3ca] to-[#d8d3ca]"
                    >
                        <div class="relative">
                            <img
                                src="/public/img/hero2.png"
                                alt="Custom Eco-Stationery"
                                class="object-cover w-full h-64 transition-all duration-300 group-hover:scale-110"
                            />
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black opacity-40"
                            ></div>
                            <div
                                class="absolute bottom-4 left-1/2 transform -translate-x-1/2 text-center"
                            >
                                
                            </div>
                        </div>
                        <div class="px-6 py-4 text-center text-[#4a4838]">
                            Bespoke stationery options crafted from sustainable
                            materials for eco-minded personalization.
                        </div>
                    </div>

                    <!-- Card 3: Eco-Friendly Packaging -->
                    <div
                        class="group overflow-hidden rounded-2xl shadow-lg transition-transform transform hover:scale-105 bg-gradient-to-b from-[#d0ccc4] to-[#d0ccc4]"
                    >
                        <div class="relative">
                            <img
                                src="/public/img/hero3.png"
                                alt="Eco-Friendly Packaging"
                                class="object-cover w-full h-64 transition-all duration-300 group-hover:scale-110"
                            />
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black opacity-40"
                            ></div>
                            <div
                                class="absolute bottom-4 left-1/2 transform -translate-x-1/2 text-center"
                            >
                            
                            </div>
                        </div>
                        <div class="px-6 py-4 text-center text-[#4a4838]">
                            Thoughtfully designed, biodegradable packaging
                            solutions to protect your products and the planet.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <Footer />
    </section>
</template>
