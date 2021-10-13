require('./bootstrap')
import "./components/index";

import Vue from "vue";
import Vuex from 'vuex';
import VueRouter from 'vue-router';

import store from './store/index';
import App from "./App.vue";
import router from "./router/index";

Vue.use(VueRouter);
Vue.use(Vuex);

new Vue({
    store,
    router,
    render: h => h(App)
}).$mount("#app");
