<template>
    <section
        class="relative bg-[url('https://images.pexels.com/photos/7578201/pexels-photo-7578201.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1')] bg-cover bg-center bg-no-repeat"
    >
        <div
            class="absolute inset-0 bg-gradient-to-r from-slate-200/90"
        ></div>
        <div
            class="relative mx-auto max-w-screen-xl px-4 py-32 sm:px-6 lg:flex lg:h-screen lg:items-center lg:px-8"
        >
            <div class="max-w-xl text-center ltr:sm:text-left rtl:sm:text-right flex items-center justify-center flex-col">
                <h1 class="text-3xl font-extrabold sm:text-5xl">
                    <ApplicationLogo />
                    Capture your thoughts, <strong class="block font-extrabold text-teal-900"> anytime, anywhere. </strong>
                </h1>

                <p class="mt-4 max-w-lg sm:text-xl/relaxed">
                    Organize your ideas and access them across all devices with ease.
                </p>

                <div class="mt-8 flex flex-wrap gap-4 text-center items-center justify-center">
                    <Link
                        href="/login"
                        class="block w-full rounded bg-teal-600 px-12 py-3 text-sm font-medium text-white shadow hover:bg-teal-700 focus:outline-none focus:ring active:bg-rose-500 sm:w-auto"
                    >
                        Login
                    </Link>

                    <Link
                        href="/register"
                        class="block w-full rounded bg-white px-12 py-3 text-sm font-medium text-teal-600 shadow hover:text-teal-900 focus:outline-none focus:ring active:text-rose-500 sm:w-auto"
                    >
                        Get Started
                    </Link>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: 'HomePage',
};
</script>

<script setup>
import { Link } from "@inertiajs/vue3";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
</script>
