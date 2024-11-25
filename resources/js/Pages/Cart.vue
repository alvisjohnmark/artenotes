<script setup>
import { clientStore } from "./PageStore/clientStore";
import { Trash2, ShoppingBasket, View } from "lucide-vue-next";
import SemiNav from "../components/seminav.vue";
import Footer from "../components/footer.vue";
import { onMounted } from "vue";

const render = clientStore();

onMounted(() => {
    render.fetchCartItems();
    render.fetchClientDetails();
});
</script>

<template>
    <SemiNav />
    <section class="bg-lpbgcolor min-h-screen p-8">
        <div
            class="w-full mx-auto bg-white shadow-lg rounded-lg p-8 gap-8 mt-6"
        >
            <h2 class="text-2xl font-semibold mb-6 text-lptxcolor">
                Shopping Cart
            </h2>
            <router-link
                to="/products"
                class="mt-4 p-4 bg-lptxcolor text-white py-2 rounded-lg font-semibold"
            >
                Continue Shopping
            </router-link>
            <button
                @click="render.toggleTable"
                class="m-4 p-4 bg-lptxcolor text-white py-2 rounded-lg font-semibold"
            >
                Services
            </button>
            <div
                v-if="render.showTable"
                class="grid grid-cols-1 md:grid-cols-[2fr_1fr] gap-8 mt-4"
            >
                <div>
                    <div
                        class="grid grid-cols-[3fr_1fr_1fr_1fr] gap-4 text-center font-semibold text-lptxcolor"
                    >
                        <span>Item Details</span>
                        <span>Quantity</span>
                        <span>Price</span>
                        <span>Action</span>
                    </div>
                    <hr />

                    <div class="space-y-4 mt-4">
                        <div
                            v-if="render.cart_list.length <= 0"
                            class="flex flex-col items-center justify-center p-6 bg-gray-100 border border-gray-300 rounded-lg shadow-md"
                        >
                            <ShoppingBasket :size="32" :stroke-width="1" />
                            <p class="text-lg font-medium text-gray-600 mb-2">
                                Your cart is empty
                            </p>
                            <p class="text-gray-500 mb-4">
                                It looks like you haven't added anything yet.
                            </p>
                            <router-link
                                to="/products"
                                class="mt-4 p-4 bg-lptxcolor text-white py-2 rounded-lg font-semibold"
                            >
                                Continue Shopping
                            </router-link>
                        </div>

                        <div
                            v-else
                            class="bg-[#d8e5b0] p-4 rounded-lg grid grid-cols-[3fr_1fr_1fr_1fr] items-center gap-4"
                            v-for="item in render.productItems"
                            :key="item.id"
                        >
                            <div class="flex items-center">
                                <div class="flex items-center">
                                    <input
                                        type="checkbox"
                                        id="checkbox-{{ item.id }}"
                                        v-model="item.checked"
                                        @change="
                                            render.updateCheckedStatus(item)
                                        "
                                        class="custom-checkbox accent-lptxcolor hover:accent-lptxcolorsemilight w-6 h-6 cursor-pointer"
                                    />
                                </div>

                                <div
                                    class="w-full h-40 rounded-t-xl flex justify-center items-center mb-4"
                                >
                                    <img
                                        v-if="
                                            item.item_type === 'product' &&
                                            item.product.pictures.length
                                        "
                                        :src="`/storage/${item.product.pictures[0].file_path}`"
                                        alt="Product Image"
                                        class="h-full object-cover rounded-t-xl px-2"
                                    />
                                </div>
                                <div>
                                    <h1
                                        class="text-2xl font-semibold text-lptxcolor"
                                    >
                                        {{
                                            item.item_type === "product"
                                                ? item.product.name
                                                : item.service.name
                                        }}
                                    </h1>
                                    <p
                                        v-if="item.item_type === 'product'"
                                        class="text-lg font-semibold font-bebasneue text-lptxcolorsemilight"
                                    >
                                        {{ item.product.size }}
                                    </p>
                                    <p
                                        v-if="item.item_type === 'product'"
                                        class="text-lg font-semibold text-lptxcolorsemilight"
                                    >
                                        Sheets per Set:
                                        {{ item.product.sheets_per_set }}
                                    </p>
                                </div>
                            </div>
                            <div class="text-center">
                                <input
                                    type="number"
                                    v-model="item.quantity"
                                    class="w-20 p-2 text-center border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-fmbtcolor focus:border-transparent transition ease-in-out duration-200"
                                    min="1"
                                    @change="render.updateQuantity(item)"
                                />
                            </div>
                            <h1
                                class="text-xl text-lptxcolorsemilight text-center"
                            >
                                {{
                                    item.item_type === "product"
                                        ? item.product.price
                                        : item.service.price
                                }}
                            </h1>
                            <button
                                @click="render.removeFromCart(item.id)"
                                class="text-red-500 flex justify-center"
                            >
                                <Trash2 class="text-center" />
                            </button>
                        </div>
                    </div>
                </div>

                <div class="bg-[#f9ffe8] p-6 rounded-lg">
                    <h3 class="text-xl font-semibold text-lptxcolor">
                        Order Details
                    </h3>
                    <ul class="mt-4 space-y-2 text-lptxcolorsemilight">
                        <li
                            v-for="item in render.getOrderDetails.items"
                            :key="item.name"
                            class="flex justify-between"
                        >
                            <span>{{ item.name }}</span>
                            <span>PHP {{ item.totalPrice }}</span>
                        </li>

                        <li
                            class="border-t mt-2 pt-2 flex justify-between text-lptxcolor"
                        >
                            <span>Subtotal</span>
                            <span
                                >PHP {{ render.getOrderDetails.subtotal }}</span
                            >
                        </li>
                        <li class="flex justify-between text-lptxcolor">
                            <span>Delivery Fee</span>
                            <span
                                >PHP
                                {{ render.getOrderDetails.deliveryFee }}</span
                            >
                        </li>
                        <li
                            class="border-t mt-2 pt-2 flex justify-between font-bold text-lptxcolor"
                        >
                            <span>Total</span>
                            <span>PHP {{ render.getOrderDetails.total }}</span>
                        </li>
                    </ul>
                    <button
                        @click="render.checkAddress()"
                        class="mt-4 w-full bg-lptxcolor text-white py-2 rounded-lg font-semibold"
                    >
                        PROCEED TO CHECKOUT
                    </button>
                </div>
            </div>

            <div
                v-else
                class="grid grid-cols-1 md:grid-cols-[2fr_1fr] gap-8 mt-4"
            >
                <div>
                    <div
                        class="grid grid-cols-[1fr_1fr_1fr_1fr_1fr] gap-4 text-center font-semibold text-lptxcolor"
                    >
                        <span></span>
                        <span>Name</span>
                        <span>Description</span>
                        <span>Price</span>
                        <span>Action</span>
                    </div>
                    <hr />

                    <div
                        v-if="render.serviceItems.length <= 0"
                        class="flex flex-col items-center justify-center p-6 bg-gray-100 border border-gray-300 rounded-lg shadow-md"
                    >
                        <ShoppingBasket :size="32" :stroke-width="1" />
                        <p class="text-lg font-medium text-gray-600 mb-2">
                            Your service cart is empty
                        </p>
                        <p class="text-gray-500 mb-4">
                            It looks like you haven't added anything yet.
                        </p>
                        <router-link
                            to="/services"
                            class="mt-4 p-4 bg-lptxcolor text-white py-2 rounded-lg font-semibold"
                            >Continue Shopping</router-link
                        >
                    </div>

                    <div v-else class="space-y-4 mt-4">
                        <div
                            v-for="item in render.serviceItems"
                            :key="item.id"
                            class="bg-[#d8e5b0] p-4 rounded-lg grid grid-cols-[1fr_1fr_1fr_1fr_1fr] items-center gap-4"
                        >
                            <div class="flex justify-center">
                                <input
                                    type="checkbox"
                                    :id="'checkbox-' + item.id"
                                    v-model="item.checked"
                                    @change="render.updateCheckedStatus(item)"
                                    class="custom-checkbox accent-lptxcolor hover:accent-lptxcolorsemilight w-6 h-6 cursor-pointer"
                                />
                            </div>

                            <!-- Font -->
                            <div class="text-center">
                                {{ item.service.service_name }}
                            </div>

                            <div class="text-center">
                                {{ item.service.service_description }}
                            </div>

                            <div class="text-center">
                                {{ item.service.service_price }}
                            </div>

                            <div class="flex justify-center">
                                <button
                                    @click="render.removeFromCart(item.id)"
                                    class="text-red-500"
                                >
                                    <Trash2 />
                                </button>
                                <button
                                    @click="render.removeFromCart(item.id)"
                                    class="text-blue-500"
                                >
                                    <View />
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-[#f9ffe8] p-6 rounded-lg">
                    <h3 class="text-xl font-semibold text-lptxcolor">
                        Order Details
                    </h3>
                    <ul class="mt-4 space-y-2 text-lptxcolorsemilight">
                        <li
                            v-for="item in render.getOrderDetails.items"
                            :key="item.name"
                            class="flex justify-between"
                        >
                            <span>{{ item.name }}</span>
                            <span>PHP {{ item.totalPrice }}</span>
                        </li>

                        <li
                            class="border-t mt-2 pt-2 flex justify-between text-lptxcolor"
                        >
                            <span>Subtotal</span>
                            <span
                                >PHP {{ render.getOrderDetails.subtotal }}</span
                            >
                        </li>

                        <li class="flex justify-between text-lptxcolor">
                            <span>Delivery Fee</span>
                            <span
                                >PHP
                                {{ render.getOrderDetails.deliveryFee }}</span
                            >
                        </li>

                        <li
                            class="border-t mt-2 pt-2 flex justify-between font-bold text-lptxcolor"
                        >
                            <span>Total</span>
                            <span>PHP {{ render.getOrderDetails.total }}</span>
                        </li>
                    </ul>
                    <button
                        @click="
                            render.checkAddress();
                        "
                        class="mt-4 w-full bg-lptxcolor text-white py-2 rounded-lg font-semibold"
                    >
                        PROCEED TO CHECKOUT
                    </button>
                </div>
            </div>
        </div>
        <div
            v-if="render.showAddressModal"
            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50"
        >
            <div class="bg-white p-8 rounded-lg shadow-lg w-96">
                <h2 class="text-2xl font-semibold mb-4">Shipping Address</h2>

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
    </section>
    <Footer />
</template>

<style scoped></style>
