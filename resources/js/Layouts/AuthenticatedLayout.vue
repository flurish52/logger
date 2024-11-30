<template>
    <div class="flex overflow-hidden h-screen relative">
        <!-- Toggle Button (Visible only on small screens) -->
        <div
            @click="toggleSidebar"
            :class="['absolute z-10 w-screen h-screen bg-black opacity-10',
                isSidebarVisible && !isLargeScreen? 'show': 'hidden'
                ]"></div>
        <button
            v-show="!isLargeScreen"
            :class="['hidden absolute top-2 left-0 z-50 bg-gray-200 rounded-lg p-2 focus:outline-none focus:ring',
            isSidebarVisible? 'left-72' : ''

            ]"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 30 30"
                width="30"
                height="30"
            >
                <rect y="5" width="30" height="4" rx="2" fill="slate"/>
                <rect y="13" width="30" height="4" rx="2" fill="slate"/>
                <rect y="21" width="30" height="4" rx="2" fill="slate"/>
            </svg>
        </button>


        <!-- Sidebar (Visible based on screen size or toggle state) -->
        <MainAuthSideNav
            @toggle="toggleSidebar"
            @toggleSidebarTrash="toggleSidebarTrash"
            @toggleSidebarSharedNotes="toggleSidebarSharedNotes"

        />
        <div
            :class="[
        'fixed top-0 py-8 left-0 w-76 bg-gray-100 h-full  z-10 transform transition-transform duration-300 text-xl px-4 overflow-y-auto pb-8',
        isSidebarVisible || isLargeScreen ? 'translate-x-0' : '-translate-x-full z-0'
      ]"
        >
            <div class="ml-16">

                <div class="">
                    <Link
                        href="/dashboard/new-note"
                        :class="[!isLargeScreen?'hidden': '']"
                        class="flex items-center justify-center w-full text-teal-900 bg-teal-200 hover:bg-teal-400 font-medium rounded-lg mb-4"
                    >
                        <span class="text-3xl p-0 m-0">New note</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                             aria-hidden="true" class="h-12">
                            <path
                                d="M10.75 6.75a.75.75 0 00-1.5 0v2.5h-2.5a.75.75 0 000 1.5h2.5v2.5a.75.75 0 001.5 0v-2.5h2.5a.75.75 0 000-1.5h-2.5v-2.5z"></path>
                        </svg>
                    </Link>

                    <input
                        type="search"
                        placeholder="Search archived chats"
                        v-model="searchQuery"
                        class="w-full p-2 bg-teal-100 text-teal-900 rounded mb-2"
                    />
                </div>
                <hr class="border border-teal-400 my-2 overflow-y-auto"/>
                <div v-if="filteredChats">
                    <ChatItem
                        class="my-2"
                        v-for="(note, index) in filteredChats"
                        @deleteNote="deleteNote(index, note.id)"
                        @restorNote="restorNote(index, note.id)"
                        @viewNote="viewNote(note.id)"
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
            <slot/>
        </div>
    </div>
</template>

<script setup>
import {ref, computed, onMounted, watch} from "vue";
import ChatItem from "@/Components/ChatItem.vue";
import {Link} from "@inertiajs/vue3";
import axios from "axios";
import {router} from '@inertiajs/vue3'
import MainAuthSideNav from "@/Components/MainAuthSideNav.vue";

import {inject} from 'vue';

const propsFromPage = inject('propsFromPage');
let props = {
    editable: propsFromPage.props.editable,
    existingNote: propsFromPage.props.existingNote,
    notes: propsFromPage.props.notes,
    trashedNotes: propsFromPage.props.trashedNotes,
    users: propsFromPage.props.users,
    sharedNotes: propsFromPage.props.sharedNotes,
    currentNotes: propsFromPage.props.currentNotes,
};

onMounted(() => {
    notes.value = props.currentNotes;
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


const deleteNote = (noteIndex, noteId) => {
    if (notes.value === props.sharedNotes) {
        axios.delete("/dashboard/delete_shared_note/" + noteId)
            .then(response => {
                if (response.status === 200) {
                    notes.value.splice(noteIndex, 1);
                    alert('Note successfully removed from your shared list')
                    if (notes.value === props.existingNote) {
                        window.location.href = "/dashboard";
                    } else {
                        window.location.href = "/dashboard";
                    }
                }
            })
            .catch((error) => {
                console.error("Error deleting note:", error);
            });
    } else {
        axios.post("/dashboard/delete/" + noteId)
            .then(() => {
                notes.value.splice(noteIndex, 1);
                if (notes.value === props.existingNote) {
                    window.location.href = "/dashboard";

                }
            })
            .catch((error) => {
                console.error("Error deleting note:", error);
                alert("Failed to delete note. Please try again.");
            });
    }
};

const restorNote = (noteIndex, noteId) => {
    axios.post("/dashboard/restor/" + noteId)
        .then(() => {
            notes.value.splice(noteIndex, 1);
        })
        .catch((error) => {
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
    notes.value = props.notes;
    isSidebarVisible.value = !isSidebarVisible.value;
};
const toggleSidebarTrash = () => {
    notes.value = props.trashedNotes;
    isSidebarVisible.value = !isSidebarVisible.value;
};
const toggleSidebarSharedNotes = () => {
    notes.value = props.sharedNotes;
    isSidebarVisible.value = !isSidebarVisible.value;
};

// Update the screen size and sidebar visibility on resize
const updateScreenSize = () => {
    isLargeScreen.value = window.innerWidth >= 1024;
    if (isLargeScreen.value) isSidebarVisible.value = false;
};

watch(isLargeScreen, (newVal) => {
    if (newVal) isSidebarVisible.value = false;
});

window.addEventListener("resize", updateScreenSize);


</script>
