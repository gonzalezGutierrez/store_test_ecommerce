import Vue from 'vue';
import VueRouter from 'vue-router';

import PageNotFound from "../../views/pages/PageNotFound";
import IndexPage from "../../views/pages/IndexPage";
import ProductPage from "../../views/pages/ProductPage";
import ProductsPage from "../../views/pages/ProductsPage";
import LoginPage from "../../views/auth/LoginPage";
import RegisterPage from "../../views/auth/RegisterPage";
import CartPage from "../../views/pages/CartPage";
import CheckoutPage from "../../views/pages/CheckoutPage";
import TrackingPage from "../../views/pages/TrackingPage";

//Admin routes
import ProductListAdminPage from "../../views/admin/products/ProductListAdminPage";
import ProductEditAdminPage from "../../views/admin/products/ProductEditAdminPage";
import ProductCreateAdminPage from "../../views/admin/products/ProductCreateAdminPage";
import UserListAdminPage from "../../views/admin/users/UserListAdminPage";
import UserEditAdminPage from "../../views/admin/users/UserEditAdminPage";
import OrderPage from "../../views/pages/OrderPage";
import OrdersPage from "../../views/pages/OrdersPage";
import IndexAdmin from "../../views/admin/IndexAdmin";
import OrdersListAdmin from "../../views/admin/orders/OrdersListAdmin";


Vue.use(VueRouter);

const router = new VueRouter({
    mode:'history',
    routes:[

        /*PUBLIC ROUTES*/
        {
            path: '/404',
            name: '404',
            component: PageNotFound,
        },

        {
            path: '*',
            redirect: '/404',
        },

        {
            path:'/', component:IndexPage,name:'index'
        },

        {
            path:'/product/:product_id/:product_slug',  component:ProductPage , name:'product'
        },

        {
            path:'/products', component:ProductsPage , name:'products'
        },

        {
            path:'/tracking', component: TrackingPage , name:'tracking'
        },

        {
            path:'/order/:order_key', component: OrderPage,  name:'order'
        },


        //auth routes
        {
            path:'/login', component:LoginPage , name:'login',meta:{
                guest:true
            }
        },

        {
            path:'/register' , component:RegisterPage, name:'register',meta:{
                guest:true
            }
        },


        //cart and checkout
        {
            path:'/cart' , component:CartPage, name:'cart',meta:{
                requiredAuth: true
            }
        },

        {
            path:'/checkout' , component: CheckoutPage, name:'checkout',meta:{
                requiredAuth: true
            }
        },

        {
            path:'/orders', component:OrdersPage,meta:{
                requiredAuth:true
            }
        },

        //admin routes

        {
            path:'/admin', component:IndexAdmin, name:'admin', meta:{
                requiredAdmin: true
            }
        },

        {
            path:'/admin/products' , component:ProductListAdminPage, name:'adminproducts',meta:{
                requiredAdmin:true
            }
        },

        {
            path:'/admin/products/create', component:ProductCreateAdminPage, name:'adminproductcreate',meta:{
                requiredAdmin:true
            }
        },

        {
            path:'/admin/users', component: UserListAdminPage , name:'adminusers',meta:{
                requiredAdmin: true
            }
        },

        {
            path:'/admin/users/:id/edit', component: UserEditAdminPage , name:'adminusersedit',meta:{
                requiredAdmin: true
            }
        },

        {
            path:'/admin/products/:product_id/:slug/edit', component:ProductEditAdminPage, name:'adminproductsedit',meta:{
                requiredAdmin:true
            }
        },

        {
            path:'/admin/orders', component:OrdersListAdmin, name:'adminorders', meta:{
                requiredAdmin:true
            }
        },
    ]
});
export  default router;

