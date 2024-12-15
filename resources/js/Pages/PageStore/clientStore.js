import { defineStore } from "pinia";
import Swal from "sweetalert2";
import axios from "axios";

export const clientStore = defineStore("clientStore", {
    state: () => ({
        product_list: [],
        service_list: [],
        cart_list: [],
        client_details: {},
        order_list: [],
        items: [],
        quantity: 1,
        showAddressModal: false,
        showRecipientAddress: false,
        showTable: true,
        recipientDetails: {
            font: "",
            province: "",
            city_municipality: "",
            barangay: "",
            street: "",
            message: "",
            has_rose: false,
            envelope_color: "",
            recipient_name: "",
        },
        address: {
            barangay: "",
            city_municipality: "",
            province: "",
            zipcode: "",
        },
        selectedService: null,
        orderStatus: null, // To store the current order status

        token: localStorage.getItem("token") || null,
    }),
    actions: {
        toggleTable() {
            this.showTable = !this.showTable;
        },
        setSelectedService(service) {
            this.selectedService = service;
            this.showRecipientAddress = !this.showRecipientAddress;
            console.log(service);
        },

        toggleRecipientAddress() {
            this.showRecipientAddress = !this.showRecipientAddress;
            if (!this.showRecipientAddress) {
                this.resetForm();
            }
        },
        resetForm() {
            this.font = "";
            this.province = "";
            this.city_municipality = "";
            this.barangay = "";
            this.street = "";
            this.message = "";
        },
        async fetchClientDetails() {
            try {
                const response = await axios.get(
                    `/api/client/getClientDetails`,
                    {
                        headers: {
                            Authorization: `Bearer ${this.token}`,
                        },
                    }
                );

                this.client_details = response.data;
            } catch (error) {
                console.error("Error fetching client details:", error);
                Swal.fire(
                    "Error",
                    "Could not retrieve client details. Please try again.",
                    "error"
                );
            }
        },

        async fetchProducts() {
            try {
                const response = await axios.get(`/api/getProducts`, {
                    headers: {
                        Authorization: `Bearer ${this.token}`,
                    },
                });

                this.product_list = response.data.map((product) => ({
                    ...product,
                    quantity: 1,
                }));
            } catch (error) {
                console.error("Error fetching products:", error);
            }
        },

        async fetchServices() {
            try {
                const response = await axios.get(`/api/getServices`, {
                    headers: {
                        Authorization: `Bearer ${this.token}`,
                    },
                });
                this.service_list = response.data;
            } catch (error) {
                console.error("Error fetching services:", error);
            }
        },

        async fetchCartItems() {
            try {
                const response = await axios.get(`/api/client/getCartItems`, {
                    headers: {
                        Authorization: `Bearer ${this.token}`,
                    },
                });

                this.cart_list = response.data
                    .filter(
                        (item, index, self) =>
                            index ===
                            self.findIndex(
                                (t) =>
                                    t.item_id === item.item_id &&
                                    t.item_type === item.item_type
                            )
                    )
                    .map((item) => ({
                        ...item,
                        checked: false,
                    }));
                console.log(this.cart_list);
                
            } catch (error) {
                console.error("Error fetching carts:", error);
            }
        },

        async fetchOrderItems() {
            try {
                const response = await axios.get(`/api/client/getOrderItems`, {
                    headers: {
                        Authorization: `Bearer ${this.token}`,
                    },
                });

                this.order_list = response.data;
            } catch (error) {
                console.error("Error fetching orders:", error);
            }
        },

        async addToCart(item_id, item_type, quantity, price, stock) {
            if (stock < quantity) {
                Swal.fire({
                    title: "Quantity Exceeds Stock",
                    text: "Please select a quantity that is available in stock.",
                    icon: "warning",
                    confirmButtonText: "OK",
                });
                return;
            }
            if (!this.token) {
                Swal.fire({
                    title: "Login Required",
                    text: "Please log in to proceed with checkout.",
                    icon: "warning",
                    confirmButtonText: "Login",
                }).then(() => {
                    this.router.push("/login");
                });
            } else {
                try {
                    await axios.post(
                        "/api/client/addToCart",
                        { item_id, item_type, quantity, price },
                        {
                            headers: {
                                Authorization: `Bearer ${this.token}`,
                            },
                        }
                    );
                    Swal.fire(
                        "Added to cart!",
                        `${
                            item_type.charAt(0).toUpperCase() +
                            item_type.slice(1)
                        } added successfully.`,
                        "success"
                    );
                } catch (error) {
                    console.error(error.response);
                    Swal.fire(
                        "Error",
                        "Could not add item to cart. Please try again.",
                        "error"
                    );
                }
            }
        },

        async addToCartService(item_id, item_type, price, recipientDetails) {
            if (!this.token) {
                Swal.fire({
                    title: "Login Required",
                    text: "Please log in to proceed with checkout.",
                    icon: "warning",
                    confirmButtonText: "Login",
                }).then(() => {
                    this.router.push("/login");
                });
            } else {
                try {
                    await axios.post(
                        "/api/client/addToCart",
                        { item_id, item_type, price, recipientDetails },
                        {
                            headers: {
                                Authorization: `Bearer ${this.token}`,
                            },
                        }
                    );
                    Swal.fire(
                        "Added to cart!",
                        `${
                            item_type.charAt(0).toUpperCase() +
                            item_type.slice(1)
                        } added successfully.`,
                        "success"
                    );
                } catch (error) {
                    console.error(error.response);
                    Swal.fire(
                        "Error",
                        "Could not add item to cart. Please try again.",
                        "error"
                    );
                }
            }
        },

        async checkAddress() {
            await this.fetchClientDetails();
            if (this.client_details.hasAddress === 0) {
                this.showAddressModal = true;
            } else if (this.client_details.hasAddress === 1) {
                await this.createOrder();
            }
        },

        async saveAddress() {
            if (!this.token) {
                Swal.fire({
                    title: "Login Required",
                    text: "Please log in to proceed with checkout.",
                    icon: "warning",
                    confirmButtonText: "Login",
                }).then(() => {
                    this.router.push("/login");
                });
                return;
            }

            if (
                !this.address.barangay ||
                !this.address.city_municipality ||
                !this.address.province ||
                !this.address.zipcode
            ) {
                Swal.fire({
                    title: "Missing Information",
                    text: "Please fill out all address fields.",
                    icon: "warning",
                    confirmButtonText: "Ok",
                });
                return;
            }

            try {
                const response = await axios.put(
                    `/api/client/saveAddress/${this.client_details.id}`,
                    this.address,
                    {
                        headers: {
                            Authorization: `Bearer ${this.token}`,
                        },
                    }
                );
                console.log(this.address);
                this.showAddressModal = false;

                await this.createOrder();
            } catch (error) {
                console.error("Error saving address:", error);
                Swal.fire(
                    "Error",
                    "Could not save address. Please try again.",
                    "error"
                );
            }
        },

        async createOrder() {
            try {
                const orderDetails = this.getOrderDetails;

                const orderResponse = await axios.post(
                    `/api/client/checkoutOrder/${this.client_details.id}`,
                    {
                        client_id: this.client_details.id,
                        total: orderDetails.total,
                    },
                    {
                        headers: {
                            Authorization: `Bearer ${this.token}`,
                        },
                    }
                );

                for (const item of orderDetails.items) {
                    await axios.put(
                        `/api/client/saveOrderItems`,
                        {
                            item_id: item.id,
                            quantity: item.quantity,
                            total_price: item.total,
                        },
                        {
                            headers: {
                                Authorization: `Bearer ${this.token}`,
                            },
                        }
                    );
                }

                Swal.fire(
                    "Order Successful",
                    "Your order has been placed successfully.",
                    "success"
                );
                this.router.push("/checkout");
            } catch (error) {
                console.error("Error creating order:", error);
                Swal.fire(
                    "Error",
                    "Could not place the order. Please try again.",
                    "error"
                );
            }
        },

        async updateQuantity(item) {
            try {
                const response = await axios.put(
                    `/api/client/updateQuantity/${item.id}`,
                    { quantity: item.quantity },
                    {
                        headers: {
                            Authorization: `Bearer ${this.token}`,
                        },
                    }
                );

                const updatedQuantity = response.data.quantity;
                const index = this.cart_list.findIndex((u) => u.id === item.id);
                if (index !== -1) {
                    this.cart_list[index].quantity = updatedQuantity;
                }

                console.log(response.data.message);
            } catch (error) {
                console.error(error.response.data);
            }
        },
        async removeFromCart(id) {
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
                    await axios.delete(`/api/client/removeFromCart/${id}`, {
                        headers: {
                            Authorization: `Bearer ${this.token}`,
                        },
                    });
                    this.fetchCartItems();
                    Swal.fire(
                        "Removed!",
                        "The item has been removed from your cart.",
                        "success"
                    );
                }
            } catch (error) {
                console.error("Error removing item from cart:", error);
                Swal.fire(
                    "Error",
                    "There was an issue removing the item from the cart.",
                    "error"
                );
            }
        },

        async updateCheckedStatus(item) {
            const { id: itemId, checked } = item; // Extract id and checked from item
            try {
                await axios.put(
                    `/api/client/updateChecked/${itemId}`,
                    {
                        checked: checked ? 1 : 0,
                    },
                    {
                        headers: {
                            Authorization: `Bearer ${this.token}`,
                        },
                    }
                );
                const foundItem = this.items.find((i) => i.id === itemId);
                if (foundItem) {
                    foundItem.checked = checked;
                }
            } catch (error) {
                console.error("Error updating checked status:", error);
            }
        },
        async updateOrderStatus(orderId) {
            try {
                const response = await axios.put(
                    `/api/orderStatus/${orderId}`,
                    {
                        status: 1,
                    }
                );
                this.orderStatus = response.data.status;

                // Show success notification and redirect
                await Swal.fire("Success", "Payment Successful!", "success");
                this.router.push("thankyou");

                return response.data;
            } catch (error) {
                console.error(
                    "Error updating order status:",
                    error.response?.data || error.message
                );

                // Show error notification
                Swal.fire(
                    "Error",
                    "Failed to update order status for Cash On Delivery.",
                    "error"
                );

                throw error;
            }
        },
    },
    getters: {
        productItems: (state) =>
            state.cart_list.filter((item) => item.item_type === "product"),
        serviceItems: (state) =>
            state.cart_list.filter((item) => item.item_type === "service"),

        getOrderDetails: (state) => {
            const items = state.cart_list
                .filter((item) => item.checked)
                .map((item) => {
                    const isService = item.item_type === "service";
                    const name = isService
                        ? item.service.service_name
                        : item.product.name;
                    const price = isService
                        ? item.service.service_price
                        : item.product.price;

                    return {
                        id: item.id,
                        name,
                        totalPrice: item.quantity * price,
                    };
                });

            const subtotal = items.reduce(
                (sum, item) => sum + item.totalPrice,
                0
            );
            const deliveryFee = items.length === 0 ? 0 : 80;
            const total = subtotal + deliveryFee;

            return {
                items,
                subtotal: subtotal.toFixed(2),
                deliveryFee: deliveryFee.toFixed(2),
                total: total.toFixed(2),
            };
        },
    },
});
