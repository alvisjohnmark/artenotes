<template>
    <div class="min-h-screen bg-lpbgcolor text-lptxcolor font-playfair">
        <div class="flex flex-col items-center justify-center h-full py-12">
            <h1
                class="text-4xl sm:text-5xl font-bebasneue text-lptxcolorsemilight mb-4"
            >
                Thank You for Your Purchase!
            </h1>
            <p class="text-lg sm:text-xl text-lptxcolorlight mb-6 text-center">
                Your order has been successfully processed. We appreciate your
                business and hope to serve you again soon.
            </p>
            <div class="mt-8">
                <router-link
                    to="/"
                    class="bg-fmbtcolor text-bglightcolor py-2 px-6 rounded-lg text-xl hover:bg-lptxcolorsemilight transition duration-300"
                >
                    Go to Dashboard
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>

</script>

<style scoped>
/* Additional custom styling can go here if needed */
</style>
