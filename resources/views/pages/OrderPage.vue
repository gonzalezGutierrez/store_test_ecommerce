<template>
    <section class="order_details section-margin--small">
        <div class="container">
            <p class="text-center billing-alert">ORDER KEY : {{order.order_key}}</p>
            <div class="row mb-5">
                <div class="col-md-6 col-xl-6 mb-4 mb-xl-0">
                    <div class="confirmation-card">
                        <h3 class="billing-title">Order Info ( {{ order.status }} ) </h3>
                        <table class="order-rable">
                            <tr>
                                <td>Order number</td>
                                <td>: #{{ order.id }}</td>
                            </tr>
                            <tr>
                                <td>Date</td>
                                <td>: {{ order.created_at }}</td>
                            </tr>
                            <tr>
                                <td>Total</td>
                                <td>: ${{ order.total }} USD</td>
                            </tr>
                            <tr>
                                <td>Customer</td>
                                <td>: {{ order.user.name }} </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-md-6 col-xl-6 mb-4 mb-xl-0">
                    <div class="confirmation-card">
                        <h3 class="billing-title">Shipping Address</h3>
                        <table class="order-rable">
                            <tr>
                                <td>Address</td>
                                <td>: {{ order.shipping_address.address }}</td>
                            </tr>
                            <tr>
                                <td>Country</td>
                                <td>: {{ order.shipping_address.country }}</td>
                            </tr>
                            <tr>
                                <td>State</td>
                                <td>: {{ order.shipping_address.state }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="order_details_table">
                <h2>Order Details</h2>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="item in order.cart.items">
                            <td><p> {{ item.name }} </p></td>
                            <td><h5>x {{ item.amount }}</h5></td>
                            <td><p>${{ item.subtotal }} USD</p></td>
                        </tr>
                        <tr>
                            <td><h4>Subtotal</h4></td>
                            <td><h5></h5></td>
                            <td><p>${{ order.total }} USD</p></td>
                        </tr>
                        <tr>
                            <td><h4>Total</h4></td>
                            <td><h5></h5></td>
                            <td><h4>${{ order.total }} USD</h4></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</template>

<script>

import OrderService from '../../services/order';

export default {
    name: "OrderPage",

    data() {
        return {
            order:{}
        }
    },
    mounted() {
        this.getOrder();
    },
    methods:{

        getOrder(){

            let orderKey = this.$route.params.order_key;

            let loading = this.$loading.show({
                container: this.fullPage ? null : this.$refs.formContainer
            });

            OrderService.getOrder(orderKey)
                .then(response => {
                    this.order = response.data;
                    loading.hide();
                })
                .catch(error => {
                    loading.hide();
                    if (error.status == 404 ){
                        this.$router.push({name:'404'});
                    }
                })
        },

    }

}
</script>

<style scoped>

</style>
