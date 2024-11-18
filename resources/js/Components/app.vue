<template>
        <div id="app" class="flex justify-center item-center w-full ">
        <div class="w-1/2 flex justify-center items-center">
            <div class=" w-1/2 bg-teal-200 h-96 rounded-md">
                <div class="bg-teal-800 w-full h-10 mb-2">
                    <h2 class="text-center font-bold text-2xl text-white">Todo List</h2>
                </div>
                <div class="flex flex-col w-full px-6 ">
                    <add-item v-on:reloadList="retrieveItems()"/>
                    <list-view v-on:reloadList="retrieveItems()"
                               :items="items"/>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import axios from 'axios'
import ListView from './listView.vue';
import AddItem from './addItemForm.vue';
export default {
    components:{
        ListView, AddItem
    },
    data: function(){
        return{
            items: [],
            newItem: []
        }

    },

    methods:{
        retrieveItems(){
            axios.get('api/items')
                .then(response =>{
                      this.items = response.data
                })
                .catch(error =>{
                    console.log(error)
                })
        }
    },
             created(){
            this.retrieveItems()
        },
}
</script>
