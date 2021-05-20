<template>
    <section class="featured section" id="feature">
        <h2 class="section-title">FEATURED PRODUCTS</h2>
        <a href="" class="section-all">View all</a>
        <div class="featured__container bd-grid">
            <ProductFeaturedItemComponent
                :key="product.id"
                :data-index="index"
                v-bind:product="product"
                v-for="(product,index) in products">

            </ProductFeaturedItemComponent>
        </div>
    </section>
</template>

<script>
import ProductFeaturedItemComponent from "../../../components/Products/FeaturedProducts/ProductFeaturedItemComponent";
import ProductService from "../../../services/Products/ProductService";

export default {

    name: "Collections",
    components:{
        ProductFeaturedItemComponent
    },
    data() {
        return {
            products:{}
        }
    },
    mounted() {
        this.getProducts();
    },
    methods:{
        async getProducts() {

            let loader = this.$loading.show({
                container: this.fullPage ? null : this.$refs.formContainer,
                canCancel:false,
                backgroundColor:"rgba(0,0,0,0.9)",
            });

            let param = this.$route.params.collection;

            let filter = this.getCollectionByParams(param);

            let response = await ProductService.searchProducts('category',filter);

            this.products = response.data;

            loader.hide();

        },

        getCollectionByParams(param) {

            if (param === 'women') return 1;

            return 2;

            return (param === 'women')
                ? 1
                : 'men';

        }


    }

}
</script>

<style scoped>

</style>
