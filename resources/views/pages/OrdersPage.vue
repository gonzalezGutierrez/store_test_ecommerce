<template>
    <OrdersListComponent></OrdersListComponent>
</template>

<script>

import OrdersServices from '../../services/order';
import OrdersListComponent from "../../components/Orders/OrdersListComponent";

export default {
    name: "OrdersPage",
    components:{
        OrdersListComponent
    }

}
</script>

<style scoped>

</style>
