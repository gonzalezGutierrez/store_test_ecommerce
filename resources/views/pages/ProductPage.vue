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
                        <div class="product_count">
                            <label for="qty">Quantity:</label>
                            <input type="text" name="qty" id="sst" size="2" maxlength="12" value="1" title="Quantity:" class="input-text qty">

                            <a class="button primary-btn" href="#">Add to Cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import ProductService from '../../services/product'

export default {
    name: "",
    data(){
        return {
            product:{}
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

            let id = this.$route.params.product_id;
            let slug = this.$route.params.product_slug;

            ProductService.getProduct(id,slug).then((response=>{
                this.product = response.data;
                loader.hide();
            })).catch((error)=>{
                this.$router.push({name:'/404'})
                loader.hide();
            });

        }
    }
}
</script>

<style scoped>

</style>
