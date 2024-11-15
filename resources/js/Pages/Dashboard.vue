
<template>
    <AuthenticatedLayout
    :notesToList = notes

    >
        <div
            v-if="props.existingNote"

        >

             <textarea
                v-model="existingNoteToDisplay.content"
                @keyup="updateNote(props.existingNote.id)"
                placeholder="Write your notes here..."
                class="w-screen mr-12 min-h-screen ml-96 m-4 py-12 p-4 text-teal-900 bg-teal-100 border border-teal-300 rounded-lg shadow-sm resize-y focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent"
            ></textarea>
        <Link href='/dashboard' class="absolute top-4 right-8 px-2 bg-red-500 border border-red-800 rounded-lg text-white shadow-lg">Close Note</Link>
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

let props = defineProps({
    existingNote: Object,
    notes: Array
})
let existingNoteToDisplay = ref('')
onMounted(() => {
    existingNoteToDisplay.value = props.existingNote
})
let updateNote = (noteId) =>{
    console.log(existingNoteToDisplay.value)
    axios.post('/dashboard/note/'+noteId, {
        content: existingNoteToDisplay.value,
        })
}
</script>

<style scoped>
textarea{
    width: 950px;
}

</style>
