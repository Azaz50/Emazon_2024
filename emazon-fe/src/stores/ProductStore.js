import { axios } from '@/util/axios.js';
import { defineStore } from 'pinia';

export const useProductStore = defineStore("product", {
	state() {
		return {
			//
			products: [],
		}
	},

	actions: {
		getProducts(query) {
			const url = '/api/v1/products';

			return new Promise((resolve, reject) => {
				axios.get(url, query).then((res) => {
					console.log(res.data);
					this.products = res.data.data;
					resolve(res.data);
				}).catch((error) => {
					reject(error);
				});
			})
		},

		getProduct(id) {
			const url = `/api/v1/products/${id}`;

			return new Promise((resolve, reject) => {
				axios.get(url).then((res) => {
					console.log(res.data);
					resolve(res.data);
				}).catch((error) => {
					reject(error);
				});
			})
		},

		addProduct(product) {
			const url = '/api/v1/products';

			return new Promise((resolve, reject) => {
				axios.post(url, product).then((res) => {
					console.log(res.data);
					resolve(res.data);
				}).catch((error) => {
					reject(error);
				});
			})
		},

		EditProduct(id, product) {
			const url = `/api/v1/products/${id}`;

			return new Promise((resolve, reject) => {
				axios.patch(url, product).then((res) => {
					console.log(res);
					resolve(res);
				}).catch((error) => {
					reject(error);
				});
			})
		},
	},
});