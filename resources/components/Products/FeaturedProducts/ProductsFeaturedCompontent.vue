<template>
    <div class="featured__container bd-grid">

        <ProductFeaturedItemComponent :key="product.id" :data-index="index" v-bind:product="product" v-for="(product,index) in featuredProducts">></ProductFeaturedItemComponent>
    </div>
</template>

<script>
import ProductService from "../../../services/Products/ProductService";
import ProductFeaturedItemComponent from "./ProductFeaturedItemComponent";

export default {
    name: "ProductsFeaturedComponent",
    components:{
        ProductFeaturedItemComponent
    },
    data(){
        return {
            featuredProducts:{}
        }
    },
    mounted() {
        this.getFeaturedProducts();
    },
    methods:{

        async getFeaturedProducts() {
            let loader = this.$loading.show({
                container: this.fullPage ? null : this.$refs.formContainer,
                canCancel:false,
                backgroundColor:"rgba(0,0,0,0.9)",
            });
            let response = await ProductService.searchProducts('featured','true');
            this.featuredProducts = response.data.data;
            loader.hide();
        }
    }

}
</script>

<style scoped>

</style>
