<template>
    <div class="new__box">
        <img src="/img/new1.png" alt="">
        <div class="new__link">
            <router-link :to="{name:'product_detail',params:{'product_id':product.id,'product_slug':product.slug}}" class="button">VIEW PRODUCT</router-link>
        </div>
    </div>
</template>

<script>
export default {
    name: "ProductItemNewsComponent",
    props:{
        product:{
            type:Object
        }
    }
}
</script>

<style scoped>

</style>
