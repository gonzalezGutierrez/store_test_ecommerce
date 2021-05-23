require('./bootstrap');

import Vue from 'vue';

import router from './routes/router';
import store from "../store/main";
import Shop from "../views/pages/Shop";


import Loading from 'vue-loading-overlay';

const loadingOptions = {
    canCancel: false,
    color: '#000000',
    loader: 'spinner',
    width: 64,
    height: 64,
    backgroundColor: '#ffffff',
    opacity: 0.5,
    zIndex: 999,
}

Vue.use(Loading,loadingOptions);

import VueSweetalert2 from 'vue-sweetalert2';

const options = {
    confirmButtonColor: '#41b882',
    cancelButtonColor: '#FF705D',
};

Vue.use(VueSweetalert2, options);

import { VuejsDatatableFactory } from 'vuejs-datatable';
Vue.use( VuejsDatatableFactory );


import VueToast from 'vue-toast-notification';
Vue.use(VueToast);


router.beforeEach(async (to,from,next) => {


    if (store.getters.isAuth)
        await store.dispatch('freshProfile');


    if (to.matched.some(record => record.meta.requiredAdmin)) {
        if (store.getters.isAuth && store.getters.isUserAdmin) {
            next()
        }else{
            next({name:'404'});
        }
    }


    if (to.matched.some(record => record.meta.guest)) {

        console.log(store.getters.isAuth);

        if (store.getters.isAuth) {
            next({name:'index'});
        }
        next();

    }else{
        next();
    }


});


const app = new Vue({
    el: '#shop',
    components:{Shop},
    router,
    store,
});
