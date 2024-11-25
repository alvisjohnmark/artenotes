<script setup>
import { Facebook, Instagram, Youtube, Check } from "lucide-vue-next";
import { clientStore } from "./PageStore/clientStore";
import { onMounted, ref } from "vue";
import SemiNav from "../components/seminav.vue";

const render = clientStore();
onMounted(() => {
    render.fetchClientDetails();
});
</script>

<template>
    <section class="bg-lpbgcolor min-h-screen font-playfair">
        <SemiNav />
        <main class="max-w-5xl mx-auto py-12 px-6">
            <div
                class="bg-bglightcolor shadow-xl rounded-2xl p-8 flex flex-col md:flex-row items-center md:items-start gap-8"
            >
                <!-- Profile Image -->
                <div
                    class="w-32 h-32 md:w-48 md:h-48 rounded-full bg-lptxcolorlight flex items-center justify-center text-fmbtcolor text-4xl font-bebasneue"
                >
                    {{
                        (render.client_details.first_name?.charAt(0) || "") +
                        (render.client_details.last_name?.charAt(0) || "")
                    }}
                </div>
                <!-- Profile Details -->
                <div class="flex-1">
                    <h1 class="text-lptxcolor text-3xl font-bold mb-4">
                        {{ render.client_details.first_name }}
                        {{ render.client_details.last_name }}
                    </h1>
                    <p class="text-lptxcolorsemilight text-lg mb-6">
                        Full-Stack Developer based in Springfield
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- First Name -->
                        <div>
                            <h2 class="text-lptxcolorsemilight font-semibold">
                                First Name:
                            </h2>
                            <p class="text-lptxcolor">
                                {{ render.client_details.first_name }}
                            </p>
                        </div>
                        <!-- Last Name -->
                        <div>
                            <h2 class="text-lptxcolorsemilight font-semibold">
                                Last Name:
                            </h2>
                            <p class="text-lptxcolor">
                                {{ render.client_details.last_name }}
                            </p>
                        </div>
                        <!-- Address -->
                        <div>
                            <h2 class="text-lptxcolorsemilight font-semibold">
                                Address:
                            </h2>
                            <p class="text-lptxcolor">
                                {{ render.client_details.address || "Not Set" }}
                            </p>
                        </div>
                        <!-- Email -->
                        <div>
                            <h2 class="text-lptxcolorsemilight font-semibold">
                                Email:
                            </h2>
                            <p class="text-lptxcolor">
                                {{ render.client_details.email }}
                            </p>
                        </div>
                        <!-- Phone -->
                        <div>
                            <h2 class="text-lptxcolorsemilight font-semibold">
                                Phone:
                            </h2>
                            <p class="text-lptxcolor">+1 234 567 8901</p>
                        </div>
                        <!-- Birthday -->
                        <div>
                            <h2 class="text-lptxcolorsemilight font-semibold">
                                Birthday:
                            </h2>
                            <p class="text-lptxcolor">March 25, 1990</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Social Media Links -->
            <div class="mt-12 flex justify-center space-x-6">
                <a href="#" class="text-lptxcolor hover:text-lptxcolorlight">
                    <Facebook class="w-6 h-6" />
                </a>
                <a href="#" class="text-lptxcolor hover:text-lptxcolorlight">
                    <Instagram class="w-6 h-6" />
                </a>
                <a href="#" class="text-lptxcolor hover:text-lptxcolorlight">
                    <Youtube class="w-6 h-6" />
                </a>
            </div>
        </main>
    </section>
</template>
