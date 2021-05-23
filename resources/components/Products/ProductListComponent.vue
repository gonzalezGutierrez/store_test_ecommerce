<template>
    <section class="section-margin--small mb-5">
       <div class="container">
           <div class="row">
               <div class="col-xl-12 col-lg-12 col-md-12">

                   <div class="filter-bar d-flex flex-wrap align-items-center">
                       <div class="sorting">
                           <select>
                               <option value="1">Default sorting</option>
                               <option value="1">Default sorting</option>
                               <option value="1">Default sorting</option>
                           </select>
                       </div>
                       <div class="sorting mr-auto">
                           <select>
                               <option value="1">Show 12</option>
                               <option value="1">Show 12</option>
                               <option value="1">Show 12</option>
                           </select>
                       </div>
                       <div>
                           <div class="input-group filter-bar-search">
                               <input type="text" placeholder="Search">
                               <div class="input-group-append">
                                   <button type="button"><i class="ti-search"></i></button>
                               </div>
                           </div>
                       </div>
                   </div>

                   <section class="lattest-product-area pb-40 category-list">
                       <div class="row">
                           <div class="col-md-6 col-lg-4" v-for="product in products">

                                   <div class="card text-center card-product">
                                       <div class="card-product__img">
                                           <img class="card-img w-50" :src="product.image_url" alt="">
                                           <ul class="card-product__imgOverlay">
                                               <li><button @click="addToCart(product.id)"><i class="ti-shopping-cart"></i></button></li>
                                           </ul>
                                       </div>
                                       <div class="card-body">
                                           <router-link class="text-black" :to="{name:'product',params:{product_id:product.id,product_slug:product.slug}}">
                                               <h4 class="card-product__title"><a href="#">{{ product.name }}</a></h4>
                                               <p class="card-product__price">${{ product.price }} USD </p>
                                           </router-link>
                                       </div>
                                   </div>

                           </div>
                       </div>
                       <nav aria-label="Page navigation example">
                           <ul class="pagination">
                               <li @click.prevent="getPreviousPage" :class="[ ! paginate.prev ? 'disabled' : '']"   class="page-item"><a class="page-link" href="#">Previous</a></li>
                               <li class="page-item" @click.prevent="getPage(page)"  v-if="paginate.last_page != 1"  :class="[paginate.current_page == page ? 'active' : '']" v-for="page in paginate.last_page">
                                   <a class="page-link" href="#">{{ page }}</a>
                               </li>
                               <li @click.prevent="getNextPage" :class="[ ! paginate.next ? 'disabled' : '']"  class="page-item"><a class="page-link" href="#">Next</a></li>
                           </ul>
                       </nav>
                   </section>

               </div>
           </div>
       </div>
   </section>
</template>

<script>
import ProductService from "../../services/product";
import CartService from '../../services/cart';

export default {
    name: "ProductListComponent",
    computed:{
        isUserAdmin(){
            return this.$store.getters.isUserAdmin;
        }
    },
    data(){
        return {
            products:{},
            paginate:{
                prev:false,
                next:false,
                last_page:0,
                current_page:1
            },
            fullPage: false
        }
    },

    mounted() {
       this.getPageOne();
    },

    methods: {

        productDelete(id) {

            this.$swal({
                title: 'Remove product',
                text: "Are you sure you want to remove this product?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((desicion) => {

                if (desicion.value) {

                    this.$swal('Great', 'Product deleted!', 'success')
                        .then(() => {

                            let loader = this.$loading.show({
                                container: this.fullPage ? null : this.$refs.formContainer
                            });

                            ProductService.deleteProduct(id)
                                .then((response) => {
                                    this.getPage(this.paginate.current_page);
                                    loader.hide();
                                }).catch((error => {
                                    loader.hide();
                                })
                            );
                        });
                }
            });
        },

        getPageOne() {
            this.getProducts(this.paginate.current_page);
        },

        getPage(page) {
            this.setCurrentPage(page);
            this.getProducts();
        },

        getPreviousPage() {
            let page = this.paginate.prev.split('?page=');
            this.setCurrentPage(page[1]);
            this.getPage();
        },

        getNextPage() {
            let page = this.paginate.next.split('?page=');
            this.setCurrentPage(page[1]);
            this.getPage();
        },

        getProducts() {

            let loader = this.$loading.show({
                container: this.fullPage ? null : this.$refs.formContainer,
                canCancel: false,
            });

            ProductService.getProducts(this.paginate.current_page)
                .then((response) => {

                    this.paginate.prev = response.data.links.prev;
                    this.paginate.next = response.data.links.next;
                    this.paginate.last_page = response.data.meta.last_page;
                    this.paginate.current_page = response.data.meta.current_page;

                    this.products = response.data.data;

                    loader.hide();


                }).catch((error => {
                    loader.hide();
                })
            );
        },

        setCurrentPage(page) {
            this.paginate.current_page = page;
        },

        async addToCart(productId) {


            let cartId = this.$store.getters['cart/getCartId'];

            let loader = this.$loading.show({
                container: this.fullPage ? null : this.$refs.formContainer
            });


            CartService.addItem(cartId,{item_id:productId})
                .then((response)=>{
                    loader.hide();
                    this.$toast.open({
                        message: response.message,
                        position:'top-right',
                        type: 'success',
                        // all of other options may go here
                    });
                    this.$store.dispatch('cart/incrementsCart',1);
                })
                .catch((error)=>{
                    loader.hide();
                    console.log(error);
                });


        }




    }
}
</script>

<style scoped>

</style>
