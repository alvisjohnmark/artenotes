import { defineStore } from "pinia";
import Swal from "sweetalert2";
import axios from "axios";

export const paymentStore = defineStore("paymentStore", {
    state: () => ({
        token: localStorage.getItem("token") || null,
        paymentIntent: null,
        paymentUrl: null,
        shipping_fee: 80,
        order_list: [],
    }),

    actions: {
        updateShippingFee() {
            if (
                Array.isArray(this.order_list.order_items) &&
                this.order_list.order_items.some(() => true)
            ) {
                this.shippingFee = 80;
            } else {
                this.shippingFee = 0;
            }
        },
        async fetchOrderItems() {
            try {
                const response = await axios.get("/api/client/getOrderItems", {
                    headers: {
                        Authorization: `Bearer ${this.token}`,
                    },
                });
                this.order_list = response.data;
                console.log("Order List:", this.order_list);
            } catch (error) {
                console.error("Error fetching orders:", error);
                Swal.fire("Error", "Unable to fetch order items", "error");
            }
        },
        async removeOrderItem(id, recipientDetailId) {
            try {
                const result = await Swal.fire({
                    title: "Are you sure?",
                    text: "Do you really want to remove this item from the cart?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, remove it",
                    cancelButtonText: "Cancel",
                });

                if (result.isConfirmed) {
                    await axios.delete(`/api/client/removeFromOrder/${id}`, {
                        headers: {
                            Authorization: `Bearer ${this.token}`,
                        },
                        data: { recipient_detail_id: recipientDetailId },
                    });
                    this.fetchOrderItems();
                    this.updateShippingFee();
                    Swal.fire(
                        "Removed!",
                        "The item has been removed from your order.",
                        "success"
                    );
                }
            } catch (error) {
                console.error("Error removing item from cart:", error);
                Swal.fire(
                    "Error",
                    "There was an issue removing the item from the order.",
                    "error"
                );
            }
        },

        async createPaymentIntent() {
            try {
                if (
                    !this.order_list ||
                    typeof this.order_list.total_amount !== "number"
                ) {
                    Swal.fire(
                        "Error",
                        "Total amount is not defined or is invalid.",
                        "error"
                    );
                    return;
                }

                if (this.order_list.total_amount < 20) {
                    Swal.fire(
                        "Error",
                        "The minimum order amount is PHP 20.00.",
                        "error"
                    );
                    return;
                }

                console.log(
                    "Original Total Amount (in PHP):",
                    this.order_list.total_amount
                );
                const amountInCentavos =
                    parseFloat(this.order_list.total_amount) * 100;

                const response = await axios.post("/api/payment-intent", {
                    amount: amountInCentavos,
                });

                this.paymentIntent = response.data;
            } catch (error) {
                console.error("Error creating payment intent:", error);
                Swal.fire("Error", "Unable to create payment intent", "error");
            }
        },

        async confirmPayment() {
            try {
                const response = await axios.post('/api/confirm-payment', {
                    payment_intent_id: this.paymentIntent.id,
                    client_key: this.paymentIntent.attributes.client_key,
                });
        
                console.log("Full Response Data:", response.data);
        
                const redirectUrl = response.data?.redirect_url || response.data?.data?.attributes?.next_action?.redirect?.url;
        
                if (redirectUrl) {
                    this.paymentUrl = redirectUrl;
                    window.location.href = redirectUrl; // Trigger the redirect explicitly
                } else {
                    Swal.fire('Error', 'Failed to get the GCash payment URL.', 'error');
                }
            } catch (error) {
                console.error("Error during payment confirmation:", error.response?.data || error.message);
                Swal.fire('Error', 'Payment confirmation failed.', 'error');
            }
        },
        
        async updateOrderStatusToCOD() {
            try {
                const response = await axios.post("/api/update-order-status", {
                    order_id: this.order_list.id,
                    status: 2, 
                });
                console.log(response.data.message);
                Swal.fire(
                    "Success",
                    "Order status updated to Cash On Delivery.",
                    "success"
                );
            } catch (error) {
                console.error("Error updating order status:", error);
                Swal.fire("Error", "Unable to update order status", "error");
            }
        },
    },
    getters: {},
});
