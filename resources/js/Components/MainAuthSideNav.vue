<template>
    <div class="fixed top-0 left-0 z-50 bg-gray-100 w-16 h-screen flex flex-col items-center py-4 space-y-6 border-r border-teal-500">
        <!-- Note Icon -->
        <div class="p-2 rounded-full hover:bg-yellow-500 cursor-pointer  bg-teal-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M4 2h16a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm2 4v12h12V6H6zm2 2h8v2H8V8zm0 4h6v2H8v-2z"/>
            </svg>
        </div>

        <!-- Tasks Icon -->
        <div class="p-2 rounded-full hover:bg-yellow-500 cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M9 2h6v4H9V2zM4 8h16v2H4V8zm0 4h16v2H4v-2zm0 4h16v2H4v-2zm0 4h16v2H4v-2zm8-14h2v4h-2V6z"/>
            </svg>
        </div>

        <!-- Schedules Icon -->
        <div class="p-2 rounded-full hover:bg-yellow-500 cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17 4h-2V2h-2v2H9V2H7v2H5a1 1 0 0 0-1 1v16a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1zm0 16H7V10h10v10zm-7-4h2v-2H8v2z"/>
            </svg>
        </div>

        <!-- Shared Notes Icon -->
        <div class="p-2 rounded-full hover:bg-yellow-500 cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17 2H7a1 1 0 0 0-1 1v18l6-4 6 4V3a1 1 0 0 0-1-1zm-2 9h-6v2h6v-2zm0-4h-6v2h6V7z"/>
            </svg>
        </div>

        <hr class="border-gray-300 w-8 my-4" />

        <!-- Profile Icon -->
        <div class="p-2 rounded-full hover:bg-yellow-500 cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-8 1.6-8 4.8V22h16v-3.2c0-3.2-4.7-4.8-8-4.8z"/>
            </svg>
        </div>

        <!-- Settings Icon -->
        <div class="p-2 rounded-full hover:bg-yellow-500 cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 8a4 4 0 1 1 0 8 4 4 0 0 1 0-8zm0-6c1.1 0 2.1.9 2.1 2s-.9 2-2.1 2a2 2 0 1 1 0-4zM12 20c1.1 0 2.1.9 2.1 2s-.9 2-2.1 2a2 2 0 1 1 0-4z"/>
            </svg>
        </div>
    </div>
</template>
