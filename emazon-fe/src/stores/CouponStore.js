import { axios } from '@/util/axios.js';
import { defineStore } from 'pinia';

export const useCouponStore = defineStore("coupon", {
	state() {
		return {
			//
			coupons: [],
		}
	},

	actions: {
		getCoupons(query) {
			const url = '/api/v1/coupons';

			return new Promise((resolve, reject) => {
				axios.get(url, {params: query}).then((res) => {
					console.log(res.data);
					this.coupons = res.data.data;
					resolve(res.data);
				}).catch((error) => {
					reject(error);
				});
			})
		}, 

		getCoupon(id) {
			const url = `/api/v1/coupons/${id}`;
			return new Promise((resolve, reject) =>{
				axios.get(url).then((res) => {
					console.log(res.data);
					resolve(res.data);
				}).catch((error) => {
					reject(error);
				});
			})
		},

		addCoupon(query) {
			const url = '/api/v1/coupons';

			return new Promise((resolve, reject) => {
				axios.post(url, query).then((res) => {
					console.log(res.data);
					this.coupons = res.data.data;
					resolve(res.data);
				}).catch((error) => {
					reject(error);
				});
			})
		}, 

		

		editCoupon(id, coupon) {
			const url = `/api/v1/coupons/${id}`;

			return new Promise((resolve, reject) => {
				axios.patch(url, coupon).then((res) => {
					console.log(res);
					resolve(res);
				}).catch((error) => {
					reject(error);
				})
			});
		},
	},
});