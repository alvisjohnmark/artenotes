<script setup>
import { Facebook, Instagram, Youtube } from "lucide-vue-next";
</script>
<template>
    <footer
        class="py-16 bg-cover bg-center relative"
        style="background-image: url('/img/lpbg3.jpg')"
    >
        <div class="container mx-auto text-center text-white space-y-4">
            <p class="text-2xl font-semibold tracking-wider">Follow Us</p>
            <div class="flex justify-center gap-6 py-4">
                <a
                    href="https://www.facebook.com"
                    target="_blank"
                    class="hover:text-[#f0ece4] transition duration-300 ease-in-out transform hover:scale-110"
                >
                    <Facebook :size="28" :stroke-width="1" />
                </a>
                <a
                    href="https://www.instagram.com"
                    target="_blank"
                    class="hover:text-[#f0ece4] transition duration-300 ease-in-out transform hover:scale-110"
                >
                    <Instagram :size="28" :stroke-width="1" />
                </a>
                <a
                    href="https://www.youtube.com"
                    target="_blank"
                    class="hover:text-[#f0ece4] transition duration-300 ease-in-out transform hover:scale-110"
                >
                    <Youtube :size="28" :stroke-width="1" />
                </a>
            </div>
            <div class="text-sm text-gray-300">
                <p>&copy; 2024 artenotes. All Rights Reserved.</p>
            </div>
        </div>
    </footer>
</template>

<style lang="scss" scoped></style>
