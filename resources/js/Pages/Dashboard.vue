<template>
    <AuthenticatedLayout>
        <div
            class="relative overflow-hidden m-4 max-w-screen py-auto px-auto flex flex-col items-center justify-center text-center text-gray-800 lg:ml-96 lg:m-4"
            v-if="props.existingNote"
        >
             <textarea
                 v-model="existingNoteToDisplay.content"
                 @keyup="updateNote(props.existingNote.id)"
                 :readonly="!editable"
                 placeholder="Write your notes here..."
                 :class="['mx-24 px-16 max-w-full md:mr-12 ml-16 min-h-screen m-4 py-12 p-4 text-teal-900 bg-teal-100 border border-teal-300 rounded-lg shadow-sm resize-y focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent',
                 props.existingNote.trashed? 'bg-red-100':'',
                 editable? ' ': 'bg-blue-100 border-0  border-none focus:ring-0 focus:ring-red-500',
                 ]"
             ></textarea>
            <input type="text"
                   v-model="existingNoteToDisplay.title"
                   placeholder="Note title here"
                   class="absolute top-4 bg-inherit left-50 w-full text-center mx-1 px-2 border border-green-800 rounded-lg shadow-lg z-0 rounded-lg shadow-sm resize-y focus:outline-none focus:ring-0 focus:border-transparent border-0"

            >

            <div class="flex absolute top-0 right-0">
                <button
                    v-show="props.existingNote.trashed"
                    @click="emtyTrash"
                    title="Empty Trash"
                    class="px-2 bg-red-800 border border-green-800 rounded-lg  shadow-lg z-10 w-full mb-6 font-extrabold text-white"
                > Empty Trash</button>


                <div class="absolute flex top-6  right-0 flex green-600 mt-2">
                    <button
                        v-if="props.existingNote.trashed"
                        title="Restor Note"
                        @click="restorNote(props.existingNote.id)"
                        class="mx-1 px-2 bg-green-500 border border-green-800 rounded-lg text-white shadow-lg z-0">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="22" height="22" fill="none"
                             stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 12a9 9 0 1 1-9-9"></path>
                            <polyline points="12 1 12 5 16 5"></polyline>
                        </svg>
                    </button>
                    <button
                        v-if="props.existingNote.trashed"
                        title="Permently delete"
                        @click="deleteNotePermenently(props.existingNote.id)"
                        class="mx-1 px-2  text-red-700 z-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true" class="w-6 md:w-8"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path></svg>

                    </button>
                <ShareButton
                    v-show="!props.existingNote.trashed || props.existingNote.shared && props.existingNote.user_id !== $page.props.auth.user.id"
                    @shareNote="shareNote"
                />
                <Link
                    title="Close note"
                    href='/dashboard'
                      class="mx-1 px-2 bg-red-800 border border-red-800 rounded-lg text-white shadow-lg z-0 hover:bg-red-500">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="currentColor"
                        class="w-6 h-6"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M6.225 5.175a.75.75 0 0 1 1.06 0L12 9.89l4.715-4.715a.75.75 0 1 1 1.06 1.06L13.06 12l4.715 4.715a.75.75 0 0 1-1.06 1.06L12 14.06l-4.715 4.715a.75.75 0 0 1-1.06-1.06L10.94 12 6.225 7.285a.75.75 0 0 1 0-1.06z"
                            clip-rule="evenodd"
                        />
                    </svg>
                </Link>
                </div>

            </div>
            <div
                @click="shareNote"
                :class="['absolute z-0 w-screen h-screen bg-black opacity-10',
                isHiddin? 'show': 'hidden'
                ]"></div>

            <div
                :class="['w-full md:w-fit h-fit px-12 lg:p-0',
            isHiddin? 'absolute top-12 z-50 ':'hidden'

            ]">
                <ListOfUsers
                    @toggle="shareNote"
                    :users="props.users"
                    :existingNoteToDisplay="existingNoteToDisplay"
                />
            </div>

        <h1 class="absolute top-0 bg-teal-600 w-full font-extrabold text-white z-0 text-center">Hi, {{$page.props.auth.user.username.toUpperCase()}}</h1>
        </div>

    <DefaultDashboard
            v-else
        />


    </AuthenticatedLayout>
</template>
<script setup>
import DefaultDashboard from "@/Components/DefaultDashboard.vue";
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {onMounted, readonly, ref} from "vue";
import {router} from "@inertiajs/vue3";
import {Link} from "@inertiajs/vue3";
import ShareButton from "@/Components/ShareNoteButton.vue";
import axios from "axios";
import ListOfUsers from "@/Pages/Partials/ListOfUsers.vue";

let props = defineProps({
    editable: Boolean,
    existingNote: Object,
    notes: Array,
    trashedNotes: Array,
    users: Array,
    sharedNotes: Array,
    currentNotes: Array
})
let existingNoteToDisplay = ref('')
onMounted(() => {
    existingNoteToDisplay.value = props.existingNote
})

const restorNote = (noteId) => {
    axios.post("/dashboard/restor/" + noteId)
        .then(() => {
            if (props.existingNote) {
                window.location.href = "/dashboard/trashed_notes";
            }
        })
        .catch((error) => {
            console.error("Error restoring note:", error);
            alert("Failed to restore the note. Please try again.");
        });
};

let updateNote = (noteId) => {
    axios.post('/dashboard/note/' + noteId, {
        content: existingNoteToDisplay.value,
    })


};
let deleteNotePermenently = (noteId) => {
    axios.delete('/dashboard/note_delete/' + noteId)
        .then(response=>{
            if (response.status === 200){
                router.get('/dashboard')
            }
        })


};
let isHiddin = ref(false)

let shareNote = () => {
    isHiddin.value = !isHiddin.value
}

let emtyTrash = () =>{
    axios.delete('/dashboard/empty_trash')
        .then(res =>{
            if (res.status === 200){
                alert('Your trash has been emptied')
                window.location.href = '/dashboard'
            }
        })
}


import { provide } from 'vue';

const propsToLayout = { props };
provide('propsFromPage', propsToLayout);
</script>

<style scoped>
textarea {
    width: 950px;
}

</style>
