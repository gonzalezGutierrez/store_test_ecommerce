<template>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Product</th>
            <th scope="col">Price</th>
            <th scope="col">Quantity</th>
            <th scope="col">Total</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="item in cart.items">
            <td>
                <router-link class="text-black-50" :to="{name:'product',params:{product_id:item.id,product_slug:item.slug}}">
                    <div class="media">
                        <div class="d-flex">
                            <img style="width: 85px" :src="item.image_url" alt="">
                        </div>
                        <div class="media-body">
                            <p>{{item.name}}</p> <br>
                            <a href="#" @click="deleteToCart(item)" class="text-danger"> <i class="fas fa-trash"></i> Remove</a>
                        </div>
                    </div>
                </router-link>
            </td>
            <td>
                <h5>${{ item.price }} USD </h5>
            </td>
            <td>
                {{ item.amount }}
            </td>
            <td>
                <h5>${{ item.subtotal }} USD </h5>
            </td>
        </tr>
        <tr>
            <td>

            </td>
            <td>

            </td>
            <td>
                <h5>Subtotal</h5>
            </td>
            <td>
                <h5>${{ cart.total }} USD</h5>
            </td>
        </tr>
        <tr class="shipping_area">
            <td class="d-none d-md-block">

            </td>
            <td>

            </td>
            <td>
                <h5>Total</h5>
            </td>
            <td>
                <h5>${{ cart.total }} USD</h5>
            </td>
        </tr>
        <tr class="out_button_area">
            <td class="d-none-l">

            </td>
            <td class="">

            </td>
            <td>

            </td>
            <td>
                <div class="checkout_btn_inner d-flex align-items-center">
                    <router-link :to="{name:'products'}" class="gray_btn" >Continue Shopping</router-link>
                    <router-link :to="{name:'checkout'}" class="primary-btn ml-2">Proceed to checkout</router-link>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</template>

<script>

import CartService from '../../services/cart';

export default {
    name: "CartListTableComponent",

    props:{
        cart:{
            type:Object
        }
    },

    methods:{
        deleteToCart(item) {
            let cartId = this.$store.getters['cart/getCartId'];

            CartService.removeItem(cartId,item).then(response=>{
                this.$store.dispatch('cart/decrementCart',item.amount);
            }).catch(error => {
                console.log(error);
            });
        }
    }

}
</script>

<style scoped>

</style>
