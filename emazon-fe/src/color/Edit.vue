<template>
    <!-- Modal content -->
    <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
        <!-- Modal header -->
        <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                Edit Color
            </h3>
           
        </div>
        <!-- Modal body -->
        <form @submit.prevent="OnEditColor" action="#">
            <div class="grid gap-6 mb-8 sm:grid-cols-1 p-12">
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Id</label>
                    <input v-model="color.id" type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Code">
                </div>
                <div>
                    <label for="brand" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">color</label>
                    <input v-model="color.color" type="text" name="brand" id="brand" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Title">
                </div>
                <div>
                    <label for="brand" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Code</label>
                    <input v-model="color.code" type="text" name="brand" id="brand" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Title">
                </div>
               
                 
                <div>
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Save</button>
                </div>
               
            </div>
                           
            
                           
        </form>
    </div>
    
</template>

<script> 
import { useColorStore } from '@/stores/ColorStore'; 
import { mapState } from 'pinia';
import { useRoute } from 'vue-router';

export default {
    data() {
        return {
            color: {},
            id: null,
        }
    },

    methods: {
        fetchColor(id) {
            console.log(id);
            this.getColor(id).then((res) => {
                console.log(res);
                this.color = res.data;
            })
        },

        OnEditColor() {
            console.log(this.id);
            this.editColor(this.id, this.color).then((res) => {
                console.log(res);
                this.$router.push({name: 'color.index'});
            }).catch((err) => {
                console.log(err);
            })
        },

    },
    mounted() {
        this.id = useRoute().params.id;
        this.fetchColor(this.id);
    },
    computed: {
        ...mapState(useColorStore, ['getColor', 'editColor'])
    }



}

</script>