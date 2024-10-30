import { defineStore } from "pinia";
import Swal from "sweetalert2";

export const adminStore = defineStore("adminStore", {
    state: () => ({
        name: "",
        stock: 0,
        price: 0,
        color: "",
        size: "",
        sheets_per_paper: "",
        showAddModal: false,
        showEditModal: false,
        productToEdit: null,
        token: localStorage.getItem("admin_token") || null,
    }),
    actions: {
        toggleAddModal() {
            this.showAddModal = !this.showAddModal;
        },
        toggleEditModal(product = null) {
            this.showEditModal = !this.showEditModal;
            this.productToEdit = product;
        },
        logoutAdmin() {
            this.token = null;
            localStorage.removeItem("admin_token");
            Swal.fire({
                icon: "success",
                title: "Logout successful",
                text: "You have successfully logged out.",
                confirmButtonColor: "#3085d6",
            });
            this.router.push("/supersecretloginpagehehe");
        },
    },
});
