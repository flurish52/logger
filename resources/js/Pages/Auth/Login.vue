<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>

        <Head title="Log in" />

        <div
            class="flex min-h-screen items-center justify-center bg-cover bg-center"
            style="background-image: url('https://images.pexels.com/photos/5797898/pexels-photo-5797898.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1')"
        >
            <div class="flex flex-col bg-white shadow-lg md:flex-row">
                <!-- Image Holder -->
                <div class="hidden w-full md:block md:w-1/2">
                    <img
                        src="https://images.pexels.com/photos/7956727/pexels-photo-7956727.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                        alt="Login Image"
                        class="h-full w-full object-cover"
                    />
                </div>

                <!-- Form Section -->
                <div class="w-full p-8 md:w-1/2 md:p-12">
                    <Link href="/">
                    <ApplicationLogo />
                    </Link>

                    <h3 class="mb-6 text-center text-2xl font-semibold text-gray-800">
                        Log in
                    </h3>

                    <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
                        {{ status }}
                    </div>

                    <form @submit.prevent="submit">
                        <!-- Email -->
                        <div class="mb-4">
                            <InputLabel for="email" value="Email" />
                            <TextInput
                                id="email"
                                type="email"
                                class="mt-1 w-full border border-gray-300 px-3 py-2 text-sm"
                                v-model="form.email"
                                required
                                autofocus
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
                                autocomplete="current-password"
                            />
                            <InputError class="mt-2" :message="form.errors.password" />
                        </div>

                        <!-- Remember Me -->
                        <div class="mb-4 block">
                            <label class="flex items-center">
                                <Checkbox name="remember" v-model:checked="form.remember" />
                                <span class="ms-2 text-sm text-gray-600">Remember me</span>
                            </label>
                        </div>

                        <!-- Actions -->
                        <div class="mt-4 flex items-center justify-between">
                            <div>
                                <Link
                                    v-if="canResetPassword"
                                    :href="route('password.request')"
                                    class="text-sm text-gray-600 hover:text-gray-900"
                                >
                                    Forgot your password?
                                </Link>
                                <br />
                                <Link
                                    v-if="canResetPassword"
                                    :href="route('register')"
                                    class="text-sm text-gray-600 hover:text-gray-900"
                                >
                                    Don't have an account yet?
                                </Link>
                            </div>
                            <PrimaryButton
                                class="ml-4 bg-indigo-600 hover:bg-indigo-700"
                                :class="{ 'opacity-50': form.processing }"
                                :disabled="form.processing"
                            >
                                Log in
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</template>
