<script setup>
import { clientStore } from "./PageStore/clientStore";
import { onMounted } from "vue";
import SemiNav from "../components/seminav.vue";
import Footer from "../components/footer.vue";

const render = clientStore();

onMounted(() => {
    render.fetchCartItems();
    render.fetchClientDetails();
});
</script>

<template>
    <SemiNav />
    <section class="bg-lpbgcolor flex justify-center items-center">
        <main
            class="w-full m-12 p-10 bg-white border border-lptxcolor rounded-xl grid grid-cols-1 lg:grid-cols-5 gap-8 text-lptxcolor font-playfair"
        >
            <div
                class="p-6 bg-bglightcolor border border-lptxcolor rounded-lg col-span-2"
            >
                <h2 class="text-2xl font-semibold text-lptxcolorsemilight">
                    Order Summary
                </h2>
                <div class="mt-4 space-y-3 text-lg">
                    <div class="flex justify-between">
                        <span>Rose and Seed Paper</span>
                        <span>50</span>
                        <span>4</span>
                        <span>200</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Recycled Notebook</span>
                        <span>75</span>
                        <span>1</span>
                        <span>75</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Embroidery Pouch</span>
                        <span>80</span>
                        <span>2</span>
                        <span>160</span>
                    </div>
                    <hr class="my-3 border-t border-gray-300" />
                    <div class="flex justify-between">
                        <span>Subtotal</span>
                        <span>435</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Delivery Fee</span>
                        <span>80</span>
                    </div>
                    <hr class="my-3 border-t border-gray-300" />
                    <div
                        class="flex justify-between font-semibold text-2xl text-fmbtcolor"
                    >
                        <span>Total</span>
                        <span>PHP 515</span>
                    </div>
                </div>
            </div>
            <div
                class="p-6 bg-bglightcolor border border-lptxcolor rounded-lg col-span-1"
            >
                <h2 class="text-2xl font-semibold text-lptxcolorsemilight">
                    Shipping Information
                </h2>
                <div class="mt-4 text-lg">
                    <p class="font-semibold text-lptxcolor">
                        {{render.client_details.first_name}} {{render.client_details.last_name}} 
                    </p>
                    <p>{{render.client_details.street}}</p>
                    <p>{{render.client_details.province}} {{render.client_details.country}}</p>
                    <p>{{render.client_details.zipcode}} {{render.client_details.country}}</p>
                </div>
            </div>
            <div
                class="p-6 bg-bglightcolor border border-lptxcolor rounded-lg col-span-2"
            >
                <h2 class="text-2xl font-semibold text-lptxcolorsemilight">
                    Choose your payment method:
                </h2>
                <div class="mt-4 space-y-4">
                    <label
                        class="flex items-center space-x-3 p-3 border border-gray-300 rounded-lg cursor-pointer"
                    >
                        <input
                            type="radio"
                            name="paymentMethod"
                            class="form-radio text-lptxcolorsemilight"
                        />
                        <span>GCash (****6808)</span>
                    </label>
                    <label
                        class="flex items-center space-x-3 p-3 border border-gray-300 rounded-lg cursor-pointer"
                    >
                        <input
                            type="radio"
                            name="paymentMethod"
                            class="form-radio text-lptxcolorsemilight"
                        />
                        <span>Cash On Delivery</span>
                    </label>
                </div>
                <button
                    class="w-full mt-24 py-3 bg-fmbtcolor text-white font-bebasneue text-xl rounded-lg"
                >
                    PAY PHP 515.00
                </button>
            </div>
        </main>
    </section>
    <Footer />
</template>

<style scoped>
</style>
