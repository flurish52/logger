<!-- src/views/HomePage.vue -->
<template>
    <div class="flex flex-col items-center justify-top pt-24 h-screen bg-gradient-to-r from-teal-200 to-teal-500 text-gray-800">
        <h1 class="text-6xl font-bold mb-4">
            <ApplicationLogo />


        </h1>
        <p class="text-4xl font-light mb-8 text-center px-4 max-w-full">
            Capture your thoughts, anytime, anywhere.
        </p>
        <div class="flex space-x-4">
            <Link
                href="/login"
                class="px-6 py-3 bg-white text-blue-600 font-semibold rounded-full hover:bg-gray-100 transition"
            >
                Login
            </Link>
            <Link
                href="/register"
                class="px-6 py-3 bg-black text-white font-semibold rounded-full hover:bg-blue-700 transition"
            >
                Get Started
            </Link>
        </div>

    </div>


</template>

<script>
export default {
    name: 'HomePage',
};
</script>

<script setup>
import {Link} from "@inertiajs/vue3";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import addItemForm from "@/Components/addItemForm.vue";
import App from "@/Components/app.vue";

</script>
