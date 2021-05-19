<template>
    <div>

        <section class="home" id="home">
            <div class="home__container bd-grid">
                <div class="home__data">
                    <h1 class="home__title">NEW <br> <span>ARRIVALS</span> </h1>
                    <a href="#feature" class="button">GO SHOPPING</a>
                </div>
            </div>
            <img src="/img/home.png" class="home__img" alt="home__image">
        </section>

        <section class="collection section">
            <div class="collection__container bd-grid">
                <div class="collection__box">
                    <img src="/img/backpackMan.png" class="collection__img" alt="">
                    <div class="collection__data">
                        <h2 class="collection__title"><span class="collection__subtitle">Men</span> <br> BackPack</h2>
                        <a href="" class="collection__view">View Collection</a>
                    </div>
                </div>

                <div class="collection__box">
                    <div class="collection__data">
                        <h2 class="collection__title"><span class="collection__subtitle">Women</span> <br> BackPack</h2>
                        <a href="" class="collection__view">View Collection</a>
                    </div>
                    <img src="/img/backpackWoman.png" class="collection__img" alt="">
                </div>
            </div>
        </section>

        <section class="featured section" id="feature">
            <h2 class="section-title">FEATURED PRODUCTS</h2>
            <a href="" class="section-all">View all</a>

            <ProductsFeaturedCompontent></ProductsFeaturedCompontent>
        </section>

        <section class="offer section">
            <div class="offer__bg">
                <div class="offer__data">
                    <div class="offer__title">Special Offer</div>
                    <p class="offer__description">
                        Special offers discounts for women this week only
                    </p>
                    <a href="" class="button">SHOP NOW</a>
                </div>
            </div>
        </section>

        <section id="new" class="new section">

            <h2 class="section-title">NEW ARRIVALS</h2>
            <a href="" class="section-all">View All</a>

            <ProductsNewsComponent></ProductsNewsComponent>

        </section>

        <section class="newsletter section" id="suscribed">
            <div class="newsletter__container bd-grid" >
                <div class="newsletter__suscribe">
                    <h2 class="section-title">OUR NEWSLETTER</h2>
                    <p class="newsletter__description">
                        Promotion new products and sales. Directly to your
                    </p>
                    <form action="" class="newsletter__form">
                        <input type="text" class="newsletter__input" placeholder="Enter your email...">
                        <a href="" class="button">SUSCRIBE</a>
                    </form>
                </div>
            </div>
        </section>

        <section class="sponsors section">
            <div class="sponsors__container bd-grid">
                <div class="sponsors__logo">
                    <img src="/img/logo1.png" alt="">
                </div>
                <div class="sponsors__logo">
                    <img src="/img/logo2.png" alt="">
                </div>
                <div class="sponsors__logo">
                    <img src="/img/logo3.png" alt="">
                </div>
                <div class="sponsors__logo">
                    <img src="/img/logo4.png" alt="">
                </div>
            </div>
        </section>

    </div>
</template>

<script>

//COMPONENTS
import ProductsNewsComponent from "../../../components/Products/NewArrivals/ProductsNewsComponent";
import ProductsFeaturedCompontent from "../../../components/Products/FeaturedProducts/ProductsFeaturedCompontent";

export default {
    name: "HomeComponent",
    components:{
        ProductsNewsComponent,
        ProductsFeaturedCompontent
    },

}
</script>

<style scoped>

</style>
