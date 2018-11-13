/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import Toasted from 'vue-toasted';
import { ServerTable } from 'vue-tables-2';

Vue.use(ServerTable, {}, false, 'bootstrap3', 'default');
Vue.use(Toasted, {
    position: 'bottom-right',
    duration: 2000,
    iconPack: 'fontawesome'
});

Vue.component('users-component', require('./components/UsersComponent.vue'));
Vue.component('categories-component', require('./components/CategoryComponent.vue'));

const app = new Vue({
    el: '#app'
});