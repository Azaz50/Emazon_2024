<template>
    <!-- Modal content -->
    <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
        <!-- Modal header -->
        <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
               Order Details 
            </h3>
           
        </div>
        <div>
  
          <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
          <table class="w-full text-sm leading-5">
            <tbody>
              <tr>
                <td class="py-3 px-4 text-left font-medium text-gray-600">Id</td>
                <td class="py-3 px-4">{{ coupon.id }}</td>
              </tr>
              <tr class="bg-gray-50">
                <td class="py-3 px-4 text-left font-medium text-gray-600">Coupon</td>
                <td class="py-3 px-4 text-left">{{ coupon.coupon }}</td>
              </tr>
              <tr>
                <td class="py-3 px-4 text-left font-medium text-gray-600">Value</td>
                <td class="py-3 px-4 text-left">{{ coupon.value }}</td>
              </tr>
              <tr class="bg-gray-50">
                <td class="py-3 px-4 text-left font-medium text-gray-600">Is Active</td>
                <td class="py-3 px-4 text-left">{{ coupon.is_active }}</td>
              </tr>
              
              <tr class="bg-gray-50">
                <td class="py-3 px-4 text-left font-medium text-gray-600">Created At</td>
                <td class="py-3 px-4 text-left">{{ coupon.created_at }}</td>
              </tr>
              <tr class="bg-gray-50">
                <td class="py-3 px-4 text-left font-medium text-gray-600">Updated At</td>
                <td class="py-3 px-4 text-left">{{ coupon.updated_at }}</td>
              </tr>
            </tbody>
          </table>
        </div>
        
          
        </div>
       
    </div>
    
    </template>



<script>
import { mapState } from 'pinia';
import { useCouponStore } from '@/stores/CouponStore.js';
import { useRoute } from 'vue-router';

export default {
	data() {
		return {
			coupon: {},
		}
	},

	methods: {
		fetchCoupon(id) {
			this.getCoupon(id).then((data) => {
				this.coupon = data.data;
				console.log(data.data);
			}).catch((error) => {
				console.error(error);
			}).finally(() => {
				//
			});
		},
	},

	mounted() {
		this.fetchCoupon(useRoute().params.id);
	},

	computed: {
		...mapState(useCouponStore, ['getCoupon']),
	},
}
</script>    