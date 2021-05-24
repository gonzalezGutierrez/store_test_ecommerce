<template>
    <div class="product_image_area mb-5">
        <div class="container">
            <div class="row s_product_inner">
                <div class="col-lg-6">
                    <div class="owl-carousel owl-theme s_Product_carousel">
                        <div class="single-prd-item">
                            <img class="img-fluid" :src="product.image_url" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1">
                    <div class="s_product_text">
                        <h3>{{ product.name }}</h3>
                        <h2>$ {{ product.price }} </h2>
                        <ul class="list">
                            <li><a href="#"><span>Availibility</span> : In Stock</a></li>
                        </ul>
                        <p class="text-justify">
                            {{ product.description }}
                        </p>
                        <div class="product_count" style="color:#000 !important;">
                            <label for="qty">Quantity:</label>

                            <input type="text" name="qty" v-model="amount" value="1"  class="" style="color:#333 !important;">

                            <a class="button primary-btn btn-sm" @click="addToCart" href="#">Add to Cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>

import ProductService from '../../services/product'
import CartService from "../../services/cart";

export default {
    name: "",
    data(){
        return {
            product:{},
            productId:'',
            amount:''
        }
    },
    mounted() {
        this.getProduct();
    },
    methods:{
        getProduct() {

            let loader = this.$loading.show({
                container: this.fullPage ? null : this.$refs.formContainer,
                canCancel: false,
            });

            this.productId = this.$route.params.product_id;
            let slug = this.$route.params.product_slug;

            ProductService.getProduct(this.productId,slug).then((response=>{
                this.product = response.data;
                loader.hide();
            })).catch((error)=>{
                this.$router.push({name:'/404'})
                loader.hide();
            });

        },
        async addToCart() {

            let cartId = this.$store.getters['cart/getCartId'];

            if (!this.$store.getters.isAuth) {
                return this.$router.push({name:'login'});
            }

            let loader = this.$loading.show({
                container: this.fullPage ? null : this.$refs.formContainer
            });

            let item = {
                item_id:this.productId,
                amount:this.amount
            }

            CartService.addItem(cartId,item)
                .then((response)=>{
                    loader.hide();
                    this.$toast.open({
                        message: response.message,
                        position:'top-right',
                        type: 'success',
                        // all of other options may go here
                    });
                    this.$store.dispatch('cart/incrementsCart',this.amount);
                    this.$router.push({name:'cart'});
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
