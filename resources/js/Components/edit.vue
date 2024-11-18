<template>
    <div class="h-12 w-full absolute flex flex-col items-center justify-center top-4"
         :class="hidden">
        <div class="flex  flex-col w-full px-4">
            <input type="text" class="outline-none w-full h-6 px-2"
                   v-model="this.existingItem.name"
                   @keyup.enter="update"
                    @keyup.esc="this.$emit('cancel')"
                    />
            <div class="flex justify-between">
                <button type="button" class="text-white bg-red-700 font-medium
                     text-sm text-center w-12 h-6 flex items-center justify-center p-2"
                    @click="this.$emit('cancel')">Cancel</button>
                <button type="button" class="text-white bg-green-700 font-medium
                     text-sm text-center w-12 h-6 flex items-center justify-center p-2"
                    @click="update()" >Submit</button>
            </div>
        </div>
    </div>
</template>


<script>
import axios from "axios";

export default {
    props:['hidden','existingItem'],
    methods:{
        update(){
            axios.put(`api/item/`+this.existingItem.id+`/corrected`, {name: this.existingItem.name})
                .then(request =>{
                    this.$emit('reloadList')
                    this.$emit('hide')
                })
                .catch(error =>{
                    console.log(error)
                })
        }
        }
    }
</script>

<style scoped>

</style>
