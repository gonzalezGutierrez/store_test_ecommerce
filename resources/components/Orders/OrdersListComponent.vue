<template>
    <section class="cart_area">
        <div class="container">
            <div class="row d-flex justify-content-between align-items-center" >
                <h4>Orders </h4>
            </div>
            <div class="cart_inner">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">CODE</th>
                            <th scope="col">Total</th>
                            <th scope="col">Date</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="order in orders">
                            <td>{{ order.order_key }}</td>
                            <td> ${{ order.total }} USD </td>
                            <td> {{ order.created_at }} </td>
                            <td> <span class="badge text-white text-uppercase bg-success"> <i class="fa fa-check-circle"></i> {{ order.status }}</span> </td>
                            <td>
                                <router-link class="btn btn-sm btn-primary" :to="{name:'order',params:{order_key:order.order_key}}"> <i class="fas fa-chevron-right "></i> </router-link>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </section>
</template>

<script>

import OrdersServices from "../../services/order";

export default {
    name: "OrdersListComponent",
    computed:{
        userIdAdmin() {
            return this.$store.getters.isUserAdmin;
        }
    },
    data() {
        return {
            orders:{}
        }
    },
    mounted() {
        this.getOrders();
    },
    methods:{

        getOrders() {

            let loading = this.$loading.show({
                container: this.fullPage ? null : this.$refs.formContainer
            });

            OrdersServices.getOrders()
                .then(response=> {
                    this.orders = response.data;

                    console.log(this.orders[0].user.name);
                    loading.hide();
                })
                .catch(error=>{
                    loading.hide();
                    console.log(error);
                });
        }

    }
}
</script>

<style scoped>

</style>
