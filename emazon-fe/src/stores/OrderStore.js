import { axios } from '@/util/axios.js';
import { defineStore } from 'pinia';

export const useOrderStore = defineStore("order", {
	state() {
		return {
			//
			orders: [],
		}
	},

	actions: {
		getOrders(query) {
			const url = '/api/v1/orders';

			return new Promise((resolve, reject) => {
				axios.get(url, {params: query}).then((res) => {
					console.log(res.data);
					this.orders = res.data.data;
					resolve(res.data);
				}).catch((error) => {
					reject(error);
				});
			})
		},

		getOrder(id) {
			const url = `/api/v1/orders/${id}`;
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