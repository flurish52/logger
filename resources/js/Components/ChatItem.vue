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
            v-else-if="props.note.shared && props.note.user_id !== $page.props.auth.user.id"
            :title="props.note.content.substring(0, 70)"
            :href="'/dashboard/shared_note/'+props.note.id">
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
            class="hover:bg-yellow-500 h-fit">
<!--            <svg width="24" height="24" viewBox="0 0 48 48" fill="red" xmlns="http://www.w3.org/2000/svg">-->
<!--                <rect x="10" y="14" width="28" height="28" rx="2" fill="red"/>-->
<!--                <rect x="13" y="17" width="22" height="22" rx="1" fill="red"/>-->
<!--                <path d="M20 20V34" stroke="white" stroke-width="2" stroke-linecap="white"/>-->
<!--                <path d="M28 20V34" stroke="white" stroke-width="2" stroke-linecap="white"/>-->
<!--                <path-->
<!--                    d="M16 8H32C32.5304 8 33.0391 8.21071 33.4142 8.58579C33.7893 8.96086 34 9.46957 34 10V12H14V10C14 9.46957 14.2107 8.96086 14.5858 8.58579C14.9609 8.21071 15.4696 8 16 8Z"-->
<!--                    fill="#757575"/>-->
<!--                <path-->
<!--                    d="M18 4H30C30.5304 4 31.0391 4.21071 31.4142 4.58579C31.7893 4.96086 32 5.46957 32 6H16C16 5.46957 16.2107 4.96086 16.5858 4.58579C16.9609 4.21071 17.4696 4 18 4Z"-->
<!--                    fill="#616161"/>-->
<!--            </svg>-->


            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 22 22" stroke-width="2" stroke="currentColor" aria-hidden="true" class="w-4"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path></svg>
        </button>
        <button
            v-else
            title="Restor Note"
            @click="restorNote(props.note.id)"
            class="hover:bg-teal-200">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="h-5 w-5 shrink-0"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
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
let emits = defineEmits(['deleteNote', 'restorNote', 'viewNote'])

let deleteNote = (noteId) => {
    emits('deleteNote', {noteId})
}

let restorNote = (noteId) => {
    emits('restorNote', {noteId})
}

let viewNote = (noteId) => {
    emits('viewNote', {noteId})
}
</script>
