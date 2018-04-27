
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

Vue.component('charge-component', require('./components/ChargeComponent.vue'));
Vue.component('invoice-component',require('./components/InvoiceComponent.vue'));
Vue.component('invoice-pay-component',require('./components/InvoicePayComponent.vue'));
Vue.component('customers-component',require('./components/CustomersComponent.vue'));
Vue.component('plans-component',require('./components/PlansComponent.vue'));
Vue.component('subscription-pay-component',require('./components/SubscriptionPayComponent.vue'));
Vue.component('send-pay-component',require('./components/SendPayComponent.vue'));
const app = new Vue({
    el: '#app'
});
