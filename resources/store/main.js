import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex);

import auth from './modules/auth';

import cart from './modules/shoppincart';

const store = new Vuex.Store({
    modules:{
        auth,
        cart
    }
});

export default  store;
