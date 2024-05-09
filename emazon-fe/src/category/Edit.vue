<template>
    <!-- Modal content -->
    <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
        <!-- Modal header -->
        <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                Edit Category
            </h3>
            
        </div>
        <!-- Modal body -->
        <form @submit.prevent="OnEditCategory" action="#">
            <div class="grid gap-6 mb-8 sm:grid-cols-2 p-12">
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                    <input v-model="category.name" type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Category Name">
                </div>
                <!-- <div>
                    <label for="brand" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Image Url</label>
                    <input v-model="category.image_url" type="text" name="brand" id="brand" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Image Link">
                </div> -->
               
                         
                <div>
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Save</button>
                </div>
                         
            </div>
                           
            
                           
        </form>
    </div>
    
</template>


<script>
import { useCategoryStore } from '@/stores/CategoryStore'
import { mapState } from 'pinia'
import { useRoute } from 'vue-router'

export default {
    data() {
        return {
            category: {},
            id: null,
        }
    },

    methods: {
        fetchCategory(id) {
            console.log(id);
            this.getCategory(id).then((res) => {
                console.log(res);
                this.category = res.data;
            })
        },

        OnEditCategory() {
            // console.log('funct calleddddd')
            console.log(this.id);
            this.EditCategory(this.id, this.category).then((res) => {
                console.log(res);
                this.$router.push({name: 'category.index'});
            }).catch((err) => {
                console.log(err);
            })
        },

    },
      
    mounted() {
            this.id = useRoute().params.id;
            this.fetchCategory(this.id);
        },

    computed: {
        ...mapState(useCategoryStore, ["getCategory", "EditCategory"]),
    }
}

</script> 