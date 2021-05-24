<template>
    <section class="tracking_box_area section-margin--small">
        <div class="container">
            <div class="tracking_box_inner">
                <p>To track your order please enter your Order ID in the box below and press the "Track" button.</p>
                <form class="row tracking_form">
                    <div class="col-md-12 form-group">
                        <input type="text" class="form-control"  v-model="orderkey" name="order" placeholder="Order ID">
                    </div>
                    <div class="col-md-12 form-group">
                        <button type="button" @click="searchOrder" class="button button-tracking">Track Order</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: "TrackingPage",

    data(){
        return {
            orderkey:''
        }
    },
    methods:{
        searchOrder() {
            this.$router.push({name:'order',params:{order_key:this.orderkey}});
        }
    }
}
</script>

<style scoped>

</style>
