<template>
    <div>
        <HeaderComponent></HeaderComponent>
        <main class="l-main">
            <router-view></router-view>
            <FooterComponent></FooterComponent>
        </main>
    </div>
</template>

<script>
import HeaderComponent from "../../components/HeaderComponent";
import FooterComponent from "../../components/FooterComponent";

export default {
    name: "ShopRootShopRoot",
    components:{
        HeaderComponent,
        FooterComponent
    },
    data() {
        return {
            loader:'',
        }
    },
    mounted(){

    },
    created(){

    },

}
</script>

<style scoped>

</style>
