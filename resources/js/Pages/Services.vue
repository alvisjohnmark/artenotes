<script setup>
import { authStore } from "./Auth/AuthStore/authClient";
import { clientStore } from "./PageStore/clientStore";
import Nav from "../components/nav.vue";
import Footer from "../components/footer.vue";
import { onMounted } from "vue";

const user = authStore();
const render = clientStore();

onMounted(() => {
    render.fetchServices();
});
</script>

<template>
    <section class="bg-lpbgcolor min-h-screen">
        <Nav />
        <main
            class="container mx-auto px-4 py-8 flex justify-center items-center"
        >
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                <div
                    v-for="service in render.service_list"
                    :key="service.id"
                    class="bg-[#f4f0eb] rounded-xl shadow-sm transition-transform transform w-full overflow-hidden border border-[#d1c5b8]"
                >
                    <div class="p-4">
                        <h2
                            class="text-lptxcolor text-lg font-playfair font-semibold mb-2"
                        >
                            {{ service.service_name }}
                        </h2>
                        <p class="text-[#5e5143] text-sm mb-4">
                            {{ service.service_description }}
                        </p>
                        <p class="text-fmbtcolor font-bold text-lg my-2">
                            Price: ${{ service.service_price }}
                        </p>
                    </div>
                    
                    <div
                        class="p-4 border-t border-gray-200 flex gap-2 bg-[#e8e0d5]"
                    >
                        <button
                            class="bg-fmbtcolor text-white w-full py-2 rounded-lg font-semibold text-sm uppercase hover:bg-opacity-90 transition-all"
                            @click="
                                render.addToCart(
                                    service.id,
                                    'service',
                                    service.price
                                )
                            "
                        >
                            Add to Cart
                        </button>
                        <button
                            class="border border-lptxcolor text-lptxcolor w-full py-2 rounded-lg font-semibold text-sm uppercase hover:bg-lptxcolor hover:text-white transition-all"
                            @click="render.checkout"
                        >
                            Buy now
                        </button>
                    </div>
                </div>
            </div>
        </main>
        <Footer />
    </section>
</template>

<style scoped></style>
