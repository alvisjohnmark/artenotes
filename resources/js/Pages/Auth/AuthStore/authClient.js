import { defineStore } from "pinia";
import Swal from "sweetalert2";

export const authStore = defineStore("auth", {
    state: () => ({
        first_name: "",
        last_name: "",
        email: "",
        password: "",
        confirmPassword: "",
        showDropdown: false,
        showPassword: false,
        showConfirmPassword: false, 
        showPasswordIcon: false, 
        showConfirmPasswordIcon: false, 
        token: localStorage.getItem("token") || null,
    }),
    actions: {
        toggleDropDown(){
            this.showDropdown = !this.showDropdown;
        },
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
        async registerUser() {
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
                const response = await axios.post("/api/client/register", {
                    first_name: this.first_name,
                    last_name: this.last_name,
                    email: this.email,
                    password: this.password,
                });
                this.token = response.data.token;
                localStorage.setItem("token", this.token);
                Swal.fire({
                    icon: "success",
                    title: "Registration successful",
                    text: "You have successfully registered!",
                    confirmButtonColor: "#3085d6",
                });
                this.router.push("/");
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

        async loginUser() {
            try {
                const response = await axios.post("/api/client/login", {
                    email: this.email,
                    password: this.password,
                });
                this.token = response.data.token;
                localStorage.setItem("token", this.token);

                Swal.fire({
                    icon: "success",
                    title: "Login successful",
                    text: "Welcome!",
                    confirmButtonColor: "#3085d6",
                });

                this.router.push("/");
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

        logoutUser() {
            this.token = null;
            localStorage.removeItem("token");
            Swal.fire({
                icon: "success",
                title: "Logout successful",
                text: "You have successfully logged out.",
                confirmButtonColor: "#3085d6",
            });
            this.router.push("/");
        },
    },
});
