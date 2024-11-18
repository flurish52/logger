<template>
    <div class="w-full flex flex-col relative">
                <edit
                    :existingItem="existingItem"
                    :class="hidden"
                    v-on:cancel="cancel()"
                    v-on:reloadList="this.$emit('reloadList')"
                    v-on:hide="cancel()"
                />
        <div class="flex  items-center w-full bg-slate-100 px-1 my-2 justify-between">
            <span class="flex w-3/4 ">
                <input type="checkbox" class="p-2"
                        @change="completedTask()"
                       :checked="!!item.completed"
                />
                <input class=" p-2 complete outline-none bg-slate-100"
                       v-model="item.name" readonly
                />
            </span>
            <div class="flex justify-between items-center w-8">
                <button type="button" class="text-white bg-red-700 font-medium
                 text-sm text-center w-2 h-2 p-2 m-px flex items-center justify-center"
                @click="removeItem()">-</button>
            <button type="button" class="text-white bg-green-700 font-medium
                 text-sm text-center w-2 h-2 flex items-center justify-center p-2"
                @click="fillFields()" >/</button>
            </div>

        </div>
    </div>
</template>
<script>
import axios from "axios";
import Edit from './edit.vue'
export default {

    data(){
      return{
          existingItem:{
              name: '',
              id: ''
          },
          hidden: 'hidden'
      }
    },
    components:{
      Edit,
    },
    props: {
        item: Object,
        newItem: Array
    },
    methods: {
        fillFields(){
                this.hidden = ''
                axios.get(`api/item/${this.item.id}/edit`)
                .then(response =>{
                    this.existingItem = response.data
                })
        },
        cancel(){
                this.hidden = 'hidden'
            },
                openEditing(){
                this.hidden = ''
                    axios.get(`api/item/` + this.item.id + `/edit`)
                    .then(response => {
                        this.existingItem = response.data
                        this.$emit('openEdit')
                    })

        },
         removeItem(){
            axios.delete('api/item/'+ this.item.id)
                .then(request=>{
                    if (request.status == 200){
                        this.$emit('reloadList')
                    }
                })
                .catch(error =>{
                    console.log(error)
                })
        },
         completedTask(){
            axios.put('api/item/'+ this.item.id )
                .then(request=>{
                    if(request.status == 'OK'){
                        this.$emit('reloadList')
                    }
                })
                .catch(error =>{
                    console.log(error)
                })
        }
    }
}
</script>

<style scoped>
       input:checked~.complete{
        text-decoration: line-through;
    }
</style>
