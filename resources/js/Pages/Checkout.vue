<script setup>
import { Trash2, ShoppingBasket } from "lucide-vue-next";
import { clientStore } from "./PageStore/clientStore";
import { paymentStore } from "./PageStore/paymentStore";
import { onMounted, ref } from "vue";
import SemiNav from "../components/seminav.vue";
import Footer from "../components/footer.vue";
import Swal from "sweetalert2";

const showCardModal = ref(false);
const payment = paymentStore();
const render = clientStore();
const selectedPaymentMethod = ref("");

const closeCardModal = () => {
    showCardModal.value = false;
};
onMounted(() => {
    payment.fetchOrderItems();
    render.fetchClientDetails();
});
const creditcard = async () => {
    try {
        const orderID = payment.order_list.order_items[0].order_id;
        await render.updateOrderStatus(orderID);
        showCardModal.value = false;
    } catch (error) {
        console.error("Error updating order status:", error);
        Swal.fire(
            "Error",
            "Failed to update order status for Cash On Delivery.",
            "error"
        );
    }
};
const handlePayment = async () => {
    if (selectedPaymentMethod.value === "Gcash") {
        try {
            await payment.createPaymentIntent();
            if (payment.paymentIntent) {
                const orderID = payment.order_list.order_items[0].order_id;
                await payment.confirmPayment(orderID);
                if (payment.paymentUrl && payment.paymentUrl !== "") {
                    window.location.href = payment.paymentUrl;
                } else {
                    Swal.fire(
                        "Error",
                        "Failed to get the GCash payment URL.",
                        "error"
                    );
                }
            } else {
                Swal.fire("Error", "Payment Intent not created.", "error");
            }
        } catch (error) {
            console.error("Error during GCash payment:", error);
            Swal.fire(
                "Error",
                "An error occurred while processing GCash payment.",
                "error"
            );
        }
    } else if (selectedPaymentMethod.value === "CashOnDelivery") {
        try {
            const orderID = payment.order_list.order_items[0].order_id;
            await render.updateOrderStatus(orderID);
        } catch (error) {
            console.error("Order status update failed:", error);
        }
    } else if (selectedPaymentMethod.value === "Debit/CreditCard") {
        showCardModal.value = true;
    } else {
        Swal.fire("Warning", "Please select a payment method.", "warning");
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
                        {{ render.client_details.city_municipality }}
                    </p>
                    <p>
                        {{ render.client_details.zipcode }}
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
                    <label
                        class="flex items-center space-x-3 p-3 border border-gray-300 rounded-lg cursor-pointer"
                    >
                        <input
                            type="radio"
                            name="paymentMethod"
                            value="Debit/CreditCard"
                            v-model="selectedPaymentMethod"
                            class="form-radio text-lptxcolorsemilight"
                        />
                        <span>Credit/Debit Card</span>
                    </label>
                </div>

                <button
                    @click="handlePayment"
                    class="w-full mt-6 py-3 bg-fmbtcolor text-white font-bebasneue text-xl rounded-lg"
                >
                    PAY PHP {{ payment.order_list.total_amount }}
                </button>
                <div
                    v-if="showCardModal"
                    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
                >
              
                    <div
                        class="w-full max-w-xl bg-bglightcolor rounded-lg p-10 relative"
                    >
                      <h1 class="text-2xl font-bold p-2">Card Details</h1>
                        <button
                            @click="closeCardModal"
                            class="absolute top-4 right-6 text-gray-500 text-lptxcolorsemilight text-xl"
                        >
                            X
                        </button>
                        <form
                            @submit.prevent="creditcard"
                            action="#"
                            class="w-full rounded-lg border border-gray-200 bg-bglightcolor p-4 shadow-sm sm:p-6 lg:max-w-xl lg:p-8"
                        >
                            
                            <div class="mb-6 grid grid-cols-2 gap-4">
                                <div class="col-span-2 sm:col-span-1">
                                    <label
                                        for="full_name"
                                        class="mb-2 block text-sm font-bold text-lptxcolorsemilight"
                                    >
                                        Full name (as displayed on card)*
                                    </label>
                                    <input
                                        type="text"
                                        id="full_name"
                                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-white focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:placeholder:text-white dark:focus:border-primary-500 dark:focus:ring-primary-500"
                                        placeholder="John Doe"
                                        required
                                    />
                                </div>

                                <div class="col-span-2 sm:col-span-1">
                                    <label
                                        for="card-number-input"
                                        class="mb-2 block text-sm font-bold text-lptxcolorsemilight"
                                    >
                                        Card number*
                                    </label>
                                    <input
                                        type="text"
                                        id="card-number-input"
                                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 pe-10 text-sm text-white  focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:placeholder:text-white dark:focus:border-primary-500 dark:focus:ring-primary-500"
                                        placeholder="xxxx-xxxx-xxxx-xxxx"
                                        required
                                    />
                                </div>

                                <div>
                                    <label
                                        for="card-expiration-input"
                                        class="mb-2 block text-sm font-bold text-lptxcolorsemilight"
                                        >Card expiration*
                                    </label>
                                    <div class="relative">
                                        <div
                                            class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3.5"
                                        >
                                            <svg
                                                class="h-4 w-4 text-gray-500 dark:text-white"
                                                aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="24"
                                                height="24"
                                                fill="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M5 5a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1 2 2 0 0 1 2 2v1a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V7a2 2 0 0 1 2-2ZM3 19v-7a1 1 0 0 1 1-1h16a1 1 0 0 1 1 1v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm6.01-6a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm-10 4a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                        </div>
                                        <input
                                            datepicker
                                            datepicker-format="mm/yy"
                                            id="card-expiration-input"
                                            type="text"
                                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 ps-9 text-sm text-white  focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:placeholder:text-white dark:focus:border-blue-500 dark:focus:ring-blue-500"
                                            placeholder="12/23"
                                            required
                                        />
                                    </div>
                                </div>
                                <div>
                                    <label
                                        for="cvv-input"
                                        class="mb-2 flex items-center gap-1 text-sm font-bold text-lptxcolorsemilight"
                                    >
                                        CVV*
                                        <button
                                            data-tooltip-target="cvv-desc"
                                            data-tooltip-trigger="hover"
                                            class="text-white hover:text-lptxcolorsemilight dark:text-gray-500 dark:hover:text-white"
                                        >
                                            <svg
                                                class="h-4 w-4"
                                                aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm9.408-5.5a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2h-.01ZM10 10a1 1 0 1 0 0 2h1v3h-1a1 1 0 1 0 0 2h4a1 1 0 1 0 0-2h-1v-4a1 1 0 0 0-1-1h-2Z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                        </button>
                                        <div
                                            id="cvv-desc"
                                            role="tooltip"
                                            class="tooltip invisible absolute z-10 inline-block rounded-lg bg-lptxcolorsemilight px-3 py-2 text-sm font-bold text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-gray-700"
                                        >
                                            The last 3 digits on back of card
                                            <div
                                                class="tooltip-arrow"
                                                data-popper-arrow
                                            ></div>
                                        </div>
                                    </label>
                                    <input
                                        type="number"
                                        id="cvv-input"
                                        aria-describedby="helper-text-explanation"
                                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-white  focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:placeholder:text-white dark:focus:border-primary-500 dark:focus:ring-primary-500"
                                        placeholder="•••"
                                        required
                                    />
                                </div>
                            </div>

                            <button
                                type="submit"
                                class="flex w-full items-center justify-center rounded-lg bg-fmbtcolor px-5 py-2.5 text-sm font-bold text-bglightcolor"
                            >
                                Pay now
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </section>
    <Footer />
</template>

<style scoped></style>
