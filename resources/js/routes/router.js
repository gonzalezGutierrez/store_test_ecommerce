import Vue from 'vue';
import VueRouter from 'vue-router';

import HomeComponent from "../../views/pages/home/HomeComponent";

Vue.use(VueRouter);

export default  new VueRouter({
    mode:'history',
    routes:[
        { path:'/', component:HomeComponent }
    ]
});
