
import axios from 'axios';
// import { axios } from '@/util/axios.js';
import { defineStore } from 'pinia';

export const useAuthStore = defineStore("auth", {
	state() {
		return {
			admin: null,
			authToken: "",
			isAdminAuthenticated: false,
		};
	},

	getters: {
		//
	},

	actions: {
		getAdmin() {
			// @TODO
			return this.admin;
		},

		isAuthenticated() {
			if (this.isAdminAuthenticated) {
				return true;
			}

			let authData = localStorage.getItem("auth_token");
			if (!authData) {
				return false;
			}

			let t = JSON.parse(authData);
			if (!t || !t.is_authenticated) { //  || !t.auth_token
				return false;
			}

			// this.authToken = t.auth_token;
			this.isAdminAuthenticated = t.is_authenticated;

			return true;
		},

		login(username, password) {
			const url = `/admin/login`;
			const data = {
				email: username,
				password: password,
			};

			return new Promise((resolve, reject) => {
				axios.post(url, data).then((res) => {
					this.admin = res.data.admin;
					this.isAdminAuthenticated = true;
					// this.authToken = res.data.token;
					// this.saveAuthState(this.authToken);
					this.saveAuthState();
					resolve(this.admin);
				}).catch((error) => {
					this.isAdminAuthenticated = false;
					reject(error);
				});
			});
		},

		logout() {
			localStorage.clear();
			this.isAdminAuthenticated = false;
			const url = `/admin/logout`;
			return new Promise((resolve, reject) => {
				let data;
				axios.post(url, data = null).then((res) => {
					resolve();
				}).catch((error) => {
					reject(error);
				});
			});
		},

		saveAuthState(authToken = null) {
			const t = {
				is_authenticated: true,
				auth_token: authToken,
				created_at: Date.now(),
			};

			localStorage.setItem("auth_token", JSON.stringify(t));
		},
	},
});
