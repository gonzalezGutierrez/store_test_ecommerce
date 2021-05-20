import Vue from 'vue';
import VueRouter from 'vue-router';

import HomeComponent from "../../views/pages/home/HomeComponent";
import Product from "../../views/pages/products/Product";
import Collections from "../../views/pages/collections/Collections";

Vue.use(VueRouter);

export default  new VueRouter({
    mode:'history',
    routes:[
        { path:'/', component:HomeComponent },
        { path:'/product/:product_id/:product_slug' , component: Product , name:'product_detail' },
        { path:'/collections/:collection',component: Collections, name:'collections' }

    ],
    scrollBehavior() {
        return {x: 0, y: 0}
    }
});
