<template>
    <div class="fixed top-2 right-2 inline-block text-left">
        <!-- Button -->
        <button
            @click="toggleDropdown"
            class="flex items-center justify-center w-10 h-10  text-white border border-2 hover: border-teal-700 rounded-full text-6xl"
        >
            <!-- Add Icon -->
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="w-5 h-5 mr-2"
                fill="none"
                viewBox="0 0 20 20"
                stroke="teal"
                stroke-width="2"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M12 4v16m8-8H4"
                />
            </svg>
        </button>

        <!-- Dropdown -->
        <div
            v-show="isDropdownVisible"
            class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg ring-1 ring-black ring-opacity-5"
        >
            <ul class="py-1 text-gray-700">
                <li>
                    <Link
                        href="/dashboard/new-note"
                        class="block w-full px-4 py-2 text-left hover:bg-teal-50"
                    >
                        New Note
                    </Link>
                </li>
                <li>
                    <Link
                        href="/dashboard/"
                        class="block w-full px-4 py-2 text-left hover:bg-teal-50"
                    >
                        New Task
                    </Link>
                </li>
                <li>
                    <Link
                        href="/dashboard/"
                        class="block w-full px-4 py-2 text-left hover:bg-teal-50"
                    >
                        New Schedules
                    </Link>
                </li>
            </ul>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import {Link} from "@inertiajs/vue3";

// Reactive variable for dropdown visibility
const isDropdownVisible = ref(false);

// Toggle the dropdown visibility
const toggleDropdown = () => {
    isDropdownVisible.value = !isDropdownVisible.value;
};

// Handle dropdown item actions
// const handleAction = (action) => {
//     console.log(`${action} clicked`); // Replace with actual logic for each action
//     isDropdownVisible.value = false; // Close the dropdown after an action
// };
</script>
