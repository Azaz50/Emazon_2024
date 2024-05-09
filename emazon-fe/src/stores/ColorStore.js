import { axios } from '@/util/axios.js';
import { defineStore } from 'pinia';

export const useColorStore = defineStore("color", {
	state() {
		return {
			//
			colors: [],
		}
	},

	actions: {
		getColors(query) {
			const url = '/api/v1/colors';

			return new Promise((resolve, reject) => {
				axios.get(url, query).then((res) => {
					console.log(res.data);
					this.colors = res.data.data;
					resolve(res.data);
				}).catch((error) => {
					reject(error);
				});
			})
		}, 

		getColor(id) {
			const url = `/api/v1/colors/${id}`;
			return new Promise((resolve, reject) =>{
				axios.get(url).then((res) => {
					console.log(res.data);
					resolve(res.data);
				}).catch((error) => {
					console.log('ok')
					reject(error);
				});
			})
		}, 


		addColor(color) {
			const url = '/api/v1/colors';

			return new Promise((resolve, reject) => {
				axios.post(url, color).then((res) => {
					console.log(res.data);
					resolve(res.data);
				}).catch((error) => {
					reject(error);
				});
			})
		},

		editColor(id, color) {
			const url = `/api/v1/colors/${id}`;

			return new Promise((resolve, reject) => {
				axios.patch(url, color).then((res) => {
					console.log(res);
					resolve(res);
				}).catch((erro) => {
					reject(error);
				});
			})
		},
	},
});