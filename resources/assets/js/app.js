
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('popper.js').default;
require('./bootstrap');

window.Vue = require('vue');

window.VueRouteLaravel = require('vue-route-laravel');
window.queryString = require('query-string');

var config = {
    baseroute: '/',
    axios: axios,
    queryString: queryString,
    csrf_token: document.head.querySelector("[name=csrf-token]").content
};

Vue.use(VueRouteLaravel, config);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('navbar', require('./components/common/NavbarComponent.vue'));
Vue.component('footer-c', require('./components/common/FooterComponent.vue'));

Vue.component('user-login', require('./components/user/LoginComponent.vue'));
Vue.component('user-register', require('./components/user/RegisterComponent.vue'));

Vue.component('category-all', require('./components/category/AllComponent.vue'));
Vue.component('category-info', require('./components/category/InfoComponent.vue'));

Vue.component('product-item', require('./components/product/ItemComponent.vue'));
Vue.component('product-info', require('./components/product/InfoComponent.vue'));

Vue.filter('price', function (value) {
    return new Intl.NumberFormat().format(value);
});

const app = new Vue({
    el: '#app'
});