<script setup>
import { authStore } from "./Auth/AuthStore/authClient";
import Nav from "../components/nav.vue";
const user = authStore();
</script>

<template>
    <section class="bg-lpbgcolor min-h-screen">
        <Nav />
        <main class="px-4 py-10 sm:px-8">
            <div class="max-w-4xl mx-auto text-center space-y-16">
                <!-- Hero Section -->
                <div class="space-y-6">
                    <h1
                        class="text-3xl sm:text-5xl font-bebasneue text-lptxcolorsemilight leading-tight"
                    >
                        Welcome to Our Eco-Friendly World
                    </h1>
                    <p class="text-base sm:text-lg text-lptxcolorlight">
                        At artenotes, we’re not just a brand — we’re a movement
                        for change. Let’s make sustainability a way of life
                        together.
                    </p>
                    <button>
                        <router-link
                            to="/products"
                            class="mt-6 bg-fmbtcolor text-bglightcolor py-2 px-6 rounded-full text-base sm:text-lg font-medium shadow-md hover:bg-lptxcolorsemilight transition duration-300"
                        >
                            Explore Our Products
                        </router-link>
                    </button>
                </div>

                <!-- Divider -->
                <hr
                    class="border-lptxcolorsemilight border-t-2 mx-auto w-full"
                />

                <!-- Content Sections -->
                <div class="space-y-12 text-left">
                    <!-- Our Mission -->
                    <div class="space-y-4">
                        <h2
                            class="text-xl sm:text-2xl font-playfair text-lptxcolor"
                        >
                            Our Mission
                        </h2>
                        <p
                            class="text-lptxcolorlight text-sm sm:text-base leading-relaxed"
                        >
                            Our mission is to empower individuals to make
                            sustainable choices every day. We believe that
                            change begins with small, conscious actions, and
                            we’re here to make those actions easier. By offering
                            eco-friendly products, we provide tools to reduce
                            waste, conserve natural resources, and minimize the
                            environmental impact of our lifestyles.
                        </p>
                        <p
                            class="text-lptxcolorlight text-sm sm:text-base leading-relaxed"
                        >
                            From reusable goods to ethically sourced materials,
                            every product we create serves a purpose — to help
                            our customers contribute to a healthier planet.
                            We’re committed to reshaping how people think about
                            consumption and sustainability.
                        </p>
                    </div>

                    <!-- Our Goal -->
                    <div class="space-y-4">
                        <h2
                            class="text-xl sm:text-2xl font-playfair text-lptxcolor"
                        >
                            Our Goal
                        </h2>
                        <p
                            class="text-lptxcolorlight text-sm sm:text-base leading-relaxed"
                        >
                            Our ultimate goal is to create a future where
                            sustainable living is the norm. We’re here to make
                            eco-conscious choices not just achievable but also
                            desirable and impactful. We aim to be a trusted name
                            in the eco-conscious movement, offering solutions
                            that align with your values while meeting your
                            everyday needs.
                        </p>
                        <p
                            class="text-lptxcolorlight text-sm sm:text-base leading-relaxed"
                        >
                            Education is key to achieving this goal. We strive
                            to inspire our customers with the knowledge and
                            resources they need to make informed decisions,
                            fostering a community of sustainability advocates
                            who lead by example.
                        </p>
                    </div>

                    <!-- Why We Care -->
                    <div class="space-y-4">
                        <h2
                            class="text-xl sm:text-2xl font-playfair text-lptxcolor"
                        >
                            Why We Care
                        </h2>
                        <p
                            class="text-lptxcolorlight text-sm sm:text-base leading-relaxed"
                        >
                            We see the impact of human activity on our planet
                            every day — from polluted oceans to deforestation
                            and the growing problem of waste. These challenges
                            motivate us to take responsibility for our actions
                            and inspire others to do the same.
                        </p>
                        <p
                            class="text-lptxcolorlight text-sm sm:text-base leading-relaxed"
                        >
                            Our passion lies in creating products that solve
                            problems without adding to them. By championing
                            sustainable practices, we’re not just reducing our
                            own environmental footprint; we’re empowering you to
                            make a difference. Together, we can ensure that
                            future generations inherit a cleaner, healthier
                            planet.
                        </p>
                    </div>

                    <!-- Join Us Section -->
                    <div class="text-center">
                        <h2
                            class="text-xl sm:text-2xl font-playfair text-lptxcolor mb-4"
                        >
                            Join Us on Our Journey
                        </h2>
                        <p
                            class="text-lptxcolorlight text-sm sm:text-base leading-relaxed"
                        >
                            Be a part of the solution. By supporting artenotes,
                            you’re not only choosing eco-friendly products but
                            also joining a community dedicated to positive
                            environmental change. Together, every small step we
                            take becomes a leap toward a sustainable future.
                        </p>
                        <button
                            class="mt-6 bg-fmbtcolor text-bglightcolor py-2 px-6 rounded-full text-base sm:text-lg font-medium shadow-md hover:bg-lptxcolorsemilight transition duration-300"
                        >
                            Learn More
                        </button>
                    </div>
                </div>
            </div>
        </main>
    </section>
</template>

<style scoped>
/* Enhance typography and spacing for mobile-first design */
h1,
h2 {
    letter-spacing: 0.05em;
}

hr {
    margin: 2rem 0;
}

button {
    cursor: pointer;
    transition: transform 0.2s ease;
}

button:hover {
    transform: translateY(-2px);
}
</style>
