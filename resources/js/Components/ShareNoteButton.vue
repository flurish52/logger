<template>
    <button
        @click="shareNote"
        class="md:right-8 flex items-center justify-center flex-col mx-2 bg-white px-2 py-1  rounded-lg text-black shadow-lg z-0 w-fit">
        <svg xmlns="http://www.w3.org/2000/svg" fill="teal" viewBox="0 0 22 22" stroke-width="2" stroke="currentColor" aria-hidden="true" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 100 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186l9.566-5.314m-9.566 7.5l9.566 5.314m0 0a2.25 2.25 0 103.935 2.186 2.25 2.25 0 00-3.935-2.186zm0-12.814a2.25 2.25 0 103.933-2.185 2.25 2.25 0 00-3.933 2.185z"></path></svg>
    </button>
</template>

<script>
export default {
    name: "ShareButton",
};
</script>

<script setup>
let emits = defineEmits(['shareNote'])
let shareNote=()=>{
    emits('shareNote')
}


</script>
