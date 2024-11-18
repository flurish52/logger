<template>
    <div class="flex items-center justify-between  rounded hover:bg-teal-50 border-y border-teal-500">

        <Link
            v-if="props.note.trashed"
            :title="props.note.content.substring(0, 70)"
            :href="'/dashboard/trashed_note/'+props.note.id">
            <div class="flex items-center justify-between my-1 px-4 py-2   rounded hover:bg-teal-500 cursor-pointer">
                <div class="flex items-center space-x-2">
                    <div class="bg-teal-500 rounded-md w-6 h-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M4 2h16a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm2 4v12h12V6H6zm2 2h8v2H8V8zm0 4h6v2H8v-2z"/>
                        </svg>

                    </div>
                    <div>
                        <h3
                            class="font-semibold text-sm text-teal-900">{{ props.note.title }}</h3>
                        <p class="text-xs text-teal-900">{{ props.note.content.substring(0, 10) }}</p>
                    </div>
                </div>
            </div>
        </Link>

        <Link
            v-else
            :title="props.note.content.substring(0, 70)"
            :href="'/dashboard/note/'+props.note.id">
            <div class="flex items-center justify-between my-1 px-4 py-2   rounded hover:bg-teal-500 cursor-pointer">
                <div class="flex items-center space-x-2">
                    <div class="bg-teal-500 rounded-md w-6 h-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M4 2h16a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm2 4v12h12V6H6zm2 2h8v2H8V8zm0 4h6v2H8v-2z"/>
                        </svg>

                    </div>
                    <div>
                        <h3
                            class="font-semibold text-sm text-teal-900">{{ props.note.title }}</h3>
                        <p class="text-xs text-teal-900">{{ props.note.content.substring(0, 10) }}</p>
                    </div>
                </div>
            </div>
        </Link>
        <button
            v-if="!props.note.trashed"
            title="Delete"
            @click="deleteNote(props.note.id)"
            class="hover:bg-yellow-500">
            <svg width="24" height="24" viewBox="0 0 48 48" fill="red" xmlns="http://www.w3.org/2000/svg">
                <rect x="10" y="14" width="28" height="28" rx="2" fill="red"/>
                <rect x="13" y="17" width="22" height="22" rx="1" fill="red"/>
                <path d="M20 20V34" stroke="white" stroke-width="2" stroke-linecap="white"/>
                <path d="M28 20V34" stroke="white" stroke-width="2" stroke-linecap="white"/>
                <path
                    d="M16 8H32C32.5304 8 33.0391 8.21071 33.4142 8.58579C33.7893 8.96086 34 9.46957 34 10V12H14V10C14 9.46957 14.2107 8.96086 14.5858 8.58579C14.9609 8.21071 15.4696 8 16 8Z"
                    fill="#757575"/>
                <path
                    d="M18 4H30C30.5304 4 31.0391 4.21071 31.4142 4.58579C31.7893 4.96086 32 5.46957 32 6H16C16 5.46957 16.2107 4.96086 16.5858 4.58579C16.9609 4.21071 17.4696 4 18 4Z"
                    fill="#616161"/>
            </svg>
        </button>

        <button
            v-else
            title="Restor Note"
            @click="restorNote(props.note.id)"
            class="hover:bg-yellow-500">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="32" height="32" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 12a9 9 0 1 1-9-9"></path>
                    <polyline points="12 1 12 5 16 5"></polyline>
                </svg>
            </button>

    </div>
</template>

<script setup>
import {defineEmits} from 'vue'
import {Link} from "@inertiajs/vue3";
import axios from "axios";

let props = defineProps({
    index: String,
    note: Object,
})
let emits = defineEmits(['deleteNote', 'restorNote'])

let deleteNote = (noteId) => {
    emits('deleteNote', {noteId})
}

let restorNote = (noteId) => {
    emits('restorNote', {noteId})
}
</script>
