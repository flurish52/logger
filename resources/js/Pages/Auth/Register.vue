<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import ApplicationLogo from "@/Components/ApplicationLogo.vue";

const form = useForm({
    name: '',
    username: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
        <Head title="Register" />

        <div
            class="flex min-h-screen items-center justify-center bg-cover bg-center"
            style="background-image: url('https://images.pexels.com/photos/5797898/pexels-photo-5797898.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1')"
        >
            <div class="flex flex-col bg-white shadow-lg md:flex-row">
                <!-- Image Holder -->
                <div class="hidden w-full md:block md:w-1/2">
                    <img
                        src="https://images.pexels.com/photos/7956727/pexels-photo-7956727.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                        alt="Registration Image"
                        class="h-full w-full object-cover"
                    />
                </div>

                <!-- Form Section -->
                <div class="w-full p-8 md:w-1/2 md:p-12">
                    <Link href="/">
                        <ApplicationLogo />
                    </Link>
                    <h3 class="mb-6 text-center text-2xl font-semibold text-gray-800">
                        Register
                    </h3>

                    <form @submit.prevent="submit">
                        <!-- Name -->
                        <div class="mb-4">
                            <InputLabel for="name" value="Name" />
                            <TextInput
                                id="name"
                                type="text"
                                class="mt-1 w-full border border-gray-300 px-3 py-2 text-sm"
                                v-model="form.name"
                                required
                                autofocus
                                autocomplete="name"
                            />
                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>

                        <!-- Username -->
                        <div class="mb-4">
                            <InputLabel for="username" value="Username" />
                            <TextInput
                                id="username"
                                type="text"
                                class="mt-1 w-full border border-gray-300 px-3 py-2 text-sm"
                                v-model="form.username"
                                required
                                autocomplete="username"
                            />
                            <InputError class="mt-2" :message="form.errors.username" />
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <InputLabel for="email" value="Email" />
                            <TextInput
                                id="email"
                                type="email"
                                class="mt-1 w-full border border-gray-300 px-3 py-2 text-sm"
                                v-model="form.email"
                                required
                                autocomplete="username"
                            />
                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>

                        <!-- Password -->
                        <div class="mb-4">
                            <InputLabel for="password" value="Password" />
                            <TextInput
                                id="password"
                                type="password"
                                class="mt-1 w-full border border-gray-300 px-3 py-2 text-sm"
                                v-model="form.password"
                                required
                                autocomplete="new-password"
                            />
                            <InputError class="mt-2" :message="form.errors.password" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-4">
                            <InputLabel
                                for="password_confirmation"
                                value="Confirm Password"
                            />
                            <TextInput
                                id="password_confirmation"
                                type="password"
                                class="mt-1 w-full border border-gray-300 px-3 py-2 text-sm"
                                v-model="form.password_confirmation"
                                required
                                autocomplete="new-password"
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.password_confirmation"
                            />
                        </div>

                        <!-- Actions -->
                        <div class="mt-4 flex items-center justify-between">
                            <Link
                                :href="route('login')"
                                class="text-sm text-gray-600 hover:text-gray-900"
                            >
                                Already registered? Login
                            </Link>
                            <PrimaryButton
                                class="ml-4 bg-indigo-600 hover:bg-indigo-700"
                                :class="{ 'opacity-50': form.processing }"
                                :disabled="form.processing"
                            >
                                Register
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</template>
