import { axios } from '@/util/axios.js';
import { Collapse } from 'flowbite';
import { defineStore } from 'pinia';

export const useSizeStore = defineStore("size", {
	state() {
		return {
			//
			sizes: [],
		}
	},

	actions: {
		getSizes(query) {
			const url = '/api/v1/sizes';

			return new Promise((resolve, reject) => {
				axios.get(url, {params: query}).then((res) => {
					console.log(res.data);
					this.sizes = res.data.data;
					resolve(res.data);
				}).catch((error) => {
					reject(error);
				});
			})
		},

		getSize(id) {
			const url = `/api/v1/sizes/${id}`;
			return new Promise((resolve, reject) => {
				axios.get(url).then((res) => {
					console.log(res.data);
					resolve(res.data);
				}).catch((error) => {
					reject(error);
				});
			})
		}, 

		addSize(size) {
			const url = '/api/v1/sizes';

			return new Promise((resolve, reject) => {
				axios.post(url, size).then((res) => {
					console.log(res.data);
					resolve(res.data);
				}).catch((error) => {
					reject(error);
				})
			})
		},

		editSize(id, size) {
			const url = `/api/v1/sizes/${id}`;

			return new Promise((resolve, reject) => {
				axios.patch(url, size).then((res) => {
					console.log(res);
					resolve(res);
				}).catch((error) => {
					reject(error);
				});
			})
		},



	},
});