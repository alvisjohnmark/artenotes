<script setup></script>
<template>
    <div
        class="min-h-screen flex flex-col justify-center items-center bg-lpbgcolor text-lptxcolor"
    >
        <h1 class="text-6xl font-bold text-lptxcolor font-playfair">404</h1>
        <p class="text-2xl mt-2 font-bebasneue text-lptxcolorsemilight">
            Oops! Page Not Found
        </p>
        <p class="text-lg mt-4 text-lptxcolorlight">
            Sorry, the page you are looking for does not exist.
        </p>
        <router-link
            to="/"
            class="mt-6 inline-block px-6 py-3 bg-fmbtcolor text-bglightcolor text-xl rounded-md hover:bg-lpbgcolordark transition duration-300 ease-in-out"
        >
            Go Back Home
        </router-link>
    </div>
</template>

<style lang="scss" scoped></style>
