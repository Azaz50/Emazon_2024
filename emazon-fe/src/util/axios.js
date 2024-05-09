import axios from 'axios';
import router from '@/router';

import { useAuthStore } from '@/stores/AuthStore.js';

const instance = axios.create({
	 //baseURL: 'http://127.0.0.1:8000',
	withCredentials: true, // default
});

instance.interceptors.request.use(function (config) {
	// @NOTE(muktar): This return is important, axios will throw error of
	// config undefined (cancelToken error in chrome)
	// I had to waste 1 day of my time with frustration.
	return config;
});

instance.interceptors.response.use(function (response) {
	return response;
}, function (error) {
	const authStore = useAuthStore();
	// If session expired and backend returned 401 (Unauthenticated)
	// then logout the user
	if (error.response.status == 401) {
		authStore.logout();
		router.push({ name: 'auth.login' });
	}

	// @TODO Need to handle 403 (Forbidden) for multi role based access of api

	return Promise.reject(error);
});

export { instance as axios };
