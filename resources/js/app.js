import 'es6-promise/auto';
import axios from 'axios';
import './bootstrap';
import Vue from 'vue';
import VueAuth from '@websanova/vue-auth';
import VueAxios from 'vue-axios';
import VueRouter from 'vue-router';
import Index from './Index';
import auth from './auth';
import router from './router';
import { library } from '@fortawesome/fontawesome-svg-core';
import { faUserSecret } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
library.add(faUserSecret);
Vue.component('font-awesome-icon', FontAwesomeIcon);

Vue.config.productionTip = false;
// Set Vue globally
window.Vue = Vue;
// Set Vue router
Vue.router = router;
Vue.use(VueRouter);
// Set Vue authentication
Vue.use(VueAxios, axios);
axios.defaults.baseURL = 'http://localhost:8000/api';
Vue.use(VueAuth, auth);
// Load Index
Vue.component('index', Index);
const app = new Vue({
    el: '#app',
    router
});
