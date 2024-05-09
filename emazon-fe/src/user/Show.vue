<template>
    <!-- Modal content -->
    <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
        <!-- Modal header -->
        <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
               User Details 
            </h3>
           
        </div>
        <div>
  
          <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
          <table class="w-full text-sm leading-5">
            <tbody>
              <tr>
                <td class="py-3 px-4 text-left font-medium text-gray-600">Id</td>
                <td class="py-3 px-4">{{ user.id }}</td>
              </tr>
              <tr class="bg-gray-50">
                <td class="py-3 px-4 text-left font-medium text-gray-600">First Name</td>
                <td class="py-3 px-4 text-left">{{ user.first_name }}</td>
              </tr>
              <tr>
                <td class="py-3 px-4 text-left font-medium text-gray-600">Last Name</td>
                <td class="py-3 px-4 text-left">{{ user.last_name }}</td>
              </tr>
              <tr class="bg-gray-50">
                <td class="py-3 px-4 text-left font-medium text-gray-600">Gender</td>
                <td class="py-3 px-4 text-left">{{ user.gender }}</td>
              </tr>
              <tr>
                <td class="py-3 px-4 text-left font-medium text-gray-600">Phone</td>
                <td class="py-3 px-4 text-left">{{ user.phone }}</td>
              </tr>
              <tr class="bg-gray-50">
                <td class="py-3 px-4 text-left font-medium text-gray-600">Email</td>
                <td class="py-3 px-4 text-left">{{ user.email }}</td>
              </tr>
              <tr>
                <td class="py-3 px-4 text-left font-medium text-gray-600">Password</td>
                <td class="py-3 px-4 text-left">{{ user.password }}</td>
              </tr>
              <tr class="bg-gray-50">
                <td class="py-3 px-4 text-left font-medium text-gray-600">Is Active</td>
                <td class="py-3 px-4 text-left">{{ user.is_active }}</td>
              </tr>
              <tr class="bg-gray-50">
                <td class="py-3 px-4 text-left font-medium text-gray-600">Address Id</td>
                <td class="py-3 px-4 text-left">{{ user.address_id }}</td>
              </tr>
              <tr class="bg-gray-50">
                <td class="py-3 px-4 text-left font-medium text-gray-600">Email Verified At</td>
                <td class="py-3 px-4 text-left">{{ user.email_verified_at }}</td>
              </tr>
              <tr class="bg-gray-50">
                <td class="py-3 px-4 text-left font-medium text-gray-600">Created At</td>
                <td class="py-3 px-4 text-left">{{ user.created_at }}</td>
              </tr>
              <tr class="bg-gray-50">
                <td class="py-3 px-4 text-left font-medium text-gray-600">Updated At</td>
                <td class="py-3 px-4 text-left">{{ user.updated_at }}</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div>
            <h3 class="text-lg font-semibold text-gray-90 dark:text-white">
               User Image 
            </h3>
            <img :src="user.image_url" style="width: 120px;" >
        </div>
        
          
        </div>
       
    </div>
    
    </template>



<script>
import { mapState } from 'pinia';
import { useUserStore } from '@/stores/UserStore.js';
import { useRoute } from 'vue-router';

export default {
	data() {
		return {
			user: {},
		}
	},

	methods: {
		fetchUser(id) {
			this.getUser(id).then((data) => {
				this.user = data.data;
				console.log(data.data);
			}).catch((error) => {
				console.error(error);
			}).finally(() => {
				//
			});
		},
	},

	mounted() {
		this.fetchUser(useRoute().params.id);
	},

	computed: {
		...mapState(useUserStore, ['getUser']),
	},
}
</script>    