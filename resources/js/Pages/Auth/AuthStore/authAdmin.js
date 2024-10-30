import { defineStore } from "pinia";
import Swal from "sweetalert2";

export const adminStore = defineStore("adminStore", {
    state: () => ({
        name: "",
        email: "",
        password: "",
        confirmPassword: "",
        showPassword: false,
        showConfirmPassword: false, 
        showPasswordIcon: false, 
        showConfirmPasswordIcon: false, 
        token: localStorage.getItem("admin_token") || null,
    }),
    actions: {
        togglePasswordVisibility() {
            this.showPassword = !this.showPassword;
        },
        toggleConfirmPasswordVisibility() {
            this.showConfirmPassword = !this.showConfirmPassword;
        },
        onPasswordInput() {
            this.showPasswordIcon = !!this.password;
        },
        onConfirmPasswordInput() {
            this.showConfirmPasswordIcon = !!this.confirmPassword; 
        },

        async registerAdmin() {
            try {
                if (this.password !== this.confirmPassword) {
                    Swal.fire({
                        icon: "error",
                        title: "Passwords do not match",
                        text: "Please make sure both passwords are the same.",
                        confirmButtonColor: "#d33",
                    });
                    return;
                }
                const response = await axios.post("/api/admin/register", {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                });
                this.token = response.data.token;
                localStorage.setItem("admin_token", this.token);
                Swal.fire({
                    icon: "success",
                    title: "Registration successful",
                    text: "You have successfully registered!",
                    confirmButtonColor: "#3085d6",
                });
                this.router.push("/admin/dashboard");
            } catch (error) {
                console.error("Registration error:", error);
                Swal.fire({
                    icon: "error",
                    title: "Registration failed",
                    text: "An error occurred during registration. Please try again.",
                    confirmButtonColor: "#d33",
                });
            }
        },
        async loginAdmin() {
            try {
                const response = await axios.post("/api/admin/login", {
                    email: this.email,
                    password: this.password,
                });
                this.token = response.data.token;
                localStorage.setItem("admin_token", this.token);
                Swal.fire({
                    icon: "success",
                    title: "Login successful",
                    text: "Welcome!",
                    confirmButtonColor: "#3085d6",
                });
                this.router.push("/admin/dashboard");
            } catch (error) {
                console.error("Login error:", error);
                Swal.fire({
                    icon: "error",
                    title: "Login failed",
                    text: "Incorrect email or password.",
                    confirmButtonColor: "#d33",
                });
            }
        },
       
    },
});
