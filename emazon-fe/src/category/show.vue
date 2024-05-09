<template>
    <!-- Modal content -->
    <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
        <!-- Modal header -->
        <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
               Categories Details 
            </h3>
           
        </div>
        <div>
  
          <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
          <table class="w-full text-sm leading-5">
            <tbody>
              <tr>
                <td class="py-3 px-4 text-left font-medium text-gray-600">Id</td>
                <td class="py-3 px-4">{{ category.id }}</td>
              </tr>
              <tr class="bg-gray-50">
                <td class="py-3 px-4 text-left font-medium text-gray-600">Name</td>
                <td class="py-3 px-4 text-left">{{ category.name }}</td>
              </tr>
              <tr>
                <td class="py-3 px-4 text-left font-medium text-gray-600">Parent Id</td>
                <td class="py-3 px-4 text-left">{{ category.parent_id }}</td>
              </tr>
             
            </tbody>
          </table>
        </div>

        <div>
          <h3 class="text-lg font-semibold text-gray-90 dark:text-white">
             Image:
          </h3>
          <img :src="category.image_url" style="width: 120px;">
        </div>
        
        
          
        </div>
       
    </div>
    
</template>



<script>
import { mapState } from 'pinia';
import { useCategoryStore } from '@/stores/CategoryStore.js';
import { useRoute } from 'vue-router';

export default {
	data() {
		return {
			category: {},
		}
	},

	methods: {
		fetchCategory(id) {
			this.getCategory(id).then((data) => {
				this.category = data.data;
				console.log(data.data);
			}).catch((error) => {
				console.error(error);
			}).finally(() => {
				//
			});
		},
	},

	mounted() {
		this.fetchCategory(useRoute().params.id);
	},

	computed: {
		...mapState(useCategoryStore, ['getCategory']),
	},
}
</script>