<template>
    <!-- Modal content -->
    <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
        <!-- Modal header -->
        <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
               Payment Details 
            </h3>
           
        </div>
        <div>
  
          <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
          <table class="w-full text-sm leading-5">
            <tbody>
              <tr>
                <td class="py-3 px-4 text-left font-medium text-gray-600">Id</td>
                <td class="py-3 px-4">{{ payment.id }}</td>
              </tr>
              <tr class="bg-gray-50">
                <td class="py-3 px-4 text-left font-medium text-gray-600">Amount</td>
                <td class="py-3 px-4 text-left">{{ payment.amount }}</td>
              </tr>
              <tr>
                <td class="py-3 px-4 text-left font-medium text-gray-600">Order Group Id</td>
                <td class="py-3 px-4 text-left">{{ payment.order_group_id }}</td>
              </tr>
              <tr class="bg-gray-50">
                <td class="py-3 px-4 text-left font-medium text-gray-600">PG Payment Id</td>
                <td class="py-3 px-4 text-left">{{ payment.pg_payment_id }}</td>
              </tr>
              <tr>
                <td class="py-3 px-4 text-left font-medium text-gray-600">Status</td>
                <td class="py-3 px-4 text-left">{{ payment.status }}</td>
              </tr>
              <tr class="bg-gray-50">
                <td class="py-3 px-4 text-left font-medium text-gray-600">Mode</td>
                <td class="py-3 px-4 text-left">{{ payment.mode }}</td>
              </tr>
              <tr>
                <td class="py-3 px-4 text-left font-medium text-gray-600">User Id</td>
                <td class="py-3 px-4 text-left">{{ payment.user_id }}</td>
              </tr>
              <tr class="bg-gray-50">
                <td class="py-3 px-4 text-left font-medium text-gray-600">Shipment</td>
                <td class="py-3 px-4 text-left">{{ payment.shipment }}</td>
              </tr>
             
              <tr class="bg-gray-50">
                <td class="py-3 px-4 text-left font-medium text-gray-600">Created At</td>
                <td class="py-3 px-4 text-left">{{ payment.created_at }}</td>
              </tr>
              <tr class="bg-gray-50">
                <td class="py-3 px-4 text-left font-medium text-gray-600">Updated At</td>
                <td class="py-3 px-4 text-left">{{ payment.updated_at }}</td>
              </tr>
            </tbody>
          </table>
        </div>
        
          
        </div>
       
    </div>
    
    </template>


<script>
import { mapState } from 'pinia';
import { usePaymentStore } from '@/stores/PaymentStore.js';
import { useRoute } from 'vue-router';

export default {
	data() {
		return {
			payment: {},
		}
	},

	methods: {
		fetchPayment(id) {
			this.getPayment(id).then((data) => {
				this.payment = data.data;
				console.log(data.data);
			}).catch((error) => {
				console.error(error);
			}).finally(() => {
				//
			});
		},
	},

	mounted() {
		this.fetchPayment(useRoute().params.id);
	},

	computed: {
		...mapState(usePaymentStore, ['getPayment']),
	},
}
</script>    