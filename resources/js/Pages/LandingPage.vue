<template>
    <v-container class="d-flex justify-center align-center" fluid>
        <v-card class="pa-10" elevation="2" width="400px">
            <!-- Icon -->
            <v-row justify="center" class="mb-4">
                <v-icon size="64" class="primary--text">mdi-vuetify</v-icon>
            </v-row>

            <!-- Title -->
            <v-row justify="center" class="mb-6">
                <h2>Log into your account</h2>
            </v-row>

            <!-- Email Address -->
            <v-text-field
                v-model="email"
                label="Email address"
                outlined
                dense
                type="email"
                required
            ></v-text-field>

            <!-- Password -->
            <v-text-field
                v-model="password"
                label="Password"
                outlined
                dense
                type="password"
                required
            ></v-text-field>

            <!-- Remember me and Forgot Password -->
            <v-row class="d-flex justify-space-between">
                <v-checkbox
                    v-model="rememberMe"
                    label="Remember me"
                ></v-checkbox>
                <v-btn text small color="primary">Forgot password?</v-btn>
            </v-row>

            <!-- Log In Button -->
            <v-btn
                class="mt-4"
                block
                color="primary"
                @click="login"
                :disabled="!email || !password"
            >
                Log In
            </v-btn>

            <!-- Divider with text -->
            <v-divider class="my-4"></v-divider>
            <v-row justify="center">Or continue with</v-row>
            <v-divider class="my-4"></v-divider>

            <!-- Social Buttons -->
            <v-row justify="space-between">
                <v-btn color="red" outlined block class="mx-2">
                    <v-icon left>mdi-google</v-icon>
                    Google
                </v-btn>
                <v-btn color="blue darken-4" outlined block class="mx-2">
                    <v-icon left>mdi-facebook</v-icon>
                    Facebook
                </v-btn>
            </v-row>

            <!-- Sign up -->
            <v-row justify="center" class="mt-6">
                <span
                    >Don't have an account?
                    <v-btn text small color="primary">Sign up</v-btn></span
                >
            </v-row>
        </v-card>
    </v-container>
</template>

<script>
const LoginForm = {
    data() {
        return {
            email: "",
            password: "",
            rememberMe: false,
        };
    },
    methods: {
        login() {
            // Handle login action
            console.log("Logging in with", this.email, this.password);
        },
    },
};

export { LoginForm };
</script>

<style scoped>
.v-container {
    min-height: 100vh;
    background-color: cornsilk; /* Set the background to cornsilk */
}
.v-card {
    background-color: #fff; /* Use white for card background for contrast */
}
h2 {
    color: #333; /* Change the title color for better readability */
}
</style>
