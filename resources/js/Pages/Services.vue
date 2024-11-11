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
                            class="bg-lptxcolor text-lptxcolor w-full text-white py-2 rounded-lg font-semibold text-sm uppercase"
                            @click="render.setSelectedService(service)"
                        >
                            Avail
                        </button>
                    </div>
                </div>
                <div
                    v-if="render.showRecipientAddress"
                    class="fixed inset-0 bg-black bg-opacity-50 z-50 flex justify-center items-center"
                >
                    <div
                        class="bg-[#d9e2c7] rounded-lg shadow-lg p-8 w-full max-w-3xl mx-auto"
                    >
                        <div class="flex flex-col md:flex-row gap-8">
                            <div class="flex-1">
                                <h2
                                    class="text-xl font-bold mb-2 text-gray-800"
                                >
                                    Your message:
                                </h2>
                                <p class="text-sm mb-4">
                                    (maximum of 500 words)
                                </p>
                                <textarea
                                    v-model="render.recipientDetails.message"
                                    rows="18"
                                    class="w-full p-2 mb-4 border rounded-lg bg-white"
                                ></textarea>
                            </div>

                            <div class="flex-1 space-y-4">
                                <div>
                                    <label class="block font-bold mb-1"
                                        >Font:</label
                                    >
                                    <input
                                        v-model="render.recipientDetails.font"
                                        placeholder="Please type in your desired font..."
                                        class="w-full p-2 border rounded bg-white"
                                    />
                                </div>
                                <div>
                                    <label class="block font-bold mb-1"
                                        >Envelope:</label
                                    >
                                    <select
                                        v-model="
                                            render.recipientDetails
                                                .envelope_color
                                        "
                                        class="w-full p-2 border rounded bg-white"
                                        placeholder="Color"
                                    >
                                        <option value="beige">Beige</option>
                                        <option value="brown">Brown</option>
                                        <option value="white">White</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block font-bold mb-1"
                                        >Additional:</label
                                    >
                                    <div class="flex items-center space-x-2">
                                        <input
                                            type="checkbox"
                                            v-model="
                                                render.recipientDetails.has_rose
                                            "
                                            class="form-checkbox h-5 w-5 text-lptxcolor"
                                        />
                                        <span>Red roses (additional ₱100)</span>
                                    </div>
                                    <div
                                        class="flex items-center space-x-2 mt-2"
                                    >
                                        <input
                                            type="checkbox"
                                            class="form-checkbox h-5 w-5 text-lptxcolor"
                                        />
                                        <span>None</span>
                                    </div>
                                </div>

                                <div>
                                    <label class="block font-bold mb-1"
                                        >Ship to:</label
                                    >
                                    <div class="grid grid-cols-1 gap-2">
                                        <input
                                            v-model="
                                                render.recipientDetails
                                                    .recipient_name
                                            "
                                            placeholder="Recipient Name"
                                            class="w-full p-2 border rounded bg-white"
                                        />
                                        <input
                                            v-model="
                                                render.recipientDetails.province
                                            "
                                            placeholder="Province"
                                            class="w-full p-2 border rounded bg-white"
                                        />
                                        <input
                                            v-model="
                                                render.recipientDetails
                                                    .city_municipality
                                            "
                                            placeholder="City/Municipality"
                                            class="w-full p-2 border rounded bg-white"
                                        />
                                        <input
                                            v-model="
                                                render.recipientDetails.barangay
                                            "
                                            placeholder="Barangay"
                                            class="w-full p-2 border rounded bg-white"
                                        />
                                        <input
                                            v-model="
                                                render.recipientDetails.street
                                            "
                                            placeholder="Street"
                                            class="w-full p-2 border rounded bg-white"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end gap-4 mt-8">
                            <button
                                class="bg-lptxcolor text-white px-4 py-2 rounded-md hover:bg-opacity-90"
                                @click="
                                    render.addToCartService(
                                        render.selectedService.id,
                                        'service',
                                        render.selectedService.service_price,
                                        render.recipientDetails
                                    )
                                "
                            >
                                Add to Cart
                            </button>

                            <button
                                @click="render.toggleRecipientAddress"
                                class="bg-blue-600 text-white px-4 py-2 rounded-md over:bg-opacity-90"
                            >
                                Checkout
                            </button>
                            <button
                                @click="render.toggleRecipientAddress"
                                class="bg-red-600 text-white px-4 py-2 rounded-md over:bg-opacity-90"
                            >
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </section>
    <Footer />
</template>

<style scoped></style>
