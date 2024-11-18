<template>
    <div class="flex w-full items-center justify-center">
            <input type="text" class="addItem w-full h-10 bg-white p-2 outline-none"
                   v-model="item.name"
                   @keyup.enter="addItem()" >
            <button type="button" class="py-2.5 px-5 h-10 text-sm font-medium
            text-gray-900  bg-green-900 text-white rounded-lg border
            border-gray-200 "
                    @click="addItem()"
                    :class="[item.name? 'active' : 'inactive']"
                    >Add</button>
    </div>
</template>
<script>
    import axios from "axios";
export default {
    data: function(){
        return{
            item: {
                name: ""
            }
        }
    },
    methods:{
        addItem(){
            if (this.item.name === ''){
                return;
            }
            axios.post('api/item/store',{
                item: this.item
            })
                .then(response =>{
                    if(response.status == 201){
                        this.item.name = '';
                        this.$emit('reloadList');
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
.inactive{
    background: gray;
    cursor: no-drop;
}
</style>

