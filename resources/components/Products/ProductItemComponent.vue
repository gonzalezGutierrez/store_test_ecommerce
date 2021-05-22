<template>

</template>

<script>

import ProductService from "../../services/product";

export default {
    name: "ProductItemComponent",
    props:{
        product:{
            type:Object
        },
        isUserAdmin:{
            type:Boolean
        }
    },

    methods:{

    }

}
</script>

<style scoped>

</style>
