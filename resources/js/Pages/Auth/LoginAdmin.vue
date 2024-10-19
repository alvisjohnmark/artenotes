<script setup>
import {
    Mail,
    Lock,
} from "lucide-vue-next";
</script>

<template>
    <section class="bg-gradient-to-br from-gray-100 to-gray-300 min-h-screen flex items-center justify-center">
        <main class="bg-white shadow-xl rounded-lg max-w-md w-full mx-4">
            <div class="p-8">
                <h2 class="text-4xl font-extrabold text-gray-800 mb-8 text-center">Admin</h2>
                <form class="space-y-6">
                    <!-- Email input -->
                    <div class="relative flex items-center border-b border-gray-300 focus-within:border-lptxcolor transition duration-300">
                        <Mail class="text-gray-400" />
                        <input
                            type="email"
                            placeholder="Email"
                            class="ml-3 flex-1 bg-transparent border-none focus:outline-none py-2 text-gray-700 placeholder-gray-400"
                        />
                    </div>
                    <!-- Password input -->
                    <div class="relative flex items-center border-b border-gray-300 focus-within:border-lptxcolor transition duration-300">
                        <Lock class="text-gray-400" />
                        <input
                            type="password"
                            placeholder="Password"
                            class="ml-3 flex-1 bg-transparent border-none focus:outline-none py-2 text-gray-700 placeholder-gray-400"
                        />
                    </div>
                    <!-- Submit button -->
                    <div class="mt-8">
                        <button
                            type="submit"
                            class="w-full bg-lptxcolor  text-white py-3 rounded-full font-semibold text-lg "
                        >
                            Login
                        </button>
                    </div>
                </form>
                <!-- Register link -->
                <p class="text-center text-sm text-gray-500 mt-6">
                    sUp3rs3c3rt
                </p>
            </div>
        </main>
    </section>
</template>

<style scoped>
</style>
