<template>

    <div class="container text-center mt-5">
        <h1 style="font-size: 120px; text-align: center;">Page Not Found</h1> <br>
        <router-link :to="{name:'index'}" class="btn btn-primary"> <i class="fas fa-home"></i> Go to home</router-link>
    </div>

</template>

<script>
export default {
    name: "PageNotFound"
}
</script>

<style scoped>

</style>
