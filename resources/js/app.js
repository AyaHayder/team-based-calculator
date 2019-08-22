/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');
// require('vue-strap/dist/vue-strap-lang.js');


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('./', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));


import PortalVue from 'portal-vue'
import Vue from 'vue';
import BootstrapVue from 'bootstrap-vue';
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(PortalVue)
Vue.use(BootstrapVue)

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('ticket-progress', require('./components/TicketProgress.vue').default);
Vue.component('ticket-credit', require('./components/TicketCredit.vue').default);
Vue.component('ticket-station', require('./components/PendingTicketStation.vue').default);
Vue.component('new-ticket', require('./components/NewTicket.vue').default);
Vue.component('new-archived-ticket', require('./components/NewArchivedTicket.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});