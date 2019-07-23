
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('../bootstrap');

require('./jquery-scripts');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('bookmark-button', require('./components/BookmarkButtonComponent.vue').default);

Vue.component('cart-button', require('./components/Cart/CartButtonComponent.vue').default);
Vue.component('product-cart-button', require('./components/Cart/ProductCartButton.vue').default);
Vue.component('cart-remove-button', require('./components/Cart/CartItemRemoveButtonComponent.vue').default);
Vue.component('cart-item-count', require('./components/Cart/CartItemCount.vue').default);
Vue.component('navbar-cart', require('./components/Cart/NavbarCartComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//

const app = new Vue({
    el: '#app',

    data: function () {
        return {
            user: window.App.user,
            bookmarks: window.App.bookmarks,
            cart_items: window.App.cart_items,
        };
    }
});