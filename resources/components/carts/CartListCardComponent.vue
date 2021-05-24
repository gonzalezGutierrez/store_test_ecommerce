<template>
    <div>
        <ul class="list">
            <li><a href="#"><h4>Product <span>Total</span></h4></a></li>
            <li v-for="item in cart.items">
                <a href="#">
                    {{ item.name }} ({{ item.amount }})
                    <span class="last">${{ item.subtotal }} USD</span>
                </a>
            </li>
        </ul>
        <ul class="list list_2">
            <li><a href="#">Subtotal <span>${{ cart.total }} USD </span></a></li>
            <li><a href="#">Total <span>${{ cart.total }} USD</span></a></li>
        </ul>
        <div class="creat_account">

        </div>
    </div>
</template>

<script>
export default {
    name: "CartListCardComponent",
    props:{
        cart:{
            type:Object
        }
    }
}
</script>

<style scoped>

</style>
