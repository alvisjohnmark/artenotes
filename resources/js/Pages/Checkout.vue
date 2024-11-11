<script setup>
import { Trash2, ShoppingBasket } from "lucide-vue-next";
import { clientStore } from "./PageStore/clientStore";
import { paymentStore } from "./PageStore/paymentStore";
import { onMounted, ref } from "vue";
import SemiNav from "../components/seminav.vue";
import Footer from "../components/footer.vue";
import Swal from "sweetalert2";

const payment = paymentStore();
const render = clientStore();
const selectedPaymentMethod = ref("");

onMounted(() => {
    payment.fetchOrderItems();
    render.fetchClientDetails();
});

const handlePayment = async () => {
    if (selectedPaymentMethod.value === 'Gcash') {
        try {
            await payment.createPaymentIntent();

            if (payment.paymentIntent) {
                await payment.confirmPayment();
                if (payment.paymentUrl && payment.paymentUrl !== '') {
                    window.location.href = payment.paymentUrl;
                } else {
                    Swal.fire('Error', 'Failed to get the GCash payment URL.', 'error');
                }
            } else {
                Swal.fire('Error', 'Payment Intent not created.', 'error');
            }
        } catch (error) {
            console.error('Error during GCash payment:', error);
            Swal.fire('Error', 'An error occurred while processing GCash payment.', 'error');
        }
    } else if (selectedPaymentMethod.value === 'CashOnDelivery') {
        try {
            await payment.updateOrderStatusToCOD();
            Swal.fire('Success', 'Order status updated to Cash On Delivery.', 'success');
        } catch (error) {
            console.error('Error updating order status:', error);
            Swal.fire('Error', 'Failed to update order status for Cash On Delivery.', 'error');
        }
    } else {
        Swal.fire('Warning', 'Please select a payment method.', 'warning');
    }
};
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

                <table class="w-full mt-4 border-collapse">
                    <thead>
                        <tr
                            class="text-left font-semibold text-lg border-b border-gray-300"
                        >
                            <th class="py-2 px-4">Name</th>
                            <th class="py-2 px-4">Price</th>
                            <th class="py-2 px-4">Quantity</th>
                            <th class="py-2 px-4">Total Price</th>
                            <th class="py-2 px-4">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-lg">
                        <tr
                            v-for="product in payment.order_list.order_items"
                            :key="product.id"
                            class="border-b border-gray-200"
                        >
                            <td class="py-2 px-4 text-center">
                                {{ product.product.name }}
                            </td>
                            <td class="py-2 px-4 text-center">
                                {{ product.price }}
                            </td>
                            <td class="py-2 px-4 text-center">
                                {{ product.quantity }}
                            </td>
                            <td class="py-2 px-4 text-center">
                                {{ product.price * product.quantity }}
                            </td>
                            <td class="py-2 px-4 text-center">
                                <button
                                    @click="
                                        payment.removeOrderItem(
                                            product.id,
                                            product.recipient_detail_id
                                        )
                                    "
                                    class="text-gray-500 flex justify-center"
                                >
                                    <Trash2 class="text-center" />
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="mt-4 font-semibold">
                    <div class="flex justify-between mt-3">
                        <span class="px-4">Subtotal</span>
                        <span class="px-4">{{
                            payment.order_list.subtotal
                        }}</span>
                    </div>
                    <div class="flex justify-between mt-3">
                        <span class="px-4">Delivery Fee</span>
                        <span class="px-4">{{ payment.shipping_fee }}</span>
                    </div>
                </div>

                <hr class="my-3 border-t border-gray-300" />
                <div class="flex justify-between text-2xl text-fmbtcolor">
                    <span>Total</span>
                    <span>PHP {{ payment.order_list.total_amount }} </span>
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
                        {{ render.client_details.first_name }}
                        {{ render.client_details.last_name }}
                    </p>
                    <p>{{ render.client_details.street }}</p>
                    <p>
                        {{ render.client_details.province }}
                        {{ render.client_details.country }}
                    </p>
                    <p>
                        {{ render.client_details.zipcode }}
                        {{ render.client_details.country }}
                    </p>
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
                            value="Gcash"
                            v-model="selectedPaymentMethod"
                            class="form-radio text-lptxcolorsemilight"
                        />
                        <span>GCash</span>
                    </label>
                    <label
                        class="flex items-center space-x-3 p-3 border border-gray-300 rounded-lg cursor-pointer"
                    >
                        <input
                            type="radio"
                            name="paymentMethod"
                            value="CashOnDelivery"
                            v-model="selectedPaymentMethod"
                            class="form-radio text-lptxcolorsemilight"
                        />
                        <span>Cash On Delivery</span>
                    </label>
                </div>

                <button
                    @click="handlePayment"
                    class="w-full mt-6 py-3 bg-fmbtcolor text-white font-bebasneue text-xl rounded-lg"
                >
                    PAY PHP {{ payment.order_list.total_amount }}
                </button>

                <!-- <p v-if="payment.paymentUrl">
                    Redirecting to:
                    <a :href="payment.paymentUrl" target="_blank">{{
                        payment.paymentUrl
                    }}</a>
                </p> -->
            </div>
        </main>
    </section>
    <Footer />
</template>

<style scoped>
/* Additional table styles if needed */
</style>
