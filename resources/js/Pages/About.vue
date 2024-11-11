<script setup>
import { authStore } from "./Auth/AuthStore/authClient";
import Nav from "../components/nav.vue";
const user = authStore();
</script>

<template>
    <section class="bg-lpbgcolor min-h-screen">
        <Nav />
        <main class="px-4 py-12 sm:px-16">
            <div class="max-w-3xl mx-auto text-center">
                <h1
                    class="text-4xl sm:text-5xl font-bebasneue text-lptxcolorsemilight mb-6"
                >
                    Welcome to Our Eco-Friendly World
                </h1>
                <p class="text-lg sm:text-xl text-lptxcolorlight mb-8">
                    At artenotes, we are more than just a brand — we are a
                    movement towards a sustainable future. By offering
                    high-quality, eco-friendly products, we aim to inspire
                    individuals to make positive changes in their everyday
                    lives, helping to protect our planet for future generations.
                </p>
                <div class="text-left space-y-6">
                    <h2
                        class="text-2xl sm:text-3xl font-playfair text-lptxcolor mb-4"
                    >
                        Our Mission
                    </h2>
                    <p class="text-lptxcolorlight text-base sm:text-lg">
                        Our mission is simple: to create a world where
                        sustainable choices are easy, affordable, and
                        accessible. We are committed to providing eco-friendly
                        products that contribute to a greener lifestyle. Whether
                        it’s reducing waste, conserving resources, or promoting
                        ethical manufacturing practices, we’re here to lead the
                        charge in making sustainability mainstream.
                    </p>

                    <h2
                        class="text-2xl sm:text-3xl font-playfair text-lptxcolor mb-4"
                    >
                        Our Goal
                    </h2>
                    <p class="text-lptxcolorlight text-base sm:text-lg">
                        Our goal is to be at the forefront of the eco-conscious
                        movement, providing products that not only meet your
                        needs but also align with your values. We aim to educate
                        our customers on the importance of sustainability, and
                        provide them with the tools and products to make
                        informed, responsible choices. We envision a world where
                        sustainable living is not a trend, but a way of life.
                    </p>

                    <h2
                        class="text-2xl sm:text-3xl font-playfair text-lptxcolor mb-4"
                    >
                        Motivation
                    </h2>
                    <p class="text-lptxcolorlight text-base sm:text-lg">
                        What motivates us every day is the belief that the small
                        changes we make today can have a monumental impact
                        tomorrow. Our inspiration comes from the growing global
                        awareness of environmental issues and the desire to be
                        part of the solution. We know that by offering
                        eco-friendly alternatives, we can help reduce the strain
                        on the planet's resources and encourage others to do the
                        same.
                    </p>

                    <h2
                        class="text-2xl sm:text-3xl font-playfair text-lptxcolor mb-4"
                    >
                        Why We Care
                    </h2>
                    <p class="text-lptxcolorlight text-base sm:text-lg">
                        Every day, we witness the effects of human activity on
                        the environment — pollution, deforestation, and waste.
                        As a brand, we believe we have a responsibility to
                        protect and preserve the earth for future generations.
                        This sense of responsibility drives everything we do,
                        from the products we create to the partnerships we
                        build. Our commitment to sustainability is not just
                        about reducing our own footprint, but also about
                        empowering our customers to make a difference.
                    </p>

                    <h2
                        class="text-2xl sm:text-3xl font-playfair text-lptxcolor mb-4"
                    >
                        Our Promise
                    </h2>
                    <p class="text-lptxcolorlight text-base sm:text-lg">
                        At artenotes, we promise to always offer products
                        that are made with the environment in mind. From
                        sourcing raw materials responsibly to ensuring our
                        products are recyclable or biodegradable, we are
                        dedicated to sustainability in every aspect of our
                        business. We work with suppliers who share our
                        commitment to ethical practices and environmental
                        responsibility, and we are constantly looking for new
                        ways to minimize our impact.
                    </p>

                    <h2
                        class="text-2xl sm:text-3xl font-playfair text-lptxcolor mb-4"
                    >
                        Join Us on Our Journey
                    </h2>
                    <p class="text-lptxcolorlight text-base sm:text-lg">
                        We invite you to join us on this journey towards a more
                        sustainable future. By choosing eco-friendly products,
                        you are making a conscious decision to protect the
                        planet and promote the well-being of future generations.
                        Every small change you make adds up, and together, we
                        can create a positive impact. Thank you for supporting
                        our vision of a cleaner, greener world. We couldn’t do
                        it without you.
                    </p>
                </div>
            </div>
        </main>
    </section>
</template>

<style scoped>
/* Add any additional styling if needed */
</style>
