<template>
    <AuthenticatedLayout
        :notesToList=notes
        :trashedNotes=trashedNotes

    >
        <div
            class="m-4 max-w-screen py-auto px-auto flex flex-col items-center justify-center text-center text-gray-800 lg:ml-96 lg:m-4"
            v-if="props.existingNote"
        >
             <textarea
                 v-model="existingNoteToDisplay.content"
                 @keyup="updateNote(props.existingNote.id)"
                 placeholder="Write your notes here..."
                 class="max-w-full md:mr-12 ml-16 min-h-screen m-4 py-12 p-4 text-teal-900 bg-teal-100 border border-teal-300 rounded-lg shadow-sm resize-y focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent"
             ></textarea>
            <Link href='/dashboard'
                  class="absolute top-6 right-0 md:right-8 px-2 bg-red-500 border border-red-800 rounded-lg text-white shadow-lg z-0">

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
            <button
                v-if="props.existingNote.trashed"
                title="Restor Note"
                @click="restorNote(props.existingNote.id)"
                class="absolute top-16 right-0 md:right-8 px-2 bg-green-500 border border-green-800 rounded-lg text-white shadow-lg z-0">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="22" height="22" fill="none"
                     stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 12a9 9 0 1 1-9-9"></path>
                    <polyline points="12 1 12 5 16 5"></polyline>
                </svg>
            </button>
            <ShareButton
            />
        </div>

        <DefaultDashboard
            v-else
        />
    </AuthenticatedLayout>
</template>
<script setup>
import DefaultDashboard from "@/Components/DefaultDashboard.vue";
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {onMounted, ref} from "vue";
import {Link} from "@inertiajs/vue3";
import ShareButton from "@/Components/ShareNoteButton.vue";
import axios from "axios";

let props = defineProps({
    existingNote: Object,
    notes: Array,
    trashedNotes: Array
})
let existingNoteToDisplay = ref('')
onMounted(() => {
    existingNoteToDisplay.value = props.existingNote
})

const restorNote = (noteId) => {
    axios.post("/dashboard/restor/" + noteId)
        .then(() => {
            // Only redirect if props.existingNote is true and the API call succeeds
            if (props.existingNote) {
                window.location.href = "/dashboard/trashed_notes";
            }
        })
        .catch((error) => {
            // Handle the error gracefully
            console.error("Error restoring note:", error);
            alert("Failed to restore the note. Please try again.");
        });
};

let updateNote = (noteId) => {
    axios.post('/dashboard/note/' + noteId, {
        content: existingNoteToDisplay.value,
    })


};

</script>

<style scoped>
textarea {
    width: 950px;
}

</style>
