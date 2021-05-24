<template>
    <div class="col-md-6 col-lg-4">

        <div class="card text-center card-product">
            <div class="card-product__img">
                <img class="card-img w-50" :src="product.image_url" alt="">
                <ul class="card-product__imgOverlay">
                    <li><button @click="addToCart(product.id)"><i class="ti-shopping-cart"></i></button></li>
                </ul>
            </div>
            <div class="card-body">
                <router-link class="text-black" :to="{name:'product',params:{product_id:product.id,product_slug:product.slug}}">
                    <h4 class="card-product__title"><a href="#">{{ product.name }}</a></h4>
                    <p class="card-product__price">${{ product.price }} USD </p>
                </router-link>
            </div>
        </div>

    </div>
</template>

<script>

import CartService from "../../services/cart";

export default {
    name: "ProductItemComponent",

    props:{
        product:{
            type:Object
        }
    },

    data() {
        return {

        }
    },
    methods:{

        async addToCart(productId) {

            let cartId = this.$store.getters['cart/getCartId'];

            if (!this.$store.getters.isAuth) {
                return this.$router.push({name:'login'});
            }

            let loader = this.$loading.show({
                container: this.fullPage ? null : this.$refs.formContainer
            });

            CartService.addItem(cartId,{item_id:productId})
                .then((response)=>{
                    loader.hide();
                    this.$toast.open({
                        message: response.message,
                        position:'top-right',
                        type: 'success',
                        // all of other options may go here
                    });
                    this.$store.dispatch('cart/incrementsCart',1);
                })
                .catch((error)=>{
                    loader.hide();
                    console.log(error);
                });
        }
    }
}
</script>

<style scoped>

</style>
