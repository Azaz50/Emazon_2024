import { axios } from '@/util/axios.js';
import { defineStore } from 'pinia';

export const usePaymentStore = defineStore("payment", {
	state() {
		return {
			//
			payments: [],
		}
	},

	actions: {
		getPayments(query) {
			const url = '/api/v1/payments';

			return new Promise((resolve, reject) => {
				axios.get(url, query).then((res) => {
					console.log(res.data);
					this.payments = res.data.data;
					resolve(res.data);
				}).catch((error) => {
					reject(error);
				});
			})
		}, 

		getPayment(id) {
			const url = `/api/v1/payments/${id}`;
			return new Promise((resolve, reject) =>{
				axios.get(url).then((res) => {
					console.log(res.data);
					resolve(res.data);
				}).catch((error) => {
					reject(error);
				});
			})
		}
	},
});