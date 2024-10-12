<script setup>
import { authStore } from "./Auth/AuthStore/authClient";
import Nav from "../components/nav.vue"
const user = authStore();
</script>

<template>
    <section class="bg-lpbgcolor min-h-screen">
        <Nav/>
        <main>
            
        </main>
    </section>
</template>

<style scoped></style>
