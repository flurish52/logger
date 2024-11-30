<template>
    <div class="w-full flex justify-center items-center  bg-gray-100">
        <div class="border-2 border-teal-600 rounded-lg shadow-md w-full h-full p-6 text-center">
            <div
                v-if="step === 1"
                class="flex flex-col">
                <h1 class="text-xl font-semibold text-teal-600 border-b-2 border-teal-600 pb-1 inline-block">
                    Share to
                </h1>
                <div class="flex justify-between items-center">

                <button
                    @click="goEmails"
                    class="btn bg-teal-600 w-1/2 h-16 my-1 mx-5 text-white rounded-md px-6 py-2 hover:bg-teal-600 transition-all"
                >
                    Email
                </button>
                <button
                    @click="goNext"
                    class="btn bg-teal-600 w-1/2 h-16 my-1 mx-5 text-white rounded-md px-6 py-2 hover:bg-teal-600 transition-all"
                >
                    Logger username
                </button>
                </div>
            </div>
            <div
                v-if="step === 2"
                class="flex flex-col">
                <div class="mb-4">
                    <input
                        type="text"
                        @keyup="searchName"
                        placeholder="user's email or full name or username"
                        class="placeholder:text-xs placeholder:italic w-full border-2 border-teal-600 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-teal-600 overflow-y-scroll"
                        v-model="searchQuery"
                    />
                </div>

                <div
                    v-if="matchingUsernamesOrEmails"
                    v-for="(userToShareWith, index) in matchingUsernamesOrEmails"
                    @click = "shareNow(existingNoteToDisplay.id, userToShareWith.id, userToShareWith.username)"
                    class="user my-1 bg-teal-900 text-white rounded-md px-4 py-px font-semibold cursor-pointer">
                    <div
                        v-if="userToShareWith.username !== $page.props.auth.user.username ||
                        userToShareWith.email !== $page.props.auth.user.email ||
                        userToShareWith.name !== $page.props.auth.user.name"
                    v-show="existingNoteToDisplay.user_id !== userToShareWith.id"
                        class="flex items-center space-x-2">
                        <div class="bg-teal-500 rounded-full w-6 h-6 overflow-hidden">
                        </div>
                        <div class="">
                            <h3 class="text-white font-semibold text-sm text-teal-900 text-left">{{ userToShareWith.username.toUpperCase() }}</h3>
                            <p class="text-white text-xs font-bold text-teal-900 text-left italic">{{ userToShareWith.name }}</p>
                            <p class="text-white text-xs text-teal-900 text-left italic">{{ userToShareWith.email }}</p>
                        </div>
                    </div>


                </div>

                <div class="flex justify-between mb-4">
                    <button
                        @click="goBack"
                        class="btn bg-black text-white rounded-md px-6 py-2 hover:bg-teal-600 transition-all"
                    >
                        Back
                    </button>
                    <button
                        @click="goNext"
                        class="btn bg-black text-white rounded-md px-6 py-2 hover:bg-teal-600 transition-all"
                    >
                        Next
                    </button>
                </div>
            </div>

            <div
                v-if="step === 3"
                class="flex flex-col">
                <div class="mb-4">
                    <input
                        type="text"
                        placeholder="Type users email..."
                        class="w-full border-2 border-teal-600 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-teal-600"
                        v-model="searchQuery"
                    />
                    <p class="text-red-600 italic text-sm">
                        Please make sure the email is correct
                    </p>
                </div>
                <div class="flex justify-between mb-4">
                    <button
                        @click="goBack"
                        class="btn bg-teal-600 text-white rounded-md px-6 py-2 hover:bg-teal-600 "
                    >
                        Back
                    </button>
                    <button
                        @click="shareNote"
                        class="btn bg-teal-600 text-white rounded-md px-6 py-2 hover:bg-teal-600 "
                    >
                        Share
                    </button>
                </div>
            </div>
            <!-- Buttons -->

        </div>
    </div>
<!--    <div class="absolute z-0 w-sc h-sc bg-black opacity-50"></div>-->

</template>
<script setup>
import {computed, onMounted, ref} from "vue";
import axios from "axios";
import {defineEmits} from 'vue'

let props = defineProps({
    users: Array,
    existingNoteToDisplay: Object,
})

let step = ref(1)
const searchQuery = ref('');

const goBack = () => {
    step.value--
};

let allUsers = ref(props.users)
let matchingUsernamesOrEmails = ref([])
const goNext = () => {
    step.value = 2;
};

const goEmails = () => {
    step.value = 3;
};
let emits = defineEmits('toggle')
const shareNow = (noteId, userId, username) => {
    axios.post('/dashboard/share_note', {
        note_id: noteId,
        user_id: userId,
    }).then(res=>{
        if(res.status === 200){
            alert(res.data.message +username)
            emits('toggle')
            matchingUsernamesOrEmails.value = []
            step.value = 1
        }else if(res.status === 201){
            alert(res.data.message + username)
            emits('toggle')
            matchingUsernamesOrEmails.value = []
            step.value = 1

        }
    })
};

  let  searchName = ()=>{
    if (!searchQuery.value || searchQuery.value === '' || searchQuery.value === ' ' ){
        matchingUsernamesOrEmails.value = []
    } else {
        matchingUsernamesOrEmails.value = allUsers.value.filter((userToSharewith) => (userToSharewith.username && userToSharewith.username.toLowerCase().includes(searchQuery.value.toLowerCase())) ||
        (userToSharewith.name && userToSharewith.name.toLowerCase().includes(searchQuery.value.toLowerCase())) ||
        (userToSharewith.email && userToSharewith.email.toLowerCase().includes(searchQuery.value.toLowerCase()))
    )
    }
}

</script>
