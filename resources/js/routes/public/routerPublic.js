import PageNotFound from "../../../views/pages/PageNotFound";
import IndexPage from "../../../views/pages/IndexPage";
import ProductPage from "../../../views/pages/ProductPage";
import ProductsPage from "../../../views/pages/ProductsPage";
import CartPage from "../../../views/pages/CartPage";
import TrackingPage from "../../../views/pages/TrakingPage";

export default  [
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
        path:'/cart' , component:CartPage, name:'cart'
    },

    {
        path:'/tracking', component: TrackingPage , name:'tracking'
    },

]
