<template>
    <div
        class="min-h-screen bg-lpbgcolor text-lptxcolor font-playfair flex items-center justify-center"
    >
        <div class="text-center max-w-lg mx-auto px-4 py-12">
            <h1
                class="text-5xl sm:text-6xl font-bebasneue text-lptxcolorsemilight mb-6"
            >
                Thank You for Your Purchase!
            </h1>
            <p class="text-lg sm:text-xl text-lptxcolorlight mb-8">
                Your order has been successfully processed. We appreciate your
                business and hope to serve you again soon.
            </p>
            <router-link
                to="/"
                class="inline-block bg-fmbtcolor text-bglightcolor py-3 px-8 rounded-lg text-lg sm:text-xl font-semibold shadow-md hover:bg-lpbgcolordark transition duration-300 ease-in-out"
            >
                Go to Dashboard
            </router-link>
        </div>
    </div>
</template>

<script>

</script>

<style scoped>
/* Additional custom styling if needed */
</style>
