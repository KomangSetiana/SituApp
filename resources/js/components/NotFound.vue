<template>
    <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100">
        <div class="text-center">
            <h1 class="text-8xl font-extrabold text-sky-950 animate-bounce">404</h1>
            <p class="text-2xl md:text-3xl text-gray-800 mt-4">
                Oops! Page not found.
            </p>
            <p class="mt-2 text-gray-600">
                The page you're looking for doesn't exist or has been moved.
            </p>
            <router-link to="/"
                class="mt-6 inline-block bg-sky-900 text-white px-5 py-3 rounded-lg shadow-lg hover:bg-sky-900 transition">
                Go Back Home
            </router-link>
        </div>
    </div>
</template>

<script setup>
import { useRouter } from "vue-router";

const router = useRouter();
</script>

<style scoped>
/* Custom animation */
.animate-bounce {
    animation: bounce 2s infinite;
}

@keyframes bounce {

    0%,
    100% {
        transform: translateY(0);
    }

    50% {
        transform: translateY(-20px);
    }
}
</style>