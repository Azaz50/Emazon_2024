import { axios } from '@/util/axios.js';
import { defineStore } from 'pinia';

export const useProductStore = defineStore("productImage", {
	state() {
		return {
			//
			productImages: [],
		}
	},

	actions: {
		getProducts(query) {
			const url = '/api/v1/productImages';

			return new Promise((resolve, reject) => {
				axios.get(url, query).then((res) => {
					console.log(res.data);
					this.productImages = res.data.data;
					resolve(res.data);
				}).catch((error) => {
					reject(error);
				});
			})
		},

		getProduct(id) {
			const url = `/api/v1/productImages/${id}`;
			return new Promise((resolve, reject) => {
				axios.get(url).then((res) => {
					console.log(res.data);
					resolve(res.data);
				}).catch((error)=> {
					reject(error);
				});
			})
		}
	},
});