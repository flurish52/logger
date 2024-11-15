<template>
    <div class="ml-96 m-4 py-auto px-auto flex flex-col items-center justify-center text-center text-gray-800">

        <div class="mx-auto flex flex-col items-center justify-center w-full">

        <!-- Icons Section -->
        <div class="flex items-center justify-center gap-6 mb-6 mx-auto">
            <!-- Notebook Icon (for mobile) -->
            <svg class="w-12 h-12 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                <path d="M4 2h10c1.1 0 2 .9 2 2v16c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2zm0 2v16h10V4H4zm14 0h2v2h-2V4zm0 4h2v2h-2V8zm0 4h2v2h-2v-2zm0 4h2v2h-2v-2zm-8 2h2v2h-2v-2z"/>
            </svg>

            <!-- Computer Icon -->
            <svg class="w-12 h-12 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                <path d="M20 18H4c-1.1 0-2-.9-2-2V5c0-1.1.9-2 2-2h16c1.1 0 2 .9 2 2v11c0 1.1-.9 2-2 2zM4 5v11h16V5H4zm-1 15h18v2H3v-2z"/>
            </svg>
        </div>

        <!-- Main Title -->
        <h1 class="text-6xl font-semibold text-teal-800 mb-2">Logger</h1>

        <!-- Description -->
        <p class="text-lg w-1/2 mb-4">
            Access and manage your notes seamlessly across devices. Use Logger on all your devices and keep all your notes synced in real-time.
        </p>

            <p class="text-2xl max-w-md mb-4 font-bold my-6">
                Click on any note to view
        </p>

        <!-- Security Notice -->
<!--        <p class="text-sm text-gray-500 mt-4">-->
<!--            🔒 Your notes are securely synced and encrypted across all devices.-->
<!--        </p>-->
        </div>
    </div>
</template>

<script>
export default {
    name: 'NoteSyncWeb'
};
</script>
