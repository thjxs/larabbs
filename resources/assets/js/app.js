
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import http from './utils/http'
import Vue from 'vue';
import Routes from './routes';
import store from './store'
import VueRouter from 'vue-router';
import VeeValidate from 'vee-validate';
import App from './App';

Vue.prototype.$http = http
Vue.use(VeeValidate);

let token = window.localStorage.getItem('access_token')
if (token) {
    store.commit('AUTH_SET_TOKEN', token)
    axios.defaults.headers.common.Authorization = `Bearer ${token}`
}

Vue.use(VueRouter);
const router = new VueRouter({
    routes: Routes,
    mode: 'history'
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

new Vue({
    el: '#app',
    router,
    store,
    components: { App },
    template: '<App/>'
});
