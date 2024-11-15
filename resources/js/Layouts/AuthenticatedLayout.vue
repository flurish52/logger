<template>
    <div class="flex overflow-hidden h-screen relative">
        <button class="absolute top-4 left-0">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="30" height="30">
                <rect y="5" width="30" height="4" rx="2" fill="slate"/>
                <rect y="13" width="30" height="4" rx="2" fill="slate"/>
                <rect y="21" width="30" height="4" rx="2" fill="slate"/>
            </svg>
        </button>

        <MainAuthSideNav />


        <div class="md:absolute ml-16 top-0 left-0 w-1/5 bg-gray-100 h-screen text-teal-200 p-4 z-0 overflow-x-hidden overflow-y-scroll">
            <div>

                <Link href="/dashboard/new-note" class="flex items-center justify-center w-full text-teal-900   bg-teal-200 hover:bg-teal-400 font-medium rounded-lg mb-4">
                    <span class="text-3xl p-0 m-0">New note</span>
                    <span class="text-6xl p-0 m-0">+</span>
                </Link>

                <input
                    type="text"
                    placeholder="Search archived chats"
                    v-model="searchQuery"
                    class="w-full p-2 bg-teal-100 text-teal-900 rounded mb-2"
                />
            </div>
 <hr class=" border border-teal-400 my-2" />
            <div v-if="filteredChats">
                <ChatItem
                    class="my-2"
                    v-for="(note, index) in filteredChats"
                    @deleteNote="deleteNote(index, note.id)"
                    :note="note"
                    :index="index"
                />
            </div>
            <div v-else>
                <p class="text-teal-400">No match found</p>
            </div>
        </div>

        <button
            @click="logout"
            class="mx-20 text-center text-white h-12 rounded-md w-1/6 hover:bg-teal-500 absolute bottom-0 left-0 right-0 bg-teal-600">
            Log out
        </button>




        <div class="overflow-hidden overflow-y-auto">
        <slot>
        </slot>
</div>
    </div>

</template>

<script setup>
import {ref, computed, onMounted} from 'vue';
import ChatItem from "@/Components/ChatItem.vue";
import {Link} from "@inertiajs/vue3";
import axios from "axios";
import MainAuthSideNav from "@/Components/MainAuthSideNav.vue";

let props = defineProps({
    notesToList: Array
})

const searchQuery = ref("");
const notes = ref('');
const filteredChats = computed(() => {
    if (!searchQuery.value) return notes.value;
    return notes.value.filter(note =>
        (note.title && note.title.toLowerCase().includes(searchQuery.value.toLowerCase())) ||
        (note.content && note.content.toLowerCase().includes(searchQuery.value.toLowerCase()))
    );
});

onMounted(()=>{
    notes.value = props.notesToList
})
let deleteNote = (noteIndex, noteId) => {
    notes.value.splice(noteIndex, 1)
    axios.delete('/dashboard/delete/'+noteId)
}
let logout = () => {

    axios.post('/logout')
    setTimeout({
        // Window.location.href = '/login'
    }, 5000)
}
</script>
