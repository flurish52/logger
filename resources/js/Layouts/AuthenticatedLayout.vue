<template>
    <div class="flex overflow-hidden h-screen relative">
        <!-- Toggle Button (Visible only on small screens) -->
        <button
            v-show="!isLargeScreen"
            @click="toggleSidebar"
            :class="['absolute top-2 left-0 z-50 bg-gray-200 rounded-lg p-2 focus:outline-none focus:ring',
            isSidebarVisible? 'left-72' : ''

            ]"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 30 30"
                width="30"
                height="30"
            >
                <rect y="5" width="30" height="4" rx="2" fill="slate" />
                <rect y="13" width="30" height="4" rx="2" fill="slate" />
                <rect y="21" width="30" height="4" rx="2" fill="slate" />
            </svg>
        </button>



        <!-- Sidebar (Visible based on screen size or toggle state) -->
        <div
            :class="[
        'fixed top-8 left-0 w-76 bg-gray-100 h-full  z-10 transform transition-transform duration-300 text-xl px-4',
        isSidebarVisible || isLargeScreen ? 'translate-x-0' : '-translate-x-full z-0'
      ]"
        >
            <MainAuthSideNav />
            <div class="ml-16">

            <div>
                <Link
                    href="/dashboard/new-note"
                    :class="[!isLargeScreen?'hidden': '']"
                    class="flex items-center justify-center w-full text-teal-900 bg-teal-200 hover:bg-teal-400 font-medium rounded-lg mb-4"
                >
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
            <hr class="border border-teal-400 my-2" />
            <div v-if="filteredChats">
                <ChatItem
                    class="my-2"
                    v-for="(note, index) in filteredChats"
                    @deleteNote="deleteNote(index, note.id)"
                    @restorNote="restorNote(index, note.id)"
                    :note="note"
                    :index="index"
                    :key="index"
                />
            </div>
            <div v-else>
                <p class="text-teal-400">No match found</p>
            </div>

            </div>

        </div>

        <!-- Main Content -->
        <div
            :class="[
        'flex-grow overflow-hidden overflow-y-auto transition-all duration-300',
        isSidebarVisible && !isLargeScreen ? 'ml-6' : ''
      ]"
        >
            <slot />
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted, watch } from "vue";
import ChatItem from "@/Components/ChatItem.vue";
import { Link } from "@inertiajs/vue3";
import axios from "axios";
import MainAuthSideNav from "@/Components/MainAuthSideNav.vue";
import AddNewDropDown from "@/Components/AddNewDropDown.vue";

let props = defineProps({
    notesToList: Array,
    trashedNotes: Array,
});

const searchQuery = ref("");
const notes = ref([]);
const filteredChats = computed(() => {
    if (!searchQuery.value) return notes.value;
    return notes.value.filter((note) =>
        (note.title &&
            note.title.toLowerCase().includes(searchQuery.value.toLowerCase())) ||
        (note.content &&
            note.content.toLowerCase().includes(searchQuery.value.toLowerCase()))
    );
});

onMounted(() => {
    if (props.notesToList){
    notes.value = props.notesToList;

    }else{
        notes.value = props.trashedNotes
    }
});

const deleteNote = (noteIndex, noteId) => {
    axios.post("/dashboard/delete/" + noteId)
        .then(() => {
            notes.value.splice(noteIndex, 1);
            window.location.href = "/dashboard";
        })
        .catch((error) => {
            console.error("Error deleting note:", error);
            alert("Failed to delete note. Please try again.");
        });
};


const restorNote = (noteIndex, noteId) => {
    axios.post("/dashboard/restor/" + noteId)
        .then(() => {
            // Only execute the following code if the axios post request is successful
            notes.value.splice(noteIndex, 1);
        })
        .catch((error) => {
            // Handle the error gracefully
            console.error("Error restoring note:", error);
            alert("Failed to restore note. Please try again.");
        });
};


const logout = () => {
    axios.post("/logout");
};

// Sidebar toggle functionality
const isSidebarVisible = ref(false);
const isLargeScreen = ref(window.innerWidth >= 768);

const toggleSidebar = () => {
    isSidebarVisible.value = !isSidebarVisible.value;
};

// Update the screen size and sidebar visibility on resize
const updateScreenSize = () => {
    isLargeScreen.value = window.innerWidth >= 768;
    if (isLargeScreen.value) isSidebarVisible.value = false;
};

watch(isLargeScreen, (newVal) => {
    if (newVal) isSidebarVisible.value = false;
});

window.addEventListener("resize", updateScreenSize);
</script>
