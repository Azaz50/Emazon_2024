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
                <td class="py-3 px-4">{{ order.id }}</td>
              </tr>
              <tr class="bg-gray-50">
                <td class="py-3 px-4 text-left font-medium text-gray-600">Razorpay Order Id</td>
                <td class="py-3 px-4 text-left">{{ order.rzp_order_id }}</td>
              </tr>
              <tr>
                <td class="py-3 px-4 text-left font-medium text-gray-600">Amount</td>
                <td class="py-3 px-4 text-left">{{ order.amount }}</td>
              </tr>
              <tr class="bg-gray-50">
                <td class="py-3 px-4 text-left font-medium text-gray-600">Gross Total</td>
                <td class="py-3 px-4 text-left">{{ order.gross_total }}</td>
              </tr>
              <tr>
                <td class="py-3 px-4 text-left font-medium text-gray-600">Sub Total</td>
                <td class="py-3 px-4 text-left">{{ order.sub_total }}</td>
              </tr>
              <tr class="bg-gray-50">
                <td class="py-3 px-4 text-left font-medium text-gray-600">Discount</td>
                <td class="py-3 px-4 text-left">{{ order.discount }}</td>
              </tr>
              <tr>
                <td class="py-3 px-4 text-left font-medium text-gray-600">Tax</td>
                <td class="py-3 px-4 text-left">{{ order.tax }}</td>
              </tr>
              <tr class="bg-gray-50">
                <td class="py-3 px-4 text-left font-medium text-gray-600">Shipment</td>
                <td class="py-3 px-4 text-left">{{ order.shipment }}</td>
              </tr>
              <tr class="bg-gray-50">
                <td class="py-3 px-4 text-left font-medium text-gray-600">User Id</td>
                <td class="py-3 px-4 text-left">{{ order.user_id }}</td>
              </tr>
              <tr class="bg-gray-50">
                <td class="py-3 px-4 text-left font-medium text-gray-600">Applied Coupon Id</td>
                <td class="py-3 px-4 text-left">{{ order.applied_coupon_id }}</td>
              </tr>
              <tr class="bg-gray-50">
                <td class="py-3 px-4 text-left font-medium text-gray-600">Status</td>
                <td class="py-3 px-4 text-left">{{ order.status }}</td>
              </tr>
              <tr class="bg-gray-50">
                <td class="py-3 px-4 text-left font-medium text-gray-600">Created At</td>
                <td class="py-3 px-4 text-left">{{ order.created_at }}</td>
              </tr>
              <tr class="bg-gray-50">
                <td class="py-3 px-4 text-left font-medium text-gray-600">Updated At</td>
                <td class="py-3 px-4 text-left">{{ order.updated_at }}</td>
              </tr>
            </tbody>
          </table>
        </div>
        
          
        </div>
       
    </div>
    
</template>


<script>
import { mapState } from 'pinia';
import { useOrderStore } from '@/stores/OrderStore.js';
import { useRoute } from 'vue-router';

export default {
	data() {
		return {
			order: {},
		}
	},

	methods: {
		fetchOrder(id) {
			this.getOrder(id).then((data) => {
				this.order = data.data;
				console.log(data.data);
			}).catch((error) => {
				console.error(error);
			}).finally(() => {
				//
			});
		},
	},

	mounted() {
		this.fetchOrder(useRoute().params.id);
	},

	computed: {
		...mapState(useOrderStore, ['getOrder']),
	},
}
</script>