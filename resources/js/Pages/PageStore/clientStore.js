import { defineStore } from "pinia";
import Swal from "sweetalert2";

export const clientStore = defineStore("clientStore", {
    state: () => ({
        product_list: [],
        service_list: [],
        quantity: 1,
        token: localStorage.getItem("token") || null,
    }),
    actions: {
        increaseQuantity() {
            this.quantity++;
        },
        decreaseQuantity() {
            if (this.quantity > 1) {
                this.quantity--;
            }
        },
        async fetchProducts() {
            try {
                const response = await axios.get(`/api/getProducts`, {
                    headers: {
                        Authorization: `Bearer ${this.token}`,
                    },
                });
                this.product_list = response.data;
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
        async addToCart(item_id, item_type, price) {
            try {
                await axios.post(
                    "/api/client/addToCart",
                    { item_id, item_type, quantity: this.quantity, price },
                    {
                        headers: {
                            Authorization: `Bearer ${this.token}`,
                        },
                    }
                );
                Swal.fire(
                    "Added to cart!",
                    `${
                        item_type.charAt(0).toUpperCase() + item_type.slice(1)
                    } added successfully.`,
                    "success"
                );
            } catch (error) {
                console.error(error.response);
                console.log(item_id)
                Swal.fire(
                    "Error",
                    "Could not add item to cart. Please try again.",
                    "error"
                );
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
    },
});
