import { defineStore } from "pinia";
import Swal from "sweetalert2";

export const clientStore = defineStore("clientStore", {
    state: () => ({
        product_list: [],
        service_list: [],
        cart_list: [],
        quantity: 1,
        token: localStorage.getItem("token") || null,
    }),
    actions: {
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

                console.log(this.product_list);
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
                console.log(this.service_list);
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

                this.cart_list = response.data.map((item) => ({
                    ...item,
                    checked: false,
                }));

                console.log(this.cart_list);
            } catch (error) {
                console.error("Error fetching carts:", error);
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

        checkout() {
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
                Swal.fire("Proceeding to checkout", "Redirecting...", "info");
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
    },
    getters: {
        getOrderDetails: (state) => {
            const items = state.cart_list
                .filter((item) => item.checked) 
                .map((item) => ({
                    id: item.id,
                    name: item.product.name,
                    totalPrice: item.quantity * item.product.price,
                }));

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
