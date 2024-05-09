<template>
    <!-- Modal content -->
    <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
        <!-- Modal header -->
        <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
               Products Details 
            </h3>
           
        </div>
        <div>
  
          <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
          <table class="w-full text-sm leading-5">
            <tbody>
              <tr>
                <td class="py-3 px-4 text-left font-medium text-gray-600">Id</td>
                <td class="py-3 px-4">{{ color.id }}</td>
              </tr>
              <tr class="bg-gray-50">
                <td class="py-3 px-4 text-left font-medium text-gray-600">color</td>
                <td class="py-3 px-4 text-left">{{ color.color }}</td>
              </tr>
              <tr>
                <td class="py-3 px-4 text-left font-medium text-gray-600">code</td>
                <td class="py-3 px-4 text-left">{{ color.code }}</td>
              </tr>
             
            </tbody>
          </table>
        </div>

     
        
        
          
        </div>
       
    </div>
    
</template>

<script>
import { mapState } from 'pinia';
import { useColorStore } from '@/stores/ColorStore.js';
import { useRoute } from 'vue-router';

export default {
  data() {
    return {
      color: {},
    }
  },

  methods: {
    fetchColor(id) {
      this.getColor(id).then((data) => {
        this.color = data.data;
        console.log(data.data);
      }).catch((error) => {
        console.error(error);
      }).finally(() => {

      });
    },
  },

  mounted() {
    this.fetchColor(useRoute().params.id);
  },
  computed: {
    ...mapState(useColorStore, ['getColor']),
  },
}


</script>