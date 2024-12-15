<script setup>
import { Facebook, Instagram, Youtube, Check } from "lucide-vue-next";
import { authStore } from "./Auth/AuthStore/authClient";
import { onMounted, ref } from "vue";
import Nav from "../components/nav.vue";
import Footer from "../components/footer.vue";
const user = authStore();
const isMobile = ref(false);

onMounted(() => {
    // Check if screen is mobile size initially
    isMobile.value = window.innerWidth <= 768;

    // Listen for resize event to toggle isMobile state
    window.addEventListener("resize", () => {
        isMobile.value = window.innerWidth <= 768;
    });

    user.checkTokenAndProceed(async () => {
        console.log("running...");
    });
});
</script>

<template>
    <section class="bg-lpbgcolor min-h-screen">
        <Nav />

        <div class="bg-[#f7f2ef] py-4 md:py-6 lg:py-8 pb-16 lg:pb-32">
            <div class="relative">
                <router-link
                    to="/services"
                    class="absolute left-8 md:left-32 lg:left-64 text-2xl md:text-3xl lg:text-4xl font-playfair text-[#5a5a3a]"
                >
                    send letters to <br />your loved ones
                </router-link>
            </div>

            <div
                class="flex flex-col lg:flex-row justify-around items-center space-y-6 lg:space-y-0 lg:space-x-6 px-4"
            >
                <div
                    class="h-[250px] w-[200px] md:h-[300px] md:w-[250px] lg:h-[350px] lg:w-[300px]"
                >
                    <img
                        src="/public/img/hero1.png"
                        alt="stationery"
                        class="object-cover h-full w-full mt-2"
                    />
                </div>

                <div
                    v-if="!isMobile"
                    class="h-[400px] w-[300px] md:h-[450px] md:w-[350px] lg:h-[500px] lg:w-[400px] relative"
                >
                    <img
                        src="/public/img/hero2.png"
                        alt="stationery"
                        class="object-cover h-full w-full rounded-t-full"
                    />
                    <div
                        class="absolute bottom-[-30px] md:bottom-[-40px] lg:bottom-[-60px] left-1/2 transform -translate-x-1/2"
                    >
                        <router-link
                            to="/products"
                            class="bg-[#3d3d2e] text-lpbgcolor text-lg md:text-xl lg:text-2xl font-playfair py-2 md:py-3 px-6 md:px-8 rounded-full shadow-md transition-transform duration-300 ease-in-out hover:bg-secondary hover:shadow-lg hover:-translate-y-1"
                        >
                            Shop Now
                        </router-link>
                    </div>
                </div>

                <div v-else class="flex justify-center">
                    <router-link
                        to="/products"
                        class="bg-[#3d3d2e] text-lpbgcolor text-lg py-2 px-6 rounded-full shadow-md transition-transform duration-300 ease-in-out hover:bg-secondary hover:shadow-lg hover:-translate-y-1"
                    >
                        Shop Now
                    </router-link>
                </div>

                <!-- Third Image -->
                <div
                    class="h-[250px] w-[200px] md:h-[300px] md:w-[250px] lg:h-[350px] lg:w-[300px]"
                >
                    <img
                        src="/public/img/hero3.png"
                        alt="stationery"
                        class="object-cover h-full w-full"
                    />
                </div>
            </div>

            <div class="relative mt-8 lg:mt-0">
                <router-link
                    to="/products"
                    class="absolute right-8 md:right-32 lg:right-64 bottom-0 text-2xl md:text-3xl lg:text-4xl font-playfair text-[#5a5a3a]"
                >
                    locally sourced <br />stationeries
                </router-link>
            </div>
        </div>

        <!-- Products Section -->
        <div class="py-16 bg-[#f7f2ef]">
            <div class="max-w-7xl mx-auto px-4">
                <h2 class="text-3xl font-bold font-playfair text-[#333] mb-8">
                    Trending products
                </h2>
                <div
                    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6"
                >
                    <div
                        class="bg-[#F1EBE1] p-6 rounded-lg shadow-md text-center"
                    >
                        <img
                            src="/public/img/wallet.jpg"
                            alt="Leather Long Wallet"
                            class="w-full h-48 object-cover rounded-md mb-4"
                        />
                        <h3 class="text-lg font-semibold text-[#333]">
                            Leather Long Wallet
                        </h3>
                        <p class="text-sm text-lptxcolor">Natural</p>
                        <p class="text-lg font-bold mt-2">₱75</p>
                    </div>
                    <div
                        class="bg-[#F1EBE1] p-6 rounded-lg shadow-md text-center"
                    >
                        <img
                            src="/public/img/pencil.jpg"
                            alt="Machined Pencil and Pen Set"
                            class="w-full h-48 object-cover rounded-md mb-4"
                        />
                        <h3 class="text-lg font-semibold text-[#333]">
                            Machined Pencil and Pen Set
                        </h3>
                        <p class="text-sm text-lptxcolor">Multicolor</p>
                        <p class="text-lg font-bold mt-2">₱70</p>
                    </div>
                    <div
                        class="bg-[#F1EBE1] p-6 rounded-lg shadow-md text-center"
                    >
                        <img
                            src="/public/img/sketchbook.jpg"
                            alt="Mini-Sketchbooks"
                            class="w-full h-48 object-cover rounded-md mb-4"
                        />
                        <h3 class="text-lg font-semibold text-[#333]">
                            Mini-Sketchbooks
                        </h3>
                        <p class="text-sm text-lptxcolor">Light Brown</p>
                        <p class="text-lg font-bold mt-2">₱50</p>
                    </div>
                    <div
                        class="bg-[#F1EBE1] p-6 rounded-lg shadow-md text-center"
                    >
                        <img
                            src="/public/img/organizer.jpg"
                            alt="Organizer Set"
                            class="w-full h-48 object-cover rounded-md mb-4"
                        />
                        <h3 class="text-lg font-semibold text-[#333]">
                            Organizer Set
                        </h3>
                        <p class="text-sm text-lptxcolor">Walnut</p>
                        <p class="text-lg font-bold mt-2">₱150</p>
                    </div>
                </div>
                <div class="mt-8 text-right">
                    <router-link
                        to="/products"
                        class="text-lptxcolor hover:underline font-semibold"
                    >
                        Shop the collection →
                    </router-link>
                </div>
            </div>
        </div>

        <!-- Services Section -->
        <div class="bg-[#f7f2ef] py-16 flex justify-center items-center">
            <div class="flex flex-col lg:flex-row max-w-screen-xl w-full">
                <div class="flex-1 mx-10 mb-8 lg:mb-0 lg:pr-12">
                    <h2 class="text-3xl font-playfair text-[#5a5a3a] mb-4">
                        Personalized Letter Writing Service
                    </h2>
                    <p class="text-[#3d3d2e] text-lg mb-6">
                        Send a thoughtful and customized message to your loved
                        ones. Whether it's for a special occasion or just to
                        brighten their day, our expert writers craft letters
                        that make each moment memorable.
                    </p>
                    <p class="text-[#3d3d2e] text-lg mb-6">
                        Our service ensures that your message is not only
                        heartfelt but also beautifully designed. You can choose
                        from a variety of elegant templates, fonts, and paper
                        types, ensuring a unique and personal touch.
                    </p>
                    <ul class="text-[#5a5a3a] text-md space-y-2 mb-8">
                        <li class="flex items-center space-x-2">
                            <span class="text-secondary"><Check /></span>
                            <span>Customized messages for any occasion</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <span class="text-secondary"><Check /></span>
                            <span
                                >Premium quality materials for a lasting
                                impression</span
                            >
                        </li>
                        <li class="flex items-center space-x-2">
                            <span class="text-secondary"><Check /></span>
                            <span>Fast and reliable delivery options</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <span class="text-secondary"><Check /></span>
                            <span
                                >Eco-friendly and sustainable paper
                                choices</span
                            >
                        </li>
                    </ul>
                    <router-link
                        to="/services"
                        class="bg-[#3d3d2e] text-lpbgcolor text-lg py-2 px-6 rounded-full shadow-md transition-transform duration-300 ease-in-out hover:bg-secondary hover:shadow-lg hover:-translate-y-1"
                    >
                        Start Creating Your Letter
                    </router-link>
                </div>

                <div
                    class="max-w-lg bg-white rounded-lg shadow-lg p-8 relative text-center mx-10"
                >
                    <div class="w-full h-48 overflow-hidden rounded-md mb-6">
                        <img
                            src="/public/img/hero2.png"
                            alt="Letter writing service"
                            class="object-cover h-full w-full"
                        />
                    </div>
                    <h2 class="text-3xl font-playfair text-[#5a5a3a] mb-4">
                        Letter Writing Service
                    </h2>
                    <p class="text-[#3d3d2e] text-lg mb-6">
                        Craft the perfect message to express your emotions. Our
                        writing service allows you to send personalized letters
                        that convey your deepest thoughts.
                    </p>
                    <ul class="text-[#5a5a3a] text-md space-y-2 mb-8">
                        <li class="flex items-center space-x-2">
                            <span class="text-secondary"><Check /></span>
                            <span>Customized message and design</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <span class="text-secondary"><Check /></span>
                            <span>High-quality paper and ink</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <span class="text-secondary"><Check /></span>
                            <span>Express delivery available</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Specialties Section -->
        <div class="bg-[#f7f2ef] py-16">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-playfair text-[#5a5a3a] mb-4">
                    Our Specialties
                </h2>
                <p class="text-lg text-[#3d3d2e]">
                    Explore our curated selection of products and services.
                </p>
            </div>
            <div
                class="grid grid-cols-1 sm:grid-cols-2 gap-8 px-6 max-w-screen-xl mx-auto"
            >
                <!-- Product Card 1 -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <img
                        src="/public/img/lpbg1.jpg"
                        alt="Product 1"
                        class="object-cover w-full h-48"
                    />
                    <div class="p-6">
                        <h3 class="text-xl font-playfair text-[#5a5a3a] mb-2">
                            Stationery Set
                        </h3>
                        <router-link
                            to="/products"
                            class="bg-[#3d3d2e] text-lpbgcolor text-lg py-2 px-6 rounded-full shadow-md transition-transform duration-300 ease-in-out hover:bg-secondary hover:shadow-lg hover:-translate-y-1"
                        >
                            Shop Now
                        </router-link>
                    </div>
                </div>

                <!-- Service Card 1 -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <img
                        src="/public/img/lpbg2.jpg"
                        alt="Service 1"
                        class="object-cover w-full h-48"
                    />
                    <div class="p-6">
                        <h3 class="text-xl font-playfair text-[#5a5a3a] mb-2">
                            Letter Writing Service
                        </h3>
                        <router-link
                            to="/services"
                            class="bg-[#3d3d2e] text-lpbgcolor text-lg py-2 px-6 rounded-full shadow-md transition-transform duration-300 ease-in-out hover:bg-secondary hover:shadow-lg hover:-translate-y-1"
                        >
                            Get Started
                        </router-link>
                    </div>
                </div>

                <!-- Product Card 2 -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <img
                        src="/public/img/lpbg2.jpg"
                        alt="Product 2"
                        class="object-cover w-full h-48"
                    />
                    <div class="p-6">
                        <h3 class="text-xl font-playfair text-[#5a5a3a] mb-2">
                            Gift Wrappers
                        </h3>
                        <router-link
                            to="/products"
                            class="bg-[#3d3d2e] text-lpbgcolor text-lg py-2 px-6 rounded-full shadow-md transition-transform duration-300 ease-in-out hover:bg-secondary hover:shadow-lg hover:-translate-y-1"
                        >
                            Shop Now
                        </router-link>
                    </div>
                </div>

                <!-- Service Card 2 -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <img
                        src="/public/img/lpbg1.jpg"
                        alt="Service 2"
                        class="object-cover w-full h-48"
                    />
                    <div class="p-6">
                        <h3 class="text-xl font-playfair text-[#5a5a3a] mb-2">
                            Custom Letter Designs
                        </h3>
                        <router-link
                            to="/services"
                            class="bg-[#3d3d2e] text-lpbgcolor text-lg py-2 px-6 rounded-full shadow-md transition-transform duration-300 ease-in-out hover:bg-secondary hover:shadow-lg hover:-translate-y-1"
                        >
                            Get Started
                        </router-link>
                    </div>
                </div>
            </div>
        </div>

        <!-- Our Team Section -->
        <div class="bg-[#f7f2ef] py-16">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-playfair text-[#5a5a3a] mb-4">
                    Meet Our Team
                </h2>
                <p class="text-lg text-[#3d3d2e]">
                    The dedicated individuals behind our services.
                </p>
            </div>
            <div
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-8 px-6 max-w-screen-xl mx-auto"
            >
                <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                    <div
                        class="w-24 h-24 rounded-full overflow-hidden mx-auto mb-4"
                    >
                        <img
                            src="/public/img/jonathan.png"
                            alt="Jonathan Apostol"
                            class="object-cover w-full h-full"
                        />
                    </div>
                    <h3 class="text-xl font-playfair text-[#5a5a3a] mb-2">
                        Jonathan Apostol
                    </h3>
                    <p class="text-md text-[#3d3d2e]">Owner</p>
                    <p class="text-sm text-[#6c6c4b]">
                        As the owner, Jonathan brings a vision for innovation
                        and growth. His leadership guides the company's
                        strategic direction.
                    </p>
                </div>

                <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                    <div
                        class="w-24 h-24 rounded-full overflow-hidden mx-auto mb-4"
                    >
                        <img
                            src="/public/img/jm.jpg"
                            alt="John Mark Alvis"
                            class="object-cover w-full h-full"
                        />
                    </div>
                    <h3 class="text-xl font-playfair text-[#5a5a3a] mb-2">
                        John Mark Alvis
                    </h3>
                    <p class="text-md text-[#3d3d2e]">Manager</p>
                    <p class="text-sm text-[#6c6c4b]">
                        John Mark leads the team with his extensive experience
                        in management. He ensures smooth operations and
                        excellent customer service.
                    </p>
                </div>

                <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                    <div
                        class="w-24 h-24 rounded-full overflow-hidden mx-auto mb-4"
                    >
                        <img
                            src="/public/img/aloh.jpg"
                            alt="Leigh Aloha Badua"
                            class="object-cover w-full h-full"
                        />
                    </div>
                    <h3 class="text-xl font-playfair text-[#5a5a3a] mb-2">
                        Leigh Aloha Badua
                    </h3>
                    <p class="text-md text-[#3d3d2e]">Assistant Manager</p>
                    <p class="text-sm text-[#6c6c4b]">
                        Leigh Aloha supports the team by managing day-to-day
                        activities, ensuring all processes run smoothly for
                        optimal performance.
                    </p>
                </div>

                <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                    <div
                        class="w-24 h-24 rounded-full overflow-hidden mx-auto mb-4"
                    >
                        <img
                            src="/public/img/earnest.jpg"
                            alt="Earnest Andrei Orcino"
                            class="object-cover w-full h-full"
                        />
                    </div>
                    <h3 class="text-xl font-playfair text-[#5a5a3a] mb-2">
                        Earnest Andrei Orcino
                    </h3>
                    <p class="text-md text-[#3d3d2e]">
                        Marketing Executive Officer
                    </p>
                    <p class="text-sm text-[#6c6c4b]">
                        Earnest Andrei drives the marketing strategies, helping
                        to establish strong brand awareness and reaching out to
                        potential customers.
                    </p>
                </div>
            </div>
        </div>

        <Footer />
    </section>
</template>
