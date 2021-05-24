<template>
    <section class="cart_area">
        <div class="container">
            <div class="cart_inner">
                <div class="table-responsive">
                    <CartListTableComponent :cart="cart"></CartListTableComponent>
                </div>
            </div>
        </div>
    </section>
</template>

<script>

import CartService from '../../services/cart';
import CartListTableComponent from "../../components/carts/CartListTableComponent";

export default {
    name: "CartPage",
    components:{
        CartListTableComponent
    },
    data() {
        return {
            cartId:this.$store.getters['cart/getCartId'],
            cart : {}
        }
    },
    mounted() {
        this.getCart();
    },
    methods:{
        getCart() {

            let loader = this.$loading.show({
                container: this.fullPage ? null : this.$refs.formContainer
            });

            CartService.getCart(this.cartId)
                .then((response)=>{
                    this.cart = response;
                    console.log(response);
                    loader.hide();
                }).
            catch((error)=>{
                console.log(error);
                loader.hide();
            });
        }
    }

}
</script>

<style scoped>

</style>
