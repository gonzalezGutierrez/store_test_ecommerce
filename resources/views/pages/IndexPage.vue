<template>

    <main class="site-main">

        <!--================ Hero banner start =================-->
        <section class="hero-banner">
            <div class="container">
                <div class="row no-gutters align-items-center pt-60px">
                    <div class="col-5 d-none d-sm-block">
                        <div class="hero-banner__img">
                            <img class="img-fluid" src="/img/home/hero-banner.png" alt="">
                        </div>
                    </div>
                    <div class="col-sm-7 col-lg-6 offset-lg-1 pl-4 pl-md-5 pl-lg-0">
                        <div class="hero-banner__content">
                            <h4>Shop is fun</h4>
                            <h1>Browse Our Premium Product</h1>
                            <p>Us which over of signs divide dominion deep fill bring they're meat beho upon own earth without morning over third. Their male dry. They are great appear whose land fly grass.</p>
                            <router-link class="button button-hero" :to="{name:'products'}">Browse Now</router-link>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================ Hero banner start =================-->


        <!-- ================ trending product section start ================= -->
        <section class="section-margin calc-60px">
            <div class="container">
                <div class="section-intro pb-60px d-flex justify-content-between align-items-center">
                    <div class="">
                        <p>Popular Item in the market</p>
                        <h2>Featured  <span class="section-intro__style">Products</span></h2>
                    </div>
                    <div class="">
                        <router-link class="text-black-50" :to="{name:'products'}">View all</router-link>
                    </div>
                </div>
                <div class="row">
                    <ProductItemComponent :key="product.id" :data-index="index" v-bind:product="product" v-for="(product,index) in products"></ProductItemComponent>
                </div>
            </div>
        </section>

    </main>


</template>

<script>

import ProductItemComponent from "../../components/Products/ProductItemComponent";

import ProductService from '../../services/product';

export default {
    name: "IndexPage",

    components:{
        ProductItemComponent
    },

    data() {
        return {
            products:{}
        }
    },

    mounted() {
        this.getNewProducts();
    },

    methods:{
        getNewProducts() {

            let loader = this.$loading.show({
                container: this.fullPage ? null : this.$refs.formContainer,
                canCancel: false,
            });

            ProductService.searchProducts('news','true')
                .then(response=>{
                    this.products = response.data.data;
                    loader.hide();
                }).catch(error => {
                    console.log(error.response);
                    loader.hide();
                });
        }
    }
}
</script>

<style scoped>

</style>
