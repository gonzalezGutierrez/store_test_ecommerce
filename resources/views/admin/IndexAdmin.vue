<template>
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-3 col-md-3 col-xs-12 col-sm-6">
                <div class="card text-center">
                    <div class="card-header">
                        <i class="fas fa-shopping-basket" style="font-size:80px; color:#03244D;"></i>
                    </div>
                    <div class="card-body ">
                        <h4 class="card-title">Products</h4>
                        <p class="text-uppercase">Products Management </p>
                        <router-link :to="{name:'adminproducts'}" class="btn btn-secondary btn-block">View</router-link>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-xs-12 col-sm-6">
                <div class="card text-center">
                    <div class="card-header">
                        <i class="fas fa-user" style="font-size:80px; color:#03244D;"></i>
                    </div>
                    <div class="card-body ">
                        <h4 class="card-title">Users</h4>
                        <p class="text-uppercase">Users Management </p>
                        <router-link :to="{name:'adminusers'}" class="btn btn-secondary btn-block">View</router-link>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-xs-12 col-sm-6">
                <div class="card text-center">
                    <div class="card-header">
                        <i class="fas fa-money-bill-alt" style="font-size:80px; color:#03244D;"></i>
                    </div>
                    <div class="card-body ">
                        <h4 class="card-title">Orders</h4>
                        <p class="text-uppercase">Orders Management </p>
                        <router-link :to="{name:'adminorders'}" class="btn btn-secondary btn-block">View</router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "IndexAdmin"
}
</script>

<style scoped>

</style>
