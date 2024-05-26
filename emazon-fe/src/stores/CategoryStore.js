import { axios } from '@/util/axios.js';
import { defineStore } from 'pinia';

export const useCategoryStore = defineStore("category", {
	state() {
		return {
			//
			categories: [],
		}
	},

	actions: {
		getCategories(query) {
			const url = '/api/v1/categories';

			return new Promise((resolve, reject) => {
				axios.get(url, {params: query}).then((res) => {
					console.log(res.data);
					this.categories = res.data.data;
					resolve(res.data);
				}).catch((error) => {
					reject(error);
				});
			})
		},

		getCategory(id) {
			const url = `/api/v1/categories/${id}`;

			return new Promise((resolve, reject) => {
				axios.get(url).then((res) => {
					console.log(res.data);
					resolve(res.data);
				}).catch((error) => {
					reject(error);
				});
			})
		},


		addCategory(category) {
			const url = '/api/v1/categories';

			return new Promise((resolve, reject) => {
				axios.post(url, category).then((res) => {
					console.log(res.data);
					resolve(res.data);
				}).catch((error) => {
					reject(error);
				});
			})
		},

		EditCategory(id, category) {
			const url = `/api/v1/categories/${id}`;

			return new Promise((resolve, reject) => {
				axios.patch(url, category).then((res) => {
					console.log(res);
					resolve(res);
				}).catch((error) => {
					reject(error);
				});
			})
		},
	},
});