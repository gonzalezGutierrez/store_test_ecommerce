<template>
    <router-link :to="{name:'product_detail',params:{'product_id':product.id,'product_slug':product.slug}}">
    <div class="featured__product">
        <div class="featured__box">
            <div class="featured__new">NEW</div>
            <img src="/img/feature1.png" alt="">
        </div>
        <div class="featured__data">
            <h3 class="featured__name">{{product.name}}</h3>
            <span class="featured__price">${{product.price}} USD</span>
        </div>
    </div>
    </router-link>
</template>

<script>
export default {
    name: "ProductFeaturedItemComponent",
    props:{
        product:{
            type:Object
        }
    }
}
</script>

<style scoped>

</style>
