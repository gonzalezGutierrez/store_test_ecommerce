<template>
    <section class="section-margin--small mb-5">
       <div class="container">
           <div class="row">
               <div class="col-xl-12 col-lg-12 col-md-12">
                   <section class="lattest-product-area pb-40 category-list">
                       <div class="row">
                           <ProductItemComponent :key="product.id" :data-index="index" v-bind:product="product" v-for="(product,index) in products"></ProductItemComponent>
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
import ProductItemComponent from "./ProductItemComponent";

export default {
    name: "ProductListComponent",
    components:{
        ProductItemComponent
    },
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




    }
}
</script>

<style scoped>

</style>
