<script setup>
import { authStore } from "./Auth/AuthStore/authClient";
import { clientStore } from "./PageStore/clientStore";
import Nav from "../components/nav.vue";
import Footer from "../components/footer.vue";
import { onMounted } from "vue";

const user = authStore();
const render = clientStore();

onMounted(() => {
    render.fetchProducts();
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
                    v-for="product in render.product_list"
                    :key="product.id"
                    class="bg-[#f4f0eb] rounded-xl shadow-sm transition-transform transform w-full overflow-hidden border border-[#d1c5b8]"
                >
                    <div
                        class="w-full h-40 bg-[#e0d7cc] rounded-t-xl flex justify-center items-center mb-4"
                    >
                        <img
                            v-if="product.pictures.length"
                            :src="`/storage/${product.pictures[0].file_path}`"
                            alt="Product Image"
                            class="h-full object-cover rounded-t-xl"
                        />
                    </div>
                    <div class="p-4">
                        <h2
                            class="text-lptxcolor text-lg font-playfair font-semibold mb-2"
                        >
                            {{ product.name }}
                        </h2>
                        <p class="text-[#5e5143] text-sm mb-1">
                            Size: {{ product.size }}
                        </p>
                        <p class="text-[#7a6855] text-sm mb-1">
                            Sheets per set: {{ product.sheets_per_set }}
                        </p>
                        <p class="text-fmbtcolor font-bold text-base my-2">
                            ₱{{ product.price }}
                        </p>
                        <p
                            :class="
                                product.stock > 0
                                    ? 'text-green-600'
                                    : 'text-red-600'
                            "
                            class="font-medium text-sm"
                        >
                            {{
                                product.stock > 0
                                    ? `${product.stock} items remaining`
                                    : "Out of stock"
                            }}
                        </p>
                        <div class="flex items-center">
                            <input
                                type="number"
                                v-model="product.quantity"
                                class="w-16 text-center border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-fmbtcolor"
                                min="1"
                                :max="product.stock"
                            />
                        </div>
                    </div>
                    <div
                        class="p-4 border-t border-gray-200 flex gap-2 bg-[#e8e0d5]"
                    >
                        <button
                            class="bg-fmbtcolor text-white w-full py-2 rounded-lg font-semibold text-sm uppercase hover:bg-opacity-90 transition-all"
                            @click="
                                render.addToCart(
                                    product.id,
                                    'product',
                                    product.quantity,
                                    product.price,
                                    product.stock
                                );
                                if (window.gtag) {
                                    window.gtag('event', 'checkout', {
                                        value: 1,
                                    });
                                }
                            "
                        >
                            Add to Cart
                        </button>
                        <!-- <button
                            class="border border-lptxcolor text-lptxcolor w-full py-2 rounded-lg font-semibold text-sm uppercase hover:bg-lptxcolor hover:text-white transition-all"
                            @click="render.checkAddress"
                        >
                            Buy now
                        </button> -->
                    </div>
                </div>
            </div>
            <div
                v-if="render.showAddressModal"
                class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50"
            >
                <div class="bg-white p-8 rounded-lg shadow-lg w-96">
                    <h2 class="text-2xl font-semibold mb-4">
                        Shipping Address
                    </h2>

                    <form @submit.prevent="render.saveAddress()">
                        <div class="mb-4">
                            <label class="block font-medium">Street</label>
                            <input
                                type="text"
                                v-model="render.address.street"
                                class="w-full p-2 border rounded-md"
                                required
                            />
                        </div>
                        <div class="mb-4">
                            <label class="block font-medium"
                                >City/Municipality</label
                            >
                            <input
                                type="text"
                                v-model="render.address.city_municipality"
                                class="w-full p-2 border rounded-md"
                                required
                            />
                        </div>
                        <div class="mb-4">
                            <label class="block font-medium">Province</label>
                            <input
                                type="text"
                                v-model="render.address.province"
                                class="w-full p-2 border rounded-md"
                                required
                            />
                        </div>
                        <div class="mb-4">
                            <label class="block font-medium">Zipcode</label>
                            <input
                                type="text"
                                v-model="render.address.zipcode"
                                class="w-full p-2 border rounded-md"
                                required
                            />
                        </div>

                        <button
                            type="submit"
                            class="mt-4 w-full bg-lptxcolor text-white py-2 rounded-lg font-semibold"
                        >
                            Submit Address
                        </button>
                    </form>
                </div>
            </div>
        </main>
    </section>
    <Footer />
</template>
