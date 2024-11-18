<template>
    <div class="fixed top-0 left-0 z-50 bg-gray-100 w-16 h-screen flex flex-col items-center py-4 space-y-6 border-r border-teal-500">
        <!-- Note Icon -->
        <Link href="/dashboard"
              title="Notes"
        >
        <div class="p-2 rounded-full hover:bg-teal-500 cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M4 2h16a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm2 4v12h12V6H6zm2 2h8v2H8V8zm0 4h6v2H8v-2z"/>
            </svg>
        </div>
        </Link>

        <!-- Tasks Icon -->
        <div class="p-2 rounded-full hover:bg-teal-500 cursor-pointer"
            title="Tasks (Todos)"

        >

            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M9 2h6v4H9V2zM4 8h16v2H4V8zm0 4h16v2H4v-2zm0 4h16v2H4v-2zm0 4h16v2H4v-2zm8-14h2v4h-2V6z"/>
            </svg>
        </div>

        <!-- Schedules Icon -->
        <div class="p-2 rounded-full hover:bg-teal-500 cursor-pointer"
             title="Scheduled events/activities"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17 4h-2V2h-2v2H9V2H7v2H5a1 1 0 0 0-1 1v16a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1zm0 16H7V10h10v10zm-7-4h2v-2H8v2z"/>
            </svg>
        </div>

        <!-- Shared Notes Icon -->
        <div class="p-2 rounded-full hover:bg-teal-500 cursor-pointer"
            title="Shared notes"

        >

            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17 2H7a1 1 0 0 0-1 1v18l6-4 6 4V3a1 1 0 0 0-1-1zm-2 9h-6v2h6v-2zm0-4h-6v2h6V7z"/>
            </svg>
        </div>

        <!-- Trash Icon -->
        <Link href="/dashboard/trashed_notes">
        <div class="p-2 rounded-full hover:bg-teal-500 cursor-pointer"
             title="Delete notes"
        >
                <svg width="24" height="24" viewBox="0 0 48 48" fill="teal" xmlns="http://www.w3.org/2000/svg">
                    <rect x="10" y="14" width="28" height="28" rx="2" fill="teal"/>
                    <rect x="13" y="17" width="22" height="22" rx="1" fill="teal"/>
                    <path d="M20 20V34" stroke="white" stroke-width="2" stroke-linecap="white"/>
                    <path d="M28 20V34" stroke="white" stroke-width="2" stroke-linecap="white"/>
                    <path d="M16 8H32C32.5304 8 33.0391 8.21071 33.4142 8.58579C33.7893 8.96086 34 9.46957 34 10V12H14V10C14 9.46957 14.2107 8.96086 14.5858 8.58579C14.9609 8.21071 15.4696 8 16 8Z" fill="#757575"/>
                    <path d="M18 4H30C30.5304 4 31.0391 4.21071 31.4142 4.58579C31.7893 4.96086 32 5.46957 32 6H16C16 5.46957 16.2107 4.96086 16.5858 4.58579C16.9609 4.21071 17.4696 4 18 4Z" fill="#616161"/>
                </svg>
        </div>
        </Link>

        <hr class="border-gray-300 w-8 my-4" />

        <!-- Profile Icon -->
        <div class="p-2 rounded-full hover:bg-teal-500 cursor-pointer"

        title="Profile"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-8 1.6-8 4.8V22h16v-3.2c0-3.2-4.7-4.8-8-4.8z"/>
            </svg>
        </div>

        <!-- Settings Icon -->
        <div class="p-2 rounded-full hover:bg-teal-500 cursor-pointer"
        title="Settings"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 8a4 4 0 1 1 0 8 4 4 0 0 1 0-8zm0-6c1.1 0 2.1.9 2.1 2s-.9 2-2.1 2a2 2 0 1 1 0-4zM12 20c1.1 0 2.1.9 2.1 2s-.9 2-2.1 2a2 2 0 1 1 0-4z"/>
            </svg>
        </div>

        <!-- Logout Icon -->
        <button
            title="Logout"

            @click="logout"
            class="flex items-center justify-center w-full text-white bg-red-200 hover:bg-red-300  font-medium rounded-lg p-3 mt-6 text-red"
        >
            <!-- Logout Icon -->
            <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 22 22"
                fill="red"
                class="w-6 h-6 mr-2"
            >
                <path
                    fill-rule="evenodd"
                    d="M7.75 3A2.25 2.25 0 0 0 5.5 5.25v13.5A2.25 2.25 0 0 0 7.75 21h8.5A2.25 2.25 0 0 0 18.5 18.75V16.5a.75.75 0 0 1 1.5 0v2.25A3.75 3.75 0 0 1 16.25 22.5h-8.5A3.75 3.75 0 0 1 4 18.75V5.25A3.75 3.75 0 0 1 7.75 1.5h8.5A3.75 3.75 0 0 1 20 5.25V7.5a.75.75 0 0 1-1.5 0V5.25A2.25 2.25 0 0 0 16.25 3h-8.5zm10.03 8.22a.75.75 0 0 0-1.06 1.06L19.94 16h-9.19a.75.75 0 0 0 0 1.5h9.19l-3.22 3.22a.75.75 0 1 0 1.06 1.06l4.5-4.5a.75.75 0 0 0 0-1.06l-4.5-4.5z"
                    clip-rule="evenodd"
                />
            </svg>
        </button>
    </div>
</template>

<script setup>
import axios from "axios";
import {Link} from "@inertiajs/vue3";

const logout = async () => {
    try {
        await axios.post("/logout");
        window.location.href = "/login";
    } catch (error) {

        alert("An error occurred while logging out.");
    }
};
</script>
