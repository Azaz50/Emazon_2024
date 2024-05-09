

import { createApp } from 'vue'
import { createPinia } from 'pinia'

import './index.css'

import App from './App.vue'
import router from './router'

const app = createApp(App)

app.use(createPinia())
app.use(router)


app.config.globalProperties.readableFormattedDate = (dateString) => {
	// let options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
	let options = { year: 'numeric', month: 'short', day: 'numeric' };
	let d = new Date(dateString);

	let result = d.toLocaleDateString("en-US", options);

	return result;
};
app.config.globalProperties.readableFormattedLongDate = (dateString) => {
	let d = new Date(dateString);

	// YYYY-MM-DD HH:mm:ss.sssZ
	let result = d.toISOString();
	result = result.substr(0, 19).replace(/T/, ' ');

	return result;
};

app.mount('#app')
