<template>
    <div>
        <div class="card__wrapper">
            <div class="card">
                <div class="product__img">
                    <div class="img__display">
                        <div class="img__showcase">
                            <img src="https://images.unsplash.com/photo-1528921581519-52b9d779df2b?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=893&q=80" alt="">
                        </div>
                    </div>
                </div>
                <div class="product__content">
                    <h2 class="product__title">{{product.name}}</h2>
                    <router-link to="/" class="product__link">{{product.category}}</router-link>
                    <div class="product__rating">
                        <i class='bx bxs-star' ></i>
                        <i class='bx bxs-star' ></i>
                        <i class='bx bxs-star' ></i>
                        <i class='bx bxs-star' ></i>
                        <i class='bx bxs-star' ></i>
                        <span>5(24)</span>
                    </div>
                    <div class="product__price">
                        <p class="product__price">${{product.price}} <span>USD</span> </p>
                    </div>

                    <div class="product__detail">
                        <h2 class="">About its Item</h2>
                        <p>{{product.description}}</p>

                        <ul>
                            <li>Available: <span>in stock</span></li>
                            <li>Category: <span>{{product.category}}</span></li>
                            <li>Shipping Area: <span>All over the world</span></li>
                            <li>Shipping Free: <span>Free</span></li>
                        </ul>
                    </div>

                    <div class="purchase__info">
                        <input type="number" min="1" value="1">
                        <button class="btn">
                            Add to Cart
                            <i class='bx bxs-cart-add' ></i>
                        </button>
                    </div>
                    <div class="social__links">
                        <p>Share At: </p>
                        <a href="">
                            <i class='bx bxl-facebook-square' ></i>
                        </a>
                        <a href="">
                            <i class='bx bxl-instagram' ></i>
                        </a>
                        <a href="">
                            <i class='bx bxl-twitter' ></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import ProductService from "../../../services/Products/ProductService";

export default {

    name: "Product",
    data(){
        return {
            product:{},
            isLoading: true,
            fullPage: true
        }
    },
    mounted() {
        this.getProduct();
    },

    methods:{
        async getProduct() {

            let loader = this.$loading.show({
                container: this.fullPage ? null : this.$refs.formContainer,
                canCancel:false,
                backgroundColor:"rgba(0,0,0,0.9)",
            });

            let id = this.$route.params.product_id;
            let slug = this.$route.params.product_slug;
            let response = await ProductService.getProduct(id,slug);
            this.product = response.data;
            this.isLoading = false;

            loader.hide();
        },
    }
}
</script>

<style scoped lang="scss">

    @import "../../../sass/_variables.scss";
    .card__wrapper {
        max-width: 1024px;
        margin:20px auto;
        display: block;
    }

    img{
        width: 100%;
        display: block;
    }

    .img__display {
        overflow: hidden;
    }

    .img__showcase {
        display: flex;
        width: 100%;
        transition: all 0.5s ease;
    }

    .img__showcase {
        min-width: 100%;
    }

    .product__content{
        padding:2rem 1rem;
    }

    .product__title {
        font-size: 3rem;
        text-transform: capitalize;
        font-weight: 700;
        position: relative;
        color:#12263a;
        margin:1rem 0;
    }

    .product__title:after {
        content:"";
        position:absolute;
        left: 0;
        bottom: 0;
        height: 4px;
        width: 80px;
        background-color: #12263a;
    }

    .product__link {
        text-decoration: none;
        text-transform: uppercase;
        font-weight: 400;
        font-size: 0.9rem;
        display: inline-block;
        margin-bottom: 0.5rem;
        background-color: #E55947;
        color:white;
        padding: 0 0.3rem;
        transition: all 0.5s ease;
    }

    .product__link:hover {
        opacity:0.9;
    }

    .product__rating {
        color:#ffc107;
    }
    .product__rating span {
        font-weight: 600;
        color:#252525;
    }

    .product__price {
        margin:1rem 0;
        font-size:1rem;
        font-weight: 700;
    }

    .product__price span {
        color:#E55947;
    }

    .product__detail h2 {
        text-transform: capitalize;
        color:#12263a;
        padding-bottom: 0.6rem;
    }

    .product__detail p {
        font-size: 0.9rem;
        padding:0.3rem;
        opacity: 0.8;
    }

    .product__detail ul {
        margin:1rem 0;
        font-size: 0.9rem;
    }

    .product__detail ul li {
        margin:0px;
        padding-left:1.7rem;
        margin:0.4rem 0;
        font-weight:600;
        opacity:0.9;
    }

    .product__detail ul li span {
        font-weight: 400;
    }

    .purchase__info {
        margin:1.5rem;
    }
    .purchase__info .btn {
        background-color: $first-color;
        font-width: bold;
        color:white;
        cursor: pointer;
    }

    .purchase__info .btn:hover{
        background-color:$first-color-alt;
    }
    .purchase__info input , .purchase__info .btn {
        border:1.5px solid #ddd;
        border-radius: 25px;
        text-align: center;
        padding:0.45rem 0.8rem;
        outline:0;
        margin-right: 0.2rem;
        margin-bottom:1rem;
    }

    .purchase__info input {
        width:85px;
    }

    .social__links {
        display: flex;
        align-items: center;
    }

    .social__links a  {
        display:flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        color:#000;
        border:1px solid #000;
        margin:0 0.2rem;
        border-radius: 50%;
        text-decoration: none;
        font-size: 0.8rem;
        transition: all 0.5s ease;
    }

    .social__links a:hover {
        background-color: #000;
        border-color:transparent;
        color:#fff;
    }

    @media screen and (min-width: 992px) {
        .card {
            display: grid;
            grid-template-columns: repeat(2,1fr);
            grid-gap:1.5rem;
        }

        .card__wrapper {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .product__content {
            padding-top:0;
        }
    }

</style>
