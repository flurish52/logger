<template>
    <div class="h-72 overflow-x-hidden">
        <div   v-for="(item, index) in items" :key="index">
                <list-item :item="item"
                v-on:reloadList="this.$emit('reloadList')"
                />
        </div>
    </div>
</template>

<script>
import ListItem from "@/components/listItem.vue";
import Edit from './edit.vue';
import {list} from "postcss";
export default {
    computed: {
        list() {
            return list
        }
    },
    props: ['items'],
    components:{
        ListItem, Edit
    },
    }
</script>
