import { axios } from '@/util/axios.js';
import { defineStore } from 'pinia';

export const useUserStore = defineStore("user", {
	state() {
		return {
			//
			users: [],
		}
	},

	actions: {
		getUsers(query) {
			const url = '/api/v1/users';

			return new Promise((resolve, reject) => {
				axios.get(url, {params: query}).then((res) => {
					console.log(res.data);
					this.users = res.data.data;
					resolve(res.data);
				}).catch((error) => {
					reject(error);
				});
			})
		}, 

		getUser(id) {
			const url = `/api/v1/users/${id}`;
			return new Promise((resolve, reject) =>{
				axios.get(url).then((res) => {
					console.log(res.data);
					resolve(res.data);
				}).catch((error) => {
					reject(error);
				});
			})
		},

		
	},
});