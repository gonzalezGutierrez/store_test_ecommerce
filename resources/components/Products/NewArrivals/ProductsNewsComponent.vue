<template>
    <div class="new__container bd-grid">

        <ProductItemNewsComponent :key="product.id" :data-index="index" v-bind:product="product" v-for="(product,index) in newsProducts">
        </ProductItemNewsComponent>

    </div>
</template>

<script>

import ProductService from "../../../services/Products/ProductService";

import ProductItemNewsComponent from "./ProductItemNewsComponent";

export default {
    name: "ProductsNewsComponent",
    components:{
        ProductItemNewsComponent
    },
    data(){
        return {
            newsProducts:{},
        }
    },
    mounted() {
        this.getNewsProducts();
    },
    methods:{
        async getNewsProducts(){
            let response = await ProductService.searchProducts('news','true');
            this.newsProducts = response.data.data;
        },
    }
}
</script>

<style scoped>

</style>
