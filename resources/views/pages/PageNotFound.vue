<template>
    <div class="small-container page-not-found">
        <div class="page-not-found-center">
            <h1 class="title">Page Not Found</h1>
            <router-link :to="{name:'index'}" class="btn">Go to home</router-link>
        </div>

    </div>
</template>

<script>
export default {
    name: "PageNotFound"
}
</script>

<style scoped>

</style>
