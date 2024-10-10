<script setup>
import { House, Users, ShoppingBag, MailCheck, LogIn } from "lucide-vue-next";
</script>

<template>
    <section class="bg-lpbgcolor min-h-screen">
        <nav class="bg-[#f5f0f1]">
            <div class="container mx-auto flex justify-between items-center py-4 px-10">
                <div class="flex items-center">
                    <img src="/public/img/logo.png" class="h-20 w-auto">
                </div>
                <h1 class="text-lptxcolor text-5xl font-playfair">
                    artenotes
                </h1>

                <router-link  to="/register" class="text-lptxcolor flex items-center space-x-1">
                    <span>
                        <LogIn :stroke-width="1" />
                    </span>
                    <span class="hover:text-[#5a5a3a] font-bebasneue">Sign In</span>
                </router-link>
                
            </div>
            <hr class="border-lptxcolor" />

            <div class="container mx-auto flex justify-center gap-8 py-2">
                <router-link
                    to="/"
                    class="text-lptxcolor flex items-center space-x-1 p-1"
                >
                    <span>
                        <House
                            :stroke-width="1"
                        />
                    </span>
                    <span class="hover:text-[#5a5a3a] font-bebasneue">HOME</span>
                </router-link>

                <router-link
                    to="/about"
                    class="text-lptxcolor flex items-center space-x-1 p-1 "
                >
                    <span>
                        <Users :stroke-width="1" />
                    </span>
                    <span class="hover:text-[#5a5a3a] font-bebasneue">ABOUT US</span>
                </router-link>

                <router-link
                    to="/products"
                    class="text-lptxcolor flex items-center space-x-1 p-1"
                >
                    <span>
                        <ShoppingBag :stroke-width="1" />
                    </span>
                    <span class="hover:text-[#5a5a3a] font-bebasneue">PRODUCTS</span>
                </router-link>

                <router-link
                    to="/services"
                    class="text-lptxcolor flex items-center space-x-1 p-1 border-b-2 border-lptxcolor"
                >
                    <span>
                        <MailCheck :stroke-width="1" />
                    </span>
                    <span class="hover:text-[#5a5a3a] font-bebasneue">SERVICES</span>
                </router-link>
            </div>
        </nav>
    </section>
</template>

<style scoped></style>
