// require('./bootstrap');

//
// window.Vue = require('vue');
//
// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

import './bootstrap'
import Vue from 'vue'
import router from './router'
import store from './store'
import App from './App.vue'


// const app =

const createApp = async () => {
    await store.dispatch('auth/currentUser')
    new Vue({
        el: '#app',
        router,
        store,
        components:{App},
        template:'<App/>'
    });
}

createApp();



