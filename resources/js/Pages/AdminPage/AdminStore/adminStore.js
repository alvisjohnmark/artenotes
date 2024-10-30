import { defineStore } from "pinia";
import Swal from "sweetalert2";

export const adminFunctions = defineStore("adminFunctions", {
    state: () => ({
        adminName: "",
        name: "",
        stock: 0,
        price: 0,
        color: "",
        size: "",
        sheets_per_set: "",
        editingProduct: null,
        selectedImage: null,
        product_list: [],
        showAddModal: false,
        showEditModal: false,
        token: localStorage.getItem("admin_token") || null,
    }),
    actions: {
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
        toggleAddModal() {
            this.showAddModal = !this.showAddModal;
            if (!this.showAddModal) {
                this.resetForm();
            }
        },
        toggleEditModal() {
            this.showEditModal = !this.showEditModal;
            if (!this.showEditModal) {
                this.resetForm();
            }
        },
        resetForm() {
            this.name = "";
            this.stock = 0;
            this.price = 0;
            this.color = "";
            this.size = "";
            this.sheets_per_set = "";
        },
        async addProduct() {
            try {
                const response = await axios.post(
                    "/api/admin/addProduct",
                    {
                        name: this.name,
                        stock: this.stock,
                        price: this.price,
                        color: this.color,
                        size: this.size,
                        sheets_per_set: this.sheets_per_set,
                    },
                    { headers: { Authorization: `Bearer ${this.token}` } }
                );

                if (this.selectedImage) {
                    const formData = new FormData();
                    formData.append("image", this.selectedImage);

                    await axios.post(
                        `/api/admin/addPicture/${response.data.id}/image`,
                        formData,
                        {
                            headers: {
                                Authorization: `Bearer ${this.token}`,
                                "Content-Type": "multipart/form-data",
                            },
                        }
                    );
                }

                Swal.fire(
                    "Success",
                    "Product and image added successfully!",
                    "success"
                );
                this.fetchProducts();
                this.toggleAddModal();
                this.resetForm();
            } catch (error) {
                console.log(error.response.data);
                Swal.fire(
                    "Error",
                    "An error occurred while adding the product.",
                    "error"
                );
            }
        },

        handleFileUpload(event) {
            this.selectedImage = event.target.files[0];
        },

        getAdminName() {
            axios
                .get("/api/admin/name", {
                    headers: {
                        Authorization: `Bearer ${this.token}`,
                    },
                })
                .then((response) => {
                    this.adminName = response.data.adminName;
                })
                .catch((error) => {
                    console.error("Error fetching admin name", error);
                });
        },
        async fetchProducts() {
            try {
                const response = await axios.get(`/api/admin/getProducts`, {
                    headers: {
                        Authorization: `Bearer ${this.token}`,
                    },
                });
                this.product_list = response.data;
                console.log(this.product_list)
            } catch (error) {
                console.error("Error fetching products:", error);
            }
        },
        editProduct(product) {
            this.showEditModal = !this.showEditModal;
            this.editingProduct = product;
            this.name = product.name;
            this.stock = product.stock;
            this.price = product.price;
            this.color = product.color;
            this.size = product.size;
            this.sheets_per_set = product.sheets_per_set;
        },

        async updateProduct() {
            try {
                const response = await axios.put(
                    `/api/admin/updateProduct/${this.editingProduct.id}`,
                    {
                        name: this.name,
                        stock: this.stock,
                        price: this.price,
                        color: this.color,
                        size: this.size,
                        sheets_per_set: this.sheets_per_set,
                    },
                    {
                        headers: {
                            Authorization: `Bearer ${this.token}`,
                        },
                    }
                );

                Swal.fire({
                    icon: "success",
                    title: "Product Updated",
                    text: "Product has been successfully updated!",
                });
                this.fetchProducts();
                this.toggleEditModal();
                this.resetForm();
            } catch (error) {
                Swal.fire({
                    icon: "error",
                    title: "Update Failed",
                    text: "An error occurred while updating the product.",
                });
            }
        },

        async deleteProduct(productId) {
            try {
                await Swal.fire({
                    title: "Are you sure?",
                    text: "This will permanently delete the product!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Yes, delete it!",
                }).then(async (result) => {
                    if (result.isConfirmed) {
                        await axios.delete(
                            `/api/admin/deleteProduct/${productId}`,
                            {
                                headers: {
                                    Authorization: `Bearer ${this.token}`,
                                },
                            }
                        );
                        Swal.fire(
                            "Deleted!",
                            "Product has been deleted.",
                            "success"
                        );
                        this.fetchProducts();
                    }
                });
            } catch (error) {
                Swal.fire({
                    icon: "error",
                    title: "Delete Failed",
                    text: "An error occurred while deleting the product.",
                });
            }
        },
    },
});
