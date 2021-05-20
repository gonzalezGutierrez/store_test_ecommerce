require('./bootstrap');

import Vue from 'vue';
import router from './routes/router';

import Shop from "../views/pages/Shop";

import Loading from 'vue-loading-overlay';
Vue.use(Loading);


const app = new Vue({
    el: '#shop',
    components:{
        Shop
    },
    router
});
